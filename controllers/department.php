<?php
class Department extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 10;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('department/json');
    }

    function add(){
        $code = time(); $status = 1; $physical = $_REQUEST['physical_id']; $year = $_REQUEST['year_id'];
        $title = $_REQUEST['title']; $system = $_REQUEST['training_system_id'];
        $isclass = (isset($_REQUEST['is_class']) && $_REQUEST['is_class'] != '') ? 1 : 0;
        $data = array("code" => $code, "title" => $title, "status" => $status, "physical_id" => $physical,
                        "year_id" => $year, "training_system_id" => $system, "user_id_charge" => '', "is_class"  => $isclass);
        if($this->model->dupliObj(0, $physical, $year) > 0){
            $jsonObj['msg'] = "Phòng vật lý đã được gán thông tin, không thể gán thông tin tiếp tục";
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
        $this->view->render("department/add");
    }

    function update(){
        $physical = $_REQUEST['physical_id']; $year = $_REQUEST['year_id']; $id = $_REQUEST['id'];
        $title = $_REQUEST['title']; $system = $_REQUEST['training_system_id'];
        $isclass = (isset($_REQUEST['is_class']) && $_REQUEST['is_class'] != '') ? 1 : 0;
        $data = array("title" => $title, "physical_id" => $physical, "year_id" => $year, "training_system_id" => $system, "is_class"  => $isclass);
        if($this->model->dupliObj($id, $physical, $year) > 0){
            $jsonObj['msg'] = "Phòng vật lý đã được gán thông tin, không thể gán thông tin tiếp tục";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
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
        }
        $this->view->render("department/update");
    }

    function del(){
        $id = $_REQUEST['id'];
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
        $this->view->render("department/del");
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
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
        $this->view->render("department/change");
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function form_charge(){
        $jsonObj = $this->model->get_department_pass_year($this->_Year[0]['id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("department/form_charge");
    }

    function add_user_class(){
        $id = $_REQUEST['id']; $value = $_REQUEST['value'];
        if($this->model->check_exit_user_charge($this->_Year[0]['id'], $value) > 0){
            $jsonObj['msg'] = 'Nhân sự đã được sếp lớp, không thể xếp lớp tiếp tục được';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $user_current = $this->model->get_user_class($id);
            $user_current = explode(",", $user_current); $user_current = array_unique($user_current);
            array_push($user_current, $value); $user_current = array_filter($user_current);
            $data = array("user_id_charge" =>  implode(",", $user_current));
            $temp = $this->model->updateObj_charge($id, $data);
            if($temp){
                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                $jsonObj['success'] = true;
                $jsonObj['personnel'] = $this->model->get_list_fullname_per_class($id);
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("department/add_user_class");
    }

    function del_charge(){
        $classid = $_REQUEST['classid']; $userid = $_REQUEST['userid'];
        $usercharge = $this->model->get_user_class($classid);
        $usercharge = explode(",", $usercharge); $usercharge = array_unique($usercharge);
        $arr_remove = array($userid); $result = array_diff($usercharge, $arr_remove);
        $data = array("user_id_charge" =>  implode(",", $result));
        $temp = $this->model->updateObj_charge($classid, $data);
        if($temp){
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $jsonObj['personnel'] = $this->model->get_list_fullname_per_class($classid);
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("department/del_charge");
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function copy(){
        $yearid = $_REQUEST['year_id_copy']; $iscopy = (isset($_REQUEST['is_copy']) && $_REQUEST['is_copy'] != '') ? 1 : 0;
        $json_dep = $this->model->get_dep_copy($this->_Year[0]['id']);
        try{
            foreach($json_dep as $row){
                $code = rand(1000000000, 9999999999);
                $user_id_charge = ($iscopy == 1) ? $row['user_id_charge'] : '';
                if($this->model->dupli_code_copy($code) > 0){
                    $code = $code + 1;
                    $data = array("code" => $code, "title" => $row['title'], "physical_id" => $row['physical_id'],  "year_id" => $yearid,
                                "training_system_id" => $row['training_system_id'], "user_id_charge" => $user_id_charge, "is_class" => $row['is_class'],
                                "status" => 1);
                    $this->model->addObj($data);
                }else{
                    $data = array("code" => $code, "title" => $row['title'], "physical_id" => $row['physical_id'],  "year_id" => $yearid,
                                "training_system_id" => $row['training_system_id'], "user_id_charge" => $user_id_charge, "is_class" => $row['is_class'],
                                "status" => 1);
                    $this->model->addObj($data);
                }
            }
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }catch(Excepion $e){
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("department/copy");
    }

    function notify_copy(){
        $jsonObj = $this->model->check_data_copy($_REQUEST['year_id']);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("department/notify_copy");
    }
}
?>
