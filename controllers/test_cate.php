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
        $this->view->render('test_cate/json');
    }

    function add(){
        $code = $_REQUEST['code']; $parentid = (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '') ? $_REQUEST['parent_id'] : 0;
        $title =addslashes($_REQUEST['title']); $content = addslashes($_REQUEST['content']);
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã danh mục đã tồn tại !";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "parent_id" => $parentid, "title" => $title, "content" => $content, "status" => 1, "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj($data);
            if($temp){
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
}
?>