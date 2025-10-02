<?php
class Group_role_model extends Model{
    function __construct(){
        parent::__construct();
    }

    function getFetObj($offset, $rows){
        $result = array();
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_group_role");
        $row = $query->fetchAll();
        $query = $this->db->query("SELECT id, code, title, roles, status, DATE_FORMAT(create_at, '%H:%i:%s %d-%m-%Y') AS create_at,  
                                    (SELECT COUNT(*) FROM tbl_users WHERE tbl_users.group_role_id = tbl_group_role.id)
                                    AS total_user FROM tbl_group_role ORDER BY id DESC LIMIT $offset, $rows");
        $result['records'] = $row[0]['Total'];
        $result['total'] = ceil($row[0]['Total']/$rows);
        $result['rows'] = $query->fetchAll();
        return $result;
    }

    function addObj($data){
        $query = $this->insert("tbl_group_role", $data);
        return $query;
    }

    function updateObj($id, $data){
        $query = $this->update("tbl_group_role", $data, "id = $id");
        return $query;
    }

    function delObj($id){
        $query = $this->delete("tbl_group_role", "id = $id");
        return $query;
    }

    function check_role_of_user($id){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE group_role_id = $id");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
}
?>