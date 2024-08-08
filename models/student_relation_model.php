<?php
class Student_relation_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($code, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_relation WHERE student_code = $code");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, student_code, fullname, phone, email, job, number_cart, birthday, relationship_id,
                                    (SELECT title FROM tbldm_relationship WHERE tbldm_relationship.id = relationship_id) AS relation 
                                    FROM tbl_student_relation WHERE student_code = $code 
                                    ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $student_code, $relation){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_relation WHERE student_code = $student_code
                                    AND relationship_id = $relation");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_relation WHERE student_code = $student_code
                                    AND relationship_id = $relation AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_student_relation", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_student_relation", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_student_relation", "id = $id");
        return $query;
    }

    function check_count_relation($code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_relation WHERE student_code = $code");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>