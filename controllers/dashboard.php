<?php
class Dashboard extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function block_one(){
        // total student
        $total_student = $this->model->get_total_students($this->_Year[0]['id']);
        $this->view->total_student = $total_student;
        // total personnel
        $total_per = $this->model->get_total_per();
        $this->view->total_per = $total_per;
        // total weok pro
        $total_work = $this->model->get_total_work_pro();
        $this->view->total_work = $total_work;
        // total dc_in
        $total_dc_in = $this->model->get_total_dc_in();
        $this->view->total_dc_in = $total_dc_in;
        // total dc_out
        $total_dc_out = $this->model->get_total_dc_out();
        $this->view->total_dc_out = $total_dc_out;
        $this->view->render('dashboard/block_one');
    }

    function block_two(){
        $id = $_REQUEST['id'];
        if($id == 1){ // gioi tinh
            $this->view->jsonObj = $this->model->get_percent_gender_student($this->_Year[0]['id']);
        }elseif($id == 2){ // do tuoi
            $this->view->jsonObj = $this->model->get_percent_year_old_student($this->_Year[0]['id']);
        }else{ // Dan toc
            $this->view->jsonObj = [];
        }
        $this->view->render("dashboard/block_two");
    }

    function block_three(){
        $id = $_REQUEST['id'];
        if($id == 1){ // gioi tinh
            $this->view->jsonObj = $this->model->get_percent_gender_personnel();
        }elseif($id == 2){ // trinh do
            $this->view->jsonObj = $this->model->get_percent_level_personnel();
        }elseif($id  == 3){ // nhiem vu
            $this->view->jsonObj = $this->model->get_percent_regency_personnel();
        }else{ // chuyen mon
            $this->view->jsonObj = $this->model->get_percent_job_personnel();
        }
        $this->view->render("dashboard/block_three");
    }

    function block_four(){
        $id = $_REQUEST['id'];
        if($id == 1){ // gioi tinh
            $this->view->jsonObj = $this->model->get_percent_gender_personnel();
        }elseif($id == 2){ // trinh do
            $this->view->jsonObj = $this->model->get_percent_level_personnel();
        }elseif($id  == 3){ // nhiem vu
            $this->view->jsonObj = $this->model->get_percent_regency_personnel();
        }else{ // chuyen mon
            $this->view->jsonObj = $this->model->get_percent_job_personnel();
        }
        $this->view->render("dashboard/block_four");
    }

    function block_six(){
        $jsonObj = $this->model->getFetObj_block_six($this->_Info[0]['id']);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('dashboard/block_six');
    }
}
?>