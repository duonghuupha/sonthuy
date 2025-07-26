<?php
class Lesson_cate_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj(){
        $query = $this->db->query("SELECT id, code, title, content, parent_id, status, create_at FROM tbl_lesson_cate");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_lesson_cate WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_lesson_cate WHERE code = '$code' AND id != $id");
        }
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_lesson_cate", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_lesson_cate", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_lesson_cate", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_lesson_cate WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>