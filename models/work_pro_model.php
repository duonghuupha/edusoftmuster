<?php
class Work_pro_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_work_pro WHERE title LIKE '%$q%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, content, user_id, status, DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at, 
                                    user_share, is_publish, IF(user_id = 1, 'Administrator', (SELECT fullname FROM tbl_personnel 
                                    WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = user_id))) AS fullname, 
                                    cate_id, (SELECT tbl_work_pro_cate.title FROM tbl_work_pro_cate WHERE tbl_work_pro_cate.id = cate_id) AS work_cate 
                                    FROM tbl_work_pro WHERE title LIKE '%$q%' ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_work_pro WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_work_pro WHERE code = $code AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_work_pro", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_work_pro", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_work_pro", "id = $id");
        return $query;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    function get_all_file_of_work_pro($id){
        $query = $this->db->query("SELECT file FROM tbl_work_pro_dt WHERE work_id = $id AND status = 1");
        return $query->fetchAll();
    }
}
?>