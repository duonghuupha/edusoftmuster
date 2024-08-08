<?php
class Province_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_province");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, code FROM tbldm_province ORDER BY code ASC
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_province", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_province", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_province", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbldm_province WHERE id = $id");
        return $query->fetchAll();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////
    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_province WHERE code = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_province WHERE code = '$code' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>