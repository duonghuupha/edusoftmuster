<?php
class Import_food_class extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');

        $info_class = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        $total_student = $this->model->get_total_student_muster($info_class[0]['id'], date('2025-12-22'));
        $this->view->total_student = $total_student; $this->view->system_id = $info_class[0]['training_system_id'];
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $number_day = $this->_Convert->return_day_number_text(date("D")); $week_of_month = $this->_Convert->weekOfMonth(date("2025-12-22"));
        $week_odd_even = ($week_of_month % 2 == 0) ? 1 : 2; 
        $json_food = $this->model->get_menu_food_ct_current_date($number_day, $week_odd_even);
        $this->view->json_food = $json_food;

        $this->view->render('import_food_class/index');
        require('layouts/footer.php');
    }

    function add(){
        $single = $_REQUEST['single']; $single = str_replace('data:image/png;base64,', '', $single); $binary = base64_decode($single, true);
        $data_food = json_decode($_REQUEST['data_food'], true); $code = time();
        $info_class = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        if($this->model->dupliObj($info_class[0]['id'], 1, date('2025-12-22')) == 0){
            $data = array('code' => $code, 'class_id' => $info_class[0]['id'], 'user_id' => $this->_Info[0]['id'], 'create_at' => date('Y-m-d H:i:s'),
                            'type_menu' => 1, 'img_single' => $binary);
            $temp = $this->model->addObj($data);
            if($temp){
                foreach($data_food as $row){
                    $data_detail = array('code' => time(), 'code_imp_food' => $code, 'food_id' => $row['food_id'], 'status' => $row['status'], 'value' => $row['value']);
                    $this->model->addObj_detail($data_detail);
                }
                $jsonObj['msg'] = "Giao nhận KPHS thành công!";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Dữ liệu đã tồn tại trong ngày hôm nay!";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("import_food_class/add");
    }
}
?>
