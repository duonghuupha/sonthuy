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
        $type = $_REQUEST['type']; $id_temp = $_REQUEST['id_temp']; $code_question = $_REQUEST['code']; $lesson_id = $_REQUEST['lesson_id'];
        if($type == 1){ // answer_a
            $answer = $_REQUEST['answer_left_'.$id_temp];
            if($this->model->check_dupli_id_temp($id_temp) > 0){
                $data = array("code" => time(), "code_question" => $code_question, "answer_a" => $answer, "file_a" => '', "answer_b" => '', "file_b" => 1, 
                                "status" => 0, "id_temp" => $id_temp);
                $temp = $this->model->addObj($data);
            }else{
                $data = array("answer_a" => $answer);
                $temp = $this->model->updateObj_via_id_temp($id_temp, $data);
            }
        }elseif($type == 2){ // file_a

        }elseif($type == 3){ // answer_b
            $answer = $_REQUEST['answer_right_'.$id_temp];
            if($this->model->check_dupli_id_temp($id_temp) > 0){
                $data = array("code" => time(), "code_question" => $code_question, "answer_a" => '', "file_a" => '', "answer_b" => $answer, "file_b" => 1, 
                                "status" => 0, "id_temp" => $id_temp);
                $temp = $this->model->addObj($data);
            }else{
                $data = array("answer_b" => $answer);
                $temp = $this->model->updateObj_via_id_temp($id_temp, $data);
            }
        }else{ // file_b

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

    }
}
?>