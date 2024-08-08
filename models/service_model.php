<?php
class Service_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_service");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, price, year_id, status, content,
                                    (SELECT tbl_years.title FROM tbl_years WHERE tbl_years.id = year_id) AS nam_hoc, 
                                    DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at FROM tbldm_service ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_service", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_service", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_service", "id = $id");
        return $query;
    }
}
?>