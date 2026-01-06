<?php
class Import_food_class extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');

        $info_class = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        $total_student = $this->model->get_total_student_muster($info_class[0]['id'], date('Y-m-d'));
        $this->view->total_student = $total_student; $this->view->system_id = $info_class[0]['training_system_id'];
	    $type_edu = $this->model->return_type_edu($info_class[0]['training_system_id']); $this->view->type_edu = $type_edu;
        $this->view->class_id = $info_class[0]['id'];
        $this->view->render('import_food_class/index');
        require('layouts/footer.php');
    }

    function add(){
        $type_menu = $_REQUEST['type_food']; $total_student = $_REQUEST['total_student'];
        $data_food = json_decode($_REQUEST['data_food'], true); $code = time();
        $info_class = $this->model->get_class_id_pass_yearid_an_userid($this->_Year[0]['id'], $this->_Info[0]['id']);
        if($this->model->dupliObj($info_class[0]['id'], $type_menu, date('Y-m-d')) == 0){
            $data = array('code' => $code, 'class_id' => $info_class[0]['id'], 'user_id' => $this->_Info[0]['id'], 'create_at' => date('Y-m-d H:i:s'),
                            'type_menu' => $type_menu, 'img_single' => '', 'student_total' => $total_student);
            $temp = $this->model->addObj($data);
            if($temp){
                foreach($data_food as $row){
                    $giatri = explode('$', $row['value']);
                    $data_detail = array('code' => time(), 'code_imp_food' => $code, 'food_id' => $row['food_id'], 'status' => $row['status'], 'value' => $giatri[0],
                                        'type_menu' => $giatri[1]);
                    $this->model->addObj_detail($data_detail);
                }
                $dir = DIR_SIGNATURE.'/'.date('Y-m');
                if(!is_dir($dir)){ mkdir($dir, 0777, true); }
                file_put_contents($dir.'/'.$filename, $binary);
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
