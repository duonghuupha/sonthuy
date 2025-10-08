<?php
class Drag_drop extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        $this->view->render('drag_drop/index');
    }

    function form(){
        $code = $_REQUEST['code'];
        $this->view->target = $this->model->get_target_edit($code);
        $this->view->answer = $this->model->get_answer_edit($code);
        $this->view->render('drag_drop/form');
    }

    function get_json_question(){
        $id = $_REQUEST['question_id'];
        $jsonObj = $this->model->get_json_question_Obj($id);
        $this->view->question = $jsonObj;
        $detail = $this->model->get_detail_question($jsonObj[0]['code']);
        $this->view->target = $detail;
        $answer = $this->model->get_item_question($jsonObj[0]['code']);
        $this->view->answer = $answer;
        $this->view->render('drag_drop/get_json_question');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function action_question($id, $lesson_id, $code, $data_darg_drop_target, $data_darg_drop_answer, $type){
        if($id != 0){
            $this->_Data->delObj_drag_drop_target($code);
        }
        foreach($data_darg_drop_target as $row_t){
            $file = (strlen($row_t['file']) != 0) ? $row_t['file'] : $row_t['file_old']; 
            $data = array("code" => time(), "code_question" => $code, "title" => $row_t['title'], "file" => $file, "status" => 1,
                            "id_temp" => $row_t['id_temp']);
            $tmp = $this->_Data->addObj_drag_drop_target($data);
            if($tmp){
                $dir_temp = $this->return_url_upload($type, $lesson_id, $code)['main'];
                if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                    mkdir($dir_temp, 0777, true);
                }
                if($row_t['file'] != '' && $row_t['file'] != $row_t['file_old']){
                    $sourcePath = $this->return_url_upload($type, $lesson_id, $code)['temp'].'/'.$row_t['file'];
                    $desPatch = $dir_temp.'/'.$row_t['file'];
                    @rename($sourcePath, $desPatch);
                    @unlink($dir_temp.'/'.$row_t['file_old']);
                }
            }
        }
        foreach($data_darg_drop_answer as $row_a){
            $file = (strlen($row_a['file']) != 0) ? $row_a['file'] : $row_a['file_old']; 
            $data = array("code" => time(), "code_question" => $code, "title" => $row_a['title'], "file" => $file, "status" => 1,
                            "target_id" => $row_a['target_id'], "id_temp" => 0);
            $tmp = $this->_Data->addObj_drag_drop_item($data);
            if($tmp){
                $dir_temp = $this->return_url_upload($type, $lesson_id, $code)['main'];
                if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                    mkdir($dir_temp, 0777, true);
                }
                if($row_a['file'] != '' && $row_a['file'] != $row_a['file_old']){
                    $sourcePath = $this->return_url_upload($type, $lesson_id, $code)['temp'].'/'.$row_a['file'];
                    $desPatch = $dir_temp.'/'.$row_a['file'];
                    @rename($sourcePath, $desPatch);
                    @unlink($dir_temp.'/'.$row_a['file_old']);
                }
            }
        }
        return true;
    }

    function upload_file(){
        $type = $_REQUEST['type'];
        if($type == "lesson"){ // cau hoi cho bai giang
            $fileName = $this->_Convert->convert_file($_FILES['file']['name'], 'leson_drag_drop_'.rand(1111, 9999));
            if(move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/lesson/temp/'.$fileName)){
                $jsonObj['file'] = $fileName;
                $jsonObj['success'] = true;
            }else{
                $jsonObj['success'] = false;
            }
        }elseif($type == "vocab"){ // cau hoi cho tu vung
            $code = $_REQUEST['code'];
            $fileName = $this->_Convert->convert_file($_FILES['file']['name'], 'vocab_drag_drop_'.rand(1111, 9999));
            if(move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/vocab/temp/'.$fileName)){
                $jsonObj['file'] = $fileName;
                $jsonObj['success'] = true;
            }else{
                $jsonObj['success'] = false;
            }
        }elseif($type == "test"){ // cau hoi cho de thi
            $fileName = $this->_Convert->convert_file($_FILES['file']['name'], 'test_drag_drop_'.rand(1111, 9999));
            if(move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLOAD.'/test/temp/'.$fileName)){
                $jsonObj['file'] = $fileName;
                $jsonObj['success'] = true;
            }else{
                $jsonObj['success'] = false;        
            }
        }
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render("drag_drop/upload_file");
    }

    function json_target(){
        $code = $_REQUEST['code'];
        $this->view->jsonObj = $this->model->get_target_edit($code);
        $this->view->render("drag_drop/json_target");
    }

    function json_answer(){
        $code = $_REQUEST['code'];
        $this->view->jsonObj = $this->model->get_answer_edit($code);
        $this->view->render("drag_drop/json_answer");
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function return_url_upload($type, $lesson_id, $code){
        if($type == 'lesson'){
            $url['main'] = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
            $url['temp'] = DIR_UPLOAD.'/lesson/temp';
        }elseif($type == 'vocab'){
            $url['main'] = DIR_UPLOAD.'/vocab/'.$code.'/question';
            $url['temp'] = DIR_UPLOAD.'/vocab/temp';
        }elseif($type == 'test'){
            $url['main'] = DIR_UPLOAD.'/test/'.$code.'/question';
            $url['temp'] = DIR_UPLOAD.'/test/temp';
        }
        return $url;
    }

    function remove_file_temp(){
        $this->view->render('drag_drop/remove_file_temp');
    }
}
?>