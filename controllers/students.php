<?php
class Students extends Controller{
    function __construct(){
        parent::__construct();
        parent::PhadhInt();
    }

    function index(){
        require('layouts/header.php');
        $this->view->render('students/index');
        require('layouts/footer.php');
    }

    function json(){
        $classid = $_REQUEST['class_id']; $code = $_REQUEST['code']; $gender = $_REQUEST['gender'];
        $fullname = isset($_REQUEST['fullname']) ? str_replace("$", " ", $_REQUEST['fullname']) : '';
        $addess = isset($_REQUEST['address']) ? str_replace("$", " ", $_REQUEST['address']) : '';
        $birthday = (isset($_REQUEST['birthday']) && $_REQUEST['birthday'] != '') ? $this->_Convert->convertDate($_REQUEST['birthday']) : '';
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj($classid, $code, $fullname, $birthday, $gender, $addess, $offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('students/json');
    }

    function add(){
        $code = $_REQUEST['code']; $fullname = $_REQUEST['fullname']; $birthday = $this->_Convert->convertDate($_REQUEST['birthday']);
        $gender = $_REQUEST['gender']; $address = $_REQUEST['address']; $email = $_REQUEST['email']; $relation = json_decode($_REQUEST['relation_dc'], true);
        $classid = $_REQUEST['class_id'];
        if($this->model->dupliObj(0, $code) > 0){
            $jsonObj['msg'] = "Mã học sinh đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("code" => $code, "fullname" => $fullname, "birthday" => $birthday, "gender" => $gender, "address" => $address, "email" => $email,
                        "status" => 1, 'create_at' => date('Y-m-d H:i:s'), "class_id" => $classid);
            $temp = $this->model->addObj($data);
            if($temp){
                foreach($relation as $row){
                    $data_relation = array("code" => time(), "code_student" => $code, "fullname" => $row['fullname'], "phone" => $row['phone'], 
                                            "email" => $row['email'], "relation_id" => $row['relationship_id']);
                    $this->model->addObj_relation( $data_relation);
                }
                $jsonObj['msg'] = "Thêm học sinh thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Thêm học sinh không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('students/add');
    }

    function update(){
        $id = $_REQUEST['id']; $code = $_REQUEST['code']; $fullname = $_REQUEST['fullname']; $birthday = $this->_Convert->convertDate($_REQUEST['birthday']);
        $gender = $_REQUEST['gender']; $address = $_REQUEST['address']; $email = $_REQUEST['email']; $relation = json_decode($_REQUEST['relation_dc'], true);
        $classid = $_REQUEST['class_id'];
        if($this->model->dupliObj($id, $code) > 0){
            $jsonObj['msg'] = "Mã học sinh đã tồn tại";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $data = array("fullname" => $fullname, "birthday" => $birthday, "gender" => $gender, "address" => $address, "email" => $email, "class_id" => $classid);
            $temp = $this->model->updateObj($id, $data);
            if($temp){
                $this->model->delObj_relation($code);
                foreach($relation as $row){
                    $data_relation = array("code" => time(), "code_student" => $code, "fullname" => $row['fullname'], "phone" => $row['phone'], 
                                            "email" => $row['email'], "relation_id" => $row['relationship_id']);
                    $this->model->addObj_relation( $data_relation);
                }
                $jsonObj['msg'] = "Cập nhật thông tin học sinh thành công";
                $jsonObj['success'] = true;
                $this->view->jsonObj = json_encode($jsonObj);
            }else{
                $jsonObj['msg'] = "Cập nhật thông học sinh không thành công";
                $jsonObj['success'] = false;
                $this->view->jsonObj = json_encode($jsonObj);
            }
        }
        $this->view->render('students/update');
    }

    function del(){
        $id = $_REQUEST['id'];
        $query = $this->model->delObj($id);
        if($query){
            $jsonObj['msg'] = "Xóa học sinh thành công";
            $jsonObj['success'] = true;
        }else{
            $jsonObj['msg'] = "Xóa học sinh không thành công";
            $jsonObj['success'] = false;
        }
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('students/del');
    }

    function change(){
        $id = $_REQUEST['id']; $status = $_REQUEST['status'];
            $data = array("status" => $status);
        $query = $this->model->updateObj($id, $data);
        if($query){
            $jsonObj['msg'] = "Cập nhật trạng thái học sinh thành công";
            $jsonObj['success'] = true;
        }else{
            $jsonObj['msg'] = "Cập nhật trạng thái học sinh không thành công";
            $jsonObj['success'] = false;
        }
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('students/change');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function relation(){
        $code_student = $_REQUEST['code'];
        $relation = $this->model->get_relation($code_student);
        $this->view->jsonObj = json_encode($relation);
        $this->view->render('students/relation');
    }

    function json_import(){
        $rows = isset($_REQUEST['rows']) ? $_REQUEST['rows'] : 20;
        $get_pages = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($get_pages-1)*$rows;
        $jsonObj = $this->model->getFetObj_temp($offset, $rows);
        $this->view->jsonObj = json_encode($jsonObj);
        $this->view->render('students/json_import');
    }

    function import(){
        $temp = $this->model->delObj_temp();
        if($temp){
            $classid = $_REQUEST['class_id_imp'];
            $file = $_FILES['file_import']['tmp_name'];
            $objFile = PHPExcel_IOFactory::identify($file);
            $objData = PHPExcel_IOFactory::createReader($objFile);
            $objData->setReadDataOnly(true);
            $objPHPExcel = $objData->load($file);
            $sheet = $objPHPExcel->setActiveSheetIndex(0);
            $Totalrow = $sheet->getHighestRow();
            $LastColumn = $sheet->getHighestColumn();
            $TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
            $data = [];
            for ($i = 4; $i <= $Totalrow; $i++) {
                for ($j = 1; $j < $TotalCol; $j++) {
                    //$data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();;
                    if($j == 1){
                        $code = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 2){
                        $fullname = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 3){
                        $gender = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }elseif($j == 4){
                        $birthday = $this->_Convert->convertDate_Import($sheet->getCellByColumnAndRow($j, $i)->getValue());
                    }elseif($j == 5){
                        $address = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                    }
                }
                if($this->model->dupliObj(0, $code) == 0){
                    $data = array("code" => $code, "fullname" => $fullname, "birthday" => $birthday, "gender" => $gender, "address" => $address, "email" => '',
                                    "status" => 99, 'create_at' => date('Y-m-d H:i:s'), "class_id" => $classid);
                    $temp_info = $this->model->addObj($data);
                    $jsonObj['msg'] = "Import dữ liệu không thành công";
                    $jsonObj['success'] = false;
                    $this->view->jsonObj = json_encode($jsonObj);
                }
            }
            $jsonObj['msg'] = "Import dữ liệu thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Import dữ liệu không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('students/import');
    }

    function save_import(){
        $data = array("status" => 1);
        $temp = $this->model->updateObj_temp($data);
        if($temp){
            $jsonObj['msg'] = "Cập nhật danh sách học sinh thành công";
            $jsonObj['success'] = true;
            $this->view->jsonObj = json_encode($jsonObj);
        }else{
            $jsonObj['msg'] = "Cập nhật danh sách học sinh không thành công";
            $jsonObj['success'] = false;
            $this->view->jsonObj = json_encode($jsonObj);
        }
        $this->view->render('students/save_import');
    }
}
?>
