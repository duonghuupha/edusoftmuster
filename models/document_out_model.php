<?php
class  Document_out_Model extends Model{
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
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_out WHERE $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, cate_id, number_dc, DATE_FORMAT(date_dc, '%d-%m-%Y') AS date_dc, title, type, is_publish, user_share,
                                    user_id, location_to, file, (SELECT tbldm_document_out.title FROM tbldm_document_out WHERE tbldm_document_out.id = cate_id) AS category 
                                    FROM tbl_document_out WHERE $where ORDER BY id DESC LIMIT $offset, $rows");
        $result['total'] = $row[0]['Total'];
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $number_dc, $year){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_out WHERE number_dc = '$number_dc'
                                    AND status = 0 AND YEAR(date_dc) = $year");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_out WHERE number_dc = '$number_dc'
                                        AND status = 0 AND id != $id AND YEAR(date_dc) = $year");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_document_out", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_document_out", $data, "id = $id");
        return $query;
    }

    function updateObj_code($code, $data){
        $query = $this->update("tbl_document_out", $data, "code = $code");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_document_out", "id = $id");
        return $querry;
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
        $query = $this->db->query("SELECT id, parent_id, title, user_id, create_at FROM tbldm_document_out
                                    WHERE status = 1");
        return $query->fetchAll();
    }

    function get_number_dc($type, $year){
        $query = $this->db->query("SELECT number_dc FROM tbl_document_out WHERE type = $type
                                    AND status = 1 AND YEAR(date_dc) = $year ORDER BY id DESC LIMIT 0, 1");
        $row = $query->fetchAll();
        return $row;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_document_out WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_info_detail($id){
        $query = $this->db->query("SELECT id, code, number_dc, date_dc, title, content, file, location_to, user_share, is_publish, type,
                                    (SELECT tbldm_document_out.title FROM tbldm_document_out WHERE tbldm_document_out.id= cate_id) AS cate
                                    FROM tbl_document_out WHERE id = $id");
        return $query->fetchAll();
    }

    function get_fullname_share_dc($id){
        $query = $this->db->query("SELECT fullname FROM tbl_personnel WHERE id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = $id)");
        $row = $query->fetchAll();
        return $row[0]['fullname'];
    }
}
?>