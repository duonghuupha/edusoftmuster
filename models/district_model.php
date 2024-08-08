<?php
class District_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_district");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, code, code_province, (SELECT tbldm_province.title FROM tbldm_province
                                    WHERE tbldm_province.code = code_province) AS tinh_tp FROM tbldm_district ORDER BY code_province ASC, code ASC
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_district", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_district", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_district", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT id, title, code, code_province, (SELECT tbldm_province.title FROM tbldm_province
                                    WHERE tbldm_province.code = code_province) AS tinh_tp FROM tbldm_district WHERE id = $id");
        return $query->fetchAll();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////
    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_district WHERE code = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_district WHERE code = '$code' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>