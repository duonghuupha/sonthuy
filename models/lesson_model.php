<?php
class Lesson_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_lesson WHERE title LIKE '%$q%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, cate_id, content, status, create_at, (SELECT tbl_lesson_cate.title FROM tbl_lesson_cate
                                    WHERE tbl_lesson_cate.id = cate_id) AS cate_title FROM tbl_lesson WHERE title LIKE '%$q%' ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_lesson WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_lesson WHERE code = $code AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_lesson", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_lesson", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_lesson", "id = $id");
        return $query;
    }

    function get_lesson_cate(){
        $query = $this->db->query("SELECT id, code, title AS text, content, parent_id, status, create_at FROM tbl_lesson_cate WHERE status = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_lesson WHERE id = $id");
        return $query->fetchAll();
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_lesson_dc($id){
        $query = $this->db->query("SELECT id, image FROM tbl_lesson_dc WHERE lesson_id = $id AND status = 1 ORDER BY order_dc ASC");
        return $query->fetchAll();
    }

    function get_lesson_media($id){
        $query = $this->db->query("SELECT id, file FROM tbl_lesson_media WHERE lesson_id = $id AND status = 1  ORDER BY order_media ASC");
        return $query->fetchAll();
    }

    function get_lesson_card($id){
        $query = $this->db->query("SELECT id, image FROM tbl_lesson_card WHERE lesson_id = $id AND status = 1  ORDER BY order_card ASC");
        return $query->fetchAll();
    }

    function get_id_via_code($code){
        $query = $this->db->query("SELECT id FROM tbl_lesson WHERE code = $code");
        $row = $query->fetchAll();
        return $row['id'];
    }
}
?>