<?php
class Question_true_false extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function form(){
        $this->view->render('question_true_false/form');
    }
}
?>