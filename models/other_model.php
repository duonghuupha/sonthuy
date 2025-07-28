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
}
?>