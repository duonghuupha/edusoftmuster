<?php
class Personnel_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_personnel WHERE status != 99 AND (fullname LIKE '%$q%' OR phone LIKE '%$q%')");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday, gender, phone, 
                                    level_id, job_id, regency_id, image, status, address, image AS image_old, email,
                                    (SELECT title FROM tbldm_level WHERE tbldm_level.id = level_id) AS level_title,
                                    (SELECT title FROM tbldm_job WHERE tbldm_job.id = job_id) AS job_title,
                                    (SELECT title FROM tbldm_regency WHERE tbldm_regency.id = regency_id) AS regency_title
                                    FROM tbl_personnel WHERE status != 99 AND (fullname LIKE '%$q%' OR phone LIKE '%$q%') ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_personnel WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_personnel WHERE code = $code AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_personnel", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_personnel", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_personnel", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT id, code, fullname, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday, gender, phone, 
                                    level_id, job_id, regency_id, image, status, address, image AS image_old, email,
                                    (SELECT title FROM tbldm_level WHERE tbldm_level.id = level_id) AS level_title,
                                    (SELECT title FROM tbldm_job WHERE tbldm_job.id = job_id) AS job_title,
                                    (SELECT title FROM tbldm_regency WHERE tbldm_regency.id = regency_id) AS regency_title
                                    FROM tbl_personnel WHERE id = $id");
        return $query->fetchAll();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delObj_temp(){
        $query = $this->delete("tbl_personnel", "status = 99");
        return $query;
    }   

    function getFetObj_temp($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_personnel WHERE status = 99 AND (fullname LIKE '%$q%' OR phone LIKE '%$q%')");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday, gender, phone, 
                                    level_id, job_id, regency_id, image, status, address, image AS image_old, email,
                                    (SELECT title FROM tbldm_level WHERE tbldm_level.id = level_id) AS level_title,
                                    (SELECT title FROM tbldm_job WHERE tbldm_job.id = job_id) AS job_title,
                                    (SELECT title FROM tbldm_regency WHERE tbldm_regency.id = regency_id) AS regency_title
                                    FROM tbl_personnel WHERE status = 99 AND (fullname LIKE '%$q%' OR phone LIKE '%$q%') ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function check_dupli_code(){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_personnel GROUP BY code HAVING Total > 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function updateObj_all($data){
        $query = $this->update("tbl_personnel", $data, "status = 99");
        return $query;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function addObj_user($data){
        $query = $this->insert("tbl_users", $data);
        return $query;
    }

    function get_per_status_99(){
        $query = $this->db->query("SELECT id, code, fullname FROM tbl_personnel WHERE status = 99");
        return $query->fetchAll();
    }

    function check_dupli_user($username){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username = '$username'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>