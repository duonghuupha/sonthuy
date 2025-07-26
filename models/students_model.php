<?php
class Students_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($classid, $code, $fullname, $birthday, $gender, $address, $offset, $rows){
        $result = array();
        $where = "code LIKE '%$code%'";
        if($classid != '')
            $where .= " AND class_id = $classid";
        if($fullname != '')
            $where .= " AND fullname LIKE '%$fullname%'";
        if($birthday != '')
            $where .= " AND birthday = '$birthday'";
        if($gender != 0)
            $where .= "gender = '$gender'";
        if($address != '')
            $where .= " AND address LIKE '%$address%'";
        $query = $this->db->query("SELECT * FROM tbl_student WHERE $where");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, email, gender, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday, address, status, class_id,
                                    (SELECT title FROM tbl_class_room WHERE tbl_class_room.id = class_id) AS class_title FROM tbl_student WHERE $where 
                                    LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE code = $code AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_student", $data);
        return $query;
    }

    function addObj_relation($data){
        $query = $this->insert("tbl_student_relation", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_student", $data, "id = $id");
        return $query;
    }

    function delObj_relation($code){
        $query = $this->delete("tbl_student_relation", "code_student = $code");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_student", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_student WHERE id = $id");
        return $query->fetchAll();
    }

    function get_relation($code_student){
        $query = $this->db->query("SELECT id, fullname, phone, email, relation_id AS relationship_id FROM tbl_student_relation WHERE code_student = $code_student");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>