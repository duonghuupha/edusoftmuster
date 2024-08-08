<?php
class Controller {
    public $_Data;
    public $_Info;
    public $_Convert;
    public $_Year;
    public $_Log;
    public $_Arr_Role;
    public $_Sendmail;
	function __construct() {
		$this->view = new View(); $this->_Data = new Model();
        $this->_Info = (isset($_SESSION['data'])) ? $_SESSION['data']: [];
        $this->_Convert = new Convert();
        $this->_Year = (isset($_SESSION['year'])) ? $_SESSION['year'] : [];
        //$this->_Log = new Log();
        $this->_Url = isset($_REQUEST['url']) ? explode("/", $_REQUEST['url']) : ['index'];
        $this->_Arr_Role = array('other', 'task_result', 'task_result_file', 'index', 'errors', 'task_group', 'task_file', 'validate_proof_dt', 'work_pro_dt', 'dashboard');
        $this->_Sendmail = new Mail();
	}

	public function loadModel($name) {
		$path = 'models/'.$name.'_model.php';
		if (file_exists($path)) {
			require 'models/'.$name.'_model.php';
			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}
	}

	public function PhadhInt(){
        Session::init();
        $logged = Session::get('loggedIn_Edusoft');
        if($logged == false){
            session_start();
            session_destroy();
            header ('Location: '.URL.'/index/login');
            exit;
        }else{
            if(isset($_REQUEST['token'])){
                if($this->_Data->check_token($_REQUEST['token']) == 0){
                    session_start();
                    session_destroy();
                    header ('Location: '.URL.'/index/login');
                    exit;
                }else{
                    if(isset($_REQUEST['url'])){
                        $url = $_REQUEST['url'];
                        $url = explode("/", $url);
                        if($this->_Info[0]['id'] != 1){ // nguoi dung dang nhap la admin thi khong chay
                            if(!in_array($url[0], $this->_Arr_Role)){ // neu duong dan thuoc cac duong dan tren thi khong chay
                                if($this->_Data->check_role_controller($this->_Info[0]['group_role_id'], $url[0]) == 0){
                                    // neu khong duoc phan quyen thi se bi logout
                                    session_start();
                                    session_destroy();
                                    header ('Location: '.URL.'/index/login');
                                    exit;
                                }
                            }
                        }
                    }else{
                        $url = "index";
                    }
                }
            }else{
                session_start();
                session_destroy();
                header ('Location: '.URL.'/index/login');
                exit;
            }
        }
    }
}
?>
