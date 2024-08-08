<?php
class Document_out extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $jsonObj = $this->model->get_cate();
        $this->view->jsonObj = $jsonObj;
        $this->view->render('document_out/index');
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
        $this->view->render('document_out/json');
    }

    function add(){
        $code = time(); $type = $_REQUEST['type']; $cateid = $_REQUEST['cate_id']; $numberdc = $_REQUEST['number_dc'];
        $datedc = $this->_Convert->convertDate($_REQUEST['date_dc']); $location = $_REQUEST['location_to'];
        $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']); 
        $file = $this->_Convert->convert_file($_FILES['file']['name'], "documnet_out");
        $publish = (isset($_REQUEST['is_publish']) && $_REQUEST['is_publish'] != '') ? 1 : 0;
        if($publish == 1){
            $usershare = '';
        }else{
            $usershare = base64_decode($_REQUEST['date_user_share']);
        }
        if($this->model->dupliObj(0, $numberdc, date("Y")) > 0){ // kiem tra trung lap so van ban
            $jsonObj['msg'] = "Số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj= json_encode($jsonObj);
        }else{
            if($datedc > date("Y-m-d")){ // kiem tra ngay van ban voi ngay hien tai
                $jsonObj['msg'] = "Ngày văn bản không được là ngày tương lai";
                $jsonObj['success'] = false;
                $this->view->jsonObj= json_encode($jsonObj);
            }else{
                $data = array("code" => $code, "cate_id" => $cateid, "number_dc" => $numberdc, "date_dc" => $datedc, "title" => $title, "content" => $content,
                                "file" => $file, "location_to" => $location, "user_id" => $this->_Info[0]['id'], "user_share"  => $usershare,
                                "type" => $type, "status" => 1, "create_at" => date("Y-m-d H:i:s"), "is_publish" => $publish);
                $temp = $this->model->addObj($data);
                if($temp){
                    $temp_upload = move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/documnet_out/'.$file);
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
        $this->view->render("document_out/add");
    }

    function update(){
        $id = $_REQUEST['id']; $type = $_REQUEST['type']; $cateid = $_REQUEST['cate_id']; $numberdc = $_REQUEST['number_dc'];
        $datedc = $this->_Convert->convertDate($_REQUEST['date_dc']); $location = $_REQUEST['location_to']; $file_old = $_REQUEST['file_old'];
        $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        $publish = (isset($_REQUEST['is_publish']) && $_REQUEST['is_publish'] != '') ? 1 : 0;
        if($publish == 1){
            $usershare = '';
        }else{
            $usershare = base64_decode($_REQUEST['date_user_share']);
        }
        $file = (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') ? $this->_Convert->convert_file($_FILES['file']['name'], "documnet_out") : $file_old;
        if($this->model->dupliObj($id, $numberdc, date("Y")) > 0){ // kiem tra trung lap so van ban
            $jsonObj['msg'] = "Số văn bản đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj= json_encode($jsonObj);
        }else{
            if($datedc > date("Y-m-d")){ // kiem tra ngay van ban voi ngay hien tai
                $jsonObj['msg'] = "Ngày văn bản không được là ngày tương lai";
                $jsonObj['success'] = false;
                $this->view->jsonObj= json_encode($jsonObj);
            }else{
                $data = array("cate_id" => $cateid, "number_dc" => $numberdc, "date_dc" => $datedc, "title" => $title, "content" => $content,
                                "file" => $file, "location_to" => $location, "user_share" => $usershare, "type" => $type, "create_at" => date("Y-m-d H:i:s"),
                                "is_publish" => $publish);
                $temp = $this->model->updateObj($id, $data);
                if($temp){
                    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
                        $temp_upload = move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/documnet_out/'.$file);
                        if($temp_upload){
                            @unlink(DIR_UPLOAD.'/document_out/'.$file_old);
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
        $this->view->render("document_out/update");
    }

    function del(){
        
        $this->view->render("document_out/del");
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function general_number_dc(){
        $type = $_REQUEST['type'];
        if($type != ''){
            $info = $this->model->get_number_dc($type, date("Y"));
            if($type == 1){ // quyet dinh
                if(count($info) > 0){ // ton tai ban ghi quyet dinh
                    $number = explode("/", $info[0]['number_dc']);
                    $numberdc = (int)$number[0];
                    $number_dc = ($numberdc < 10) ? '0'.($numberdc + 1) : ($numberdc + 1);
                    $jsonObj['code'] = $number_dc."/QĐ-MNĐTSĐ";
                }else{
                    $jsonObj['code'] = '01/QĐ-MNĐTSĐ';
                }
            }elseif($type == 2){ // ke hoach
                if(count($info) > 0){ // ton tai ban ghi ke hoach
                    $number = explode("/", $info[0]['number_dc']);
                    $numberdc = (int)$number[0];
                    $number_dc = ($numberdc < 10) ? '0'.($numberdc + 1) : ($numberdc + 1);
                    $jsonObj['code'] = $number_dc."/KH-MNĐTSĐ";
                }else{
                    $jsonObj['code'] = '01/KH-MNĐTSĐ';
                }
            }elseif($type == 3){ // cong van
                if(count($info) > 0){ // ton tai ban ghi cong van
                    $number = explode("/", $info[0]['number_dc']);
                    $numberdc = (int)$number[0];
                    $number_dc = ($numberdc < 10) ? '0'.($numberdc + 1) : ($numberdc + 1);
                    $jsonObj['code'] = $number_dc."/MNĐTSĐ";
                }else{
                    $jsonObj['code'] = '01/MNĐTSĐ';
                }
            }elseif($type == 4){ // bao cao
                if(count($info) > 0){ // ton tai ban ghi bao cao
                    $number = explode("/", $info[0]['number_dc']);
                    $numberdc = (int)$number[0];
                    $number_dc = ($numberdc < 10) ? '0'.($numberdc + 1) : ($numberdc + 1);
                    $jsonObj['code'] = $number_dc."/BC-MNĐTSĐ";
                }else{
                    $jsonObj['code'] = '01/BC-MNĐTSĐ';
                }
            }else{  //  khac
                $jsonObj['code'] = '';
            }
        }else{
            $jsonObj['code'] = '';
        }
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("document_out/general_number_dc");
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function data_edit(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = json_encode($jsonObj[0]);
        $this->view->render("document_out/data_edit");
    }

    function json_user(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_user($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('document_out/json_user');
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
        $this->view->render("document_out/detail");
    }
}
?>
