<?php
class Model {
    function __construct() {
		$this->db = new Database();
	}

    // them moi du lieu
    function insert($table, $array){
        $cols = array();
        $bind = array();
        foreach($array as $key => $value){
            $cols[] = $key;
            $bind[] = "'".$value."'";
        }
        $query = $this->db->query("INSERT INTO ".$table." (".implode(",", $cols).") VALUES (".implode(",", $bind).")");
        return $query;
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
}

?>
