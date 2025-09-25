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
        $query = $this->db->query("SELECT id, code, code_question, answer_a, file_a, answer_b, file_b FROM tbl_question_match WHERE code_question = $code 
                                    AND status = 1 AND id_temp = 0 ORDER BY id DESC");
        return $query->fetchAll();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_detail_match($code){
        $query = $this->db->query("SELECT * FROM tbl_question_match WHERE code_question = $code");
        return $query->fetchAll();
    }
}
?>