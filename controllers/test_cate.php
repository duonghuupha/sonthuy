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

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('test_cate/json');
    }

    function add(){
        $code = $_REQUEST['code']; $parentid = (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '') ? $_REQUEST['parent_id'] : 0;
        $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        $file = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], 'test_cate') : '';
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã danh mục đã tồn tại !";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "parent_id" => 0, "title" => $title, "content" => $content, "status" => 1, "create_at" => date("Y-m-d H:i:s"), 'image' => $file);
            $temp = $this->model->addObj($data);
            if($temp){
                if($_FILES['image']['name'] != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/test/cate/'.$file);
                }
                $jsonObj['msg'] = "Ghi dữ liệu thành công !";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công !";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('test_cate/add');
    }

    function update(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code']; $parentid = (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '') ? $_REQUEST['parent_id'] : 0;
        $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        $file = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], 'test_cate') : $_REQUEST['image_old'];
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "Mã danh mục đã tồn tại !";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("parent_id" => 0, "title" => $title, "content" => $content, 'image' => $file);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($_FILES['image']['name'] != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/test/cate/'.$file);
                    @unlink(DIR_UPLOAD.'/test/cate/'.$_REQUEST['image_old']);
                }
                $jsonObj['msg'] = "Cập nhật dữ liệu thành công !";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật dữ liệu không thành công !";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('test_cate/update');
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("test_cate/change");
    }

    function del(){
        $id = $_REQUEST['id']; $info = $this->model->get_info($id);
        $data = array("status" => $status);
        $temp = $this->model->delObj($id);
        if($temp){
            @unlink(DIR_UPLOAD.'/test/cate/'.$info[0]['image']);
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("test_cate/del");
    }
}
?>