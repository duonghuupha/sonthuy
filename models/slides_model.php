<?php
class Slides_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_lesson(){
        $query = $this->db->query("SELECT id, code, title, content FROM tbl_lesson WHERE status = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_lesson_detail($id){
        $query = $this->db->query("SELECT image, order_dc FROM tbl_lesson_dc WHERE lesson_id = $id AND status = 1 ORDER BY order_dc ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>