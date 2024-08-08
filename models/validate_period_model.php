<?php
class Validate_period_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_period");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, status, DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at 
                                    FROM tbl_validate_period ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_validate_period", $data);
        return $query;
    }

    function addObj_dt($data){
        $query = $this->insert("tbl_validate_period_dt", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_validate_period", $data, "id = $id");
        return $query;
    }

    function updateObj_dt($id, $data){
        $query = $this->update("tbl_validate_period_dt", $data, "id = $id");
        return $query;
    }

    function delObj_dt($id){
        $query = $this->delete("tbl_validate_period_dt", "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_validate_period", "id = $id");
        return $query;
    }

    function updateObj_all(){
        $query = $this->db->query("UPDATE tbl_validate_period SET status = 0");
        return $query;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_period_dt($code){
        $query = $this->db->query("SELECT id, title, period_code, 1 AS status FROM tbl_validate_period_dt WHERE period_code = $code");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>