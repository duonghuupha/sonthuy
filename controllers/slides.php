<?php
class Slides extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('slides/index');
    }
}
?>
