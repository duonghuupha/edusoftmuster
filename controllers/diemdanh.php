<?php
class Diemdanh extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('diemdanh/index');
        require('layouts/footer.php');
    }

    function json(){
        $classid = isset($_REQUEST['classid']) ? $_REQUEST['classid'] : 0;
        $date = isset($_REQUEST['date']) ? $this->_Convert->convertDate($_REQUEST['date']) : date("Y-m-d");
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($classid, $date, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('diemdanh/json');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add(){
        $id = $_REQUEST['id']; $classid = $_REQUEST['classid']; $code = time(); $date = $this->_Convert->convertDate($_REQUEST['date']);
        $ccreate = $date.' '.date("H:i:s");
        if($this->model->dupliObj($id, $classid, $date) > 0){
            $jsonObj['msg'] = "Học sinh đã tồn tại dữ liệu điểm danh, không thể điểm danh lại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => time(), "student_id" => $id, "date_muster" => $date, "class_id" => $classid, "breakfast" => 0,
                            "user_id" => $this->_Info[0]['id'], "create_at" => $ccreate);
            $temp = $this->model->addObj($data);
            if($temp){
                $total_food = $this->model->get_data_time_food($classid, $date);
                $data_time_food = array("code" => time(), "class_id" => $classid, "user_id" => $this->_Info[0]['id'], "food_main" => $total_food,
                                        "food_morning" => 0, "create_at" => $ccreate);
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
        $this->view->render("diemdanh/add");
    }

    function del(){
        $id = $_REQUEST['id']; $classid = $_REQUEST['classid']; $date = $this->_Convert->convertDate($_REQUEST['date']);
        $temp = $this->model->delObj($id, $classid, $date);  $ccreate = $date.' '.date("H:i:s");
        if($temp){
            $total_food = $this->model->get_data_time_food($classid, $date);
            $data_time_food = array("code" => time(), "class_id" => $classid, "user_id" => $this->_Info[0]['id'], "food_main" => $total_food,
                                    "food_morning" => 0, "create_at" => $ccreate);
            $this->model->addObj_food($data_time_food);
            $jsonObj['msg'] = "Hủy điểm danh thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Hủy điểm danh không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("diemdanh/del");
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function combo_class(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_class($keyword, $this->_Year[0]['id']);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("diemdanh/combo_class");
    }
}
?>
