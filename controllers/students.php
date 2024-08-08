<?php
class Students extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('students/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        if($this->model->check_exit_user_id_class($this->_Info[0]['id'], $this->_Year[0]['id']) > 0){
            // ton tai xep lop
            $classid = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
            $jsonObj = $this->model->getFetObj_user($this->_Year[0]['id'], $classid, $keyword, $offset, $rows);
        }else{
            $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        }
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('students/json');
    }

    function add(){
        $code = $_REQUEST['code']; $identifier = $_REQUEST['identifier']; $fullname = $_REQUEST['fullname'];
        $nickname = $_REQUEST['nickname']; $birthday = $this->_Convert->convertDate($_REQUEST['birthday']);
        $gender = $_REQUEST['gender']; $createat = date("Y-m-d H:i:s"); $relationdc = json_decode($_REQUEST['relation_dc'], true);
        $image = $this->_Convert->convert_file($_FILES['image']['name'], $code);
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $address = $_REQUEST['address']; $classid = $_REQUEST['class_id'];
        /************************************************************************************************************** */
        if($this->model->dupliObj(0, $code, $identifier) > 0){
            $jsonObj['msg'] = "Mã học sinh hoặc mã định danh đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "identifier" => $identifier, "fullname" => $fullname, 'nickname' => $nickname, 'birthday' => $birthday,
                            'gender' => $gender, "image" => $image, 'status' => 1, 'create_at' => $createat);
            $temp = $this->model->addObj($data);
            if($temp){
                /*******************tai hinh anh********************** */
                move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/students/images/'.$image);
                /******** thong tin dia chi*******************/
                $data_address = array("student_code" => $code, "address" => $address);
                $temp_add = $this->model->addObj_address($data_address);
                if($temp_add){
                    /****************thong tin lop hoc ***************************** */
                    $data_class = array("student_code" => $code, "year_id" => $this->_Year[0]['id'], "class_id" => $classid, "create_at" => date("Y-m-d H:i:s"));
                    $this->model->addObj_class($data_class);
                    /*******************thong tin phu huynh********************/
                    if(count($relationdc) > 0){
                        foreach($relationdc as $row){
                            $data_relation = array("student_code" => $code, "fullname" => $row['fullname'], "phone" => $row['phone'], "email" => $row['email'],
                                                'job' => $row['job'], "number_cart" => $row['number_cart'], "birthday" => $row['birthday'], 
                                                'relationship_id' => $row['relationship_id']);
                            $this->model->addObj_relation($data_relation);
                        }
                        $jsonObj['msg'] = "Ghi dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Ghi dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }else{
                    $jsonObj['msg'] = "Thông tin địa chỉ không được ghi thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("students/add");
    }

    function del(){
        $id = $_REQUEST['id']; $info = $this->model->get_info($id);
        $temp = $this->model->delObj($id);
        if($temp){
            if(file_exists(DIR_UPLOAD.'/students/images/'.$$info[0]['image'])){
                if(unlink(DIR_UPLOAD.'/students/images/'.$info[0]['image'])){
                    $jsonObj['msg'] = "Xóa dữ liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Xóa dữ liệu thành công, hình ảnh chưa được xóa khỏi hệ thống";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Xóa dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("students/del");
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function form_info(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("students/form_info");
    }

    function update_info(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code']; $identifier = $_REQUEST['identifier']; $gender = $_REQUEST['gender']; $img_old = $_REQUEST['image_old'];
        $fullname = $_REQUEST['fullname']; $nickname = $_REQUEST['nickname']; $birthday = $this->_Convert->convertDate($_REQUEST['birthday']);
        $image = ($_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], $code) : $img_old;
        if($this->model->dupliObj($id, $code, $identifier) > 0){
            $jsonObj['msg'] = "Mã học sinh hoặc mã định danh đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            if(!isset($_REQUEST['edit'])){
                $data = array('identifier' => $identifier, "fullname" => $fullname, "nickname" => $nickname, "birthday" => $birthday, "gender" => $gender,
                                "image" => $image);
            }else{
                $data = array('identifier' => $identifier, "fullname" => $fullname, "nickname" => $nickname, "birthday" => $birthday, "gender" => $gender,
                                "image" => $image, "code" => $code);
            }
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($_FILES['image']['name'] != ''){
                    // xoa anh cu
                    if(file_exists(DIR_UPLOAD.'/students/images/'.$img_old)){
                        if(unlink(DIR_UPLOAD.'/students/images/'.$img_old)){
                            if(move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/students/images/'.$image)){
                                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                                $jsonObj['success'] = true;
                                $this->view->jsonObj = json_encode($jsonObj);
                            }else{
                                $jsonObj['msg'] = "Ảnh đại diện không upload thành công";
                                $jsonObj['success'] = false;
                                $this->view->jsonObj = json_encode($jsonObj);
                            }
                        }else{
                            $jsonObj['msg'] = "Thay đổi ảnh không thành công, vui lòng liên hệ quản trị viên";
                            $jsonObj['success'] = false;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }else{
                        if(move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/students/images'.$image)){
                            $jsonObj['msg'] = "Ghi dữ liệu thành công";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }else{
                            $jsonObj['msg'] = "Ảnh đại diện không upload thành công";
                            $jsonObj['success'] = false;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }
                }else{
                    $jsonObj['msg'] = "Ghi dữ liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('students/update_info');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function import_student(){
        require('layouts/header.php');
        $this->view->render('students/import_student');
        require('layouts/footer.php');
    }

    function json_temp(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_temp($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('students/json_temp');
    }

    function import(){
        $temp = $this->model->delObj_temp();
        if($temp){
            $classid = $_REQUEST['class_id'];
            $file = $_FILES['file_tmp']['tmp_name'];
            $objFile = PHPExcel_IOFactory::identify($file);
            $objData = PHPExcel_IOFactory::createReader($objFile);
            $objData->setReadDataOnly(true);
            $objPHPExcel = $objData->load($file);
            $sheet = $objPHPExcel->setActiveSheetIndex(0);
            $Totalrow = $sheet->getHighestRow();
            $LastColumn = $sheet->getHighestColumn();
            $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
            $data = [];
            for ($i = 4; $i <= $Totalrow; $i++) {
                for ($j = 1; $j < $TotalCol; $j++) {
                    //$data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
                    if($j == 1){
                        $code = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 2){
                        $madinhdanh = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 3){
                        $fullname = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 4){
                        $nickname = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 5){
                        $gender = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 6){
                        $birthday = $this->_Convert->convertDate_Import($sheet->getCellByColumnAndRow($j, $i)->getValue());
                    }elseif($j == 7){
                        $address = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 8){
                        $name_fa = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 9){
                        $year_fa = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 10){
                        $phone_fa = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 11){
                        $name_mo = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 12){
                        $year_mo = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 13){
                        $phone_mo = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }
                }
                if($this->model->dupliObj(0, $code, $madinhdanh) == 0){
                    $data = array("code" => $code, "identifier" => $madinhdanh, "fullname" => $fullname, 'nickname' => $nickname, 
                                'birthday' => $birthday, 'gender' => $gender, 'status' => 99, 'create_at' => date("Y-m-d H:i:s"),
                                'image' => '');
                    $temp_info = $this->model->addObj($data);
                    if($temp_info){
                        // dia chi
                        $data_address = array("student_code" => $code, "address" => $address);
                        $this->model->addObj_address($data_address);
                        // lop hoc
                        $data_class = array("student_code" => $code, "year_id" => $this->_Year[0]['id'], "class_id" => $classid, "create_at" => date("Y-m-d H:i:s"));
                        $this->model->addObj_class($data_class);
                        // quan he cua hoc sinh
                        if($name_fa != '' && $year_fa != '' && $phone_fa != ''){
                            $data_relation_fa = array("student_code" => $code, "fullname" => $name_fa, "phone" => $phone_fa, "birthday" => $year_fa, 
                                                    'relationship_id' => 1, 'email' => '', 'number_cart' => '', 'job' => '');
                            $this->model->addObj_relation($data_relation_fa);
                        }
                        if($name_mo != '' && $year_mo != '' && $phone_mo != ''){
                            $data_relation_mo = array("student_code" => $code, "fullname" => $name_mo, "phone" => $phone_mo, "birthday" => $year_mo, 
                                                    'relationship_id' => 2, 'email' => '', 'number_cart' => '', 'job' => '');
                            $this->model->addObj_relation($data_relation_mo);
                        }
                    }else{
                        $jsonObj['msg'] = "Import dữ liệu không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }
            $jsonObj['msg'] = "Import dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Import dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('students/import');
    }

    function del_all_temp(){
        $temp = $this->model->delObj_temp();
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("students/del_all_temp");
    }

    function del_temp(){
        $temp = $this->model->delObj($_REQUEST['id']);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("students/del_temp");
    }

    function update_temp(){
        $data = array("status" => 1);
        $temp = $this->model->updateObj_all($data);
        if($temp){
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("students/update_temp");
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detail(){
        $id = $_REQUEST['id'];
        /////////////////////////////////////////////////////////////////////////////////////
        $info = $this->model->get_info($id);
        $this->view->jsonObj = $info;
        /////////////////////////////////////////////////////////////////////////////////////
        $add = $this->model->get_address_student($info[0]['code']);
        $this->view->add = $add;
        /////////////////////////////////////////////////////////////////////////////////////
        $relation = $this->model->get_relation_student($info[0]['code']);
        $this->view->relation = $relation;
        /////////////////////////////////////////////////////////////////////////////////////
        $class_stu = $this->model->get_class_student($info[0]['code']);
        $this->view->class_stu = $class_stu;
        /////////////////////////////////////////////////////////////////////////////////////
        $class_change = $this->model->get_class_change_student($info[0]['id']);
        $this->view->class_change= $class_change;
        $this->view->render("students/detail");
    }

    function qrcode(){
        $dir_temp = DIR_UPLOAD.'/students/qrcode/'; $filename = $dir_temp.'test.png';
        $level = 'H'; $size = 6; $code = $_REQUEST['code'];
        $filename = $dir_temp.'test'.md5($code.'|'.$level.'|'.$size).'.png';
        if(file_exists($dir_temp.$filename)){
            unlink($dir_temp.$filename);
        }
        QRcode::png($code, $filename, $level, $size, 2);
        $jsonObj['msg'] = "Mã QRcode đã tạo thành công";
        $jsonObj['success'] = true;
        $jsonObj['qrcode'] = basename($filename);
        $this->view->jsonObj  = json_encode($jsonObj);
        $this->view->render("students/qrcode");
    }
}
?>