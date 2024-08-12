<?php
class Muster_data extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('muster_data/index');
        require('layouts/footer.php');
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $classid = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        $jsonObj = $this->model->getFetObj($classid, $offset, $rows);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('muster_data/json');
    }
}
?>
