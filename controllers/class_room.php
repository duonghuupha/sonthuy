<?php
class Class_room extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('class_room/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('class_room/json');
    }

    function add(){
        $code = $_REQUEST['code']; $title = $_REQUEST['title']; $date_start = $this->_Convert->convertDate($_REQUEST['date_start']);
        $date_end = $this->_Convert->convertDate($_REQUEST['date_end']); $content = addslashes($_REQUEST['content']);
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã lớp học đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "title" => $title, "date_start" => $date_start, "date_end" => $date_end, "content" => $content, "status" => 1,
                        "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj($data);
            if($temp){
                $jsonObj['msg'] = "Thêm lớp học thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Thêm lớp học thất bại";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('class_room/add');
    }

    function update(){
        $id = $_REQUEST['id'];
        $code = $_REQUEST['code']; $title = $_REQUEST['title']; $date_start = $this->_Convert->convertDate($_REQUEST['date_start']);
        $date_end = $this->_Convert->convertDate($_REQUEST['date_end']); $content = addslashes($_REQUEST['content']);
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "Mã lớp học đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "title" => $title, "date_start" => $date_start, "date_end" => $date_end, "content" => $content, "status" => 1,
                        "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $jsonObj['msg'] = "Cập  nhật lớp học thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật lớp học thất bại";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('class_room/update');
    }

    function del(){
        $id = $_REQUEST['id'];
        if($this->model->delObj($id)){
            $jsonObj['msg'] = "Xóa lớp học thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa lớp học thất bại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('class_room/del');
    }

    function change(){
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        $data = array("status" => $status);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật trạng thái thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật trạng thái thất bại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('class_room/change');
    }
}
?>
