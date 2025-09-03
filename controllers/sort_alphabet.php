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
}
?>