<?php
class Multiple_true extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('multiple_true/index');
    }

    function form(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->get_info($id);
        $this->view->jsonObj = $jsonObj;
        $this->view->render('multiple_true/form');
    }

    function get_json_question(){
        $question_id = $_REQUEST['question_id'];
        $jsonObj = $this->model->get_json_question_Obj($question_id);
        $this->view->jsonObj = $jsonObj;
        $json_detail = $this->model->get_detail_question($jsonObj[0]['code']);
        $this->view->detail = $json_detail;
        $this->view->render('multiple_true/get_json_question');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function action_question($id, $lesson_id, $code){
        if($id == 0){
            return $this->add($lesson_id, $code);
        }else{
            return $this->update($lesson_id, $code);
        }
    }

    function add($lesson_id, $code){
        for($i = 1; $i <= 4; $i++){
            $answer = (isset($_REQUEST['answer_multiple_true_'.$i]) && $_REQUEST['answer_multiple_true_'.$i] != '') ? 1 : 0; 
            $title = $_REQUEST['title_multiple_true_'.$i];
            $file = ($_FILES['file_multiple_true_'.$i]['name'] != '') ? $this->_Convert->convert_file($_FILES['file_multiple_true_'.$i]['name'], rand(11111, 99999)) : '';
            $data = array("code" => time(), "code_question" => $code, "answer" => $answer, "title" => $title, "file" => $file);
            $tmp = $this->_Data->addObj_multiple_true($data);
            if($tmp){
                if($file != ''){
                    $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                    if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                        mkdir($dir_temp, 0777, true);
                    }
                    if(move_uploaded_file($_FILES['file_multiple_true_'.$i]['tmp_name'], $dir_temp.'/'.$file)){
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
        return $temp;
    }

    function update($lesson_id, $code){
        $id_answer = $_REQUEST['id_answer']; $id_answer = explode(",", $id_answer);
        foreach($id_answer as $row){
            $answer = (isset($_REQUEST['answer_multiple_true_'.$row]) && $_REQUEST['answer_multiple_true_'.$row] != '') ? 1 : 0; 
            $title = $_REQUEST['title_multiple_true_'.$row];
            $file = ($_FILES['file_multiple_true_'.$row]['name'] != '') ? $this->_Convert->convert_file($_FILES['file_multiple_true_'.$row]['name'], rand(11111, 99999)) : $_REQUEST['file_old_multiple_true_'.$row];
            $data = array("answer" => $answer, "title" => $title, "file" => $file);
            $tmp = $this->_Data->updateObj_multiple_true($row, $data);
            if($tmp){
                if($_FILES['file_multiple_true_'.$row]['name'] != ''){
                    $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                    if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                        mkdir($dir_temp);
                    }
                    if(move_uploaded_file($_FILES['file_multiple_true_'.$row]['tmp_name'], $dir_temp.'/'.$file)){
                        if(file_exists(DIR_UPLOAD."/lesson/".$lesson_id.'/question/'.$_REQUEST['file_old_multiple_true_'.$row])){
                            @unlink(DIR_UPLOAD."/lesson/".$lesson_id.'/question/'.$_REQUEST['file_old_multiple_true_'.$row]);
                        }
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
        return $temp;
    }
}
?>