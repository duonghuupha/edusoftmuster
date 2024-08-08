<?php
class Other_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_combo_province($q){
        $query = $this->db->query("SELECT title, code AS id FROM tbldm_province WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_district($q, $code_province){
        $query = $this->db->query("SELECT title, code AS id FROM tbldm_district WHERE title LIKE '%$q%' AND code_province = '$code_province'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_commune($q, $code_district){
        $query = $this->db->query("SELECT title, code AS id FROM tbldm_commune WHERE title LIKE '%$q%' AND code_district = '$code_district'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_job($q){
        $query = $this->db->query("SELECT title, id FROM tbldm_job WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_level($q){
        $query = $this->db->query("SELECT title, id FROM tbldm_level WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_regency($q){
        $query = $this->db->query("SELECT title, id FROM tbldm_regency WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_relationship($q){
        $query = $this->db->query("SELECT title, id FROM tbldm_relationship WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_system($q){
        $query = $this->db->query("SELECT title, id FROM tbldm_training_system WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_physical($q){
        $query = $this->db->query("SELECT title, id FROM tbldm_physical_room WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_years($q){
        $query = $this->db->query("SELECT title, id FROM tbl_years WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_task_group($q, $userid){
        $query = $this->db->query("SELECT title, id FROM tbl_task_group WHERE user_id = $userid AND title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_users($q){
        $query = $this->db->query("SELECT id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = personnel_id) AS title FROM tbl_users 
                                    WHERE id != 1 AND personnel_id IN (SELECT tbl_personnel.id FROM tbl_personnel WHERE fullname LIKE '%$q%')");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_users_class($q){
        $query = $this->db->query("SELECT id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = personnel_id) AS title FROM tbl_users 
                                    WHERE id != 1 AND personnel_id IN (SELECT tbl_personnel.id FROM tbl_personnel WHERE regency_id IN (SELECT tbldm_regency.id
                                    FROM tbldm_regency WHERE tbldm_regency.is_class = 1) AND fullname LIKE '%$q%')");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_users_task_process($q, $userid){
        $query = $this->db->query("SELECT id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = personnel_id) AS title FROM tbl_users 
                                    WHERE id != 1 AND personnel_id IN (SELECT tbl_personnel.id FROM tbl_personnel WHERE fullname LIKE '%$q%') AND id != $userid");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_roles_parent($q){
        $query = $this->db->query("SELECT title, id FROM tbl_roles WHERE title LIKE '%$q%' AND parent_id = 0");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_group_role($q){
        $query = $this->db->query("SELECT title, id FROM tbl_group_role WHERE status = 1");
        return $query->fetchAll();
    }

    function get_combo_class($q, $yearid){
        $query = $this->db->query("SELECT id, title FROM tbl_class WHERE title LIKE '%$q%' AND is_class = 1 AND year_id = $yearid");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_validate_dc($q){
        $query = $this->db->query("SELECT id, title FROM tbl_validate_dc WHERE status = 1 AND title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_validate_stand($q){
        $query = $this->db->query("SELECT id, title, content FROM tbl_validate_standard WHERE title LIKE '%$q%' OR content LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_work_pro($q){
        $query = $this->db->query("SELECT id, title FROM tbl_work_pro_cate WHERE status = 1 AND title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>