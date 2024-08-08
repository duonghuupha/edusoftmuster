<?php
class Category extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('category/index');
        require('layouts/footer.php');
    }
}
?>
