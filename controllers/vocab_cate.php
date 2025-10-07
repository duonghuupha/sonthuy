<?php
class Vocab_cate extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('vocab_cate/index');
        require('layouts/footer.php');
    }
    
    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('vocab_cate/json');
    }
    
    function add(){
        $code = time(); $title = addslashes($_REQUEST['title']);
        $file = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], 'vocab_cate') : '';
        $data = array("code" => $code, "title" => $title, "status" => 1, "create_at" => date("Y-m-d H:i:s"), 'image' => $file);
        $temp = $this->model->addObj($data);
        if($temp){
            if($file != ''){
                move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/vocab/cate/'.$file);
            }
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vocab_cate/add");
    }

    function update(){
        $id = $_REQUEST['id']; $title = addslashes($_REQUEST['title']);
        $file = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], 'vocab_cate') : $_REQUEST['image_old'];
        $data = array("title" => $title, "create_at" => date("Y-m-d H:i:s"), 'image' => $file);
        $temp = $this->model->updateObj($id, $data); 
        if($temp){
            if($_FILES['image']['name'] != ''){
                move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/vocab/cate/'.$file);
                @unlink(DIR_UPLOAD.'/vocab/cate/'.$_REQUEST['image_old']);
            }
            $jsonObj['msg'] = "Ghi dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Ghi dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vocab_cate/update");
    }
    
    function del(){
        $id = $_REQUEST['id']; $info = $this->model->get_info($id);
        $temp = $this->model->delObj($id);
        if($temp){
            @unlink(DIR_UPLOAD.'/vocab/cate/'.$info[0]['image']);
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vocab_cate/del");
    }
    
    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
        $temp = $this->model->updateObj($id, $data); 
        if($temp){
            $jsonObj['msg'] = "Thay đổi trạng thái thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thay đổi trạng thái không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("vocab_cate/change");
    }
}
?>