<?php
class Import_food_class extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('import_food_class/index');
        require('layouts/footer.php');
    }
}
?>
