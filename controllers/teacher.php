<?php
class Teacher extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('teacher/index');
        require('layouts/footer.php');
    }

    function json(){
        $this->view->render('teacher/json');
    }

    function add(){

    }

    function update(){

    }

    function del(){

    }

    function change(){
        
    }
}
?>
