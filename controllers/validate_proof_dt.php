<?php
class Validate_proof_dt extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function json(){
        $proof_id = $_REQUEST['proof_id'];
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($proof_id, $offset, $rows);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('validate_proof_dt/json');
    }

    function add(){
        $code = time(); $year_proof = $_REQUEST['year_proof']; $title = addslashes($_REQUEST['title']); $id_proof = $_REQUEST['proof_id'];
        $type_data = $_REQUEST['type_data']; $status = 0; $create_at = date("Y-m-d H:i:s");
        if($type_data == 1){ // file du lieu
            $file = $this->_Convert->convert_file($_FILES['file']['name'], 'proof_file');
            $file_link = ''; $link = '';
        }elseif($type_data == 2){ // tep du lieu van thu
            $file = ''; $link = '';
            $file_link = $_REQUEST['type_dc_dc'].'.'.$_REQUEST['file_link'];
        }else{ // link du lieu
            $file = ''; $file_link = ''; $link = $_REQUEST['link'];
        }
        if($this->model->dupliObj(0, $id_proof, $year_proof) > 0){
            $jsonObj['msg'] = "Năm học đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "proof_id" => $id_proof, "title" => $title, "type_data" => $type_data, "file" => $file,
                            "file_link" => $file_link, "link" => $link, "status" => $status, "create_at" => $create_at, "year_proof" => $year_proof,
                            "user_id" => $this->_Info[0]['id'], "user_approve" => 0);
            $temp = $this->model->addObj($data);
            if($temp){
                if($type_data == 1){
                    $dirname = DIR_UPLOAD.'/validate_file/proof/'.$id_proof;
                    if(!file_exists($dirname)){
                        mkdir($dirname, 0777);
                    }
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $dirname.'/'.$file)){
                        $jsonObj['msg'] = "Ghi dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $data_u = array("file" => ""); $this->model->updateObj_by_code($code, $data_u);
                        $jsonObj['msg'] = "Ghi dữ liệu thành công, <b>Tệp minh chứng chưa được tải lên</b>";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
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
        $this->view->render('validate_proof_dt/add');
    }

    function update(){
        $id = $_REQUEST['id']; $year_proof = $_REQUEST['year_proof']; $title = addslashes($_REQUEST['title']);
        $type_data = $_REQUEST['type_data']; $create_at = date("Y-m-d H:i:s"); $file_old = $_REQUEST['file_old'];
        $id_proof = $_REQUEST['proof_id'];
        if($type_data == 1){ // file du lieu
            $file = ($_FILES['file']['name'] != '') ? $this->_Convert->convert_file($_FILES['file']['name'], 'proof_file') : $file_old;
            $file_link = ''; $link = '';
        }elseif($type_data == 2){ // tep du lieu van thu
            $file = ''; $link = '';
            $file_link = $_REQUEST['type_dc_dc'].'.'.$_REQUEST['file_link'];
        }else{ // link du lieu
            $file = ''; $file_link = ''; $link = $_REQUEST['link'];
        }
        if($this->model->dupliObj($id, $id_proof, $year_proof) > 0){
            $jsonObj['msg'] = "Năm học đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("title" => $title, "type_data" => $type_data, "file" => $file, "file_link" => $file_link, 
                            "link" => $link,"create_at" => $create_at,  "year_proof" => $year_proof);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($type_data == 1){
                    if($_FILES['file']['name'] != ''){
                        $dirname = DIR_UPLOAD.'/validate_file/proof/'.$id_proof;
                        if(!file_exists($dirname)){
                            mkdir($dirname, 0777);
                        }
                        if(move_uploaded_file($_FILES['file']['tmp_name'], $dirname.'/'.$file)){
                            @unlink($dirname.'/'.$file_old);
                            $jsonObj['msg'] = "Ghi dữ liệu thành công";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }else{
                            $data_u = array("file" => $file_old); $this->model->updateObj($id, $data_u);
                            $jsonObj['msg'] = "Ghi dữ liệu thành công, <b>Tệp minh chứng chưa được tải lên</b>";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }else{
                        $jsonObj['msg'] = "Ghi dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }else{
                    $data_u = array("file" => ''); $this->model->updateObj($id, $data_u);
                    $dirname = DIR_UPLOAD.'/validate_file/proof/'.$id_proof; @unlink($dirname.'/'.$file_old);
                    $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('validate_proof_dt/update');
    }

    function del(){
        $id = $_REQUEST['id']; $_SESSION['file_old'] = $this->model->return_file_old($id);
        $temp = $this->model->delObj($id);
        if($temp){
            if($_SESSION['file_old'][0]['file'] != ''){
                $dirname = DIR_UPLOAD.'/validate_file/proof/'.$_SESSION['file_old'][0]['proof_id'];
                @unlink($dirname.'/'.$_SESSION['file_old'][0]['file']);
            }
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            unset($_SESSION['file_old']);
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_proof_dt/del");
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
        $this->view->render("validate_proof_dt/change");
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function combo_year_proof(){
        $jsonObj = $this->model->get_period();
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("validate_proof_dt/combo_year_proof");
    }

    function data_proof(){
        $jsonObj = $this->model->get_info_proof($_REQUEST['proof_id']);
        $this->view->jsonObj = json_encode($jsonObj[0]);
        $this->view->render("validate_proof_dt/data_proof");
    }

    function json_dc(){
        $type = $_REQUEST['type_dc'];
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_dc($type, $keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('validate_proof_dt/json_dc');
    }
}
?> 