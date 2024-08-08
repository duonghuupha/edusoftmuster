<?php
class Document_cate_out extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function add(){
        $title = $_REQUEST['title']; 
        $parent = (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '') ? $_REQUEST['parent_id'] : 0;
        $data = array("parent_id" => $parent, "title" => $title, "user_id" => $this->_Info[0]['id'],
                        "create_at" => date("Y-m-d H:i:s"), "status" => 1);
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
        $this->view->render("document_cate_out/add");
    }

    function update(){
        $title = $_REQUEST['title']; $id = $_REQUEST['id'];
        $parent = (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '') ? $_REQUEST['parent_id'] : 0;
        $data = array("parent_id" => $parent, "title" => $title, "user_id" => $this->_Info[0]['id'],
                        "create_at" => date("Y-m-d H:i:s"));
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
        $this->view->render("document_cate_out/add");
    }

    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("document_cate_out/del");
    }

    function data_edit(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj= json_encode($jsonObj[0]);
        $this->view->render('document_cate_out/data_edit');
    }
}
?>
