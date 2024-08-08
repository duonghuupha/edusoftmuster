<?php
class Muster_data extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $jsonObj = $this->model->get_class_pass_year($this->_Year[0]['id'], date("Y-m-d"));
        $this->view->jsonObj = $jsonObj;
        $this->view->render('muster_data/index');
    }
}
?>
