<?php
class Students_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE status != 99 AND fullname LIKE '%$q%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, identifier, fullname, nickname, DATE_FORMAT(birthday, '%d-%m-%Y') As birthday, gender, image, status,
                                    (SELECT address FROM tbl_student_add WHERE student_code = tbl_student.code ORDER BY id DESC LIMIT 0, 1) AS address,
                                    (SELECT title FROM tbl_class WHERE tbl_class.id = (SELECT class_id FROM tbl_student_class 
                                    WHERE tbl_student_class.student_code = tbl_student.code) ORDER BY id DESC LIMIT 0, 1) AS class_title 
                                    FROM tbl_student WHERE status != 99 AND fullname LIKE '%$q%' ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function getFetObj_user($yearid, $class_id, $q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_class WHERE year_id = $yearid AND class_id = $class_id
                                    AND student_code IN (SELECT tbl_student.code FROM tbl_student WHERE fullname LIKE '%$q%')");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT student_code AS code, year_id, class_id, (SELECT title FROM tbl_class WHERE tbl_class.id = class_id) AS class_title,
                                    (SELECT identifier FROM tbl_student WHERE tbl_student.code = student_code) AS identifier, (SELECT fullname FROM tbl_student
                                    WHERE tbl_student.code = student_code) AS fullname, (SELECT nickname FROM tbl_student WHERE tbl_student.code = student_code)
                                    AS nickname, (SELECT DATE_FORMAT(birthday, '%d-%m-%Y') FROM tbl_student WHERE tbl_student.code = student_code) AS birthday,
                                    (SELECT gender FROM tbl_student WHERE tbl_student.code = student_code) AS gender, (SELECT image FROM tbl_student
                                    WHERE tbl_student.code = student_code) AS image, (SELECT tbl_student.status FROM tbl_student WHERE tbl_student.code = student_code)
                                    AS status, (SELECT tbl_student.id FROM tbl_student WHERE tbl_student.code = student_code) AS id, (SELECT address FROM tbl_student_add
                                    WHERE tbl_student_add.student_code = student_code ORDER BY id DESC LIMIT 0, 1) AS address FROM tbl_student_class WHERE year_id = $yearid 
                                    AND class_id = $class_id AND student_code IN (SELECT tbl_student.code FROM tbl_student WHERE fullname LIKE '%$q%')ORDER BY (SELECT fullname 
                                    FROM tbl_student WHERE tbl_student.code = student_code) ASC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code, $identifier){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE code = $code OR identifier = '$identifier'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE (code = $code OR identifier = '$identifier') AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_student", $data);
        return $query;
    }

    function addObj_address($data){
        $query = $this->insert("tbl_student_add", $data);
        return $query;
    }

    function addObj_relation($data){
        $query = $this->insert("tbl_student_relation", $data);
        return $query;
    }

    function addObj_class($data){
        $query = $this->insert("tbl_student_class", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_student", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_student", "id = $id");
        return $query;
    }

    function updateObj_all($data){
        $query = $this->update("tbl_student", $data, "status = 99");
        return $query;
    }
/////////////////////////////////////////////////////////////////////////////////////////
    function get_info($id){
        $query = $this->db->query("SELECT id, code, identifier, fullname, nickname, birthday, gender, image FROM tbl_student WHERE id = $id");
        return $query->fetchAll();
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function getFetObj_temp($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE status = 99 AND  fullname LIKE '%$q%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, identifier, fullname, nickname, DATE_FORMAT(birthday, '%d-%m-%Y') As birthday, gender, image, status,
                                    (SELECT address FROM tbl_student_add WHERE student_code = tbl_student.code ORDER BY id DESC LIMIT 0, 1) AS address,
                                    (SELECT title FROM tbl_class WHERE tbl_class.id = (SELECT class_id FROM tbl_student_class 
                                    WHERE tbl_student_class.student_code = tbl_student.code) ORDER BY id DESC LIMIT 0, 1) AS class_title 
                                    FROM tbl_student WHERE status = 99 AND fullname LIKE '%$q%' ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function delObj_temp(){
        $query = $this->delete("tbl_student", "status = 99");
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function check_exit_user_id_class($userid, $yearid){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class WHERE year_id = $yearid AND FIND_IN_SET($userid, user_id_charge) AND status = 1");
        $row = $query->fetchAll();
        return  $row[0]['Total'];
    }

    function get_class_id_pass_yearid_an_userid($yearid, $userid){
        $query = $this->db->query("SELECT id FROM tbl_class WHERE year_id = $yearid AND FIND_IN_SET($userid, user_id_charge) AND status = 1");
        $row = $query->fetchAll();
        return $row[0]['id'];
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_address_student($code){
        $query = $this->db->query("SELECT address FROM tbl_student_add WHERE student_code = $code");
        return $query->fetchAll();
    }

    function get_relation_student($code){
        $query = $this->db->query("SELECT fullname, phone, job, birthday, (SELECT title FROM tbldm_relationship 
                                    WHERE tbldm_relationship.id = relationship_id) AS relation FROM tbl_student_relation WHERE student_code = $code");
        return $query->fetchAll();
    }

    function get_class_student($code){
        $query = $this->db->query("SELECT class_id, year_id, (SELECT title FROM tbl_years WHERE tbl_years.id = year_id) AS nam_hoc,
                                    (SELECT title FROM tbl_class WHERE tbl_class.id = class_id) AS lop_hoc FROM tbl_student_class WHERE student_code = $code
                                    ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_class_change_student($id){
        $query = $this->db->query("SELECT year_id_from, class_id_from,  year_id_to, class_id_to, date_approve, content, (SELECT title FROM tbl_years WHERE tbl_years.id = year_id_from) AS tu_nam,
                                    (SELECT title FROM tbl_years WHERE tbl_years.id = year_id_to) AS den_nam, (SELECT title FROM tbl_class WHERE tbl_class.id = class_id_from) AS lop_di,
                                    (SELECT title FROM tbl_class WHERE tbl_class.id = class_id_to) AS lop_den FROM tbl_student_change_class 
                                    WHERE student_id = $id AND status = 1 ORDER BY id DESC");
        return $query->fetchAll();
    }
}
?>