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
     * return fullname personnel pass user_id
     */
    function return_fullname_pass_user_id($id){
        $query = $this->db->query("SELECT fullname FROM tbl_personnel WHERE id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = $id)");
        $row = $query->fetchAll();
        return $row[0]['fullname'];
    }

    /**
     * return timeline comment task pass date create
     */
    function return_list_result_task_pass_date_create($id, $date){
        $query = $this->db->query("SELECT create_at, content, code, IF(user_id = 1, 'Administrator', (SELECT fullname FROM tbl_personnel
                                    WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = user_id))) AS user_create 
                                    FROM tbl_task_result WHERE task_id = $id AND DATE_FORMAT(create_at, '%d-%m-%Y') = '$date' ORDER BY id DESC");
        return $query->fetchAll();
    }

    /**
     * return file attach result
     */
    function return_list_file_result($code){
        $query = $this->db->query("SELECT file FROM tbl_task_result_file WHERE code_result = $code AND status = 1");
        return $query->fetchAll();
    }

    /**
     * return parent_name roles
     */
    function return_parent_name_roles($id){
        $query = $this->db->query("SELECT title FROM tbl_roles WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }

    /**
     * return sidebar roles
     */
    function return_sidebar($userid, $id){
        if($userid == 1){
            $query = $this->db->query("SELECT id, title, icon, link, parent_id FROM tbl_roles WHERE parent_id = $id AND status = 1 ORDER BY order_position ASC");
        }else{
            $query = $this->db->query("SELECT id, title, icon, link, parent_id FROM tbl_roles WHERE parent_id = $id AND FIND_IN_SET(id,
                                        (SELECT roles FROM tbl_group_role WHERE tbl_group_role.id = (SELECT group_role_id FROM tbl_users WHERE tbl_users.id = $userid)))
                                        AND status = 1 ORDER BY order_position ASC");
        }
        return $query->fetchAll();
    }

    /**
     * return id role via link
     */
    function return_id_role_via_link($link){
        $query = $this->db->query("SELECT parent_id FROM tbl_roles WHERE link = '$link'");
        $row = $query->fetchAll();
        return $row[0]['parent_id'];
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * return role parent
     */
    function get_data_role_parent(){
        $query = $this->db->query("SELECT id, title, link, functions FROM tbl_roles WHERE parent_id = 0 AND status = 1 ORDER BY order_position ASC");
        return $query->fetchAll();
    }

    /**
     * return role sub
     */
    function get_data_role_sub($id){
        $query = $this->db->query("SELECT id, title, link, functions FROM tbl_roles WHERE parent_id = $id AND status = 1 ORDER BY order_position ASC");
        return $query->fetchAll();
    }

    /**
     * Check role of group
     */
    function checked_role($id, $role){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_group_role WHERE id = $id
                                    AND FIND_IN_SET('$role', roles)");
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
     * return dupli code personnel_temp
     */
    function return_dupli_code_personnel_temp($code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_personnel WHERE code = $code AND status = 99");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    /**
     * kiem tra quyen nguoi dung
     */
    function check_role_controller($grouproleid, $link){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_group_role WHERE id = $grouproleid 
                                    AND FIND_IN_SET((SELECT tbl_roles.id FROM tbl_roles 
                                    WHERE tbl_roles.link = '$link'), roles) AND status = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    /**
     * return list user class
     */
    function get_list_name_per_class($id){
        $query = $this->db->query("SELECT id, personnel_id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = personnel_id)
                                    AS fullname FROM tbl_users WHERE FIND_IN_SET(tbl_users.id, (SELECT user_id_charge FROM tbl_class
                                    WHERE id = $id))");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * return list criteria
     */
    function get_list_criteria($stand_id){
        $query = $this->db->query("SELECT id, title, content FROM tbl_validate_criteria WHERE stand_id = $stand_id AND status = 1
                                ORDER BY id ASC");
        return $query->fetchAll();
    }

    /**
     * return standard
     */
    function get_standard($id){
        $query = $this->db->query("SELECT title FROM tbl_validate_standard WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }

    /**
     * return criteria
     */
    function get_criteria($id){
        $query = $this->db->query("SELECT title FROM tbl_validate_criteria WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }

    /**
     * return  file name document_in
     */
    function return_file_name_dc_in($id){
        $query = $this->db->query("SELECT file, title FROM tbl_document_in WHERE id= $id");
        return $query->fetchAll();
    }

    /**
     * return  file name document_out
     */
    function return_file_name_dc_out($id){
        $query = $this->db->query("SELECT file, title FROM tbl_document_out WHERE id= $id");
        return $query->fetchAll();
    }

    /**
     * return fullname user_process
     */
    function return_fullname_user_proccess_task($id){
        $query = $this->db->Query("SELECT fullname FROM tbl_personnel WHERE id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = $id)");
        $row = $query->fetchAll();
        if($id == 1){
            return 'Administrator';
        }else{
            return $row[0]['fullname'];
        }
    }

    /**
     * return check_role_function
     */
    function check_functions_role($userid, $functions, $controller){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_group_role WHERE id = (SELECT group_role_id FROM tbl_users WHERE tbl_users.id= $userid)
                                    AND FIND_IN_SET(CONCAT((SELECT tbl_roles.id FROM tbl_roles WHERE tbl_roles.link = '$controller'), '_', $functions), roles)");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Hien thi danh sach cong viec theo ngay cuaa tung nguoi dung
     */
    function get_task_of_date($str_user, $date){
        $query = $this->db->query("SELECT id, title, user_id_process, user_id_monitor, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id
                                    FROM tbl_users WHERE tbl_users.id = user_id_monitor)) AS user_monitor FROM tbl_task WHERE display_week = 1 AND date_start <= '$date' 
                                    AND date_end >= '$date' AND (FIND_IN_SET('$str_user', user_id_process) OR FIND_IN_SET(user_id_monitor, '$str_user')) ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_task_of_date_first($str_user, $date){
        $query = $this->db->query("SELECT id, title, user_id_process, user_id_monitor, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id
                                    FROM tbl_users WHERE tbl_users.id = user_id_monitor)) AS user_monitor FROM tbl_task WHERE display_week = 1 AND date_start <= '$date' 
                                    AND date_end >= '$date' AND (FIND_IN_SET('$str_user', user_id_process) OR FIND_IN_SET(user_id_monitor, '$str_user')) ORDER BY id DESC
                                    LIMIT 0, 1");
        return $query->fetchAll();
    }

    function get_task_of_date_continue($str_user, $date){
        $query = $this->db->query("SELECT id, title, user_id_process, user_id_monitor, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id
                                    FROM tbl_users WHERE tbl_users.id = user_id_monitor)) AS user_monitor FROM tbl_task WHERE display_week = 1 AND date_start <= '$date' 
                                    AND date_end >= '$date' AND (FIND_IN_SET('$str_user', user_id_process) OR FIND_IN_SET(user_id_monitor, '$str_user')) ORDER BY id DESC
                                    LIMIT 1, 1000");
        return $query->fetchAll();
    }
}

?>
