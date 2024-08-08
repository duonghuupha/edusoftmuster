<?php
class Validate_period extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('validate_period/index');
        require('layouts/footer.php');
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('validate_period/json');
    }

    function add(){
        $code = time(); $title = $_REQUEST['title']; $datadc = json_decode($_REQUEST['datadc'], true);
        $data = array("code" => $code, "title" => $title, "status" => 0, "create_at" => date("Y-m-d H:i:s"));
        $temp = $this->model->addobj($data);
        if($temp){
            foreach($datadc as $row){
                if($row['status'] != 2){
                    $data_dt = array("period_code" => $code, "title" => $row['title']);
                    $this->model->addObj_dt($data_dt);
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
        $this->view->render("validate_period/add");
    }

    function update(){
        $code = $_REQUEST['code']; $title = $_REQUEST['title']; $datadc = json_decode($_REQUEST['datadc'], true); $id = $_REQUEST['id'];
        $data = array("title" => $title, "create_at" => date("Y-m-d H:i:s"));
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            foreach($datadc as $row){
                if($row['status'] == 0){
                    $data_dt = array("period_code" => $code, "title" => $row['title']);
                    $this->model->addObj_dt($data_dt);
                }else if($row['status'] == 1){
                    $data_dt = array("title" => $row['title']);
                    $this->model->updateObj_dt($row['id'], $data_dt);
                }else{
                    $this->model->delObj_dt($row['id']);
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
        $this->view->render("validate_period/update");
    }

    function del(){
        $id = $_REQUEST['id'];
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
        $this->view->render("validate_period/del");
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $temp = $this->model->updateObj_all();
        if($temp){
            $data = array("status" => $status);
            $tmp = $this->model->updateObj($id, $data);
            if($tmp){
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_period/change");
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function json_period_dt(){
        $code = $_REQUEST['code'];
        $jsonObj = $this->model->get_period_dt($code);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('validate_period/json_period_dt');
    }
}
?>