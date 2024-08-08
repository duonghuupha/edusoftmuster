<?php
class Work_pro extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('work_pro/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('work_pro/json');
    }

    function add(){
        $code = $_REQUEST['code']; $title = addslashes($_REQUEST['title']); $cateid = $_REQUEST['cate_id'];
        $content = addslashes($_REQUEST['content']); $publish = (isset($_REQUEST['is_publish']) && $_REQUEST['is_publish'] != '') ? 1: 0;
        if($publish == 1){
            $usershare = '';
        }else{
            $usershare = base64_decode($_REQUEST['data_user_share']);
        }
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã hồ sơ đã tồn tại";
            $jsonObj['success'] =  false;
            $this->view->jsonObj =  json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "title" => $title, "content" => $content, "user_id" => $this->_Info[0]['id'], "user_share" => $usershare,
                            "is_publish" => $publish, "status" => 1, "create_at" => date("Y-m-d H:i:s"), "cate_id" => $cateid);
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj["msg"] = "Ghi dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj= json_encode($jsonObj);
            }else{
                $jsonObj["msg"] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj= json_encode($jsonObj);
            }
        }
        $this->view->render("work_pro/add");
    }

    function update(){
        $id = $_REQUEST['id']; $title = addslashes($_REQUEST['title']); $cateid = $_REQUEST['cate_id']; $code = $_REQUEST['code'];
        $content = addslashes($_REQUEST['content']); $publish = (isset($_REQUEST['is_publish']) && $_REQUEST['is_publish'] != '') ? 1: 0;
        if($publish == 1){
            $usershare = '';
        }else{
            $usershare = base64_decode($_REQUEST['data_user_share']);
        }
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "Mã hồ sơ đã tồn tại";
            $jsonObj['success'] =  false;
            $this->view->jsonObj =  json_encode($jsonObj);
        }else{
            $data = array( "title" => $title, "content" => $content, "user_share" => $usershare, "code" => $code,
                            "is_publish" => $publish, "create_at" => date("Y-m-d H:i:s"), "cate_id" => $cateid);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $jsonObj["msg"] = "Ghi dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj= json_encode($jsonObj);
            }else{
                $jsonObj["msg"] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj= json_encode($jsonObj);
            }
        }
        $this->view->render("work_pro/update");
    }

    function del(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code'];
        $temp = $this->model->delObj($id);
        if($temp){
            $dirname = DIR_UPLOAD.'/work_pro/'.$code;
            array_map('unlink', glob("$dirname/*.*"));
            rmdir($dirname);
            $jsonObj['msg'] = " Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = " Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("work_pro/del");
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function json_user(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_user($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('work_pro/json_user');
    }

    function download_work(){
        $code = $_REQUEST['code']; $id = $_REQUEST['id'];
        $json_file = $this->model->get_all_file_of_work_pro($id);
        foreach($json_file as $row){
            $file_names[] = $row['file'];
        }
        $archive_file_name = $code.'_work_pro.zip';
        $file_path = DIR_UPLOAD.'/work_pro/'.$code.'/';
        $this->ZipFilesAndDownload($file_names, $archive_file_name, $file_path);
    }

    function ZipFilesAndDownload($file_names, $archive_file_name, $file_path){
        $zip = new ZipArchive();
        if($zip->open($archive_file_name, ZIPARCHIVE::CREATE) != TRUE){
            exit("Không thể mở file ".$archive_file_name);
        }
        foreach($file_names as $files){
            $zip->addFile($file_path.$files, $files);
        }
        $zip->close();
        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=$archive_file_name");
        header("Content-length: " . filesize($archive_file_name));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile("$archive_file_name");
        exit;
    }
}
?>