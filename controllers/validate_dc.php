<?php
class Validate_dc extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('validate_dc/index');
        require('layouts/footer.php');
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('validate_dc/json');
    }

    function add(){
        $code = time(); $title = addslashes($_REQUEST['title']); $number_dc  = $_REQUEST['number_dc'];
        $datedc = $this->_Convert->convertDate($_REQUEST['date_dc']); $file = $this->_Convert->convert_file($_FILES['file']['name'], 'validate_dc');
        $levels = implode(",", $_REQUEST['levels']); $status = 1;
        if($this->model->dupliObj(0, $number_dc,  date("Y")) > 0){
            $jsonObj['msg'] = "Số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "title" => $title, "file" => $file, "number_dc" => $number_dc, "date_dc" => $datedc,
                            "levels" => $levels, "status" => $status);
            $temp = $this->model->addObj($data);
            if($temp){
                $temp_upload = move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/validate_file/document/'.$file);
                if($temp_upload){
                    $jsonObj['msg'] = "Ghi dữ liệu thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $data_u = array("status" => 0); $this->model->updateObj_code($code, $data_u);
                    $jsonObj['msg'] = "Ghi dữ liệu thành công, do file quá dung lượng";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("validate_dc/add");
    }

    function update(){
        $id = $_REQUEST['id']; $title = addslashes($_REQUEST['title']); $number_dc  = $_REQUEST['number_dc']; $file_old = $_REQUEST['file_old'];
        $datedc = $this->_Convert->convertDate($_REQUEST['date_dc']); 
        $file = (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') ? $this->_Convert->convert_file($_FILES['file']['name'], 'validate_dc') : $file_old;
        $levels = implode(",", $_REQUEST['levels']); $status = 1;
        if($this->model->dupliObj(0, $number_dc,  date("Y")) > 0){
            $jsonObj['msg'] = "Số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("title" => $title, "file" => $file, "number_dc" => $number_dc, "date_dc" => $datedc, "levels" => $levels);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
                    $temp_upload = move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/validate_file/document/'.$file);
                    if($temp_upload){
                        @unlink(DIR_UPLOAD.'/validate_file/document/'.$file_old);
                        $jsonObj['msg'] = "Ghi dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $data_u = array("file" => $file_old); $this->model->updateObj($id, $data_u);
                        $jsonObj['msg'] = "Ghi dữ liệu thành công, do file quá dung lượng";
                        $jsonObj['success'] = false;
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
        $this->view->render("validate_dc/update");
    }
    function del(){
        $id = $_REQUEST['id']; $file = $this->model->get_title_file($id);
        $temp = $this->model->delObj($id);
        if($temp){
            @unlink(DIR_UPLOAD.'/validate_file/document/'.$file);
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_dc/del");
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function data_edit(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj= json_encode($jsonObj[0]);
        $this->view->render("validate_dc/data_edit");
    }
}
?>