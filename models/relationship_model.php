<?php
class Relationship_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_relationship");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, read_only FROM tbldm_relationship ORDER BY id DESC
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_relationship", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_relationship", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_relationship", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbldm_relationship WHERE id = $id");
        return $query->fetchAll();
    }
}
?>