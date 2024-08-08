<?php
class Validate_criteria extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('validate_criteria/json');
    }

    function add(){
        $code = time(); $standid = $_REQUEST['stand_id']; $title = addslashes($_REQUEST['title_criteria']);
        $content = addslashes($_REQUEST['content_criteria']); 
        $data = array("code" => $code, "title" =>  $title, "stand_id" => $standid, "status" => 1, "content" => $content);
        $temp = $this->model->addObj($data);
        if($temp){
            $jsonObj['msg'] ="Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] ="Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_criteria/add");
    }

    function update(){
        $id = $_REQUEST['id']; $standid = $_REQUEST['stand_id']; $title = addslashes($_REQUEST['title_criteria']);
        $content = addslashes($_REQUEST['content_criteria']); 
        $data = array("title" =>  $title, "stand_id" => $standid, "content" => $content);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] ="Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] ="Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_criteria/update");
    }

    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] ="Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] ="Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_criteria/del");
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] ="Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] ="Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_criteria/change");
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function combo_level(){
        $id  = $_REQUEST['id']; $jsonObj = $this->model->get_level($id);
        $jsonObj = array_map('intval', explode(",", $jsonObj)); $jsonObj = array_filter($jsonObj);
        sort($jsonObj); $array = [];
        foreach($jsonObj as $row){
            $array[] = array('id' => $row, 'title' => 'Mức độ '.$row);
        }
        $this->view->jsonObj = json_encode($array);
        $this->view->render("validate_criteria/combo_level");
    }
}
?>
