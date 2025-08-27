<?php
class Match_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_json_question_Obj($question_id){
        $query = $this->db->query("SELECT id, code, title, file, lesson_id FROM tbl_lesson_question WHERE id = $question_id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_detail_question($code){
        $query = $this->db->query("SELECT answer, title, file FROM tbl_question_multiple_true WHERE code_question = $code ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_question_multiple_true WHERE code_question = (SELECT tbl_lesson_question.code FROM tbl_lesson_question
                                    WHERE tbl_lesson_question.id = $id)");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>