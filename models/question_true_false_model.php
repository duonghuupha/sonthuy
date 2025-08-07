<?php
class Question_true_false_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_json_question_Obj($question_id){
        $query = $this->db->query("SELECT id, title, file, (SELECT answer FROM tbl_question_true_false WHERE code_question = tbl_lesson_question.code) AS answer, 
                                    lesson_id FROM tbl_lesson_question WHERE id = $question_id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_question_true_false WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>