<?php
class Work_pro_dt extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function json(){
        $work_id = $_REQUEST['work_id'];
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($work_id, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('work_pro_dt/json');
    }

    function add(){
        $work_id = $_REQUEST['work_id']; $code = time();
        $title = addslashes($_REQUEST['title']); $info_work = $this->model->get_info_work_pro_by_id($work_id);
        $file = $this->_Convert->convert_file($_FILES['file']['name'], 'work_pro');
        $data = array("code" => $code, "work_id" => $work_id, "title" => $title, "file" => $file, "status" => 0, "create_at" => date("Y-m-d H:i:s"));
        $temp = $this->model->addObj($data);
        if($temp){
            $dirname = DIR_UPLOAD.'/work_pro/'.$info_work[0]['code'];
            if(!file_exists($dirname)){
                mkdir($dirname, 0777);
            }
            if(move_uploaded_file($_FILES['file']['tmp_name'], $dirname.'/'.$file)){
                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                $jsonObj['success']= true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu thành công, File dữ liệu chưa được cập nhật";
                $jsonObj['success']= true;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("work_pro_dt/add");
    }

    function update(){
        $id = $_REQUEST['id']; $code_work = $_REQUEST['code_work_pro'];  $title = addslashes($_REQUEST['title']);
        $file_old = $_REQUEST['file_old'];
        $file = ($_FILES['file']['name'] != '') ? $this->_Convert->convert_file($_FILES['file']['name'], 'work_pro') : $file_old;
        $data = array("title" => $title, "file" => $file, "create_at" => date("Y-m-d H:i:s"));
        $temp = $this->model->updateObj($id, $data);
        if ($temp){
                if($_FILES['file']['name'] != ''){
                    if(move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/work_pro/'.$code_work.'/'.$file)){
                        @unlink(DIR_UPLOAD.'/work_pro/'.$code_work.'/'.$file_old);
                        $jsonObj['msg'] = "Ghi dữ liệu thành công";
                        $jsonObj['success']= true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $data_u = array('file' => $file_old); $this->model->updateObj($id, $data_u);
                        $jsonObj['msg'] = "Ghi dữ liệu thành công, File dữ liệu chưa được cập nhật";
                        $jsonObj['success']= true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }else{
                    $jsonObj['msg'] = "Ghi dữ liệu thành công";
                    $jsonObj['success']= true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
        }else{
            $jsonObj['msg'] = 'Ghi dữ liệu không thành công';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("work_pro_dt/update");
    }

    function del(){
        $id = $_REQUEST['id']; $info = $this->model->get_info($id);
        $info_work = $this->model->get_info_work_pro_by_id($info[0]['work_id']);
        $file = $info[0]['file']; $code_work = $info_work[0]['code'];
        $temp = $this->model->delObj($id);
        if($temp){
            @unlink(DIR_UPLOAD.'/work_pro/'.$code_work.'/'.$file);
            $jsonObj['msg'] = 'Xóa dữ liệu thành công';
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = 'Xóa dữ liệu không thành công';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("work_pro_dt/del");
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array('status' =>  $status);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = 'Cập nhật dữ liệu thành công';
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = 'Cập nhật dữ liệu không thành công';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("work_pro_dt/change");
    }
}
?>