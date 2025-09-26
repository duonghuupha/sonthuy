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
    function action_question($id, $lesson_id, $code, $data_match, $type){
        if($id != 0){
            $this->_Data->delObj_match($code);
        }
        foreach($data_match as $row){
            $file_a = (strlen($row['file_a']) != 0) ? $row['file_a'] : $row['file_a_old']; 
            $file_b = (strlen($row['file_b']) != 0) ? $row['file_b'] : $row['file_b_old'];
            $data = array("code" => time(), "code_question" => $code, "answer_a" => $row['answer_a'], "file_a" => $file_a,
                            "answer_b" => $row['answer_b'], "file_b" => $file_b, "status" => 1, "id_temp" => 0);
            $tmp = $this->_Data->addObj_match($data);
            if($tmp){
                if($row['file_a'] != '' && $row['file_a'] != $row['file_a_old']){
                    $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                    if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                        mkdir($dir_temp, 0777, true);
                    }
                    $sourcePath = DIR_UPLOAD.'/lesson/temp/'.$row['file_a'];
                    $desPatch = $dir_temp.'/'.$row['file_a'];
                    @rename($sourcePath, $desPatch);
                    @unlink($dir_temp.'/'.$row['file_a_old']);
                }
                if($row['file_b'] != '' && $row['file_b'] != $row['file_b_old']){
                    $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                    if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                        mkdir($dir_temp, 0777, true);
                    }
                    $sourcePath = DIR_UPLOAD.'/lesson/temp/'.$row['file_b'];
                    $desPatch = $dir_temp.'/'.$row['file_b'];
                    @rename($sourcePath, $desPatch);
                    @unlink($dir_temp.'/'.$row['file_b_old']);
                }
            }
        }
        return true;
    }

    function upload_file(){
        $type = $_REQUEST['type'];
        if($type == 'lesson'){ // cau hoi cho bai giang
            $fileName = $this->_Convert->convert_file($_FILES['file']['name'], 'lesson_match_'.rand(1111, 9999));
            if(move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/lesson/temp/'.$fileName)){
                $jsonObj['file'] = $fileName;
                $jsonObj['success'] = true;
            }else{
                $jsonObj['success'] = false;
            }
        }elseif($type == 'vocab'){ // cau hoi cho tu vung
            $fileName = $this->_Convert->convert_file($_FILES['file']['name'], 'vocab_match_'.rand(1111, 9999));
            if(move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/vocab/temp/'.$fileName)){
                $jsonObj['file'] = $fileName;
                $jsonObj['success'] = true;
            }else{
                $jsonObj['success'] = false;
            }
        }elseif($type == 'test'){ // cau hoi cho de thi
            $fileName = $this->_Convert->convert_file($_FILES['file']['name'], 'test_match_'.rand(1111, 9999));
            if(move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/test/temp/'.$fileName)){
                $jsonObj['file'] = $fileName;
                $jsonObj['success'] = true;
            }else{
                $jsonObj['success'] = false;
            }
        }
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("match/upload_file");
    }

    function json_edit(){
        $code = $_REQUEST['code'];
        $this->view->jsonObj =$this->model->get_detail_match($code);
        $this->view->render("match/json_edit");
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>