<?php
class Group_role extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('group_role/index');
        require('layouts/footer.php');
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('group_role/json');
    }

    function add(){
        $code = time(); $title = $_REQUEST['title']; $roles = base64_decode($_REQUEST['datadc']);
        $status = 1; $create_at = date("Y-m-d H:i:s");
        $data = array("code" => $code, "title" => $title, "roles" => $roles, "status" => $status, "create_at" =>  $create_at);
        $temp = $this->model->addObj($data);
        if($temp){
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('group_role/add');
    }

    function update(){
        $id = $_REQUEST['id']; $title = $_REQUEST['title']; $roles = base64_decode($_REQUEST['datadc']);
        $create_at = date("Y-m-d H:i:s");
        $data = array("title" => $title, "roles" => $roles, "create_at" =>  $create_at);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('group_role/update');
    }

    function del(){
        $id = $_REQUEST['id'];
        if($this->model->check_role_of_user($id) > 0){
            $jsonObj['msg'] = "Nhóm quyền sử dụng này đã được cấp cho người dùng, bạn không thể xóa";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $temp = $this->model->delObj($id);
            if($temp){
                $jsonObj['msg'] = "Xóa dữ liệu thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Xóa dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('group_role/del');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////
    function data_role(){
        $this->view->render('group_role/data_role');
    }
    
    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật trạng thái dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật trạng thái dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('group_role/change');
    }
}
?>
