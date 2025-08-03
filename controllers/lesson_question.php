<?php
class Lesson_question extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('lesson_question/index');
        require('layouts/footer.php');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
