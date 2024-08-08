<?php
class Decentral_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE id != 1 AND status = 1
                                    AND username LIKE '%$q%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, username, personnel_id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = personnel_id)
                                    AS fullname, (SELECT title FROM tbl_group_role WHERE tbl_group_role.id = group_role_id) AS group_role_title 
                                    FROM tbl_users WHERE id != 1 AND status = 1 AND username LIKE '%$q%' ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_users", $data, "id = $id");
        return $query;
    }
}
?>