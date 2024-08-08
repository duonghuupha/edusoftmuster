<?php
class Validate_proof_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_proof");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, encode, user_id, status, DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at,
                                    IF(user_id = 1, 'Administator', (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id 
                                    FROM tbl_users WHERE tbl_users.id = user_id))) AS fullname, stand_id, criteria_id, (SELECT title FROM tbl_validate_standard
                                    WHERE tbl_validate_standard.id = stand_id) AS stand_title, (SELECT title FROM tbl_validate_criteria
                                    WHERE tbl_validate_criteria.id = criteria_id) AS criteria_title FROM tbl_validate_proof ORDER BY id DESC 
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $encode){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_proof WHERE encode = '$encode'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_validate_proof WHERE encode = '$encode' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_validate_proof", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_validate_proof", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_validate_proof", "id = $id");
        return $query;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_stand_role($userid){
        if($userid == 1){
            $query = $this->db->query("SELECT id, title FROM tbl_validate_standard WHERE status = 1");
        }else{
            $query = $this->db->query("SELECT id, title FROM tbl_validate_standard WHERE status = 1 AND FIND_IN_SET(id, (SELECT stand_id FROM tbl_validate_role
                                        WHERE user_id = $userid AND tbl_validate_role.status = 1))");
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_criteria_role($stand_id, $userid){
        if($userid == 1){
            $query = $this->db->query("SELECT id, title FROM tbl_validate_criteria WHERE status = 1 AND stand_id = $stand_id");
        }else{
            $query = $this->db->query("SELECT id, title FROM tbl_validate_criteria WHERE status = 1 AND stand_id = $stand_id AND FIND_IN_SET(id, (SELECT criteria_id
                                        FROM tbl_validate_role WHERE user_id = $userid AND tbl_validate_role.status = 1))");
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>