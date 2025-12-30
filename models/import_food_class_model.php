<?php
class Import_food_class_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    // get tong so hoc sinh di hoc hom nay
    function get_total_student_muster($class_id, $date){
        $query = $this->db->query("SELECT food_main FROM tbl_time_food WHERE class_id = $class_id AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$date'
                                    ORDER BY id DESC LIMIT 0, 1");
        $row = $query->fetchAll();
        return $row[0]['food_main'];
    }

    // tra ve id cua lop hoc theo nam hoc va id giao vien
    function get_class_id_pass_yearid_an_userid($yearid, $userid){
        $query = $this->db->query("SELECT id, training_system_id FROM tbl_class WHERE year_id = $yearid AND FIND_IN_SET($userid, user_id_charge) AND status = 1");
        return $row = $query->fetchAll();
    }
    
    function check_type_edu($sytem_id){
        $query = $this->db->query("SELECT type_edu FROM tbldm_training_system WHERE id = $sytem_id");
        $row = $query->fetchAll();
        return $row[0]['type_edu'];
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function addObj($data){
        $query = $this->insert("tbl_imp_food_class", $data);
        return $query;
    }

    function addObj_detail($data){
        $query = $this->insert("tbl_imp_food_class_detail", $data);
        return $query;
    }

    function dupliObj($class_id, $type_menu, $date){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_imp_food_class WHERE class_id = $class_id AND type_menu = $type_menu 
                                    AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$date'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_signture_food_class($class_id, $type_menu, $date){
        $query = $this->db->query("SELECT img_single, mime_type FROM tbl_imp_food_class WHERE class_id = $class_id AND type_menu = $type_menu 
                                    AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$date' ORDER BY id DESC LIMIT 0, 1");
        return $row = $query->fetchAll();
    }
}
?>