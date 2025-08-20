<?php
class Slides extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $id = $_REQUEST['id'];
        $json_lesson_dc = $this->model->get_lesson_detail($id);
        $this->view->json_lesson_dc = $json_lesson_dc;
        $this->view->render('slides/index');
    }

    function json_lesson(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $jsonObj = $this->model->get_lesson($keyword);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('slides/json_lesson');
    }

    function media(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_lesson_media($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('slides/media');
    }

    function flashcard(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_lesson_card($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('slides/flashcard');
    }

    function question(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_lesson_question($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('slides/question');
    }
}
?>
