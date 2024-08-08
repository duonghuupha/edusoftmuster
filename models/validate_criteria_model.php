<?php
class Validate_criteria_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_criteria");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, stand_id, status, content, (SELECT tbl_validate_standard.title
                                    FROM tbl_validate_standard WHERE tbl_validate_standard.id= stand_id) AS stand_title 
                                    FROM tbl_validate_criteria ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_level($id){
        $query = $this->db->query("SELECT levels FROM tbl_validate_dc WHERE id = (SELECT dc_id FROM tbl_validate_standard
                                    WHERE tbl_validate_standard.id  = $id)");
        $row = $query->fetchAll();
        return $row[0]['levels'];
    }

    function addObj($data){
        $query = $this->insert("tbl_validate_criteria", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_validate_criteria", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_validate_criteria", "id = $id");
        return $query;
    }
}
?>