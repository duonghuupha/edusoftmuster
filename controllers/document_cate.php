<?php
class Document_cate extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $jsonObj_dc_in = $this->model->get_data_cate_in();
        $this->view->jsonObj_dc_in = $jsonObj_dc_in;
        $jsonObj_dc_out = $this->model->get_data_cate_out();
        $this->view->jsonObj_dc_out = $jsonObj_dc_out;
        $this->view->render('document_cate/index');
        require('layouts/footer.php');
    }
}
?>
