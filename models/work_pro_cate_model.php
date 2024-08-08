<?php
class Work_pro_cate_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_work_pro_cate");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, content, user_id, status, DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at 
                                    FROM tbl_work_pro_cate ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_work_pro_cate", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_work_pro_cate", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_work_pro_cate", "id = $id");
        return $query;
    }
}
?>