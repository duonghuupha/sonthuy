<?php
class Class_room_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
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