<?php
class Test_cate_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_test_cate WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_test_cate WHERE code = $code AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert('tbl_test_cate', $data); 
        return $query;
    }
}
?>