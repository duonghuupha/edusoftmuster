<?php
class Face_recon extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render("face_recon/index");
    }
}
?>