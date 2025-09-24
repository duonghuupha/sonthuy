<?php
class Match extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('match/index');
    }

    function form(){
        $code_question = $_REQUEST['code'];
        $detail = $this->model->get_detail_question_edit($code_question);
        $this->view->detail = $detail;
        $this->view->render('match/form');
    }

    function get_json_question(){
        $id = $_REQUEST['question_id'];
        $jsonObj = $this->model->get_json_question_Obj($id);
        $this->view->question = $jsonObj;
        $detail = $this->model->get_detail_question($jsonObj[0]['code']);
        $this->view->detail = $detail;
        $this->view->render('match/get_json_question');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_item(){
        $type = $_REQUEST['type']; $id_temp = $_REQUEST['id_temp']; $code_question = $_REQUEST['code_question']; $lesson_id = $_REQUEST['lesson_id'];
        if($type == 1){ // answer_a
            $answer = addslashes($_REQUEST['answer_left_'.$id_temp]);
            if($this->model->check_dupli_id_temp($id_temp) == 0){
                $data = array("code" => time(), "code_question" => $code_question, "answer_a" => $answer, "file_a" => '', "answer_b" => '', "file_b" => '', 
                                "status" => 0, "id_temp" => $id_temp);
                $temp = $this->model->addObj($data);
            }else{
                $data = array("answer_a" => $answer);
                $temp = $this->model->updateObj_via_id_temp($id_temp, $data);
            }
        }elseif($type == 2){ // file_a
            $file = $this->_Convert->convert_file($_FILES['file_left_'.$id_temp]['name'], rand(11111, 99999));
            if($this->model->check_dupli_id_temp($id_temp) == 0){
                $data = array("code" => time(), "code_question" => $code_question, "answer_a" => '', "file_a" => $file, "answer_b" => '', "file_b" => '', 
                                "status" => 0, "id_temp" => $id_temp);
                $tmp = $this->model->addObj($data);
                if($tmp){   
                    $temp = move_uploaded_file($_FILES['file_left_'.$id_temp]['tmp_name'], DIR_UPLOAD.'/lesson/'.$lesson_id.'/question/'.$file);
                }else{
                    $temp = false;
                }
            }else{
                $data = array("file_a" => $file);
                $tmp = $this->model->updateObj_via_id_temp($id_temp, $data);
                if($tmp){
                    $temp = move_uploaded_file($_FILES['file_left_'.$id_temp]['tmp_name'], DIR_UPLOAD.'/lesson/'.$lesson_id.'/question/'.$file);
                }else{
                    $temp = false;
                }
            }
        }elseif($type == 3){ // answer_b
            $answer = addslashes($_REQUEST['answer_right_'.$id_temp]);
            if($this->model->check_dupli_id_temp($id_temp) == 0){
                $data = array("code" => time(), "code_question" => $code_question, "answer_a" => '', "file_a" => '', "answer_b" => $answer, "file_b" => '', 
                                "status" => 0, "id_temp" => $id_temp);
                $temp = $this->model->addObj($data);
            }else{
                $data = array("answer_b" => $answer);
                $temp = $this->model->updateObj_via_id_temp($id_temp, $data);
            }
        }else{ // file_b
            $file = $this->_Convert->convert_file($_FILES['file_right_'.$id_temp]['name'], rand(11111, 99999));
            if($this->model->check_dupli_id_temp($id_temp) == 0){
                $data = array("code" => time(), "code_question" => $code_question, "answer_a" => '', "file_a" => '', "answer_b" => '', "file_b" => $file, 
                                "status" => 0, "id_temp" => $id_temp);
                $tmp = $this->model->addObj($data);
                if($tmp){   
                    $temp = move_uploaded_file($_FILES['file_right_'.$id_temp]['tmp_name'], DIR_UPLOAD.'/lesson/'.$lesson_id.'/question/'.$file);
                }else{
                    $temp = false;
                }
            }else{
                $data = array("file_b" => $file);
                $tmp = $this->model->updateObj_via_id_temp($id_temp, $data);
                if($tmp){
                    $temp = move_uploaded_file($_FILES['file_right_'.$id_temp]['tmp_name'], DIR_UPLOAD.'/lesson/'.$lesson_id.'/question/'.$file);
                }else{
                    $temp = false;
                }
            }
        }
        if($temp){
            $jsonObj['msg'] = "Thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thêm dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("match/add_item");
    }

    function update_item(){
        $type = $_REQUEST['type']; $id_temp = $_REQUEST['id_temp']; $code_question = $_REQUEST['code_question']; $lesson_id = $_REQUEST['lesson_id'];
        $id = $_REQUEST['id'];
        if($type == 1){ // answer_a
            $answer = addslashes($_REQUEST['answer_left_'.$id]);
            $data = array("answer_a" => $answer);
            $temp = $this->model->updateObj($id, $data);
        }elseif($type == 2){ // file_a
            $file = $this->_Convert->convert_file($_FILES['file_left_'.$id]['name'], rand(11111, 99999));
            $data = array("file_a" => $file);
            $tmp = $this->model->updateObj($id, $data);
            if($tmp){
                $temp = move_uploaded_file($_FILES['file_left_'.$id]['tmp_name'], DIR_UPLOAD.'/lesson/'.$lesson_id.'/question/'.$file);
            }else{
                $temp = false;
            }
        }elseif($type == 3){ // answer_b
            $answer = addslashes($_REQUEST['answer_right_'.$id]);
            $data = array("answer_b" => $answer);
            $temp = $this->model->updateObj($id, $data);
        }else{ // file_b
            $file = $this->_Convert->convert_file($_FILES['file_right_'.$id]['name'], rand(11111, 99999));
            $data = array("file_b" => $file);
            $tmp = $this->model->updateObj($id, $data);
            if($tmp){
                $temp = move_uploaded_file($_FILES['file_right_'.$id]['tmp_name'], DIR_UPLOAD.'/lesson/'.$lesson_id.'/question/'.$file);
            }else{
                $temp = false;
            }
        }
        if($temp){
            $jsonObj['msg'] = "Thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thêm dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("match/update_item");
    }

    function action_question($id, $lession_id, $code){
        $data = array("status" => 1, "id_temp" => 0);
        $temp = $this->_Data->updateObj_via_code_question_match($code, $data);
        return $temp;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function cancel_match(){
        $code = $_REQUEST['code_question'];
        $list_id = $this->model->get_list_id_edit($code);
        $this->model->delObj_cancel($code);
        foreach($list_id as $row){
            $title_a = addslashes($_REQUEST['answer_left_old'.$row['id']]);
            $title_b = addslashes($_REQUEST['answer_right_old'.$row['id']]);
            $file_a = $_REQUEST['file_left_old_'.$row['id']];
            $file_b = $_REQUEST['file_right_old_'.$row['id']];
            $data = array("answer_a" => $title_a, "file_a" => $file_a, "answer_b" => $title_b, "file_b" => $file_b);
            $this->model->updateObj($row['id'], $data);
        }
        $jsonObj['msg'] = "Thành công";
        $jsonObj['success'] = true;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("match/cancel_match");
    }
}
?>