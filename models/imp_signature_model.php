<?php
class Imp_signature_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_combo_personnel($q){
        $query = $this->db->query("SELECT id, fullname AS title, DATE_FORMAT(birthday, '%d-%m-%Y') AS content FROM tbl_personnel WHERE status = 1 AND fullname LIKE '%$q%'
                                    ORDER BY fullname ASC");
        return $query->fetchAll();
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_personnel", $data, "id = $id");
        return $query;
    }

    function get_signature_old($id){
        $query = $this->db->query("SELECT signature FROM tbl_personnel WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['signature'];
    }
}
?>