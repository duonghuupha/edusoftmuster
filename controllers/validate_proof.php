<?php
class Validate_proof extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('validate_proof/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('validate_proof/json');
    }

    function add(){
        $code = time(); $encode = mb_strtoupper($_REQUEST['encode'], 'UTF-8'); $standid = $_REQUEST['stand_id'];
        $criteria_id = $_REQUEST['criteria_id']; $userid = $this->_Info[0]['id']; $status = 0; $create_at = date("Y-m-d H:i:s");
        if($this->model->dupliObj(0, $encode) > 0){
            $jsonObj['msg']= "Mã hóa minh chứng đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "encode" => $encode, "stand_id" => $standid, "criteria_id" => $criteria_id, "user_id" => $userid,
                            "status" => $status, "create_at" => $create_at);
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj['msg'] = "Ghi dữ liệu thành công, chờ người có thẩm quyền phê duyệt";
                $jsonObj['success'] = true;
                $this->view->jsonObj =  json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj =  json_encode($jsonObj);
            }
        }
        $this->view->render('validate_proof/add');
    }

    function update(){
        $id = $_REQUEST['id']; $encode = mb_strtoupper($_REQUEST['encode'], 'UTF-8'); $standid = $_REQUEST['stand_id'];
        $criteria_id = $_REQUEST['criteria_id']; $userid = $this->_Info[0]['id']; $create_at = date("Y-m-d H:i:s");
        if($this->model->dupliObj($id, $encode) > 0){
            $jsonObj['msg']= "Mã hóa minh chứng đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("encode" => $encode, "stand_id" => $standid, "criteria_id" => $criteria_id, "user_id" => $userid,
                            "create_at" => $create_at);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj =  json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj =  json_encode($jsonObj);
            }
        }
        $this->view->render('validate_proof/update');
    }

    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $dirname = DIR_UPLOAD.'/validate_file/proof/'.$id;
            array_map('unlink', glob("$dirname/*.*"));
            rmdir($dirname);
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("validate_proof/del");
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
        $this->view->render("validate_proof/change");
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function qrcode(){
        if($_REQUEST['type_render'] == 0){
            if($this->model->dupliObj(0,$_REQUEST['encode']) > 0){
                $jsonObj['msg'] = "Mã minh chứng đã tồn tại";
                $jsonObj['success'] = false;
                $this->view->jsonObj  = json_encode($jsonObj);
            }else{
                $dir_temp = DIR_UPLOAD.'/validate_file/qrcode_temp/'; $filename = $dir_temp.'test.png';
                $level = 'H'; $size = 6; $code = $_REQUEST['encode'];
                $filename = $dir_temp.'test'.md5($code.'|'.$level.'|'.$size).'.png';
                if(file_exists($dir_temp.$filename)){
                    unlink($dir_temp.$filename);
                }
                QRcode::png($code, $filename, $level, $size, 2);
                $jsonObj['msg'] = "Mã QRcode đã tạo thành công";
                $jsonObj['success'] = true;
                $jsonObj['qrcode'] = basename($filename);
                $this->view->jsonObj  = json_encode($jsonObj);
            }
        }else{
            $level = 'H'; $size = 6; $code = $_REQUEST['encode'];
            $filename = $dir_temp.'test'.md5($code.'|'.$level.'|'.$size).'.png';
            $jsonObj['msg'] = "Mã QRcode đã tạo thành công";
            $jsonObj['success'] = true;
            $jsonObj['qrcode'] = basename($filename);
            $this->view->jsonObj  = json_encode($jsonObj);
        }
        $this->view->render("validate_proof/qrcode");
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function combo_stand(){
        $jsonObj = $this->model->get_stand_role($this->_Info[0]['id']);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("validate_proof/combo_stand");
    }

    function combo_criteria(){
        $id = $_REQUEST['stand_id'];
        $jsonObj = $this->model->get_criteria_role($id, $this->_Info[0]['id']);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("validate_proof/combo_criteria");
    }
}
?> 