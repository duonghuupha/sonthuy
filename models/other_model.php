<?php
class Other_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_combo_class($q, $user_id){
        if($user_id != 1){
            $query = $this->db->query("SELECT title, id FROM tbl_class_room WHERE title LIKE '%$q%' AND status = 1 AND user_id = $user_id");
        }else{
            $query = $this->db->query("SELECT title, id FROM tbl_class_room WHERE title LIKE '%$q%' AND status = 1");
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_roles_parent($q){
        $query = $this->db->query("SELECT title, id FROM tbl_roles WHERE title LIKE '%$q%' AND parent_id = 0");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_test_cate($q){
        $query = $this->db->query("SELECT title, id, parent_id FROM tbl_test_cate WHERE title LIKE '%$q%' AND status = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_vocab($q){
        $query = $this->db->query("SELECT title, id FROM tbl_vocab_cate WHERE title LIKE '%$q%' AND status = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_personnel($q){
        $query = $this->db->query("SELECT fullname AS title, id FROM tbl_teacher WHERE fullname LIKE '%$q%' AND status = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_group_role($q){
        $query = $this->db->query("SELECT title, id FROM tbl_group_role WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_lesson_cate($q){
        $query = $this->db->query("SELECT title, id FROM tbl_lesson_cate WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_combo_user($q){
        $query = $this->db->query("SELECT id, (SELECT fullname FROM tbl_teacher WHERE tbl_teacher.id = personnel_id) AS title 
                                    FROM tbl_users WHERE personnel_id IN (SELECT tbl_teacher.id FROM tbl_teacher WHERE fullname LIKE '%$q%') 
                                    AND status = 1 AND username != 'admin'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>