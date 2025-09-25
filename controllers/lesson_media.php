<?php
class Lesson_media extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function json(){
        $id = $_REQUEST['id'];
        $jsonObj = $this->model->getFetObj($id);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('lesson_media/json');
    }

    function add(){
        $lesson_id = $_REQUEST['id']; $file = $_FILES['media']['name']; $total = count($file);
        $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/media';
        if(!file_exists($dir_temp) && !is_dir($dir_temp)){
            mkdir($dir_temp, 0777, true);
        }
        for($i = 0; $i < $total; $i++){
            $code = rand(); $new_File_name = $this->_Convert->convert_file($_FILES['media']['name'][$i], $code);
            $data = array("code" => $code, "lesson_id" => $lesson_id, "file" => $new_File_name, "order_media" => 0, "status" => 1, "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj($data);
            if($temp){
                move_uploaded_file($_FILES['media']['tmp_name'][$i], $dir_temp.'/'.$new_File_name);
            }
        }
        $jsonObj['msg'] = "Tải file bài giảng thành công";
        $jsonObj['success'] = true;
        $jsonObj['lesson_id'] = $lesson_id;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('lesson_media/add');
    }

    function update(){
        $id = $_REQUEST['id']; $lesson_id = $_REQUEST['lesson_id']; $ordermedia = $_REQUEST['order_media'];
        $data = array("order_media" => $ordermedia);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $jsonObj['lesson_id'] = $lesson_id;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("lesson_media/update");
    }

    function del(){
        $id = $_REQUEST['id']; $lesson_id = $_REQUEST['lesson_id'];
        $info = $this->model->get_info($id); $file_old = $info[0]['file'];
        $temp = $this->model->delObj($id);
        if($temp){
            if(file_exists(DIR_UPLOAD."/lesson/".$lesson_id."/media/".$file_old)){
                @unlink(DIR_UPLOAD."/lesson/".$lesson_id."/media/".$file_old);
            }
            $jsonObj['msg'] = "Xóa dữ liệu thành công";
            $jsonObj['success'] = true;
            $jsonObj['lesson_id'] = $lesson_id;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("lesson_media/del");
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
