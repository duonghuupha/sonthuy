<?php
class Test_cate_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_test_cate");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, image, status, create_at, content, (SELECT COUNT(*) FROM tbl_question WHERE tbl_question.source_edu = 3 
                                    AND tbl_question.test_cate_id = tbl_test_cate.id) AS total_question FROM tbl_test_cate ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
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

    function updateObj($id, $data){
        $query = $this->update('tbl_test_cate', $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_test_cate", "id = $id");
        return $query;
    }

    function get_info($id){
        $query = $this->db->query("SELECT * FROM tbl_test_cate WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>