<?php
class Muster_data_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_class_pass_year($yearid, $date){
        $query = $this->db->query("SELECT id, title, (SELECT food_main FROM tbl_time_food WHERE class_id = tbl_class.id
                                    AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$date' ORDER BY id DESC LIMIT 0, 1) AS food_main, 
                                    (SELECT food_morning FROM tbl_time_food WHERE class_id = tbl_class.id AND 
                                    DATE_FORMAT(create_at, '%Y-%m-%d') = '$date' ORDER BY id DESC LIMIT 0, 1) AS food_morning,
                                    (SELECT COUNT(*) FROM tbl_time_food WHERE class_id = tbl_class.id AND 
                                    DATE_FORMAT(create_at, '%Y-%m-%d') = '2024-07-31') AS total_main,
                                    (SELECT food_main FROM tbl_time_food WHERE class_id = tbl_class.id
                                    AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$date' ORDER BY id DESC LIMIT 1, 1) AS food_main_old, 
                                    (SELECT food_morning FROM tbl_time_food WHERE class_id = tbl_class.id AND 
                                    DATE_FORMAT(create_at, '%Y-%m-%d') = '$date' ORDER BY id DESC LIMIT 1, 1) AS food_morning_old 
                                    FROM tbl_class WHERE year_id = $yearid AND is_class = 1");
        return $query->fetchAll();
    }
}
?>