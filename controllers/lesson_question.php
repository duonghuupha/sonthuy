<?php
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
            $data = array("code" => $code, "lesson_id" => $lesson_id, "type_question" => $type_question, "title" => $title, "file" => $file, "create_at" => $create_at);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($file != ''){
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
                        $jsonObj['msg'] = "Ghi dữ liệu không thành công";
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
                $jsonObj['msg'] = "Ghi dữ liệu không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("lesson_question/update");
    }

    function del(){
        
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_update_detail_question($type, $lesson_id, $id, $code){
        if($type == 1){// dang cau hoi dung sai
            return $this->add_and_update_true_false($id, $code);
        }elseif($type == 2){ // dang cau hoi co 1 dap an dung
            return $this->add_and_update_one_true($id, $lesson_id, $code);
        }
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_and_update_true_false($id, $code){
        $answer = $_REQUEST['true_false_value']; $idh = $_REQUEST['id_true_false'];
        if($id == 0){
            $data = array("code" => time(), "code_question" => $code, "answer" => $answer);
            $temp = $this->model->addObj_true_false($data);
        }else{
            $data = array("code_question" => $code, "answer" => $answer);
            $temp = $this->model->updateObj_true_false($idh, $data);
        }
        if($temp){
            return true;
        }else{
            return false;
        }
    }

    function add_and_update_one_true($id, $lesson_id, $code){
        if($id == 0){
            for($i = 1; $i <= 4; $i++){
                $answer = (isset($_REQUEST['answer_one_true_'.$i]) && $_REQUEST['answer_one_true_'.$i] != '') ? 1 : 0; 
                $title = $_REQUEST['title_one_true_'.$i];
                $file = ($_FILES['file_one_true_'.$i]['name'] != '') ? $this->_Convert->convert_file($_FILES['file_one_true_'.$i]['name'], rand(11111, 99999)) : '';
                $data = array("code" => time(), "code_question" => $code, "answer" => $answer, "title" => $title, "file" => $file);
                $tmp = $this->model->addObj_one_true($data);
                if($tmp){
                    if($file != ''){
                        $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                        if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                            mkdir($dir_temp);
                        }
                        if(move_uploaded_file($_FILES['file_one_true_'.$i]['tmp_name'], $dir_temp.'/'.$file)){
                            $temp = true;
                        }else{
                            $temp = false;
                        }
                    }else{
                        $temp = true;
                    }
                }else{
                    $temp = false;
                }
            }
        }else{
            $id_answer = $_REQUEST['id_answer']; $id_answer = explode(",", $id_answer);
            foreach($id_answer as $row){
                $answer = (isset($_REQUEST['answer_one_true_'.$row]) && $_REQUEST['answer_one_true_'.$row] != '') ? 1 : 0; 
                $title = $_REQUEST['title_one_true_'.$row];
                $file = ($_FILES['file_one_true_'.$row]['name'] != '') ? $this->_Convert->convert_file($_FILES['file_one_true_'.$row]['name'], rand(11111, 99999)) : $_REQUEST['file_old_one_true_'.$row];
                $data = array("answer" => $answer, "title" => $title, "file" => $file);
                $tmp = $this->model->updateObj_one_true($row, $data);
                if($tmp){
                    if($file != ''){
                        $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                        if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                            mkdir($dir_temp);
                        }
                        if(move_uploaded_file($_FILES['file_one_true_'.$row]['tmp_name'], $dir_temp.'/'.$file)){
                            $temp = true;
                        }else{
                            $temp = false;
                        }
                    }else{
                        $temp = true;
                    }
                }else{
                    $temp = false;
                }
            }
        }
        return $temp;
    }
}
?>
