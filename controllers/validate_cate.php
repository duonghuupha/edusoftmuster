<?php
class Validate_cate extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('validate_cate/index');
        require('layouts/footer.php');
    }
}
?>
