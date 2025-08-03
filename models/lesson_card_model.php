<?php
class Lesson_card_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($id){
        $query = $this->db->query("SELECT id, code, lesson_id, image, order_card, status, create_at FROM tbl_lesson_card WHERE lesson_id = $id
                                    ORDER BY order_card ASC");
        return $query->fetchAll();
    }

    function addObj($data){
        $query = $this->insert("tbl_lesson_card", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_lesson_card", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_lesson_card", "id = $id");
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_lesson_card WHERE id = $id");
        return $query->fetchAll();
    }
}
?>