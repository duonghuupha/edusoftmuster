<?php
class Change_class extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('change_class/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('change_class/json');
    }

    function json_change_class(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 10;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_change_class($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('change_class/json_change_class');
    }

    function add(){
        $studentid = $_REQUEST['student_id']; $class_from = $_REQUEST['class_id_from'];
        $class_to = $_REQUEST['class_to']; $content = $_REQUEST['content']; $code = time();
        $data = array("student_id" => $studentid, "year_id_from" => $this->_Year[0]['id'], "class_id_from" => $class_from,
                        "year_id_to" => $this->_Year[0]['id'], "class_id_to" => $class_to, "content" => $content, "status" => 0,
                        "create_at" => date("Y-m-d H:i:s"), "code" => $code, 'user_id_approve' => 0, "date_approve" => date("Y-m-d"));
        $temp = $this->model->addObj($data);
        if($temp){
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("change_class/add");
    }

    function detail(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_detail($id);
        $this->view->jsonObj  = $jsonObj;
        $this->view->render("change_class/detail");
    }

    function approve(){
        $id = $_REQUEST['id']; $info = $this->model->get_info_student($id);
        $data = array("date_approve" => date("Y-m-d"), "user_id_approve" => $this->_Info[0]['id'], "status" => 1);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $data_u = array("class_id" => $info[0]['class_id_to']);
            $this->model->updateObj_class_student($info[0]['code_stu'], $info[0]['year_id_to'], $data_u);
            $jsonObj['msg'] = "Duyệt chuyển lớp thành công";
            $jsonObj['success']= true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Duyệt chuyển lớp không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("change_class/approve");
    }
}
?>
