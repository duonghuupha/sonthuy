<?php
class Other extends Controller{
    function __construct(){
        parent::__construct();
    }

    function combo_class(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_class($keyword, $this->_Info[0]['id']);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_class");
    }

    function combo_roles_parent(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_roles_parent($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_roles_parent");
    }

    function combo_role_link(){
        $this->view->render("other/combo_role_link");
    }

    function combo_test_cate(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_test_cate($keyword);
        $this->view->jsonObj = $jsonObj;
        $this->view->render("other/combo_test_cate");
    }

    function combo_vocab(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_vocab($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_vocab");
    }

    function combo_personnel(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_personnel($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_personnel");
    }

    function combo_group_role(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_group_role($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_group_role");
    }

    function combo_user(){
        $keyword = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $jsonObj = $this->model->get_combo_user($keyword);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("other/combo_user");
    }
}
?>
