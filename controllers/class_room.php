<?php
class Class_room extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('class_room/index');
        require('layouts/footer.php');
    }

    function json(){
        $this->view->render('class_room/json');
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
