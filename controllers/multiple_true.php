<?php
class Multiple_true extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('multiple_true/index');
    }

    function form(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('multiple_true/form');
    }

    function get_json_question(){
        $question_id = $_REQUEST['question_id'];
        $jsonObj = $this->model->get_json_question_Obj($question_id);
        $this->view->jsonObj = $jsonObj;
        $json_detail = $this->model->get_detail_question($jsonObj[0]['code']);
        $this->view->detail = $json_detail;
        $this->view->render('multiple_true/get_json_question');
    }
}
?>