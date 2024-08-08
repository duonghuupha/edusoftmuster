<?php
class Document_in_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $cate, $userid, $offset, $rows){
        $result = array();
        $where = "status = 1 AND (user_id = $userid OR FIND_IN_SET($userid, user_share) OR is_publish = 1)";
        if($q != '')
            $where = $where." AND (title LIKE '%$q%' OR number_dc LIKE '%$q%')";
        if($cate != '')
            $where = $where." AND cate_id = $cate";
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_in WHERE $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, number_in, DATE_FORMAT(date_in, '%d-%m-%Y') AS date_in, number_dc, title, is_publish,
                                DATE_FORMAT(date_dc, '%d-%m-%Y') AS date_dc, content, user_id, user_share, create_at, file, cate_id, 
                                (SELECT tbldm_document_in.title FROM tbldm_document_in WHERE tbldm_document_in.id = cate_id) AS category FROM tbl_document_in
                                WHERE $where ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_document_in", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_document_in", $data, "id = $id");
        return $query;
    }

    function updateObj_code($code, $data){
        $query = $this->update("tbl_document_in", $data, "code = $code");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_document_in", "id = $id");
        return $query;
    }

    function dupliObj_in($id, $numberin, $year_in){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_in WHERE number_in = $numberin 
                                    AND status = 1 AND YEAR(date_in) = $year_in");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_in WHERE number_in = $numberin
                                    AND id != $id AND status = 1 AND YEAR(date_in) = $year_in");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function dupliObj_dc($id, $numberdc, $year_dc){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_in WHERE number_dc = '$numberdc'
                                    AND status = 1 AND YEAR(date_dc) = $year_dc");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_in WHERE number_dc = '$numberdc'
                                    AND id != $id AND status = 1 AND YEAR(date_dc) = $year_dc");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
//////////////////////////////////////////////////////////////////////////////////////////////////
    function getFetObj_user($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE id != 1 AND status = 1 AND personnel_id IN (SELECT tbl_personnel.id
                                    FROM tbl_personnel WHERE fullname LIKE '%$q%')");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, personnel_id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id= personnel_id) AS fullname, 
                                    (SELECT tbl_personnel.code FROM tbl_personnel WHERE tbl_personnel.id= personnel_id) AS code_per, 
                                    (SELECT DATE_FORMAT(birthday, '%d-%m-%Y') FROM tbl_personnel WHERE tbl_personnel.id= personnel_id) AS birthday, 
                                    (SELECT title FROM tbldm_job WHERE tbldm_job.id = (SELECT job_id FROM tbl_personnel WHERE tbl_personnel.id = personnel_id)) AS job_title, 
                                    (SELECT title FROM tbldm_regency WHERE tbldm_regency.id = (SELECT regency_id FROM tbl_personnel WHERE tbl_personnel.id = personnel_id)) 
                                    AS regency_title FROM tbl_users WHERE id != 1 AND status = 1 AND personnel_id IN (SELECT tbl_personnel.id
                                    FROM tbl_personnel WHERE fullname LIKE '%$q%') LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
        
    }
/////////////////////////////////////////////////////////////////////////////////////////////////
    function get_cate(){
        $query = $this->db->query("SELECT id, parent_id, title, user_id, create_at FROM tbldm_document_in
                                    WHERE status = 1");
        return $query->fetchAll();
    }

    function get_number_in_last($date_year){
        $query = $this->db->query("SELECT number_in FROM tbl_document_in WHERE status = 1 AND YEAR(date_in) = $date_year ORDER BY id DESC LIMIT 0, 1");
        $row  = $query->fetchAll();
        if(count($row) == 0){
            return 0;
        }else{
            return $row[0]['number_in'];
        }
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_document_in WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_title_file($id){
        $query = $this->db->query("SELECT file FROM  tbl_document_in WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['file'];
    }

    function get_info_detail($id){
        $query = $this->db->query("SELECT id, code, title, number_in, date_in, number_dc, date_dc, content, file, is_publish, user_share,
                                    (SELECT tbldm_document_in.title FROM tbldm_document_in WHERE tbldm_document_in.id = cate_id) AS cate
                                    FROM tbl_document_in WHERE id = $id");
        return $query->fetchAll();
    }

    function get_fullname_share_dc($id){
        $query = $this->db->query("SELECT fullname FROM tbl_personnel WHERE id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = $id)");
        $row = $query->fetchAll();
        return $row[0]['fullname'];
    }
}
?>