<?php
class Lesson_media_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($id, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(id) AS Total FROM tbl_lesson_media WHERE lesson_id = $id");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, lesson_id, file, order_media, status, create_at FROM tbl_lesson_media WHERE lesson_id = $id
                                    ORDER BY order_media ASC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_lesson_media", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_lesson_media", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_lesson_media", "id = $id");
        return $query;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_lesson_media WHERE id = $id");
        return $query->fetchAll();
    }
}
?>