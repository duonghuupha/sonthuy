<?php
class Test_Model extends Model{
    function __contruct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_question WHERE title LIKE '%$q%' AND source_edu = 3");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, type_question, title, file, status, create_at, test_cate_id, level,
                                    (SELECT tbl_test_cate.title FROM tbl_test_cate WHERE tbl_test_cate.id = test_cate_id) AS test_cate_title
                                    FROM tbl_question WHERE title LIKE '%$q%' AND source_edu = 3 ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function dupliObj($id, $code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_question WHERE code = $code");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_question WHERE code = $code AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_question", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_question", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_question", "id = $id");
        return $query;
    }
    
    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_question WHERE id = $id");
        return $query->fetchAll();
    }
}
?>