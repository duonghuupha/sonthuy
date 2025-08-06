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
                if($file != ''){
                    $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/question';
                    if(!file_exists($dir_temp) && !is_dir($dir_temp)){
                        mkdir($dir_temp);
                    }
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $dir_temp.'/'.$file)){
                        if($this->add_and_update_true_false($code)){
                            $jsonObj['msg'] = "Ghi dữ liệu thành công 1";
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
                }else{
                    if($this->add_and_update_true_false($code)){
                        $jsonObj['msg'] = "Ghi dữ liệu thành công 1";
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function view_question(){
        $id = $_REQUEST['id'];
        $this->view->render("lesson_question/view_question");
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_and_update_true_false($code){
        $answer = $_REQUEST['true_false_value'];
        $data = array("code" => time(), "code_question" => $code, "answer" => $answer);
        $temp = $this->model->addObj_true_false($data);
        if($temp){
            return true;
        }else{
            return false;
        }
    }
}
?>
