<?php
class Muster_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($yearid, $class_id, $date, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_class WHERE year_id = $yearid AND class_id = $class_id AND student_code NOT IN (SELECT tbl_student.code
                                    FROM tbl_student WHERE tbl_student.id IN (SELECT student_id FROM tbl_student_muster WHERE class_id = $class_id AND 
                                    date_muster = '$date'))");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT student_code AS code, class_id,
                                    (SELECT identifier FROM tbl_student WHERE tbl_student.code = student_code) AS identifier, 
                                    (SELECT fullname FROM tbl_student WHERE tbl_student.code = student_code) AS fullname, 
                                    (SELECT DATE_FORMAT(birthday, '%d-%m-%Y') FROM tbl_student WHERE tbl_student.code = student_code) AS birthday,
                                    (SELECT gender FROM tbl_student WHERE tbl_student.code = student_code) AS gender, 
                                    (SELECT tbl_student.id FROM tbl_student WHERE tbl_student.code = student_code) AS id 
                                    FROM tbl_student_class WHERE year_id = $yearid AND class_id = $class_id AND student_code NOT IN (SELECT tbl_student.code
                                    FROM tbl_student WHERE tbl_student.id IN (SELECT student_id FROM tbl_student_muster WHERE class_id = $class_id AND 
                                    date_muster = '$date')) ORDER BY (SELECT fullname FROM tbl_student WHERE tbl_student.code = student_code) ASC 
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function getFetObj_muster($class_id, $date, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_muster WHERE date_muster = '$date' AND class_id = $class_id");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT student_id AS id, class_id, (SELECT tbl_student.code FROM tbl_student WHERE tbl_student.id = student_id) AS code,
                                    (SELECT tbl_student.fullname FROM tbl_student WHERE tbl_student.id = student_id) AS fullname,
                                    (SELECT DATE_FORMAT(birthday, '%d-%m-%Y') FROM tbl_student WHERE tbl_student.id = student_id) AS birthday,
                                    (SELECT gender FROM tbl_student WHERE tbl_student.id = student_id) AS gender, breakfast FROM tbl_student_muster
                                    WHERE date_muster = '$date' AND class_id = $class_id ORDER BY tbl_student_muster.id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function addObj($data){
        $query = $this->insert("tbl_student_muster", $data);
        return $query;
    }

    function delObj($id, $classid, $date){
        $query = $this->delete("tbl_student_muster", "student_id = $id AND class_id = $classid AND date_muster = '$date'");
        return $query;
    }

    function updateObj($where, $data){
        $query = $this->update("tbl_student_muster", $data, $where);
        return $query;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function addObj_food($data){
        $query = $this->insert("tbl_time_food", $data);
        return $query;
    }

    function get_history_time_food($classid, $date){
        $query = $this->db->query("SELECT id, code, class_id, user_id, food_main, food_morning, create_at, (SELECT title FROM tbl_class WHERE tbl_class.id = class_id) 
                                    AS class_title, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = user_id))
                                    AS fullname FROM tbl_time_food WHERE class_id= $classid AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$date' ORDER BY id DESC");
        return $query->fetchAll();
    }

    function check_muster_by_date($class_id, $date){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_muster WHERE class_id = $class_id AND date_muster = '$date'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function check_student_in_class($class_id){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_class WHERE class_id = $class_id");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function check_muster_morning_by_date($class_id, $date){
        $query = $this->db->query("SELECT COUNT(breakfast) AS Total FROM tbl_student_muster WHERE class_id = $class_id AND date_muster = '$date'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>