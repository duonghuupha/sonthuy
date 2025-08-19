<?php
class Slides_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_lesson_cate(){
        $query = $this->db->query("SELECT id, code, title AS text, content, parent_id, status, create_at FROM tbl_lesson_cate WHERE status = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>