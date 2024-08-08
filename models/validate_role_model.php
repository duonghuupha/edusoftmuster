<?php
class Validate_role_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetobj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_role");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, user_id, stand_id, criteria_id, status, DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at, 
                                    (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = user_id)) AS fullname 
                                    FROM tbl_validate_role ORDER BY Id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_stand(){
        $query = $this->db->query("SELECT id, title, content FROM tbl_validate_standard WHERE status = 1 ORDER BY id ASC");
        return $query->fetchAll();
    }

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

    function check_exit_data($userid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_role WHERE user_id = $userid");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_validate_role", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_validate_role", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_validate_role", "id = $id");
        return $query;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_info($id){
        $query = $this->db->query("SELECT id, code,  user_id, stand_id, criteria_id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id
                                    FROM tbl_users WHERE tbl_users.id = user_id)) AS fullname FROM tbl_validate_role WHERE id = $id");
        return $query->fetchAll();
    }
}
?>