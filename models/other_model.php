<?php
class Other_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_combo_class($q){
        $query = $this->db->query("SELECT title, id FROM tbl_class_room WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_roles_parent($q){
        $query = $this->db->query("SELECT title, id FROM tbl_roles WHERE title LIKE '%$q%' AND parent_id = 0");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_test_cate($q){
        $query = $this->db->query("SELECT title, id, parent_id FROM tbl_test_cate WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_vocab($q){
        $query = $this->db->query("SELECT title, id FROM tbl_vocab_cate WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_personnel($q){
        $query = $this->db->query("SELECT fullname AS title, id FROM tbl_teacher WHERE fullname LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_group_role($q){
        $query = $this->db->query("SELECT title, id FROM tbl_group_role WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>