<?php
class Document_cate_in_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj(){
        $query = $this->db->query("SELECT id, parent_id, title, user_id, create_at FROM tbldm_document_in
                                    WHERE status = 1");
        return $query->fetchAll();
    }

    function addObj($data){
        $query = $this->insert("tbldm_document_in", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbldm_document_in", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbldm_document_in", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbldm_document_in WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>