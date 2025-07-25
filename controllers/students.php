<?php
class Students extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('students/index');
        require('layouts/footer.php');
    }

    function json(){
        
        $this->view->render('students/json');
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
