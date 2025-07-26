<?php
class Other extends Controller{
    function __construct(){
        parent::__construct();
    }

    function combo_class(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_class($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_class");
    }
}
?>
