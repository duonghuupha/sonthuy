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
     * Check token
     */
    function check_token($token){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_users WHERE token = '$token' AND status = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    /**
     * return role parent
     */
    function get_data_role_parent(){
        $query = $this->db->query("SELECT id, title, link, functions FROM tbl_roles WHERE parent_id = 0 AND status = 1 ORDER BY order_position ASC");
        return $query->fetchAll();
    }

    /**
     * return role sub
     */
    function get_data_role_sub($id){
        $query = $this->db->query("SELECT id, title, link, functions FROM tbl_roles WHERE parent_id = $id AND status = 1 ORDER BY order_position ASC");
        return $query->fetchAll();
    }

    /**
     * Check role of group
     */
    function checked_role($id, $role){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_group_role WHERE id = $id
                                    AND FIND_IN_SET('$role', roles)");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    /**
     * kiem tra quyen nguoi dung
     */
    function check_role_controller($grouproleid, $link){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_group_role WHERE id = $grouproleid 
                                    AND FIND_IN_SET((SELECT tbl_roles.id FROM tbl_roles 
                                    WHERE tbl_roles.link = '$link'), roles) AND status = 1");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    /**
     * return check_role_function
     */
    function check_functions_role($userid, $functions, $controller){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_group_role WHERE id = (SELECT group_role_id FROM tbl_users WHERE tbl_users.id= $userid)
                                    AND FIND_IN_SET(CONCAT((SELECT tbl_roles.id FROM tbl_roles WHERE tbl_roles.link = '$controller'), '_', $functions), roles)");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    /**
     * return sidebar roles
     */
    function return_sidebar($userid, $id){
        if($userid == 1){
            $query = $this->db->query("SELECT id, title, icon, link, parent_id FROM tbl_roles WHERE parent_id = $id AND status = 1 ORDER BY order_position ASC");
        }else{
            $query = $this->db->query("SELECT id, title, icon, link, parent_id FROM tbl_roles WHERE parent_id = $id AND FIND_IN_SET(id,
                                        (SELECT roles FROM tbl_group_role WHERE tbl_group_role.id = (SELECT group_role_id FROM tbl_users WHERE tbl_users.id = $userid)))
                                        AND status = 1 ORDER BY order_position ASC");
        }
        return $query->fetchAll();
    }
    
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
    function addObj_match($data){
        $query = $this->insert("tbl_question_match", $data);
        return $query;
    }

    function delObj_match($code){
        $query = $this->delete("tbl_question_match", "code_question = $code");
        return $query;
    }
/////////////////////////////////Dang cau hoi keo tha//////////////////////////////////////////////////////////////////////////////
    function addObj_drag_drop_target($data){
        $query = $this->insert("tbl_question_drag_drop_target", $data);
        return $query;
    }

    function addObj_drag_drop_item($data){
        $query = $this->insert("tbl_question_drag_drop_item", $data);
        return $query;
    }

    function delObj_drag_drop_target($code){
        $query = $this->delete("tbl_question_drag_drop_target", "code_question = $code");
        return $query;
    }
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
