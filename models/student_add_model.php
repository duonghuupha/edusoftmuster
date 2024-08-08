<?php
class Student_add_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($code, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_add WHERE student_code = $code");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, student_code, address FROM tbl_student_add WHERE student_code = $code 
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_student_add", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_student_add", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_student_add", "id = $id");
        return $query;
    }

    function check_count_add($code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_add WHERE student_code = $code");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>