<?php
class Validate_dc_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_dc WHERE status = 1");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, file, number_dc, date_dc, levels FROM tbl_validate_dc WHERE status = 1 ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $numberdc, $year){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_dc WHERE number_dc = '$numberdc' AND YEAR(date_dc) = $year AND status = 1");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_dc WHERE number_dc = '$numberdc' AND YEAR(date_dc) = $year AND id != $id
                                        AND status = 1");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_validate_dc", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_validate_dc", $data, "id = $id");
        return $query;
    }

    function updateObj_code($code, $data){
        $query = $this->update("tbl_validate_dc", $data, "code = $code");
        return $query;
    }

    function delObj($id){
        $query = $this->delete('tbl_validate_dc', "id = $id");
        return $query;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_validate_dc WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_title_file($id){
        $query = $this->db->query("SELECT file FROM tbl_validate_dc WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['file'];
    }
}
?>