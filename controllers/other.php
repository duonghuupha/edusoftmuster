<?php
class Other extends Controller{
    function __construct(){
        parent::__construct();
    }

    function combo_province(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_province($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_province");
    }

    function combo_district(){
        $codeprovince = $_REQUEST['code_province'];
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_district($keyword, $codeprovince);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_district");
    }

    function combo_commune(){
        $codeprovince = $_REQUEST['code_district'];
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_commune($keyword, $codeprovince);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_commune");
    }

    function combo_job(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_job($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_job");
    }

    function combo_level(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_level($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_level");
    }

    function combo_regency(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_regency($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_regency");
    }

    function combo_relationship(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_relationship($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_relationship");
    }

    function combo_system(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_system($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_system");
    }

    function combo_physical(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_physical($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_physical");
    }

    function combo_years(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_years($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_years");
    }

    function combo_task_group(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_task_group($keyword, $this->_Info[0]['id']);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_task_group");
    }

    function combo_users(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_users($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_users");
    }

    function combo_users_class(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_users_class($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_users_class");
    }

    function combo_users_task_process(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_users_task_process($keyword, $this->_Info[0]['id']);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_users_task_process");
    }

    function combo_roles_parent(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_roles_parent($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_roles_parent");
    }

    function combo_role_link(){
        $this->view->render("other/combo_role_link");
    }

    function combo_group_role(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_group_role($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_group_role");
    }

    function combo_class(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_class($keyword, $this->_Year[0]['id']);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_class");
    }

    function combo_validate_dc(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_validate_dc($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_validate_dc");
    }

    function combo_validate_stand(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_validate_stand($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_validate_stand");
    }

    function combo_work_pro(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_work_pro($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_work_pro");
    }
}
?>
