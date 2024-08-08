<?php
class Task_result_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function addObj($data){
        $query = $this->insert("tbl_task_result", $data);
        return $query;
    }

    function updateObj_file_result($code, $data){
        $query = $this->update("tbl_task_result_file", $data, "code_result = $code");
        return $query;
    }

    function updateObj_erp($id, $data){
        $query = $this->update("tbl_task", $data, "id = $id");
        return $query;
    }
}
?>