<?php
class Commune_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_commune");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, code, code_province, code_district FROM tbldm_commune ORDER BY code_province ASC, 
                                    code_district ASC, code ASC  LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbldm_commune", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_commune", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_commune", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT id, title, code, code_province, (SELECT tbldm_province.title FROM tbldm_province
                                    WHERE tbldm_province.code = code_province) AS tinh_tp, code_district, (SELECT tbldm_district.title 
                                    FROM tbldm_district WHERE tbldm_district.code = code_district) AS quan_huyen FROM tbldm_commune WHERE id = $id");
        return $query->fetchAll();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////
    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_commune WHERE code = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbldm_commune WHERE code = '$code' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>