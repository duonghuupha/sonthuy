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
        $this->view->detail = $detail;
        $this->view->render('drag_drop/get_json_question');
    }
}
?>