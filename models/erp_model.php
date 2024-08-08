<?php
class Erp_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($userid, $q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_task WHERE (user_id_create = $userid OR user_id_monitor = $userid
                                    OR FIND_IN_SET($userid, user_id_process)) AND (title LIKE '%$q%' OR content LIKE '%$q%')");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, group_id, user_id_create, user_id_process, user_id_monitor, date_start, DATE_FORMAT(date_end, '%d-%m-%Y') AS date_end, title, 
                                    status AS trang_thai, content, private, display_week, DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at, (SELECT tbl_task_group.title 
                                    FROM tbl_task_group WHERE tbl_task_group.id = group_id) AS group_title, prioritize, IF(user_id_create = 1, 'Administrator',
                                    (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = user_id_create))) 
                                    AS user_create, DATEDIFF(date_end, CURRENT_DATE()) AS deadline, IF(status = 2, DATEDIFF(date_done, date_end), 0) AS date_result,
                                    IF(user_id_monitor = 1, 'Administrator', (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users 
                                    WHERE tbl_users.id = user_id_monitor))) AS user_monitor, IF(status = 1 AND user_id_create != $userid AND user_id_monitor != $userid, 
                                    IF((SELECT COUNT(*) FROM tbl_task_result WHERE task_id = tbl_task.id AND tbl_task_result.user_id = $userid) > 0, 1, 0), status) AS status
                                    FROM tbl_task WHERE (user_id_create = $userid OR user_id_monitor = $userid OR FIND_IN_SET($userid, user_id_process)) 
                                    AND (title LIKE '%$q%' OR content LIKE '%$q%') ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_task", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_task", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_task", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT id, code, group_id, user_id_create, user_id_process, user_id_monitor, date_start, date_end, title, prioritize,
                                    content, private, display_week, status, DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at, (SELECT tbl_task_group.title 
                                    FROM tbl_task_group WHERE tbl_task_group.id = group_id) AS group_title, IF(user_id_create = 1, 'Administrator',
                                    (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = user_id_create))) 
                                    AS user_create, IF(user_id_monitor = 1, 'Administrator', (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id 
                                    FROM tbl_users WHERE tbl_users.id = user_id_monitor))) AS user_monitor, (SELECT COUNT(*) FROM tbl_task_file WHERE tbl_task_file.code_task = tbl_task.code)
                                    AS file_att FROM tbl_task WHERE id = $id");
        return $query->fetchAll();
    }
//////////////////////////////////////////////////////////////////////////////////////
    function updateObj_task_file($code, $data){
        $query = $this->update("tbl_task_file", $data, "code_task = $code");
        return $query;
    }

    function get_task_file($code){
        $query = $this->db->query("SELECT id, code, code_task, file FROM tbl_task_file WHERE code_task = $code AND status = 1");
        return $query->fetchAll();
    }
//////////////////////////////////////////////////////////////////////////////////////////
    function addObj_task_result($data){
        $query = $this->insert("tbl_task_result", $data);
        return $query;
    }

    function get_date_result($id){
        $query = $this->db->query("SELECT DATE_FORMAT(create_at, '%d-%m-%Y') AS create_at FROM tbl_task_result WHERE task_id = $id
                                    GROUP BY DATE_FORMAT(create_at, '%d-%m-%Y') ORDER BY DATE_FORMAT(create_at, '%d-%m-%Y') DESC");
        return $query->fetchAll();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_data_edit($id){
        $query = $this->db->query("SELECT id, code, group_id, user_id_create, user_id_process, user_id_monitor, DATE_FORMAT(date_start, '%d-%m-%Y') AS date_start, 
                                    DATE_FORMAT(date_end, '%d-%m-%Y') AS date_end, title, content, private, display_week, prioritize, (SELECT tbl_task_group.title 
                                    FROM tbl_task_group WHERE tbl_task_group.id = group_id) AS group_title, IF(user_id_create = 1, 'Administrator',
                                    (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = user_id_create))) 
                                    AS user_create, IF(user_id_monitor = 1, 'Administrator', (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id 
                                    FROM tbl_users WHERE tbl_users.id = user_id_monitor))) AS user_monitor, (SELECT COUNT(*) FROM tbl_task_file WHERE tbl_task_file.code_task = tbl_task.code)
                                    AS file_att FROM tbl_task WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function return_id_task_by_code($code){
        $query = $this->db->query("SELECT id FROM tbl_task WHERE code = $code");
        $row = $query->fetchAll();
        return $row[0]['id'];
    }

    function return_info_personnel_to_send_mail($id){
        $query = $this->db->query("SELECT id, code, fullname, email FROM tbl_personnel WHERE id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = $id)");
        return $query->fetchAll();
    }

    function return_total_row_task_comment_of_user_id($id, $userid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_task_result WHERE task_id = $id AND user_id = $userid");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>