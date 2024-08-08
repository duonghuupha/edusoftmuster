<?php
class Users_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE id != 1 AND (username LIKE '%$q%' OR
                                    personnel_id IN (SELECT tbl_personnel.id FROM tbl_personnel WHERE fullname LIKE '%$q%'))");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, username, personnel_id, group_role_id, last_login, info_login, status,
                                    (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = personnel_id) AS fullname,
                                    (SELECT title FROM tbl_group_role WHERE tbl_group_role.id = group_role_id) AS group_role
                                    FROM tbl_users WHERE id != 1 AND (username LIKE '%$q%' OR personnel_id IN (SELECT tbl_personnel.id 
                                    FROM tbl_personnel WHERE fullname LIKE '%$q%')) ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $username, $per_id){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username = '$username' OR personnel_id = $per_id");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE (username = '$username' OR personnel_id = $per_id) AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_users", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_users", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete('tbl_users', "id = $id");
        return $query;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_combo_personnel($q){
        $query = $this->db->query("SELECT id, fullname AS title FROM tbl_personnel WHERE status = 1 AND fullname LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>