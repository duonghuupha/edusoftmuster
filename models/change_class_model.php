<?php
class Change_class_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE status = 1 AND fullname LIKE '%$q%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday, gender,
                                    (SELECT class_id FROM tbl_student_class WHERE tbl_student_class.student_code = tbl_student.code) AS class_id,
                                    (SELECT title FROM tbl_class WHERE tbl_class.id = (SELECT class_id FROM tbl_student_class 
                                    WHERE tbl_student_class.student_code = tbl_student.code)) AS class_title FROM tbl_student 
                                    WHERE status = 1 AND fullname LIKE '%$q%' ORDER BY fullname ASC LIMIT $offset, $rows"); 
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function getFetObj_change_class($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_change_class");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, student_id, year_id_from, class_id_from, year_id_to, class_id_to, content, status,
                                    DATE_FORMAT(create_at, '%d-%m-%Y') AS create_at, (SELECT title FROM tbl_class WHERE tbl_class.id = class_id_from) AS class_from,
                                    (SELECT title FROM tbl_class WHERE tbl_class.id = class_id_to) AS class_to,
                                    (SELECT title FROM tbl_years WHERE tbl_years.id = year_id_from) AS year_from, 
                                    (SELECT fullname FROM tbl_student WHERE tbl_student.id= student_id) AS fullname,
                                    (SELECT title FROM tbl_years WHERE tbl_years.id = year_id_to) AS year_to FROM tbl_student_change_class 
                                    ORDER BY id DESC LIMIT $offset, $rows"); 
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_student_change_class", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_student_change_class", $data, "id= $id");
        return $query;
    }

    function get_detail($id){
        $query = $this->db->query("SELECT id, student_id, year_id_from, class_id_from, year_id_to, class_id_to, content, status,
                                    DATE_FORMAT(create_at, '%d-%m-%Y') AS create_at, (SELECT title FROM tbl_class WHERE tbl_class.id = class_id_from) AS class_from,
                                    (SELECT title FROM tbl_class WHERE tbl_class.id = class_id_to) AS class_to, code,
                                    (SELECT title FROM tbl_years WHERE tbl_years.id = year_id_from) AS year_from, 
                                    (SELECT title FROM tbl_years WHERE tbl_years.id = year_id_to) AS year_to,
                                    (SELECT fullname FROM tbl_student WHERE tbl_student.id= student_id) AS fullname,
                                    (SELECT tbl_student.code FROM tbl_student WHERE tbl_student.id= student_id) AS student_code,
                                    (SELECT birthday FROM tbl_student WHERE tbl_student.id= student_id) AS birthday FROM tbl_student_change_class WHERE id= $id");
        return $query->fetchAll();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_info_student($id){
        $query = $this->db->query("SELECT id, code, (SELECT tbl_student.code FROM tbl_student WHERE tbl_student.id = student_id) AS code_stu,
                                    class_id_to, year_id_to FROM tbl_student_change_class WHERE id = $id");
        return  $query->fetchAll();
    }

    function updateObj_class_student($code, $yearid, $data){
        $query = $this->update("tbl_student_class", $data, "year_id = $yearid AND student_code = $code");
        return $query;
    }
}
?>