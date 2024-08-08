<?php
class Calendar extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('calendar/index');
        require('layouts/footer.php');
    }

    function data_task(){
        $this->view->render("calendar/data_task");
    }

    function export_calendar(){
        $this->view->render("calendar/export_calendar");
    }
}
?>
