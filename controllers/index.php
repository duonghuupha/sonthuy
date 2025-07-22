<?php
class Index extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('index/index');
        require('layouts/footer.php');
    }

    function login(){
        $this->view->render('index/login');
    }

    function do_login(){
        $username = $_REQUEST['username']; 
        $password = sha1($_REQUEST['password']);
        if($this->model->check_login($username, $password) > 0){
            $token = sha1(time()); $info_login = $_SERVER['HTTP_USER_AGENT']; $last_login = date("Y-m-d H:i:s");
            $data = array("last_login" => $last_login, "token" => $token, "info_login" => $info_login);
            $temp = $this->model->updateObj($username, $password, $data);
            if($temp){
                Session::init();
                Session::set('loggedIn_Sonthuy', true);
                $_SESSION['data'] = $this->model->get_data($username, $password);
                $jsonObj['msg'] = "Đăng nhập thành công";
                $jsonObj['success'] = true;
                $jsonObj['token'] = $token;
                $jsonObj['change_pass'] = $_SESSION['data'][0]['change_pass'];
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Đăng nhập không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }else{
            $jsonObj['msg'] = "Thông tin đăng nhập không chính xác";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("index/do_login");
    }

    function logout(){
        session_start();
        //Session::destroy();
        session_destroy();
        header('Location: '.URL.'/index/login');
        exit;
    }
}
?>
