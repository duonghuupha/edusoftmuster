<?php
class Document_in extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $jsonObj = $this->model->get_cate();
        $this->view->jsonObj = $jsonObj;
        $this->view->render('document_in/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $cate = $_REQUEST['cate'];
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $cate, $this->_Info[0]['id'], $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('document_in/json');
    }

    function add(){
        $code = time(); $cateid = $_REQUEST['cate_id']; $number_in = $_REQUEST['number_in'];
        $date_in = $this->_Convert->convertDate($_REQUEST['date_in']); $number_dc = $_REQUEST['number_dc'];
        $date_dc = $this->_Convert->convertDate($_REQUEST['date_dc']); $title = addslashes($_REQUEST['title']);
        $content = addslashes($_REQUEST['content']); $userid = $this->_Info[0]['id']; $status = 1;
        $creat_at = date("Y-m-d H:i:s"); $file = $this->_Convert->convert_file($_FILES['file']['name'], 'document_in');
        $publish = (isset($_REQUEST['is_publish']) && $_REQUEST['publish'] != '') ? 1 : 0;
        if($publish == 1){
            $user_share = '';
        }else{
            $user_share = base64_decode($_REQUEST['data_user_share']); 
        }
        // kiem tra so den
        if($this->model->dupliObj_in(0, $number_in, date("Y", strtotime($date_in))) > 0){
            $jsonObj['msg'] = "Số đến của văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            // kiem tra so van ban
            if($this->model->dupliObj_dc(0, $number_dc, date("Y", strtotime($date_dc))) > 0){
                $jsonObj['msg'] = "Số văn bản đã tồn tại";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                if($date_in > date("Y-m-d") || $date_dc > date("Y-m-d")){
                    $jsonObj['msg'] = "Ngày đến hoặc ngày văn bản không được lớn hơn ngày hiện tại";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    if($date_in < $date_dc){
                        $jsonObj['msg'] = "Ngày đến không được nhỏ hơn ngày văn bản";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $data = array("code" => $code, "cate_id" => $cateid, "number_in" => $number_in, "date_in" => $date_in, "number_dc" => $number_dc,
                                "date_dc" => $date_dc, "title" => $title, "content" => $content, "user_id" => $userid, "user_share" => $user_share,
                                "create_at" => $creat_at, "file" => $file, "status" => $status, "is_publish" => $publish);
                        $temp = $this->model->addObj($data);
                        if($temp){
                            // luu file
                            $temp_upload = move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/document_in/'.$file);
                            if($temp_upload){
                                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                                $jsonObj['success'] = true;
                                $this->view->jsonObj = json_encode($jsonObj);
                            }else{
                                $data_u = array("status" => 0); $this->model->updateObj_code($code, $data_u);
                                $jsonObj['msg'] = "Ghi dữ liệu không thành công, do file dữ liệu quá kích thước";
                                $jsonObj['success'] = false;
                                $this->view->jsonObj = json_encode($jsonObj);
                            }
                        }else{
                            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                            $jsonObj['success'] = false;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }
                }
            }
        }
        $this->view->render("document_in/add");
    }

    function update(){
        $cateid = $_REQUEST['cate_id']; $number_in = $_REQUEST['number_in']; $id = $_REQUEST['id'];
        $date_in = $this->_Convert->convertDate($_REQUEST['date_in']); $number_dc = $_REQUEST['number_dc'];
        $date_dc = $this->_Convert->convertDate($_REQUEST['date_dc']); $title = addslashes($_REQUEST['title']);
        $content = addslashes($_REQUEST['content']); $userid = $this->_Info[0]['id'];
        $creat_at = date("Y-m-d H:i:s"); $file_old = $_REQUEST['file_old'];
        $file = (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') ? $this->_Convert->convert_file($_FILES['file']['name'], 'document_in') : $file_old;
        $publish = (isset($_REQUEST['is_publish']) && $_REQUEST['publish'] != '') ? 1 : 0;
        if($publish == 1){
            $user_share = '';
        }else{
            $user_share = base64_decode($_REQUEST['data_user_share']); 
        }
        // kiem tra so den
        if($this->model->dupliObj_in($id, $number_in, date("Y", strtotime($date_in))) > 0){
            $jsonObj['msg'] = "Số đến của văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            // kiem tra so van ban
            if($this->model->dupliObj_dc($id, $number_dc, date("Y", strtotime($date_dc))) > 0){
                $jsonObj['msg'] = "Số văn bản đã tồn tại";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                if($date_in > date("Y-m-d") || $date_dc > date("Y-m-d")){
                    $jsonObj['msg'] = "Ngày đến hoặc ngày văn bản không được lớn hơn ngày hiện tại";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    if($date_in < $date_dc){
                        $jsonObj['msg'] = "Ngày đến không được nhỏ hơn ngày văn bản";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $data = array("cate_id" => $cateid, "number_in" => $number_in, "date_in" => $date_in, "number_dc" => $number_dc,
                                "date_dc" => $date_dc, "title" => $title, "content" => $content, "user_id" => $userid, "user_share" => $user_share,
                                "create_at" => $creat_at, "file" => $file, "is_publish" => $publish);
                        $temp = $this->model->updateObj($id, $data);
                        if($temp){
                            // luu file
                            if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
                                $temp_upload = move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/document_in/'.$file);
                                if($temp_upload){
                                    @unlink(DIR_UPLOAD.'/document_in/'.$file_old);
                                    $jsonObj['msg'] = "Ghi dữ liệu thành công";
                                    $jsonObj['success'] = true;
                                    $this->view->jsonObj = json_encode($jsonObj);
                                }else{
                                    $data_u = array("file" => $file_old); $this->model->updateObj($id, $data_u);
                                    $jsonObj['msg'] = "Ghi dữ liệu không thành công, do file dữ liệu quá kích thước";
                                    $jsonObj['success'] = false;
                                    $this->view->jsonObj = json_encode($jsonObj);
                                }
                            }else{
                                $jsonObj['msg'] = "Ghi dữ liệu thành công";
                                $jsonObj['success'] = true;
                                $this->view->jsonObj = json_encode($jsonObj);
                            }
                        }else{
                            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                            $jsonObj['success'] = false;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }
                }
            }
        }
        $this->view->render("document_in/update");
    }

    function del(){
        $id = $_REQUEST['id']; $file = $this->model->get_title_file($id);
        $temp = $this->model->delObj($id);
        if($temp){
            @unlink(DIR_UPLOAD.'/document_in/'.$file);
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("document_in/del");
    }
//////////////////////////////////////////////////////////////////////////////////////////////
    function json_user(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_user($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('document_in/json_user');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function number_in(){
        $jsonObj = $this->model->get_number_in_last(date("Y"));
        $this->view->jsonObj = $jsonObj;
        $this->view->render("document_in/number_in");
    }

    function data_edit(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = json_encode($jsonObj[0]);
        $this->view->render("document_in/data_edit");
    }

    function detail(){
        $id = $_REQUEST['id']; $info = $this->model->get_info_detail($id);
        $this->view->info = $info;
        if($info[0]['user_share'] != ''){
            $user_share = explode(",", $info[0]['user_share']);
            foreach($user_share as $item){
                $arr_full[] = $this->model->get_fullname_share_dc($item);
            }
            $this->view->share = implode(", ", $arr_full);
        }else{
            $this->view->share = '';
        }
        $this->view->render("document_in/detail");
    }
}
?>
