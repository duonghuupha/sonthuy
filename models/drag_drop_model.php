<?php
class Drag_drop_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_json_question_Obj($question_id){
        $query = $this->db->query("SELECT id, code, title, file, lesson_id FROM tbl_lesson_question WHERE id = $question_id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_detail_question($code){
        $query = $this->db->query("SELECT id, code, code_question, title, file FROM tbl_question_drag_drop_target WHERE code_question = $code AND status = 1 ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_item_question($code){
        $query = $this->db->query("SELECT id, code, code_question, title, file, target_id FROM tbl_question_drag_drop_item WHERE code_question = $code AND status = 1");
        return $query->fetchAll();
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function check_dupli_id_temp_target($id_temp){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_question_drag_drop_target WHERE id_temp = $id_temp");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj_target($data){
        $query = $this->insert("tbl_question_drag_drop_target", $data);
        return $query;
    }

    function updateObj_target($id, $data){
        $query = $this->update("tbl_question_drag_drop_target", $data, "id = $id");
        return $query;
    }

    function updateObj_via_id_temp_target($id, $data){
        $query = $this->update("tbl_question_drag_drop_target", $data, "id_temp = $id");
        return $query;
    }

    function check_dupli_id_temp_answer($id_temp){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_question_drag_drop_item WHERE id_temp = $id_temp");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj_answer($data){
        $query = $this->insert("tbl_question_drag_drop_item", $data);
        return $query;
    }

    function updateObj_answer($id, $data){
        $query = $this->update("tbl_question_drag_drop_item", $data, "id = $id");
        return $query;
    }

    function updateObj_via_id_temp_answer($id, $data){
        $query = $this->update("tbl_question_drag_drop_item", $data, "id_temp = $id");
        return $query;
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function check_exit_file_match_target($id_temp){
        $query = $this->db->query("SELECT file_a, file_b FROM tbl_question_drag_drop_target WHERE id_temp = $id_temp");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_target($code_question){
        $query = $this->db->query("SELECT id, title FROM tbl_question_drag_drop_target WHERE code_question = $code_question");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_target_edit($code_question){
        $query = $this->db->query("SELECT * FROM tbl_question_drag_drop_target WHERE code_question = $code_question");
        return $query->fetchAll();
    }

    function get_answer_edit($code_question){
        $query = $this->db->query("SELECT id, code, code_question, target_id, title, file, status, id_temp, 
                                    (SELECT tbl_question_drag_drop_target.title FROM tbl_question_drag_drop_target
                                    WHERE tbl_question_drag_drop_target.id = target_id) AS target_title
                                    FROM tbl_question_drag_drop_item WHERE code_question = $code_question");
        return $query->fetchAll();
    }
}
?>