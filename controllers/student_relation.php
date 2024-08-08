<?php
class Student_relation extends Controller{
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
        $this->view->render('student_relation/json');
    }

    function add(){
        $row = json_decode($_REQUEST['content'], true); $student_code = $_REQUEST['student_code'];
        $data = array("fullname" => $row[0]['fullname'], "phone" => $row[0]['phone'], "job" => $row[0]['job'], "birthday" => $row[0]['birthday'], 
                        "number_cart" => $row[0]['number_cart'], "email" => $row[0]['email'], "student_code" => $_REQUEST['student_code'],
                        "relationship_id" => $row[0]['relationship_id']);
        if($this->model->dupliObj(0, $_REQUEST['student_code'], $row[0]['relationship_id']) > 0){
            $jsonObj['msg'] = "Mối quan hệ đã tồn tại, vui lòng lựa chọn lại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
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
        }
        $this->view->render("student_relation/add");
    }

    function update(){
        $row = json_decode($_REQUEST['content'], true); $student_code = $_REQUEST['student_code']; $id = $_REQUEST['id'];
        $data = array("fullname" => $row[0]['fullname'], "phone" => $row[0]['phone'], "job" => $row[0]['job'], "birthday" => $row[0]['birthday'], 
                        "number_cart" => $row[0]['number_cart'], "email" => $row[0]['email'], "relationship_id" => $row[0]['relationship_id']);
        if($this->model->dupliObj($id, $_REQUEST['student_code'], $row[0]['relationship_id']) > 0){
            $jsonObj['msg'] = "Mối quan hệ đã tồn tại, vui lòng lựa chọn lại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
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
        }
        $this->view->render("student_relation/update");
    }

    function del(){
        $id = $_REQUEST['id']; $code = $_REQUEST['student_code'];
        if($this->model->check_count_relation($code)  == 1){
            $jsonObj['msg'] = "Học sinh bắt buộc phải có thông tin liên hệ";
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
        $this->view->render("student_relation/del");
    }
}
?>
