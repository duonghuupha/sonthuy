<?php
require_once('controllers/true_false.php');
require_once('controllers/one_true.php');
require_once('controllers/multiple_true.php');
require_once('controllers/match.php');
require_once('controllers/sort_alphabet.php');
class Lesson_question extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('lesson_question/index');
        require('layouts/footer.php');
    }

    function json(){
        $lesson_id = base64_decode($_REQUEST['id']);
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($lesson_id, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('lesson_question/json');
    }

    function add(){
        $code = $_REQUEST['code']; $lesson_id = $_REQUEST['lesson_id']; $type_question = $_REQUEST['type_question'];
        $title = addslashes($_REQUEST['title']); $status = 1; $create_at = date("Y-m-d H:i:s");
        $file = (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') ? $this->_Convert->convert_file($_FILES['file']['name'], $code) : '';
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã câu hỏi đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "lesson_id" => $lesson_id, "type_question" => $type_question, "title" => $title, "file" => $file,
                            "status" => $status, "create_at" => $create_at);
            $temp = $this->model->addObj($data);
            if($temp){
                if($file != ''){ // tai file dinh kem cua cau hoi
                    $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                    if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                        mkdir($dir_temp);
                    }
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $dir_temp.'/'.$file)){
                        if($this->add_update_detail_question($type_question, $lesson_id, 0, $code)){
                            $jsonObj['msg'] = "Ghi dữ liệu thành công";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }else{
                            $jsonObj['msg'] = "Dữ liệu câu hỏi được lưu thành công, đáp án chưa được lưu";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }else{
                        $this->model->delObj_via_code($code);
                        $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }else{// khong co file dinh kem cua cau hoi
                    if($this->add_update_detail_question($type_question, $lesson_id, 0, $code)){
                        $jsonObj['msg'] = "Ghi dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Dữ liệu câu hỏi được lưu thành công, đáp án chưa được lưu";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("lesson_question/add");
    }

    function update(){
        $code = $_REQUEST['code']; $lesson_id = $_REQUEST['lesson_id']; $type_question = $_REQUEST['type_question'];
        $title = addslashes($_REQUEST['title']); $status = 1; $create_at = date("Y-m-d H:i:s"); $id = $_REQUEST['id'];
        $file = (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') ? $this->_Convert->convert_file($_FILES['file']['name'], $code) : $_REQUEST['file_old'];
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "Mã câu hỏi đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("lesson_id" => $lesson_id, "type_question" => $type_question, "title" => $title, "file" => $file, "create_at" => $create_at);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($_FILES['file']['name'] != ''){
                    $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                    if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                        mkdir($dir_temp);
                    }
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $dir_temp.'/'.$file)){
                        if($this->add_and_update_true_false($id, $code)){
                            if(file_exists(DIR_UPLOAD."/lesson/".$lesson_id.'/question/'.$_REQUEST['file_old'])){
                                @unlink(DIR_UPLOAD."/lesson/".$lesson_id.'/question/'.$_REQUEST['file_old']);
                            }
                            $jsonObj['msg'] = "Ghi dữ liệu thành công";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }else{
                            $jsonObj['msg'] = "Dữ liệu câu hỏi được lưu thành công, đáp án chưa được lưu";
                            $jsonObj['success'] = true;
                            $this->view->jsonObj = json_encode($jsonObj);
                        }
                    }else{
                        $jsonObj['msg'] = "Ghi dữ liệu không thành công 1";
                        $jsonObj['success'] = false;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }else{
                    if($this->add_update_detail_question($type_question, $lesson_id, $id, $code)){
                        $jsonObj['msg'] = "Ghi dữ liệu thành công";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }else{
                        $jsonObj['msg'] = "Dữ liệu câu hỏi được lưu thành công, đáp án chưa được lưu";
                        $jsonObj['success'] = true;
                        $this->view->jsonObj = json_encode($jsonObj);
                    }
                }
            }else{
                $jsonObj['msg'] = "Ghi dữ liệu không thành công 2";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("lesson_question/update");
    }

    function del(){
        $id = $_REQUEST['id']; $info = $this->model->get_info($id);
        $temp = $this->model->delObj($id);
        if($temp){
            // xoa file dinh kem cua cau hoi
            if(file_exists(DIR_UPLOAD."/lesson/".$id."/question/".$info[0]['file'])){
                @unlink(DIR_UPLOAD."/lesson/".$id."/question/".$info[0]['file']);
            }
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("lesson_question/del");
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
        $this->view->render("lesson_question/change");
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_update_detail_question($type, $lesson_id, $id, $code){
        $trueFalseCtrl = new True_false(); $oneTrueCtrl = new One_true(); $multipleTrueCtrl = new Multiple_true();
        $matchCtrl = new Match(); $sortCtrl = new Sort_alphabet();
        if($type == 1){// dang cau hoi dung sai
            return $trueFalseCtrl->add($id, $code);
        }elseif($type == 2){ // dang cau hoi co 1 dap an dung
            return $oneTrueCtrl->action_question($id, $lesson_id, $code);
        }elseif($type == 3){ // dang cau hoi co nhieu dap an dung
            return $multipleTrueCtrl->action_question($id, $lesson_id, $code);
        }elseif($type == 4){ // dang cau hoi noi
            return $matchCtrl->action_question($id, $lesson_id, $code);
        }elseif($type == 5){

        }else{ // dang cau hoi sawp xep chu cai
            return $sortCtrl->action_question($id, $code);
        }
    }
}
?>
