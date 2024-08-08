<?php
class Years_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_years");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, code, status, create_at FROM tbl_years ORDER BY id DESC
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_years", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_years", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_years", "id = $id");
        return $query;
    }

    function updateObj_All(){
        $query = $this->db->query("UPDATE tbl_years SET status = 0");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_years WHERE id = $id");
        return $query->fetchAll();
    }
}
?>