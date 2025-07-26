<?php
class Other_Model extends Model{
    function __construct(){
        parent::__construct();
    }

    function get_combo_class($q){
        $query = $this->db->query("SELECT title, id FROM tbl_class_room WHERE title LIKE '%$q%'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>