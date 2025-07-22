<?php
class View {
    function __construct() {
		//echo 'this is the view';
	    $this->_Data = new Model();
        $this->_Info = (isset($_SESSION['data'])) ? $_SESSION['data']: [];
        $this->_Convert = new Convert();
        $this->_Year = (isset($_SESSION['year'])) ? $_SESSION['year'] : [];
        $this->_Url = isset($_REQUEST['url']) ? explode("/", $_REQUEST['url']) : ['index'];
	}

    public function render($name, $noInclude = false){
        require 'views/' . $name . '.php';
	}

}