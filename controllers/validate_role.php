<?php
class Validate_role extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('validate_role/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('validate_role/json');
    }

    function json_user(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_user($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('validate_role/json_user');
    }

    function formadd(){
        require('layouts/header.php');

        $jsonObj = $this->model->get_stand();
        $this->view->jsonObj = $jsonObj;

        $this->view->render('validate_role/formadd');
        require('layouts/footer.php');
    }

    function add(){
        $data_user = base64_decode($_REQUEST['data_user']); $data_stand = base64_decode($_REQUEST['data_stand']);
        $data_cri = base64_decode($_REQUEST['data_cri']); $data_user = explode(",", $data_user);
        $data_user = array_filter($data_user);
        foreach($data_user as $row){
            $data = array("code" => time(), "user_id" => $row, "stand_id" => $data_stand, "criteria_id" => $data_cri, "status" => 1,
                            "create_at" => date("Y-m-d H:i:s"));
            $this->model->addObj($data);
        }
        $jsonObj['msg'] = "Ghi dữ liệu thành công";
        $jsonObj['success'] = true;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("validate_role/add");
    }

    function formedit(){
        require('layouts/header.php');

        $jsonObj = $this->model->get_stand();
        $this->view->jsonObj = $jsonObj;
        $id = $_REQUEST['id'];
        $info = $this->model->get_info($id);
        $this->view->info = $info;

        $this->view->render('validate_role/formedit');
        require('layouts/footer.php');
    }

    function update(){
        $id = $_REQUEST['id'];
        $data_stand = base64_decode($_REQUEST['data_stand']);$data_cri = base64_decode($_REQUEST['data_cri']);
        $data = array("stand_id" => $data_stand, "criteria_id" => $data_cri, "create_at" => date("Y-m-d H:i:s"));
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_role/update");
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
        $this->view->render("validate_role/del");
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
        $this->view->render("validate_role/change");
    }
}
?>