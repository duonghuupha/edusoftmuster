<?php
class Level_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_level");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, status FROM tbldm_level ORDER BY id DESC
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_level", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_level", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_level", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbldm_level WHERE id = $id");
        return $query->fetchAll();
    }
}
?>