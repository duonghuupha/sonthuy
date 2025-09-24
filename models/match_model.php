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
    function get_detail_question_edit($code_question){
        $query = $this->db->query("SELECT id, answer_a, answer_b, file_a, file_b, id_temp FROM tbl_question_match WHERE code_question = $code_question");
        return $query->fetchAll();
    }

    function get_list_id_edit($code){
        $query = $this->db->query("SELECT id FROM tbl_question_match WHERE code_question = $code");
        return $query->fetchAll();
    }

    function delObj_cancel($code){
        $query = $this->delete("tbl_question_match", "code_question = $code AND id_temp != 0");
        return $query;
    }
}
?>