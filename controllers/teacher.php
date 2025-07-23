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
        $image = (isset($_REQUEST['image']) && $_REQUEST['image'] != '') ? $this->_Convert->convert_file($_REQUEST['image'], $code) : '';
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã giáo viên đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "fullname" => $fullname, "birthday" => $birthday, "gender" => $gender,
                        "address" => $address, "phone" => $phone, "email" => $email, "level" => $level, "image" => $image,
                        "status" => 1, "created_at" => date("Y-m-d H:i:s"));
            $temp = $this->model->addObj($data);
            if($temp){
                if($image != ''){
                    move_uploaded_file($_FILES['image']['tmp_name'], DIR_UPLOD."/public/images/teacher/".$image);
                }
                $jsonObj['msg'] = "Thêm mới giáo viên thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Thêm mới giáo viên thất bại";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render("teacher/add");
    }

    function update(){

    }

    function del(){

    }

    function change(){
        
    }
}
?>
