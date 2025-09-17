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
        $query = $this->db->query("SELECT id, code, code_question, answer_a, file_a, answer_b, file_b FROM tbl_question_match WHERE code_question = $code ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_question_multiple_true WHERE code_question = (SELECT tbl_lesson_question.code FROM tbl_lesson_question
                                    WHERE tbl_lesson_question.id = $id)");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function check_dupli_id_temp($id_temp){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_question_match WHERE id_temp = $id_temp");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_question_match", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_question_match", $data, "id = $id");
        return $query;
    }

    function updateObj_via_id_temp($id, $data){
        $query = $this->update("tbl_question_match", $data, "id_temp = $id");
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function check_exit_file_match($id_temp){
        $query = $this->db->query("SELECT file_a, file_b FROM tbl_question_match WHERE id_temp = $id_temp");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>