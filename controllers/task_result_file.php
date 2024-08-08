<?php
class Task_result_file extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }
    
    function upload(){
        $total = count($_FILES['file']['name']); $code = $_REQUEST['code'];
        $dirname = DIR_UPLOAD.'/task_result/'.$code;
        if(!file_exists($dirname)){
            mkdir($dirname, 0777);
        }
        for($i = 0; $i < $total; $i++){
            $tmp_file = $_FILES['file']['tmp_name'][$i];
            $file_name = $_FILES['file']['name'][$i];
            $data = array("code" => time(), "code_result" => $code, "file" => $file_name, "status" => 0);
            $temp = $this->model->addobj($data);
            if($temp){
                move_uploaded_file($tmp_file, $dirname.'/'.$file_name);
            }
        }
        $jsonObj['msg'] = "Tải file thành công";
        $jsonObj['success'] = true;
        $jsonObj['code'] = $code;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("task_result_file/upload");
    }

    function list_task_file(){
        $code = $_REQUEST['code'];
        $jsonObj = $this->model->get_task_file($code);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("task_result_file/list_task_file");
    }

    function del(){
        $id = $_REQUEST['id']; $info = $this->model->get_info_file($id);
        $temp = $this->model->delObj($id);
        if($temp){
            unlink(DIR_UPLOAD.'/task_result/'.$info[0]['code_result'].'/'.$info[0]['file']);
            if(count($this->model->get_task_file($info[0]['code_result'])) == 0){
                rmdir(DIR_UPLOAD.'/task_result/'.$info[0]['code_result']);
            }
            $jsonObj['msg'] = "Xóa file thành công";
            $jsonObj['success'] = true;
            $jsonObj['code'] = $info[0]['code_result'];
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa file không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("task_result_file/del");
    }
}
?>
