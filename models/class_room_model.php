<?php
class Class_room_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class_room WHERE title LIKE '%$q%'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, date_start, date_end, content, status, DATE_FORMAT(date_start, '%d-%m-%Y') AS bat_dau,
                                    DATE_FORMAT(date_end, '%d-%m-%Y') AS ket_thuc FROM tbl_class_room WHERE title LIKE '%$q%' ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class_room WHERE code = '$code'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_class_room WHERE code = '$code' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_class_room", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_class_room", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_class_room", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_class_room WHERE id = $id");
        return $query->fetchAll();
    }
}
?>