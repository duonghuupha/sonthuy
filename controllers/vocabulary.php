<?php
class Vocabulary extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }
    
    function index(){
        require('layouts/header.php');
        $this->view->render('vocabulary/index');
        require('layouts/footer.php');
    }
    
    function json(){
        
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