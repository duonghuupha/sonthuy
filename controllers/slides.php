<?php
class Slides extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $jsonObj = $this->model->get_lesson();
        $this->view->jsonObj = $jsonObj;
        $this->view->render('slides/index');
    }

    function json_lesson(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_lesson_detail($id);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('slides/json_lesson');
    }
}
?>
