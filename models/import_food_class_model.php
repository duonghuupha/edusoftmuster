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

    // thuc don hien tai chinh
    function get_menu_food_ct_current_date($date_menu, $week_odd_even){
        $query = $this->db->query("SELECT food_id, (SELECT type_id FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) AS type_food, 
                                    (SELECT tbldm_food.title FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) AS title_food, 
                                    (SELECT tbldm_unit.title FROM tbldm_unit WHERE tbldm_unit.id = (SELECT tbldm_food.unit_id FROM tbldm_food WHERE tbldm_food.id = food_id 
                                    AND tbldm_food.status = 1)) AS unit_title FROM tbl_menu_food_detail WHERE menu_code_ct = (SELECT tbl_menu_food_ct.code FROM tbl_menu_food_ct 
                                    WHERE date_menu = $date_menu AND type_menu = 1 AND menu_id = (SELECT tbl_menu_food.id FROM tbl_menu_food WHERE tbl_menu_food.week_odd_even = $week_odd_even 
                                    ORDER BY date_start DESC LIMIT 0, 1)) ORDER BY (SELECT type_id FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) ASC;");
        return $query->fetchAll();
    }

    // thuc don hien tai phu mau giao
    function get_menu_food_ct_current_date_sub_mg($date_menu, $week_odd_even){
        $query = $this->db->query("SELECT food_id, (SELECT type_id FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) AS type_food, 
                                    (SELECT tbldm_food.title FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) AS title_food, 
                                    (SELECT tbldm_unit.title FROM tbldm_unit WHERE tbldm_unit.id = (SELECT tbldm_food.unit_id FROM tbldm_food WHERE tbldm_food.id = food_id 
                                    AND tbldm_food.status = 1)) AS unit_title FROM tbl_menu_food_detail WHERE menu_code_ct = (SELECT tbl_menu_food_ct.code FROM tbl_menu_food_ct 
                                    WHERE date_menu = $date_menu AND type_menu = 4 AND menu_id = (SELECT tbl_menu_food.id FROM tbl_menu_food WHERE tbl_menu_food.week_odd_even = $week_odd_even 
                                    ORDER BY date_start DESC LIMIT 0, 1)) ORDER BY (SELECT type_id FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) ASC;");
        return $query->fetchAll();
    }

    // thuc don hien tai phu mau giao
    function get_menu_food_ct_current_date_sub_nt($date_menu, $week_odd_even){
        $query = $this->db->query("SELECT food_id, (SELECT type_id FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) AS type_food,
                                    (SELECT tbldm_food.title FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) AS title_food,
                                    (SELECT tbldm_unit.title FROM tbldm_unit WHERE tbldm_unit.id = (SELECT tbldm_food.unit_id FROM tbldm_food WHERE tbldm_food.id = food_id 
                                    AND tbldm_food.status = 1)) AS unit_title FROM tbl_menu_food_detail WHERE menu_code_ct IN (SELECT tbl_menu_food_ct.code FROM tbl_menu_food_ct 
                                    WHERE date_menu = $date_menu AND (type_menu = 2 OR type_menu = 3) AND tbl_menu_food_ct.menu_id = (SELECT tbl_menu_food.id FROM tbl_menu_food 
                                    WHERE week_odd_even = $week_odd_even AND status = 1 ORDER BY date_start DESC LIMIT 0, 1)) 
                                    ORDER BY (SELECT type_id FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) ASC");
        return $query->fetchAll();
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