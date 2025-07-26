<?php
class Muster_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_student_by_class($class_id, $date_muster, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE class_id = $class_id AND status = 1
                                    AND id NOT IN (SELECT student_id FROM tbl_student_muster WHERE date_muster = '$date_muster' AND class_id = $class_id)");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, gender, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday, (SELECT title FROM tbl_class_room
                                    WHERE tbl_class_room.id = class_id) AS class_title FROM tbl_student WHERE class_id = $class_id AND status = 1 
                                    AND id NOT IN (SELECT student_id FROM tbl_student_muster WHERE date_muster = '$date_muster' AND class_id = $class_id) 
                                    ORDER BY fullname ASC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function get_student_muster($class_id, $date_muster, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student WHERE class_id = $class_id AND status = 1
                                    AND id IN (SELECT student_id FROM tbl_student_muster WHERE date_muster = '$date_muster' AND class_id = $class_id)");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, gender, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday, (SELECT title FROM tbl_class_room
                                    WHERE tbl_class_room.id = class_id) AS class_title FROM tbl_student WHERE class_id = $class_id AND status = 1 
                                    AND id IN (SELECT student_id FROM tbl_student_muster WHERE date_muster = '$date_muster' AND class_id = $class_id) 
                                    ORDER BY fullname ASC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($student_id, $class_id, $date_muster){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_muster WHERE student_id = $student_id AND class_id = $class_id AND date_muster = '$date_muster'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
    function addObj($data){
        $query = $this->insert("tbl_student_muster", $data);
        return $query;
    }

    function delObj($student_id, $class_id, $date_muster){
        $query = $this->delete("tbl_student_muster", "student_id = $student_id AND class_id = $class_id AND date_muster = '$date_muster'");
        return $query;
    }
}
?>