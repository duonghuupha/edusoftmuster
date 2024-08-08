<?php
class Task_group_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($userid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_task_group WHERE user_id = $userid");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, code, content FROM tbl_task_group WHERE user_id = $userid ORDER BY id DESC
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_task_group", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_task_group", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_task_group", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_task_group WHERE id = $id");
        return $query->fetchAll();
    }
}
?>