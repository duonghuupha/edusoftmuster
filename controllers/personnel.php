<?php
class Personnel extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('personnel/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('personnel/json');
    }

    function add(){
        $code = $_REQUEST['code']; $fullname = $_REQUEST['fullname']; $birthday = $this->_Convert->convertDate($_REQUEST['birthday']);
        $gender = $_REQUEST['gender']; $phone = $_REQUEST['phone']; $address = $_REQUEST['address']; $email = $_REQUEST['email'];
        $level = $_REQUEST['level_id']; $job = $_REQUEST['job_id']; $regency = $_REQUEST['regency_id']; $status = 1; $create_at = date("Y-m-d H:i:s");
        if($_FILES['image']['name'] != ''){
            $image = $this->_Convert->convert_file($_FILES['image']['name'], "Personnel");
        }else{
            $image = "";
        }
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã nhân sự đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "fullname" => $fullname, "birthday" => $birthday, "gender" => $gender, "phone" => $phone,
                            "address" => $address, "email" => $email, "level_id" => $level, "job_id" => $job, "regency_id" => $regency,
                            "status" => $status, "create_at" => $create_at, "image" => $image);
            $temp = $this->model->addObj($data);
            if($temp){
                if($_FILES['image']['name'] != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/personnel/avatar/'.$image);
                }
                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("personnel/add");
    }

    function update(){
        $code = $_REQUEST['code']; $fullname = $_REQUEST['fullname']; $birthday = $this->_Convert->convertDate($_REQUEST['birthday']);
        $gender = $_REQUEST['gender']; $phone = $_REQUEST['phone']; $address = $_REQUEST['address']; $email = $_REQUEST['email'];
        $level = $_REQUEST['level_id']; $job = $_REQUEST['job_id']; $regency = $_REQUEST['regency_id']; $id = $_REQUEST['id'];
        if($_FILES['image']['name'] != ''){
            $image = $this->_Convert->convert_file($_FILES['image']['name'], "Personnel");
        }else{
            $image = $_REQUEST['image_old'];
        }
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "Mã nhân sự đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("fullname" => $fullname, "birthday" => $birthday, "gender" => $gender, "phone" => $phone,
                            "address" => $address, "email" => $email, "level_id" => $level, "job_id" => $job, "regency_id" => $regency,
                            "image" => $image, "code" => $code);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($_FILES['image']['name'] != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/personnel/avatar/'.$image);
                }
                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("personnel/update");
    }

    function del(){
        $id = $_REQUEST['id']; $info = $this->model->get_info($id);
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("personnel/del");
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("personnel/change");
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detail(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id); $this->view->jsonObj = $jsonObj;
        $this->view->render("personnel/detail");
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function import(){
        if($this->_Data->check_functions_role($this->_Info[0]['id'], 4, 'personnel') > 0 || $this->_Info[0]['id'] == 1){
            require('layouts/header.php');
            $this->view->render('personnel/import');
            require('layouts/footer.php');
        }else{
            session_start();
            session_destroy();
            header ('Location: '.URL.'/index/login');
            exit;
        }
    }

    function json_temp(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_temp($keyword, $offset, $rows);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('personnel/json_temp');
    }

    function do_import(){
        $temp = $this->model->delObj_temp();
        if($temp){
            try{
                $file = $_FILES['file_tmp']['tmp_name'];
                $objFile = PHPExcel_IOFactory::identify($file);
                $objData = PHPExcel_IOFactory::createReader($objFile);
                $objData->setReadDataOnly(true);
                $objPHPExcel = $objData->load($file);
                $sheet = $objPHPExcel->setActiveSheetIndex(0);
                $Totalrow = $sheet->getHighestRow();
                $LastColumn = $sheet->getHighestColumn();
                $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
                for ($i = 4; $i <= $Totalrow; $i++) {
                    for ($j = 1; $j < $TotalCol; $j++) {
                        //$data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
                        if($j == 1){
                            $code = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                        }elseif($j == 2){
                            $fullname = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                        }elseif($j == 3){
                            $gender = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                        }elseif($j == 4){
                            $birthday = $this->_Convert->convertDate_Import($sheet->getCellByColumnAndRow($j, $i)->getValue());
                        }elseif($j == 5){
                            $address = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                        }elseif($j == 6){
                            $phone = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                        }elseif($j == 7){
                            $email = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                        }
                    }
                    $data = array("code" => $code, 'fullname' => $fullname, "gender" => $gender, "birthday" => $birthday,
                                    "address" => $address, "phone" => $phone, "email" => $email, "status" => 99, "image" => "",
                                    "create_at" => date("Y-m-d H:i:s"), "level_id" => 0, "job_id" => 0, "regency_id" => 0);
                    $this->model->addObj($data);
                }

                $jsonObj['msg'] = "Import dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }catch(Excepion $e){
                $jsonObj['msg'] = "Import dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Import dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('personnel/do_import');
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
        $this->view->render("personnel/del_all_temp");
    }

    function update_temp(){
        if($this->model->check_dupli_code() > 1){
            $jsonObj['msg'] = "Danh sách có mã bị trùng, vui lòng cập nhật lại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
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
        }
        $this->view->render("personnel/update_temp");
    }

    function update_temp_user(){
        if($this->model->check_dupli_code() > 1){
            $jsonObj['msg'] = "Danh sách có mã bị trùng, vui lòng cập nhật lại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $list_per = $this->model->get_per_status_99();
            $data = array("status" => 1);
            $temp = $this->model->updateObj_all($data);
            if($temp){
                foreach($list_per as $row){
                    if($this->model->check_dupli_user($this->_Convert->vn2latin_no_space($row['fullname'], true)) == 0){
                        $data_user = array("code" => $row['code'], "username" => $this->_Convert->vn2latin_no_space($row['fullname'], true), 'password' => sha1('abcd1234'),
                                            "personnel_id" => $row['id'], "status" => 1, "create_at" => date("Y-m-d H:i:s"), "group_role_id" => 0, 'last_login' => '',
                                            "info_login"=> '', "token" => '');
                        $this->model->addObj_user($data_user);
                    }
                }
                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("personnel/update_temp_user");
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function qrcode(){
        $dir_temp = DIR_UPLOAD.'/personnel/qrcode/'; $filename = $dir_temp.'test.png';
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
        $this->view->render("personnel/qrcode");
    }
}
?>