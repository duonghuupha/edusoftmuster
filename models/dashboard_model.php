<?php
class Dashboard_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    /**
     * Begin BLock one
     */
    function get_total_students($yearid){
        $query = $this->db->query("SELECT COUNT(*) as Total FROM tbl_student_class WHERE year_id = $yearid AND student_code IN (SELECT code FROM tbl_student WHERE status = 1)");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_total_per(){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_personnel WHERE status = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_total_work_pro(){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_work_pro");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_total_dc_in(){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_in");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_total_dc_out(){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_document_out");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    /**
     * End BLock one
     */

    /**
     * Begin Block two
     */
    function get_percent_gender_student($year_id){
        $query = $this->db->query("SELECT COUNT(*) AS Total, 'Nam' AS title FROM tbl_student_class WHERE year_id = $year_id AND student_code IN (SELECT code 
                                    FROM tbl_student WHERE status = 1 AND gender = 1)
                                    UNION ALL
                                    SELECT COUNT(*) AS Total, 'Nữ' AS title FROM tbl_student_class WHERE year_id = $year_id AND student_code IN (SELECT code 
                                    FROM tbl_student WHERE status = 1 AND gender = 2);");
        return $query->fetchAll();
    }

    function get_percent_year_old_student($yearid){
        $query = $this->db->query("SELECT COUNT(*) AS Total, DATE_FORMAT(birthday, '%Y') AS title FROM tbl_student WHERE status = 1 
                                    AND code IN (SELECT student_code FROM tbl_student_class WHERE year_id = $yearid) GROUP BY DATE_FORMAT(birthday, '%Y'); ");
        return $query->fetchAll();
    }
    /**
     * Eng block two
     */
    
    /**
     * Begin Block three
     */
    function get_percent_gender_personnel(){
        $query = $this->db->query("SELECT COUNT(*) AS Total, 'Nam' AS title FROM tbl_personnel WHERE status = 1 AND gender = 1
                                    UNION ALL
                                    SELECT COUNT(*) AS Total, 'Nữ' AS title FROM tbl_personnel WHERE status = 1 AND gender = 2");
        return $query->fetchAll();
    }

    function get_percent_level_personnel(){
        $query = $this->db->query("SELECT level_id, IF(level_id = 0, 'Chưa rõ', (SELECT title FROM tbldm_level 
                                    WHERE tbldm_level.id = level_id)) AS title, COUNT(*) AS Total FROM tbl_personnel 
                                    WHERE status = 1 GROUP BY level_id");
        return $query->fetchAll();
    }

    function get_percent_regency_personnel(){
        $query = $this->db->query("SELECT regency_id, IF(regency_id = 0, 'Chưa rõ', (SELECT title FROM tbldm_regency
                                    WHERE tbldm_regency.id = regency_id)) AS title, COUNT(*) AS Total FROM tbl_personnel
                                    WHERE status = 1 GROUP BY regency_id");
        return $query->fetchAll();
    }

    function get_percent_job_personnel(){
        $query = $this->db->query("SELECT job_id, IF(job_id = 0, 'Chưa rõ', (SELECT title FROM tbldm_job
                                    WHERE tbldm_job.id = job_id)) AS title, COUNT(*) AS Total FROM tbl_personnel
                                    WHERE status = 1 GROUP BY job_id");
        return $query->fetchAll();
    }
    /**
     * End Block three
     */

    /**
     * Begin Block four
     */
     
    /**
     * End Block four
     */

    /**
     * Begin Block six
     */
    function getFetObj_block_six($userid){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_work_pro WHERE user_id = $userid OR is_publish = 1 OR FIND_IN_SET($userid, user_share)");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, (SELECT tbl_work_pro_cate.title FROM tbl_work_pro_cate WHERE tbl_work_pro_cate.id = cate_id) AS work_cate 
                                    FROM tbl_work_pro WHERE user_id = $userid OR is_publish = 1 OR FIND_IN_SET($userid, user_share) ORDER BY id DESC LIMIT 0, 10");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/10);
        $result['rows'] = $query->fetchAll();
        return $result;
    }
}
?>