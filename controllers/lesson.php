<?php
class Lesson extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('lesson/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('lesson/json');
    }

    function add(){
        $code = $_REQUEST['code']; $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']); $cateid = $_REQUEST['cate_id'];
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã bài giảng đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "cate_id" => $cateid, "title" => $title, "content" => $content, "status" => 1,
                            "create_at" => date("Y-m-d H:i:s"));
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
        }
        $this->view->render("lesson/add");
    }

    function update(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code']; $title = addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        $cateid = $_REQUEST['cate_id'];
        if($this->model->dupliObj($id, $code) > 0 ){
            $jsonObj['msg'] = "Mã bài giảng đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "title" => $title, "content" => $content, "cate_id" => $cateid, "create_at" => date("Y-m-d H:i:s"));
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
        }
        $this->view->render("lesson/update");
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
        $this->view->render("lesson/change");
    }

    function del(){
        $id = $_REQUEST['id'];
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
        $this->view->render("lesson/del");
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function json_lesson_cate(){
        $jsonObj = $this->model->get_lesson_cate();
        $this->view->jsonObj = $jsonObj;
        $this->view->render('lesson/json_lesson_cate');
    }

    function cate_cte(){
        $this->view->render('lesson/cate_cte');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function detail(){
        require('layouts/header.php');

        $id = base64_decode($_REQUEST['id']);
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = $jsonObj;

        $this->view->render('lesson/detail');
        require('layouts/footer.php');
    }

    function view_lesson(){
        $id = base64_decode($_REQUEST['id']);
        $lesson_dc = $this->model->get_lesson_dc($id);
        $this->view->lesson_dc = $lesson_dc;
        $lesson_media = $this->model->get_lesson_media($id);
        $this->view->lesson_media = $lesson_media;
        $this->view->lesson_id = $id;
        $this->view->render("lesson/view_lesson");
    }
}
?>
