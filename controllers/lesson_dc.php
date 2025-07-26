<?php
class Lesson_dc extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('lesson_dc/index');
    }

    function add(){
        
        $this->view->render('lesson_dc/add');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
