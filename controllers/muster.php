<?php
class Muster extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('muster/index');
        require('layouts/footer.php');
    }

    function json_student(){
        $class_id = (isset($_REQUEST['class_id']) && $_REQUEST['class_id'] != '') ? $_REQUEST['class_id'] : 0;
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_student_by_class($class_id, date("Y-m-d"), $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('muster/json_student');
    }

    function json_student_muster(){
        $class_id = (isset($_REQUEST['class_id']) && $_REQUEST['class_id'] != '') ? $_REQUEST['class_id'] : 0;
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_student_muster($class_id, date("Y-m-d"), $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('muster/json_student_muster');
    }

    function add(){
        $id = $_REQUEST['student_id']; $class_id = $_REQUEST['class_id'];
        $date_muster = date("Y-m-d");
        if($this->model->dupliObj($id, $class_id, $date_muster) > 0){   
            $this->view->jsonobj = json_encode(array("success" => false, "msg" => "Học sinh đã được điểm danh trong ngày hôm nay"));
        }else{
            $data = array("code" => time(), "class_id" => $class_id, "student_id" => $id, "date_muster" => $date_muster, "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj($data);
            if($temp){
                $this->view->jsonobj = json_encode(array("success" => true, "msg" => "Điểm danh học sinh thành công")); 
            }else{
                $this->view->jsonobj = json_encode(array("success" => false, "msg" => "Điểm danh học sinh không thành công, vui lòng thử lại sau"));
            }
        }
        $this->view->render('muster/add');
    }

    function del(){
        $id = $_REQUEST['student_id']; $class_id = $_REQUEST['class_id'];
        $date_muster = date("Y-m-d");   
        $temp = $this->model->delObj($id, $class_id, $date_muster);
        if($temp){
            $this->view->jsonObj = json_encode(array("success" => true, "msg" => "Xóa điểm danh học sinh thành công")); 
        }else{
            $this->view->jsonObj = json_encode(array("success" => false, "msg" => "Xóa điểm danh học sinh không thành công, vui lòng thử lại sau"));
        }
        $this->view->render('muster/del');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function json_muster_total(){
        $class_id = (isset($_REQUEST['class_id']) && $_REQUEST['class_id'] != '') ? $_REQUEST['class_id'] : 0;
        $date_muster = (isset($_REQUEST['date_muster']) && $_REQUEST['date_muster'] != '') ? $_REQUEST['date_muster'] : date("Y-m-d");
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->get_student_muster($class_id, $date_muster, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('muster/json_muster_total');
    }
}
?>
