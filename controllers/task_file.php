<?php
class Task_file extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function upload_task_file(){
        $total = count($_FILES['file']['name']); $code = $_REQUEST['code'];
        $dirname = DIR_UPLOAD.'/task/'.$code;
        if(!file_exists($dirname)){
            mkdir($dirname, 0777);
        }
        for($i = 0; $i < $total; $i++){
            $tmp_file = $_FILES['file']['tmp_name'][$i];
            $file_name = $_FILES['file']['name'][$i];
            $data = array("code" => time(), "code_task" => $code, "file" => $file_name, "status" => 0);
            $temp = $this->model->addObj_task_file($data);
            if($temp){
                move_uploaded_file($tmp_file, $dirname.'/'.$file_name);
            }
        }
        $jsonObj['msg'] = "Tải file thành công";
        $jsonObj['success'] = true;
        $jsonObj['code'] = $code;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("task_file/upload_task_file");
    }

    function list_task_file(){
        $code = $_REQUEST['code'];
        $jsonObj = $this->model->get_task_file($code);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("task_file/list_task_file");
    }

    function del_task_file(){
        $id = $_REQUEST['id']; $info = $this->model->get_info_file($id);
        $temp = $this->model->delObj_task_file($id);
        if($temp){
            unlink(DIR_UPLOAD.'/task/'.$info[0]['code_task'].'/'.$info[0]['file']);
            $jsonObj['msg'] = "Xóa file thành công";
            $jsonObj['success'] = true;
            $jsonObj['code'] = $info[0]['code_task'];
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa file không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("task_file/del_task_file");
    }
}
?>
