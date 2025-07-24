<?php
class Teacher extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('teacher/index');
        require('layouts/footer.php');
    }

    function json(){
        $keyword = isset($_REQUEST['q']) ? str_replace("$", " ", $_REQUEST['q']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($keyword, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('teacher/json');
    }

    function add(){
        $code = $_REQUEST['code']; $fullname = $_REQUEST['fullname']; $gender = $_REQUEST['gender'];
        $birthday = $this->_Convert->convertDate($_REQUEST['birthday']); $address = addslashes($_REQUEST['address']);
        $phone = $_REQUEST['phone']; $email = $_REQUEST['email']; $level = addslashes($_REQUEST['level']);
        $image = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], $code) : '';
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã giáo viên đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "fullname" => $fullname, "birthday" => $birthday, "gender" => $gender,
                        "address" => $address, "phone" => $phone, "email" => $email, "level" => $level, "image" => $image,
                        "status" => 1, "create_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj($data);
            if($temp){
                if($image != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD."/images/teacher/".$image);
                }
                $jsonObj['msg'] = "Thêm mới thông tin thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Thêm mới thông tin thất bại";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("teacher/add");
    }

    function update(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code']; $fullname = $_REQUEST['fullname']; $gender = $_REQUEST['gender'];
        $birthday = $this->_Convert->convertDate($_REQUEST['birthday']); $address = addslashes($_REQUEST['address']);
        $phone = $_REQUEST['phone']; $email = $_REQUEST['email']; $level = addslashes($_REQUEST['level']);
        $image = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $this->_Convert->convert_file($_FILES['image']['name'], $code) : $_REQUEST['image_old'];
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "Mã giáo viên đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "fullname" => $fullname, "birthday" => $birthday, "gender" => $gender,
                        "address" => $address, "phone" => $phone, "email" => $email, "level" => $level, "image" => $image);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                if($image != ''){
                    if(move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOAD."/images/teacher/".$image)){
                        if(file_exists(DIR_UPLOAD."/images/teacher/".$_REQUEST['image_old'])){
                            @unlink(DIR_UPLOAD."/images/teacher/".$_REQUEST['image_old']);
                        }
                    }
                }
                $jsonObj['msg'] = "Cập nhật thông tin thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật thông tin thất bại";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("teacher/update");
    }

    function del(){
        $id = $_REQUEST['id']; $image = base64_decode($_REQUEST['image']);
        $temp = $this->model->delObj($id);
        if($temp){
            if(file_exists(DIR_UPLOAD."/images/teacher/".$image)){
                @unlink(DIR_UPLOAD."/images/teacher/".$image);
            }
            $jsonObj['msg'] = "Xóa thông tin thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Xóa thông tin thất bại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render("teacher/del");
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
        $data = array("status" => $status);
        $temp = $this->model->updateObj($id, $data);
        if($temp){
            $jsonObj['msg'] = "Thay đổi trạng thái thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Thay đổi trạng thái thất bại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);   
        }
        $this->view->render("teacher/change");
    }
}
?>
