<?php
class Roles extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('roles/index');
        require('layouts/footer.php');
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('roles/json');
    }

    function add(){
        $title = $_REQUEST['title']; $link = $_REQUEST['link']; $order = $_REQUEST['order'];
        $function = isset($_REQUEST['functions']) ? implode(",", $_REQUEST['functions']) : '';
        $parent = isset($_REQUEST['parent_id']) ? $_REQUEST['parent_id'] : 0; $icon = $_REQUEST['icon'];
        $data = array("title" => $title, "link" => $link, "functions" => $function, "parent_id" => $parent,
                        "order_position" => $order, 'is_submenu' => 0, 'icon' => $icon, 'status' => 1);
        $temp = $this->model->addObj($data);
        if($temp){
            $jsonObj['msg'] = "Ghi dữ  liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ  liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('roles/add');
    }

    function update(){
        $title = $_REQUEST['title']; $link = $_REQUEST['link']; $id = $_REQUEST['id']; $icon = $_REQUEST['icon'];
        $function = isset($_REQUEST['functions']) ? implode(",", $_REQUEST['functions']) : '';
        $parent = isset($_REQUEST['parent_id']) ? $_REQUEST['parent_id'] : 0; $order = $_REQUEST['order'];
        $data = array("title" => $title, "link" => $link, "functions" => $function,"parent_id" => $parent,
                        "order_position" => $order, "icon" => $icon);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Ghi dữ  liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ  liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('roles/update');
    }

    function del(){
        $id = $_REQUEST['id'];
        $temp = $this->model->delObj($id);
        if($temp){
            $jsonObj['msg'] = "Xóa dữ  liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ  liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('roles/del');
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
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
        $this->view->render("roles/change");
    }
/////////////////////////////////////////////////////////////////////////////////
    function combo_link(){
        $this->view->render('roles/combo_link');
    }

    function combo_menu(){
        $jsonObj = $this->model->get_data_parent();
        $this->view->jsonObj = $jsonObj;
        $this->view->render("roles/combo_menu");
    }

    function check_function_role(){
        $url = $_REQUEST['url'];
        //$jsonObj = $this->_Data->check_functions_role($this->_Info[0]['id'], 4, 'personnel');
        $this->view->content = $url;
        $this->view->render("roles/check_function_role");
    }
////////////////////////////////////////////////////////////////////////////////////////
    function check_roles_js(){
        $data = base64_decode($_REQUEST['data']); $data = explode("$", $data);
        $url = $data[0]; $roles = $data[1];
        $check_role = $this->_Data->check_functions_role($this->_Info[0]['id'], $roles, $url);
        if($check_role != 0 || $this->_Info[0]['id'] == 1){
            $jsonObj = 1;
        }else{
            $jsonObj = 0;
        }
        $this->view->jsonObj = $jsonObj;
        $this->view->render("roles/check_roles_js");
    }
}
?>