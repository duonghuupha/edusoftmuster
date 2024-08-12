<?php
class Muster extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('muster/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $classid = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        $jsonObj = $this->model->getFetObj($keyword, $this->_Year[0]['id'], $classid, date("Y-m-d"), $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('muster/json');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add(){
        $id = $_REQUEST['id']; $classid = $_REQUEST['classid'];
        if(date("Y-m-d H:i:s") < date("Y-m-d 07:30:00") || date("Y-m-d H:i:s") > date("Y-m-d 08:30:00")){
            $jsonObj['msg'] = "Chưa đến giờ điểm danh hoặc Đã quá giờ điểm danh";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => time(), "student_id" => $id, "date_muster" => date("Y-m-d"), "class_id" => $classid, "breakfast" => 0);
            $temp = $this->model->addObj($data);
            if($temp){
                $total_food = $this->model->get_data_time_food($classid);
                $data_time_food = array("code" => time(), "class_id" => $classid, "user_id" => $this->_Info[0]['id'], "food_main" => $total_food,
                                        "food_morning" => 0, "create_at" => date("Y-m-d H:i:s"));
                $this->model->addObj_food($data_time_food);
                $jsonObj['msg'] = "Điểm danh thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Điểm danh không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("muster/add");
    }

    function del(){
        $id = $_REQUEST['id']; $classid = $_REQUEST['classid'];
        if(date("Y-m-d H:i:s") < date("Y-m-d 07:30:00") || date("Y-m-d H:i:s") > date("Y-m-d 08:30:00")){
            $jsonObj['msg'] = "Chưa đến giờ điểm danh hoặc Đã quá giờ điểm danh";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $temp = $this->model->delObj($id, $classid, date("Y-m-d"));
            if($temp){
                $total_food = $this->model->get_data_time_food($classid);
                $data_time_food = array("code" => time(), "class_id" => $classid, "user_id" => $this->_Info[0]['id'], "food_main" => $total_food,
                                        "food_morning" => 0, "create_at" => date("Y-m-d H:i:s"));
                $this->model->addObj_food($data_time_food);
                $jsonObj['msg'] = "Hủy điểm danh thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Hủy điểm danh không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("muster/del");
    }
}
?>
