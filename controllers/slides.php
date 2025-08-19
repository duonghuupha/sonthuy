<?php
class Slides extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $jsonObj = $this->model->get_lesson_cate();
        $this->view->jsonObj = $jsonObj;
        $this->view->render('slides/index');
    }
}
?>
