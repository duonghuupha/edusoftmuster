<?php
class Administrative extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('administrative/index');
        require('layouts/footer.php');
    }
}
?>
