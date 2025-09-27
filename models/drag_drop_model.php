<?php
class Drag_drop_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_json_question_Obj($question_id){
        $query = $this->db->query("SELECT id, code, title, file, lesson_id FROM tbl_question WHERE id = $question_id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_detail_question($code){
        $query = $this->db->query("SELECT id, code, code_question, title, file, id_temp FROM tbl_question_drag_drop_target WHERE code_question = $code AND status = 1 ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_item_question($code){
        $query = $this->db->query("SELECT id, code, code_question, title, file, target_id FROM tbl_question_drag_drop_item WHERE code_question = $code AND status = 1");
        return $query->fetchAll();
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_target_edit($code_question){
        $query = $this->db->query("SELECT * FROM tbl_question_drag_drop_target WHERE code_question = $code_question");
        return $query->fetchAll();
    }

    function get_answer_edit($code_question){
        $query = $this->db->query("SELECT * FROM tbl_question_drag_drop_item WHERE code_question = $code_question");
        return $query->fetchAll();
    }
}
?>