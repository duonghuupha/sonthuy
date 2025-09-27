<?php
class Sort_alphabet_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_json_question_Obj($question_id){
        $query = $this->db->query("SELECT id, title, file, (SELECT answer FROM tbl_question_sort_alphabet WHERE code_question = tbl_question.code) AS answer, 
                                    lesson_id FROM tbl_question WHERE id = $question_id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_question_sort_alphabet WHERE code_question = (SELECT tbl_question.code FROM tbl_question
                                    WHERE tbl_question.id = $id)");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>