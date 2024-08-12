<?php
class Muster_data_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($classid, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM (SELECT food_main FROM tbl_time_food WHERE class_id = $classid
                                    GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d')) AS Phadh");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT class_id, DATE_FORMAT(create_at, '%Y-%m-%d') AS create_at FROM tbl_time_food WHERE class_id = $classid 
                                    GROUP BY DATE_FORMAT(create_at, '%Y-%m-%d') ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d') DESC 
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }  

    function get_class_id_pass_yearid_an_userid($yearid, $userid){
        $query = $this->db->query("SELECT id FROM tbl_class WHERE year_id = $yearid AND FIND_IN_SET($userid, user_id_charge) AND status = 1");
        $row = $query->fetchAll();
        if(count($row) > 0){
            return $row[0]['id'];
        }else{
            return 0;
        }
    }
}
?>