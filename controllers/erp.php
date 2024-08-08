<?php
class Erp extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('erp/index');
        require('layouts/footer.php');
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 10;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($this->_Info[0]['id'], '', $offset, $rows);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('erp/json');
    }

    function add(){
        $code = $_REQUEST['code']; $private = (isset($_REQUEST['private']) && $_REQUEST['private'] != '') ? 1 : 0; 
        $display_week = (isset($_REQUEST['display_week']) && $_REQUEST['display_week'] != '') ? 1 : 0;
        $groupid = $_REQUEST['group_id']; $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        $prioritize = $_REQUEST['prioritize']; $date_end = $this->_Convert->convertDate($_REQUEST['date_end']);
        $user_id_create = $this->_Info[0]['id'];
        if($private == 0){ // cong viec co nguoi lien quan
            $user_monitor = $_REQUEST['user_id_monitor'];
            $user_id_process = implode(",", $_REQUEST['user_id_process']);
            $status = 0;
        }else{ // cong viec khong co nguoi lien quan
            $user_monitor = $this->_Info[0]['id'];
            $user_id_process = $this->_Info[0]['id'];
            $status = 1;
        }
        $data = array("code" => $code, "group_id" => $groupid, "user_id_create" => $user_id_create, "user_id_monitor" => $user_monitor,
                        "user_id_process" => $user_id_process, "date_start" => date('Y-m-d'), "date_end" => $date_end, "title" => $title,
                        "content" => $content, "private" => $private, "display_week" => $display_week, "status" => $status, "date_done" => $date_end,
                        "create_at" => date("Y-m-d H:i:s"), "prioritize" => $prioritize);
        $temp = $this->model->addObj($data);
        if($temp){
            $id_task = $this->model->return_id_task_by_code($code); // lay id cua task vua tao
            if($private != 0){
                $data_result = array("code" => time(), 'task_id' => $id_task, 'content' => 'Công việc đã được tiếp nhận và xử lý', 
                                    "create_at" => date("Y-m-d H:i:s"), "user_id" => $this->_Info[0]['id']);
                $this->model->addObj_task_result($data_result);
            }
            //// cap nhat trang thai cho ban ghi task file
            $data_task_file = array("status" => 1);
            $this->model->updateObj_task_file($code, $data_task_file);
    /*********************************************************************************************************************************************************** */
            /*if($private != 1){ // cong viec co nguoi lien quan
                //nguoi tham gia giam sat
                if($user_monitor != $this->_Info[0]['id']){
                    $info_monitor = $this->model->return_info_personnel_to_send_mail($user_monitor);
                    if($info_monitor[0]['email'] != ''){
                        $this->send_mail($info_monitor[0]['email'], $title, "Giám sát", $id_task, "Công việc mới :: Hệ thống quản trị trường học");
                    }
                }
                // nguoi xu ly chinh
                $arr_user_pro = explode(",", $user_id_process); $arr_user_pro = array_filter(array_unique($arr_user_pro));
                foreach($arr_user_pro as $item){
                    $info_pro = $this->model->return_info_personnel_to_send_mail($item);
                    if($info_pro[0]['email'] != ''){
                        $temp_mail = $this->send_mail($info_pro[0]['email'], $title, "Xử lý chính", $id_task, "Công việc mới :: Hệ thống quản trị trường học");
                    }
                }
            }*/
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("erp/add");
    }

    function update(){
        $id = $_REQUEST['id'];
        $code = $_REQUEST['code']; $private = (isset($_REQUEST['private']) && $_REQUEST['private'] != '') ? 1 : 0; 
        $display_week = (isset($_REQUEST['display_week']) && $_REQUEST['display_week'] != '') ? 1 : 0;
        $groupid = $_REQUEST['group_id']; $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        $prioritize = $_REQUEST['prioritize']; $date_end = $this->_Convert->convertDate($_REQUEST['date_end']);
        $user_id_create = $this->_Info[0]['id'];
        if($private == 0){
            $user_monitor = $_REQUEST['user_id_monitor'];
            $user_id_process = implode(",", $_REQUEST['user_id_process']);
        }else{
            $user_monitor = $this->_Info[0]['id'];
            $user_id_process = $this->_Info[0]['id'];
        }
        $data = array("group_id" => $groupid, "user_id_create" => $user_id_create, "user_id_monitor" => $user_monitor,
                        "user_id_process" => $user_id_process, "date_end" => $date_end, "title" => $title, "date_done" => $date_end,
                        "content" => $content, "private" => $private, "display_week" => $display_week, "create_at" => date("Y-m-d H:i:s"),
                        "prioritize" => $prioritize);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            //// cap nhat trang thai cho ban ghi task file
            $data_task_file = array("status" => 1);
            $this->model->updateObj_task_file($code, $data_task_file);
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("erp/update");
    }

    function del(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code'];
        $temp = $this->model->delObj($id);
        if($temp){
            $dirname = DIR_UPLOAD.'/task/'.$code;
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
        $this->view->render("erp/del");
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detail_task(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("erp/detail_task");
    }

    function detail(){
        require('layouts/header.php');
        
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        if($jsonObj[0]['user_id_create'] != $this->_Info[0]['id'] && $this->_Info[0]['id'] != $jsonObj[0]['user_id_monitor']){ 
            // neu nguoi tao khac nguoi dang nhap hoac nguoi giam sat thi tao comment
            if($jsonObj[0]['status'] == 0){ // kiem tra neu trang thai cua cong viec laf 0 thi chuyen thanh 1
                $data = array("status" => 1);
                $this->model->updateObj($id, $data);
                $data_result = array("code" => time(), 'task_id' => $id, 'content' => 'Công việc đã được tiếp nhận và xử lý', 
                                        "create_at" => date("Y-m-d H:i:s"), "user_id" => $this->_Info[0]['id']);
                $this->model->addObj_task_result($data_result);
            }elseif($jsonObj[0]['status'] == 1){ // neu trang thai la 1 thi kiem tra xem co bao nhieeu nguoi xu ly chinh cong viec
                $user_pro = explode(",", $jsonObj[0]['user_id_process']);
                if(count($user_pro) > 1){ // neu nhieu hon 1 nguoi thi thuc hien tiep dong lenh
                    // kiem tra xem nguoi dung da tao ban ghi cho cong viec chua
                    if($this->model->return_total_row_task_comment_of_user_id($id, $this->_Info[0]['id']) == 0){
                        // neu chua ton tai thi tao ban ghi nhan viec cho nguoi dung
                        $data_result = array("code" => time(), 'task_id' => $id, 'content' => 'Công việc đã được tiếp nhận và xử lý', 
                                        "create_at" => date("Y-m-d H:i:s"), "user_id" => $this->_Info[0]['id']);
                        $this->model->addObj_task_result($data_result);
                    }
                }
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $this->view->jsonObj = $jsonObj;
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if($jsonObj[0]['file_att'] != 0){
            $this->view->file_att = $this->model->get_task_file($jsonObj[0]['code']);
        }else{
            $this->view->file_att = [];
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $this->view->date_result = $this->model->get_date_result($id);

        $this->view->render('erp/detail');
        require('layouts/footer.php');
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function data_edit(){
        $id = $_REQUEST['id'];
        $json = $this->model->get_data_edit($id);
        $this->view->jsonObj = json_encode($json[0]);
        $this->view->render("erp/data_edit");
    }
/********************************************************************************************************************************************************************* */
    function send_mail($email, $title_task, $private, $id_task, $subject){
        $message = file_get_contents(DIR_UPLOAD.'/tmp/email_task_new.html'); // get template email
        $message = str_replace("####title_task####", $title_task, $message); // thay the noi dung can thiet
        $message = str_replace("####private####", $private, $message); // thay the noi dung can thiet
        $message = str_replace("####url_confirm####", URL.'/index', $message); // thay the noi dung can thiet
        $temp = $this->_Sendmail->send_notify_task($email, $subject, $message);
        return $temp;
    }
}
?>
