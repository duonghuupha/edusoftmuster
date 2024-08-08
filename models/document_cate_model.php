<?php
class Document_cate_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_data_cate_in(){
        $query = $this->db->query("SELECT id, parent_id, title, user_id, create_at FROM tbldm_document_in
                                    WHERE status = 1");
        return $query->fetchAll();
    }

    function get_data_cate_out(){
        $query = $this->db->query("SELECT id, parent_id, title, user_id, create_at FROM tbldm_document_out
                                    WHERE status = 1");
        return $query->fetchAll();
    }
}
?>