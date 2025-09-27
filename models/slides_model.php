<?php
class Slides_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_lesson($q){
        $query = $this->db->query("SELECT id, code, title, content FROM tbl_lesson WHERE status = 1 AND (title LIKE '%$q%' OR content LIKE '%$q%')");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_lesson_detail($id){
        $query = $this->db->query("SELECT image, order_dc FROM tbl_lesson_dc WHERE lesson_id = $id AND status = 1 ORDER BY order_dc ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_lesson_media($id){
        $query = $this->db->query("SELECT file, order_media FROM tbl_lesson_media WHERE status = 1 AND lesson_id = $id ORDER BY order_media ASC");
        return $query->fetchAll();
    }

    function get_lesson_card($id){
        $query = $this->db->query("SELECT image, order_card FROM tbl_lesson_card WHERE status = 1 AND lesson_id = $id ORDER BY order_card ASC");
        return $query->fetchAll();
    }

    function get_lesson_question($id){
        $query = $this->db->query("SELECT id, code, lesson_id, type_question, title, file FROM tbl_question WHERE status = 1 AND lesson_id = $id");
        return $query->fetchAll();
    }
}
?>