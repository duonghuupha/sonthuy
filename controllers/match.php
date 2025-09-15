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
        $type = $_REQUEST['type']; $id_temp = $_REQUEST['id_temp']; $str_code = $_REQUEST['str_code']; $code_question = $_REQUEST['code'];
        $lesson_id = $_REQUEST['lesson_id'];
        if($this->model->check_dupli_id_temp($id_temp) == 0){ // khong co thi them moi
            if($str_code == 'left'){ // cot ben trai
                $answer = $_REQUEST['answer_left_'.$id_temp];
                $file = (isset($_FILES['file_left_'.$id_temp]['name']) && $_FILES['file_left_'.$id_temp] != '') ? $this->_Convert->convert_file($_FILES['file_left_'.$id_temp]['name'], rand(11111, 99999)) : '';
                $data = array('code' => time(), "code_question" => $code_question, "answer_a" => $answer, "file_a" => $file, "answer_b" => '', "file_b" => '',
                                "status" => 0, "id_temp" => $id_temp);
                $temp = $this->model->addObj($data);
                if($temp){
                    if($file != ''){
                        @move_uploaded_file($_FILES['file_left_'.$id_temp]['tmp_name'], DIR_UPLOAD.'/lesson/'.$lesson_id.'/question/'.$file);
                    }
                    $jsonObj['msg'] = "Thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Thêm dữ liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }else{ // cot ben phai
                $answer = $_REQUEST['answer_right_'.$id_temp];
                $file = (isset($_FILES['file_right_'.$id_temp]['name']) && $_FILES['file_right_'.$id_temp] != '') ? $this->_Convert->convert_file($_FILES['file_right_'.$id_temp]['name'], rand(11111, 99999)) : '';
                $data = array('code' => time(), "code_question" => $code_question, "answer_a" => '', "file_a" => '', "answer_b" => $answer, "file_b" => $file,
                                "status" => 0, "id_temp" => $id_temp);
                $temp = $this->model->addObj($data);
                if($temp){
                    if($file != ''){
                        @move_uploaded_file($_FILES['file_right_'.$id_temp]['tmp_name'], DIR_UPLOAD.'/lesson/'.$lesson_id.'/question/'.$file);
                    }
                    $jsonObj['msg'] = "Thành công";
                    $jsonObj['success'] = true;
                    $this->view->jsonObj = json_encode($jsonObj);
                }else{
                    $jsonObj['msg'] = "Thêm dữ liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
        }else{ // cap nhat 
            if($str_code == 'left'){ // cot ben trai
                
            }else{ // cot ben phai

            }
        }
    }

    function update_item(){

    }
}
?>