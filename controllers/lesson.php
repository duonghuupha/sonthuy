<?php
class Lesson extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('lesson/index');
        require('layouts/footer.php');
    }

    function json(){
        
        $this->view->render('lesson/json');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
