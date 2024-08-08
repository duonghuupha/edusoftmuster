<?php
class Task_file_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function addObj_task_file($data){
        $query = $this->insert("tbl_task_file", $data);
        return $query;
    }

    function get_task_file($code){
        $query = $this->db->query("SELECT id, file FROM tbl_task_file WHERE code_task = $code");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function delObj_task_file($id){
        $query = $this->delete("tbl_task_file", "id = $id");
        return $query;
    }

    function get_info_file($id){
        $query = $this->db->query("SELECT * FROM tbl_task_file WHERE id = $id");
        return $query->fetchAll();
    }
}
?>