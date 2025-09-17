<?php
class True_false extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('true_false/index');
    }

    function form(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('true_false/form');
    }

    function get_json_question(){
        $question_id = $_REQUEST['question_id'];
        $jsonObj = $this->model->get_json_question_Obj($question_id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('true_false/get_json_question');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add($id, $code){
        $answer = $_REQUEST['true_false_value']; $idh = $_REQUEST['id_true_false'];
        if($id == 0){
            $data = array("code" => time(), "code_question" => $code, "answer" => $answer);
            $temp = $this->_Data->addObj_true_false($data);
        }else{
            $data = array("code_question" => $code, "answer" => $answer);
            $temp = $this->_Data->updateObj_true_false($idh, $data);
        }
        return $temp;
    }
}
?>