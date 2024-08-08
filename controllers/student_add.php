<?php
class Student_add extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function json(){
        $code = $_REQUEST['code'];
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 10;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($code, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('student_add/json');
    }

    function add(){
        $address = addslashes($_REQUEST['address']); $student_code = $_REQUEST['student_code'];
        $data = array("student_code" => $student_code, "address" => $address);
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
        $this->view->render("student_add/add");
    }

    function update(){
        $address = addslashes($_REQUEST['address']); $id = $_REQUEST['id'];
        $data = array("address" => $address);
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
        $this->view->render("student_add/update");
    }

    function del(){
        $id = $_REQUEST['id']; $code = $_REQUEST['student_code'];
        if($this->model->check_count_add($code)  == 1){
            $jsonObj['msg'] = "Học sinh bắt buộc phải có địa chỉ liên hệ";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
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
        }
        $this->view->render("student_add/del");
    }
}
?>
