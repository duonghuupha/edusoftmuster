<?php
class Department_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, title, code, status, physical_id, year_id, training_system_id, (SELECT title FROM tbl_years
                                    WHERE tbl_years.id = year_id) AS year_title, is_class, (SELECT title FROM tbldm_physical_room
                                    WHERE tbldm_physical_room.id = physical_id) AS physical_title, (SELECT title FROM tbldm_training_system
                                    WHERE tbldm_training_system.id = training_system_id) AS system_title FROM tbl_class ORDER BY id DESC
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $physical, $yearid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class WHERE physical_id = $physical AND year_id = $yearid");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class WHERE physical_id = $physical AND year_id = $yearid 
                                        AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_class", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_class", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_class", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_class WHERE id = $id");
        return $query->fetchAll();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_department_pass_year($yearid){
        $query = $this->db->query("SELECT id, title FROM tbl_class WHERE year_id = $yearid AND status = 1 AND is_class = 1");
        return $query->fetchAll();
    }

    function get_user_class($id){
        $query = $this->db->query("SELECT user_id_charge FROM tbl_class WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['user_id_charge'];
    }

    function check_exit_user_charge($yearid,  $userid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class WHERE year_id = $yearid AND FIND_IN_SET($userid, user_id_charge) AND status = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function updateObj_charge($id, $data){
        $query = $this->update("tbl_class", $data, "id =  $id");
        return $query;
    }

    function get_list_fullname_per_class($id){
        $query = $this->db->query("SELECT id, personnel_id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = personnel_id)
                                    AS fullname FROM tbl_users WHERE FIND_IN_SET(tbl_users.id, (SELECT user_id_charge FROM tbl_class
                                    WHERE id = $id))");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_dep_copy($yearid){
        $query = $this->db->query("SELECT id, physical_id, year_id, training_system_id, is_class, title, user_id_charge 
                                    FROM tbl_class WHERE year_id = $yearid");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function check_data_copy($yearid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class WHERE year_id = $yearid");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function dupli_code_copy($code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class WHERE code = $code");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>