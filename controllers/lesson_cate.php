<?php
class Lesson_cate extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('lesson_cate/index');
        require('layouts/footer.php');
    }

    function json(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('lesson_cate/json');
    }

    function add(){
        $code = $_REQUEST['code']; $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        //$parent_id = (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '') ? $_REQUEST['parent_id'] : 0;
        $file = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], 'lesson_cate') : '';
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = 'Mã danh mục đã tồn tại, vui lòng nhập mã khác!';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "title" => $title, "content" => $content, "parent_id" => 0, "status" => 1, "create_at" => date('Y-m-d H:i:s'),
                            'image' => $file);
            $temp = $this->model->addObj($data);
            if($temp){
                if($file != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/lesson/cate/'.$file);
                }
                $jsonObj['msg'] = 'Thêm mới danh mục thành công!';
                $jsonObj['success'] = true; 
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = 'Thêm mới danh mục không thành công, vui lòng thử lại sau!';
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('lesson_cate/add');
    }

    function update(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code']; $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        //$parent_id = (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '') ? $_REQUEST['parent_id'] : 0;
        $file = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], 'lesson_cate') : $_REQUEST['image_old'];
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = 'Mã danh mục đã tồn tại, vui lòng nhập mã khác!';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "title" => $title, "content" => $content, "parent_id" => 0, "create_at" => date('Y-m-d H:i:s'), 'image' => $file);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD.'/lesson/cate/'.$file);
                    @unlink(DIR_UPLOAD.'/lesson/cate/'.$_REQUEST['image_old']);
                }
                $jsonObj['msg'] = 'Cập nhật danh mục thành công!';
                $jsonObj['success'] = true; 
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = 'Cập nhật danh mục không thành công, vui lòng thử lại sau!';
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('lesson_cate/update');
    }

    function del(){
        $id = $_REQUEST['id']; $info = $this->model->get_info($id);
        if($this->model->delObj($id)){
            @unlink(DIR_UPLOAD.'/lesson/cate/'.$info[0]['image']);
            $jsonObj['msg'] = 'Xóa danh mục thành công!';
            $jsonObj['success'] = true; 
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = 'Xóa danh mục không thành công, vui lòng thử lại sau!';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('lesson_cate/del');
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status, "create_at" => date('Y-m-d H:i:s'));
        if($this->model->updateObj($id, $data)){
            $jsonObj['msg'] = 'Cập nhật trạng thái thành công!';
            $jsonObj['success'] = true; 
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = 'Cập nhật trạng thái không thành công, vui lòng thử lại sau!';
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('lesson_cate/change');
    }

    function get_row(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = json_encode($jsonObj[0]);
        $this->view->render('lesson_cate/get_row');
    }
}
?>
