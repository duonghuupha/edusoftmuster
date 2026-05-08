<?php
class Diemdanh_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($class_id, $date, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_class WHERE class_id = $class_id");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT class_id, (SELECT fullname FROM tbl_student WHERE tbl_student.code = student_code) AS fullname, 
                                    (SELECT tbl_student.id FROM tbl_student WHERE tbl_student.code = student_code) AS id,
                                    (SELECT COUNT(*) AS Total FROM tbl_student_muster WHERE class_id = $class_id AND date_muster = '$date'
                                    AND student_id = (SELECT tbl_student.id FROM tbl_student WHERE tbl_student.code = student_code)) AS muster 
                                    FROM tbl_student_class WHERE class_id = $class_id ORDER BY (SELECT fullname FROM tbl_student 
                                    WHERE tbl_student.code = student_code) ASC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_combo_class($q, $yearid){
        $query = $this->db->query("SELECT id, title FROM tbl_class WHERE status = 1 AND year_id = $yearid AND title LIKE '%$q%' ORDER BY order_class ASC");
        return $query->fetchAll();
    }

    function dupliObj($studentid, $classid, $date){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_muster WHERE student_id = $studentid AND class_id = $classid AND date_muster = '$date'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_student_muster", $data);
        return $query;
    }

    function delObj($id, $classid, $date){
        $query = $this->delete("tbl_student_muster", "student_id = $id AND class_id = $classid AND date_muster = '$date'");
        return $query;
    }

    function get_data_time_food($classid, $date){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_muster WHERE class_id = $classid AND date_muster = '$date'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj_food($data){
        $query = $this->insert("tbl_time_food", $data);
        return $query;
    }
}
?>