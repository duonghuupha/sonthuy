<?php
class Test_cate extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('test_cate/index');
        require('layouts/footer.php');
    }
}
?>