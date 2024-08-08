<?php
class Decentral extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('decentral/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('decentral/json');
    }

    function update(){
        $group_id = $_REQUEST['group_role_id']; $datadc = json_decode($_REQUEST['data_dc'], true);
        foreach($datadc as $row){
            $data = array("group_role_id" => $group_id);
            $this->model->updateObj($row['id'], $data);
        }
        $jsonObj['msg'] = "Ghi dữ liệu thành công";
        $jsonObj['success'] = true;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("decentral/update");
    }
}
?>