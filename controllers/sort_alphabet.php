<?php
class Sort_alphabet extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('sort_alphabet/index');
    }

    function form(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('sort_alphabet/form');
    }

    function get_json_question(){
        $question_id = $_REQUEST['question_id'];
        $jsonObj = $this->model->get_json_question_Obj($question_id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('sort_alphabet/get_json_question');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function action_question($id, $code){
        $answer = $_REQUEST['answer_sort']; $idh = $_REQUEST['id_sort'];
        if($id == 0){
            $data = array("code" => time(), "code_question" => $code, "answer" => $answer);
            $temp = $this->_Data->addObj_sort_alphabet($data);
        }else{
            $data = array("code_question" => $code, "answer" => $answer);
            $temp = $this->_Data->updateObj_sort_alphabet($idh, $data);
        }
        return $temp;
    }
}
?>