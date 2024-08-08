<?php
class Work_pro_dt_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($work_id, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_work_pro_dt WHERE work_id = $work_id");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, work_id, title, file, status, create_at, (SELECT tbl_work_pro.code FROM tbl_work_pro
                                    WHERE tbl_work_pro.id = work_id) AS code_work
                                    FROM tbl_work_pro_dt WHERE work_id = $work_id ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_work_pro_dt", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_work_pro_dt", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_work_pro_dt", "id = $id");
        return $query;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_info_work_pro_by_id($id){
        $query = $this->db->query("SELECT id, code,  title FROM tbl_work_pro WHERE id = $id");
        return $query->fetchAll();
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_work_pro_dt WHERE id = $id");
        return $query->fetchAll();
    }
}
?>