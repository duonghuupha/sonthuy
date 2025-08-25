<?php
class Lesson_question_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($lesson_id, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_lesson_question WHERE lesson_id = $lesson_id");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, lesson_id, title, type_question, status, create_at, file FROM tbl_lesson_question
                                    WHERE lesson_id = $lesson_id ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_lesson_question WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_lesson_question WHERE code = $code AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_lesson_question", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_lesson_question", $data, "id = $id");
        return $query;
    }

    function delObj_via_code($code){
        $query = $this->delete("tbl_lesson_question", "code = $code");
        return $query;
    }
////////////////////////////////// Dang cau hoi dung sai///////////////////////////////////////////////////////////////////////
    function addObj_true_false($data){
        $query = $this->insert("tbl_question_true_false", $data);
        return $query;
    }

    function updateObj_true_false($id, $data){
        $query = $this->update("tbl_question_true_false", $data, "id = $id");
        return $query;
    }
//////////////////////////////// Dang cau hoi 1 dap an dung////////////////////////////////////////////////////////////////////
    function addObj_one_true($data){
        $query = $this->insert("tbl_question_one_true", $data);
        return $query;
    }

    function updateObj_one_true($id, $data){
        $query = $this->update("tbl_question_one_true", $data, "id = $id");
        return $query;
    }
}
?>