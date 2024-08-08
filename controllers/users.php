<?php
class Users extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('users/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('users/json');
    }

    function add(){
        $code = time(); $perid = $_REQUEST['personnel_id']; $username = $_REQUEST['username'];
        $password = sha1($_REQUEST['password']); $repass = sha1($_REQUEST['re_pass']);
        $group_role = $_REQUEST['group_role_id'];
        if($this->model->dupliObj(0, $username ,$perid) > 0){
            $jsonObj['msg'] = "Tên đăng nhập đã tồn tại hoặc nhân sự đã được tạo tài khoản";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            if($password != $repass){
                $jsonObj['msg'] = "Xác nhận mật khẩu không chính xác";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $data = array("code" => $code, "username" => $username, "password" => $password, "personnel_id" => $perid, "status" => 1,
                                "create_at" => date("Y-m-d H:i:s"), "group_role_id" => $group_role, "last_login" => '', "info_login" => '', "token" => '');
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
        }
        $this->view->render("users/add");
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
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
        $this->view->render("users/change");
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
        $this->view->render("users/del");
    }

    function reset_pass(){
        $id = $_REQUEST['id']; $data = array("password" => sha1('abcd1234'));
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Mật khẩu đã được khôi phục. <b>abcd1234</b> là mật khẩu mới";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Khôi phục mật khẩu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("users/reset_pass");
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function combo_personnel(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_personnel($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("users/combo_personnel");
    }
}
?>