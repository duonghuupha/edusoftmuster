<?php
class Model {
    function __construct() {
		$this->db = new Database();
	}

    // them moi du lieu
    function insert($table, $data) {
        $fields = array_keys($data);
        $params = array_map(fn($f) => ':' . $f, $fields);

        $sql = "INSERT INTO {$table}
                (" . implode(',', $fields) . ")
                VALUES (" . implode(',', $params) . ")";

        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            if (is_resource($value) || is_string($value) && strlen($value) > 1000) {
                $stmt->bindValue(':' . $key, $value, PDO::PARAM_LOB);
            } else {
                $stmt->bindValue(':' . $key, $value);
            }
        }

        return $stmt->execute();
    }


    // cap nhat du lieu
    function update($table, $array, $where){
        $set = array();
        foreach($array as $key => $value){
            $set[] = $key." = '".$value."'";
        }
        $query = $this->db->query("UPDATE ".$table." SET ".implode(",", $set)." WHERE ".$where);
        return $query;
    }

    // xoa du lieu
    function delete($table, $where = ''){
        if($where == ''){
            $query = $this->db->query("DELETE FROM ".$table);
        }else{
        $query = $this->db->query("DELETE FROM ".$table." WHERE ".$where);
        }
        return $query;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Check token
     */
    function check_token($token){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE token = '$token' AND status = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    
    /**
     * return fullname by user_id
     */
    function return_fullname_personnel_userid($personel_id){
        $query = $this->db->query("SELECT fullname FROM tbl_personnel WHERE id = $personel_id");
        $row = $query->fetchAll();
        return $row[0]['fullname'];
    }

    /**
     * return last food_main
     */
    function get_last_food_main_of_date($class_id, $date){
        $query = $this->db->query("SELECT food_main FROM tbl_time_food WHERE class_id = $class_id AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$date'
                                    ORDER BY id DESC LIMIT 0, 1");
        $row = $query->fetchAll();
        return $row[0]['food_main'];
    }

    /**
     * return value share food
     */
    function get_value_share_food($food_id, $system_id, $type_food){
        $query = $this->db->query("SELECT value_share FROM tbldm_food_ct WHERE food_code = (SELECT tbldm_food.code FROM tbldm_food WHERE tbldm_food.id = $food_id
                                    AND tbldm_food.type_id = $type_food) AND system_id = $system_id");
        $row = $query->fetchAll();
        return $row[0]['value_share'];
    }
}

?>
