<?php
class Teacher_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT * FROM tbl_teacher WHERE fullname LIKE '%$q%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, fullname, email, phone, level, gender, DATE_FORMAT(birthday, '%d-%m-%Y') AS birthday, 
                                    address, email, status, image FROM tbl_teacher WHERE fullname LIKE '%$q%' LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_teacher WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_teacher WHERE code = $code AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_teacher", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_teacher", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_teacher", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_teacher WHERE id = $id");
        return $query->fetchAll();
    }
}
?>