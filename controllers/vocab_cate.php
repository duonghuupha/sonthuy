<?php
class Vocab_cate extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
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
        $data = array("code" => $code, "title" => $title, "status" => 1, "create_at" => date("Y-m-d H:i:s"));
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
        $this->view->render("vocab_cate/add");
    }

    function update(){
        $id = $_REQUEST['id']; $title = addslashes($_REQUEST['title']);
        $data = array("title" => $title, "create_at" => date("Y-m-d H:i:s"));
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
        $this->view->render("vocab_cate/update");
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