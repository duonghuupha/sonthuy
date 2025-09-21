<?php
class Drag_drop extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('drag_drop/index');
    }

    function form(){
        $this->view->render('drag_drop/form');
    }

    function get_json_question(){
        $id = $_REQUEST['question_id'];
        $jsonObj = $this->model->get_json_question_Obj($id);
        $this->view->question = $jsonObj;
        $detail = $this->model->get_detail_question($jsonObj[0]['code']);
        $this->view->target = $detail;
        $answer = $this->model->get_item_question($jsonObj[0]['code']);
        $this->view->answer = $answer;
        $this->view->render('drag_drop/get_json_question');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_target(){
        $type = $_REQUEST['type']; $id_temp = $_REQUEST['id_temp']; $code_question = $_REQUEST['code_question']; $lesson_id = $_REQUEST['lesson_id'];
        $title = addslashes($_REQUEST['target_title_'.$id_temp]);
        $file = (isset($_FILES['file_target_'.$id_temp]['name']) && $_FILES['file_target_'.$id_temp]['name'] != '') ? $this->_Convert->convert_file($_FILES['file_target_'.$id_temp]['name'], 'target_'.rand(111111, 9999999)) : '';
        if($this->model->check_dupli_id_temp_target($id_temp) == 0){
            $data = array("code" => time(), "code_question" => $code_question, "title" => $title, "file" => $file, "status" => 0, "id_temp" => $id_temp);
            $temp = $this->model->addObj_target($data);
        }else{
            $data = array("title" => $target_title, "file" => $file);
            $temp = $this->model->updateObj_via_id_temp_target($id_temp, $data);
        }
        if($temp){
            $jsonObj['msg'] = "Thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thêm dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("drag_drop/add_target");
    }

    function add_answer(){
        $type = $_REQUEST['type']; $id_temp = $_REQUEST['id_temp']; $code_question = $_REQUEST['code_question']; $lesson_id = $_REQUEST['lesson_id'];
        $title = addslashes($_REQUEST['answer_title_'.$id_temp]); $target = $_REQUEST['target_'.$id_temp];
        $file = (isset($_FILES['file_answer_'.$id_temp]['name']) && $_FILES['file_answer_'.$id_temp]['name'] != '') ? $this->_Convert->convert_file($_FILES['file_answer_'.$id_temp]['name'], 'answer_'.rand(111111, 9999999)) : '';
        if($this->model->check_dupli_id_temp_answer($id_temp) == 0){
            $data = array("code" => time(), "code_question" => $code_question, "target_id" => $target, "title" => $title, "file" => $file, "status" => 0, "id_temp" => $id_temp);
            $temp = $this->model->addObj_answer($data);
        }else{
            $data = array("target_id" => $target, "title" => $title, "file" => $file);
            $temp = $this->model->updateObj_via_id_temp_answer($id_temp, $data);
        }
        if($temp){
            $jsonObj['msg'] = "Thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thêm dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("drag_drop/add_answer");
    }

    function action_question($id, $lession_id, $code){
        $data = array("status" => 1, "id_temp" => 0);
        $temp = $this->_Data->updateobj_via_code_question_drag_drop($code, $data);
        return $temp;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function combo_target(){
        $code_question = $_REQUEST['code_question'];
        $jsonObj = $this->model->get_combo_target($code_question);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("drag_drop/combo_target");
    }
}
?>