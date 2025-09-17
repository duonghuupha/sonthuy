<?php
class Model {
    function __construct() {
		$this->db = new Database();
	}

    // them moi du lieu
    function insert($table, $array){
        $cols = array();
        $bind = array();
        foreach($array as $key => $value){
            $cols[] = $key;
            $bind[] = "'".$value."'";
        }
        $query = $this->db->query("INSERT INTO ".$table." (".implode(",", $cols).") VALUES (".implode(",", $bind).")");
        return $query;
    }

    // cap nhat du lieu
    function update($table, $array, $where){
        $set = array();
        foreach($array as $key => $value){
            $set[] = $key." = '".$value."'";
        }
        $query = $this->db->query("UPDATE ".$table." SET ".implode(",", $set)." WHERE ".$where);
        return $query;
    }

    // xoa du lieu
    function delete($table, $where = ''){
        if($where == ''){
            $query = $this->db->query("DELETE FROM ".$table);
        }else{
            $query = $this->db->query("DELETE FROM ".$table." WHERE ".$where);
        }
        return $query;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Menu
     */
    function get_menu($id = 0){
        $query = $this->db->query("SELECT * FROM tbl_roles WHERE parent_id = ".$id." ORDER BY order_position ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Return title cate
     */
    function get_parent_title($id){
        $query = $this->db->query("SELECT title FROM tbl_test_cate WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }
////////////////////////////////// Dang cau hoi dung sai///////////////////////////////////////////////////////////////////////
    function addObj_true_false($data){
        $query = $this->insert("tbl_question_true_false", $data);
        return $query;
    }

    function updateObj_true_false($id, $data){
        $query = $this->update("tbl_question_true_false", $data, "id = $id");
        return $query;
    }
//////////////////////////////// Dang cau hoi 1 dap an dung////////////////////////////////////////////////////////////////////
    function addObj_one_true($data){
        $query = $this->insert("tbl_question_one_true", $data);
        return $query;
    }

    function updateObj_one_true($id, $data){
        $query = $this->update("tbl_question_one_true", $data, "id = $id");
        return $query;
    }
//////////////////////////////// Dang cau hoi nhieu dap an dung////////////////////////////////////////////////////////////////////
    function addObj_multiple_true($data){
        $query = $this->insert("tbl_question_multiple_true", $data);
        return $query;
    }

    function updateObj_multiple_true($id, $data){
        $query = $this->update("tbl_question_multiple_true", $data, "id = $id");
        return $query;
    }
/////////////////////////// Dang cau hoi noi /////////////////////////////////////////////////////////////////////////////////////
    function updateObj_via_code_question_match($code, $data){
        $query = $this->update("tbl_question_match", $data, "code_question = $code");
        return $query;
    }
/////////////////////////////////Dang cau hoi keo tha//////////////////////////////////////////////////////////////////////////////

////////////////////////////////// Dang cau hoi sap xep tu/////////////////////////////////////////////////////////////////////////
    function addObj_sort_alphabet($data){
        $query = $this->insert("tbl_question_sort_alphabet", $data);
        return $query;
    }

    function updateObj_sort_alphabet($id, $data){
        $query = $this->update("tbl_question_sort_alphabet", $data, "id = $id");
        return $query;
    }
}
?>
