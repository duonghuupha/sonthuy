<?php
class Users_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($q, $offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username LIKE '%$q%' AND username != 'admin'");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, username, group_role_id, personnel_id, status, (SELECT fullname FROM tbl_teacher WHERE tbl_teacher.id = personnel_id)
                                    AS teacher_title, (SELECT title FROM tbl_group_role WHERE tbl_group_role.id = group_role_id) AS group_title 
                                    FROM tbl_users WHERE username LIKE '%$q%' AND username != 'admin' LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function dupliObj($id, $username){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username = '$username'");
        if($id > 0){
            $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE username = '$username' AND id != $id");
        }
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function addObj($data){
        $query = $this->insert("tbl_users", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_users", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_users", "id = $id");
        return $query;
    }
}
?>