<?php
class Task_result extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }
    
    function add(){
        $id_task = $_REQUEST['id']; $code = $_REQUEST['code'];
        $content = addslashes($_REQUEST['content']); $userid = $this->_Info[0]['id'];
        $create_at = date("Y-m-d H:i:s");
        $data = array("code" => $code, "task_id" => $id_task, "content" => $content, "create_at" => $create_at, "user_id" => $userid);
        $temp = $this->model->addObj($data);
        if($temp){
            // update trang thai cua file
            $data_u = array("status" => 1);
            $this->model->updateObj_file_result($code, $data_u);
            $jsonObj['msg'] = "Gửi ý kiến thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Gửi ý kiến không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("task_result/add");
    }

    function done(){
        $id_task = $_REQUEST['id']; $code = $_REQUEST['code'];
        $content = addslashes($_REQUEST['content']); $userid = $this->_Info[0]['id'];
        $create_at = date("Y-m-d H:i:s");
        $data = array("code" => $code, "task_id" => $id_task, "content" => $content, "create_at" => $create_at, "user_id" => $userid);
        $temp = $this->model->addObj($data);
        if($temp){
            // update trang thai cua file
            $data_u = array("status" => 1);
            $this->model->updateObj_file_result($code, $data_u);
            // cap nhat trang thai cua cong viec
            $data_erp = array("status" => 2, "date_done" => date("Y-m-d"));
            $this->model->updateObj_erp($id_task, $data_erp);
            ///////////////////////////////////////////////////////////
            $jsonObj['msg'] = "Gửi ý kiến thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Gửi ý kiến không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("task_result/done");
    }
}
?>
