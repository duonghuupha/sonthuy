<?php
class Vocab_cate_Model extends Model{
    function __contruct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_vocab_cate");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT * FROM tbl_vocab_cate ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert('tbl_vocab_cate', $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update('tbl_vocab_cate', $data, "id=$id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete('tbl_vocab_cate', "id=$id");
        return $query;
    }
}
?>