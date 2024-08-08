<?php
class Validate_proof_dt_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($proof_id, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_proof_dt WHERE proof_id = $proof_id");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, proof_id, year_proof, title, file, status, file_link, link, type_data, user_id, user_approve,
                                    DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at, (SELECT tbl_validate_period_dt.title FROM tbl_validate_period_dt
                                    WHERE tbl_validate_period_dt.id = year_proof) AS year_proof_title
                                    FROM tbl_validate_proof_dt WHERE proof_id = $proof_id ORDER BY year_proof 
                                    DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $proof_id, $year_proof){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_proof_dt WHERE year_proof = $year_proof AND proof_id = $proof_id");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_proof_dt WHERE year_proof = $year_proof AND
                                        id != $id  AND proof_id = $proof_id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_validate_proof_dt", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_validate_proof_dt", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_validate_proof_dt", "id = $id");
        return $query;
    }

    function updateObj_by_code($code, $data){
        $query = $this->update("tbl_validate_proof_dt", $data, "code = $code");
        return $query;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_period(){
        $query = $this->db->query("SELECT id, title FROM tbl_validate_period_dt WHERE period_code = (SELECT code FROM tbl_validate_period WHERE status = 1)");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_info_proof($id){
        $query = $this->db->query("SELECT id, code, encode, stand_id, criteria_id, create_at, (SELECT title FROM tbl_validate_standard
                                    WHERE tbl_validate_standard.id = stand_id) AS stand_title, (SELECT content FROM tbl_validate_standard
                                    WHERE tbl_validate_standard.id = stand_id) AS stand_content, (SELECT title FROM tbl_validate_criteria
                                    WHERE tbl_validate_criteria.id = criteria_id) AS criteria_title, (SELECT content FROM tbl_validate_criteria
                                    WHERE tbl_validate_criteria.id = criteria_id) AS criteria_content FROM tbl_validate_proof WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getFetObj_dc($type, $q, $offset, $rows){
        $result = array();
        if($type == 1){ // van ban den
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_in WHERE status = 1 AND title LIKE '%$q%'");
            $row = $query->fetchAll();
            $query = $this->db->query("SELECT id, title, number_dc, DATE_FORMAT(date_dc, '%d-%m-%Y') AS date_dc FROM tbl_document_in
                                        WHERE status = 1 AND title LIKE '%$q%' ORDER BY id DESC LIMIT $offset, $rows");
        }else{ // van ban di
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_out WHERE status = 1 AND title LIKE '%$q%'");
            $row = $query->fetchAll();
            $query = $this->db->query("SELECT id, title, number_dc, DATE_FORMAT(date_dc, '%d-%m-%Y') AS date_dc FROM tbl_document_out
                                        WHERE status = 1 AND title LIKE '%$q%' ORDER BY id DESC LIMIT $offset, $rows");
        }
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function return_file_old($id){
        $query = $this->db->query("SELECT proof_id, file FROM tbl_validate_proof_dt WHERE id = $id");
        return $query->fetchAll();
    }
}
?>