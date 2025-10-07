<?php
class Lesson_dc extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function json(){
        $id = $_REQUEST['id'];
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($id, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('lesson_dc/json');
    }

    function add(){
        $lesson_id = $_REQUEST['id']; $file = $_FILES['image']['name']; $total = count($file);
        $dir_temp = DIR_UPLOAD.'/lesson/'.$lesson_id.'/dc';
        if(!file_exists($dir_temp) && !is_dir($dir_temp)){
            mkdir($dir_temp, 0777, true);
        }
        for($i = 0; $i < $total; $i++){
            $code = rand(); $new_File_name = $this->_Convert->convert_file($_FILES['image']['name'][$i], $code);
            $data = array("code" => $code, "lesson_id" => $lesson_id, "image" => $new_File_name, "order_dc" => 0, "status" => 1, "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj($data);
            if($temp){
                move_uploaded_file($_FILES['image']['tmp_name'][$i], $dir_temp.'/'.$new_File_name);
            }
        }
        $jsonObj['msg'] = "Tải file bài giảng thành công";
        $jsonObj['success'] = true;
        $jsonObj['lesson_id'] = $lesson_id;
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('lesson_dc/add');
    }

    function update(){
        $id = $_REQUEST['id']; $lesson_id = $_REQUEST['lesson_id']; $orderdc = $_REQUEST['order_dc'];
        $data = array("order_dc" => $orderdc);
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
        $this->view->render("lesson_dc/update");
    }

    function del(){
        $id = $_REQUEST['id']; $lesson_id = $_REQUEST['lesson_id'];
        $info = $this->model->get_info($id); $file_old = $info[0]['image'];
        $temp = $this->model->delObj($id);
        if($temp){
            if(file_exists(DIR_UPLOAD."/lesson/".$lesson_id."/dc/".$file_old)){
                @unlink(DIR_UPLOAD."/lesson/".$lesson_id."/dc/".$file_old);
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
        $this->view->render("lesson_dc/del");
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
