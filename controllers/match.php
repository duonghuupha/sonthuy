<?php
class Match extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('match/index');
    }

    function form(){
        $this->view->render('match/form');
    }
}
?>