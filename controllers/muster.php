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
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $classid = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        $jsonObj = $this->model->getFetObj($this->_Year[0]['id'], $classid, date("Y-m-d"), $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('muster/json');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function json_muster(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $classid = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        $jsonObj = $this->model->getFetObj_muster($classid, date("Y-m-d"),$offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('muster/json_muster');
    }

    function add(){
        $id = $_REQUEST['id']; $classid = $_REQUEST['classid'];
        /*if(date("Y-m-d H:i:s") < date("Y-m-d 07:00:00") || date("Y-m-d H:i:s") > date("Y-m-d 08:30:00")){
            $jsonObj['msg'] = "Chưa đến giờ điểm danh hoặc Đã quá giờ điểm danh";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{*/
            $data = array("code" => time(), "student_id" => $id, "date_muster" => date("Y-m-d"), "class_id" => $classid, "breakfast" => 0);
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj['msg'] = "Điểm danh thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Điểm danh không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        //}
        $this->view->render("muster/add");
    }

    function del(){
        $id = $_REQUEST['id']; $classid = $_REQUEST['classid'];
        /*if(date("Y-m-d H:i:s") < date("Y-m-d 07:00:00") || date("Y-m-d H:i:s") > date("Y-m-d 08:30:00")){
            $jsonObj['msg'] = "Đã quá giờ điểm danh";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{*/
            $temp = $this->model->delObj($id, $classid, date("Y-m-d"));
            if($temp){
                $jsonObj['msg'] = "Xóa điểm danh thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Xóa điểm danh không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        //}
        $this->view->render("muster/del");
    }

    function add_breackfast(){
        $id = $_REQUEST['id']; $classid = $_REQUEST['classid']; $ansang = $_REQUEST['ansang'];
        /*if(date("Y-m-d H:i:s") < date("Y-m-d 07:00:00") || date("Y-m-d H:i:s") > date("Y-m-d 08:30:00")){
            $jsonObj['msg'] = "Đã quá giờ điểm danh";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{*/
            $data = array("breakfast" => $ansang);
            $temp = $this->model->updateObj("student_id = $id AND class_id = $classid AND date_muster = '".date("Y-m-d")."'", $data);
            if($temp){
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        //}
        $this->view->render("muster/add_breackfast");
    }

    function time_food(){
        $anchinh = $_REQUEST['anchinh']; $ansang = $_REQUEST['ansang'];
        $userid = $this->_Info[0]['id'];
        $classid = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        $data = array("code" => time(), "class_id" => $classid, "user_id" =>  $userid, "food_main" => $anchinh, "food_morning" =>$ansang,
                        "create_at" => date("Y-m-d  H:i:s"));
        /*if(date("Y-m-d H:i:s") < date("Y-m-d 07:00:00") || date("Y-m-d H:i:s") > date("Y-m-d 08:30:00")){
            $jsonObj['msg'] = "Đã quá giờ điểm danh";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{*/
            if($this->model->check_muster_by_date($classid, date("Y-m-d")) > 0){
                if($anchinh > $this->model->check_muster_by_date($classid, date("Y-m-d")) || $ansang > $this->model->check_muster_by_date($classid, date("Y-m-d"))){
                    $jsonObj['msg'] = "Số lượng báo ăn không thể vượt quá số lượng điểm danh trong ngày";
                    $jsonObj['success']  = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $temp = $this->model->addObj_food($data);
                    if($temp){
                        $jsonObj['msg'] = "Báo ăn thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Báo ăn không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }else{
                if($anchinh > $this->model->check_student_in_class($classid) || $ansang > $this->model->check_student_in_class($classid)){
                    $jsonObj['msg'] = "Số lượng báo ăn không thể vượt quá số lượng học sinh của lớp";
                    $jsonObj['success']  = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $temp = $this->model->addObj_food($data);
                    if($temp){
                        $jsonObj['msg'] = "Báo ăn thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Báo ăn không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }
        //}
        $this->view->render("muster/time_food");
    }

    function history(){
        $classid = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        if($classid == 0){
            $jsonObj = [];
        }else{
            $jsonObj = $this->model->get_history_time_food($classid, date("Y-m-d"));
        }
        $this->view->jsonObj= $jsonObj;
        $this->view->render("muster/history");
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function rest(){
        require('layouts/header.php');
        $this->view->render('muster/rest');
        require('layouts/footer.php');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function syns_food(){
        $classid = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        $food_main = $this->model->check_muster_by_date($classid, date("Y-m-d"));
        $food_morning = $this->model->check_muster_morning_by_date($classid, date("Y-m-d"));
        $data = array("code" => time(), "class_id" => $classid, "user_id" =>  $this->_Info[0]['id'], "food_main" => $food_main, "food_morning" =>$food_morning,
                        "create_at" => date("Y-m-d  H:i:s"));
        if($food_main == 0){
            $jsonObj['msg'] = "Chưa có dữ liệu điểm danh";
            $jsonObj['success'] = false;
            $this->view->jsonObj=  json_encode($jsonObj);
        }else{
            $temp = $this->model->addObj_food($data);
            if($temp){
                $jsonObj['msg'] = "Đồng bộ dữ liệu báo ăn thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Đồng bộ dữ liệu báo ăn không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('muster/syns_food');
    }
}
?>
