<?php
class Users extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }
    
    function index(){
        require('layouts/header.php');
        $this->view->render('users/index');
        require('layouts/footer.php');
    }
    
    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('users/json');
    }

    function add(){
        $code = time(); $personnel_id = $_REQUEST['personnel_id']; $username = $_REQUEST['username']; $pass = $_REQUEST['pass']; $group_role_id = $_REQUEST['group_role_id'];
        if($this->model->dupliObj(0, $username) > 0){
            $jsonObj['msg'] = "Tên đăng nhập đã tồn tại trong hệ thống!";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('code' => $code, 'personnel_id' => $personnel_id, 'username' => $username, 'password' => sha1($pass), 'group_role_id' => 0, 
                        'create_at'=>date('Y-m-d H:i:s'), "status" => 1, "last_login" => "", "info_login" => "", "token" => "", "change_pass" => 0);
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj['msg'] = "Ghi dữ liệu thành công!";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công!";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('users/add');
    }

    function update(){
        $id = $_REQUEST['id']; $group_role_id = $_REQUEST['group_role_id'];
        if($this->model->dupliObj($id, $username) > 0){
            $jsonObj['msg'] = "Tên đăng nhập đã tồn tại trong hệ thống!";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array('group_role_id' => 0);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công!";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công!";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('users/update');
    }

    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ liệu thành công!";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công!";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('users/del');
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array('status' => $status);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công!";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công!";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('users/change');
    }
}
?>