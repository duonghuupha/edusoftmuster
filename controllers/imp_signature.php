<?php
class Imp_signature extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('imp_signature/index');
        require('layouts/footer.php');
    }

    function combo_personnel(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_personnel($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("imp_signature/combo_personnel");
    }

    function get_signature(){
        $personnel_id = $_REQUEST['personnel_id'];
        $signature = $this->model->get_signature_old($personnel_id);
        $this->view->jsonObj = json_encode($signature);
        $this->view->render("imp_signature/get_signature");
    }

    function update(){
        $single = $_REQUEST['single']; $single = preg_replace('#^data:image/\w+;base64,#i', '', $single); $binary = base64_decode($single);
        $filename = 'signature_'.time().'_'.rand(100, 999).'.png'; $personnel_id = $_REQUEST['personnel_id'];
        $data = array('signature' => $filename); $signature = $this->model->get_signature_old($personnel_id);
        $temp = $this->model->updateObj($personnel_id, $data);
        if($temp){
            $dir = DIR_SIGNATURE;
            file_put_contents($dir.'/'.$filename, $binary);
            @unlink($dir.'/'.$signature);
            $jsonObj['msg'] = "Cấu hình chữ ký thành công!";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cấu hình chữ ký không thành công!";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("imp_signature/update");
    }
}
?>
