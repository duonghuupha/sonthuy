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
     * return fullname personnel pass user_id
     */
    function return_fullname_pass_user_id($id){
        $query = $this->db->query("SELECT fullname FROM tbl_personnel WHERE id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = $id)");
        $row = $query->fetchAll();
        return $row[0]['fullname'];
    }

    /**
     * return timeline comment task pass date create
     */
    function return_list_result_task_pass_date_create($id, $date){
        $query = $this->db->query("SELECT create_at, content, code, IF(user_id = 1, 'Administrator', (SELECT fullname FROM tbl_personnel
                                    WHERE tbl_personnel.id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = user_id))) AS user_create 
                                    FROM tbl_task_result WHERE task_id = $id AND DATE_FORMAT(create_at, '%d-%m-%Y') = '$date' ORDER BY id DESC");
        return $query->fetchAll();
    }

    /**
     * return file attach result
     */
    function return_list_file_result($code){
        $query = $this->db->query("SELECT file FROM tbl_task_result_file WHERE code_result = $code AND status = 1");
        return $query->fetchAll();
    }

    /**
     * return parent_name roles
     */
    function return_parent_name_roles($id){
        $query = $this->db->query("SELECT title FROM tbl_roles WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
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
     * return id role via link
     */
    function return_id_role_via_link($link){
        $query = $this->db->query("SELECT parent_id FROM tbl_roles WHERE link = '$link'");
        $row = $query->fetchAll();
        return $row[0]['parent_id'];
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
     * return fullname by user_id
     */
    function return_fullname_personnel_userid($personel_id){
        $query = $this->db->query("SELECT fullname FROM tbl_personnel WHERE id = $personel_id");
        $row = $query->fetchAll();
        return $row[0]['fullname'];
    }

    /**
     * return dupli code personnel_temp
     */
    function return_dupli_code_personnel_temp($code){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_personnel WHERE code = $code AND status = 99");
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
     * return list user class
     */
    function get_list_name_per_class($id){
        $query = $this->db->query("SELECT id, personnel_id, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = personnel_id)
                                    AS fullname FROM tbl_users WHERE FIND_IN_SET(tbl_users.id, (SELECT user_id_charge FROM tbl_class
                                    WHERE id = $id))");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * return list criteria
     */
    function get_list_criteria($stand_id){
        $query = $this->db->query("SELECT id, title, content FROM tbl_validate_criteria WHERE stand_id = $stand_id AND status = 1
                                ORDER BY id ASC");
        return $query->fetchAll();
    }

    /**
     * return standard
     */
    function get_standard($id){
        $query = $this->db->query("SELECT title FROM tbl_validate_standard WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }

    /**
     * return criteria
     */
    function get_criteria($id){
        $query = $this->db->query("SELECT title FROM tbl_validate_criteria WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }

    /**
     * return  file name document_in
     */
    function return_file_name_dc_in($id){
        $query = $this->db->query("SELECT file, title FROM tbl_document_in WHERE id= $id");
        return $query->fetchAll();
    }

    /**
     * return  file name document_out
     */
    function return_file_name_dc_out($id){
        $query = $this->db->query("SELECT file, title FROM tbl_document_out WHERE id= $id");
        return $query->fetchAll();
    }

    /**
     * return fullname user_process
     */
    function return_fullname_user_proccess_task($id){
        $query = $this->db->Query("SELECT fullname FROM tbl_personnel WHERE id = (SELECT personnel_id FROM tbl_users WHERE tbl_users.id = $id)");
        $row = $query->fetchAll();
        if($id == 1){
            return 'Administrator';
        }else{
            return $row[0]['fullname'];
        }
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
     * return list class of table food
     */
    function return_list_talbe_food($year_id, $offset, $rows){
        $query = $this->db->query("SELECT id, class_id, order_class, (SELECT tbl_class.title FROM tbl_class 
                                    WHERE tbl_class.id = class_id) AS title FROM tbl_food_class WHERE year_id = $year_id
                                    ORDER BY order_class ASC LIMIT $offset, $rows");
        return $query->fetchAll();
    }

    /**
     * return list class of talbe food readtime
     */
    function get_class_food_pass_year_and_date($yearid, $date, $offset, $rows){
        $query = $this->db->query("SELECT id, class_id, (SELECT title FROM tbl_class WHERE tbl_class.id = class_id) AS title, 
                                    (SELECT COUNT(*) FROM tbl_student_muster WHERE tbl_student_muster.class_id = tbl_food_class.class_id 
                                    AND tbl_student_muster.date_muster = '$date') AS food_main,
                                    (SELECT training_system_id FROM tbl_class WHERE tbl_class.id = class_id) AS system_id
                                    FROM tbl_food_class WHERE year_id = $yearid ORDER BY order_class ASC LIMIT $offset, $rows");
        return $query->fetchAll();
    }

    function get_value_share_food($food_id, $system_id, $type_food){
        $query = $this->db->query("SELECT value_share FROM tbldm_food_ct WHERE food_code = (SELECT tbldm_food.code FROM tbldm_food WHERE tbldm_food.id = $food_id
                                    AND tbldm_food.type_id = $type_food) AND system_id = $system_id");
        $row = $query->fetchAll();
        return $row[0]['value_share'];
    }

    /**
     * return title device when print qrcode
     */
    function get_titlte_device_print_qrcode($id){
        $query = $this->db->query("SELECT title FROM tbl_device WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }

    function get_title_system_id($id){
        $query = $this->db->query("SELECT title FROM tbldm_training_system WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }

    function get_food_menu_detail($code){
        $query = $this->db->query("SELECT food_id, (SELECT type_id FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) AS type_food, (SELECT tbldm_food.title
                                    FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) AS title_food, (SELECT tbldm_unit.title FROM tbldm_unit WHERE tbldm_unit.id = (SELECT tbldm_food.unit_id
                                    FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1)) AS unit_title FROM tbl_menu_food_ct WHERE menu_code = $code 
                                    ORDER BY (SELECT type_id FROM tbldm_food WHERE tbldm_food.id = food_id AND tbldm_food.status = 1) ASC");
        return $query->fetchAll();
    }

    function get_info_commune($id){
        $query = $this->db->query("SELECT code, title FROM tbldm_commune WHERE id = $id");
        return $query->fetchAll();
    }

    function get_info_village($id){
        $query = $this->db->query("SELECT title FROM tbldm_village WHERE id = $id");
        $row = $query->fetchAll();
        return $row[0]['title'];
    }

    function get_last_food_main_of_date($class_id, $date){
        $query = $this->db->query("SELECT food_main FROM tbl_time_food WHERE class_id = $class_id AND DATE_FORMAT(create_at, '%Y-%m-%d') = '$date'
                                    ORDER BY id DESC LIMIT 0, 1");
        $row = $query->fetchAll();
        return $row[0]['food_main'];
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Hien thi danh sach cong viec theo ngay cuaa tung nguoi dung
     */
    function get_task_of_date($str_user, $date){
        $query = $this->db->query("SELECT id, title, user_id_process, user_id_monitor, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id
                                    FROM tbl_users WHERE tbl_users.id = user_id_monitor)) AS user_monitor FROM tbl_task WHERE display_week = 1 AND date_start <= '$date' 
                                    AND date_end >= '$date' AND (FIND_IN_SET('$str_user', user_id_process) OR FIND_IN_SET(user_id_monitor, '$str_user')) ORDER BY id DESC");
        return $query->fetchAll();
    }

    function get_task_of_date_first($str_user, $date){
        $query = $this->db->query("SELECT id, title, user_id_process, user_id_monitor, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id
                                    FROM tbl_users WHERE tbl_users.id = user_id_monitor)) AS user_monitor FROM tbl_task WHERE display_week = 1 AND date_start <= '$date' 
                                    AND date_end >= '$date' AND (FIND_IN_SET('$str_user', user_id_process) OR FIND_IN_SET(user_id_monitor, '$str_user')) ORDER BY id DESC
                                    LIMIT 0, 1");
        return $query->fetchAll();
    }

    function get_task_of_date_continue($str_user, $date){
        $query = $this->db->query("SELECT id, title, user_id_process, user_id_monitor, (SELECT fullname FROM tbl_personnel WHERE tbl_personnel.id = (SELECT personnel_id
                                    FROM tbl_users WHERE tbl_users.id = user_id_monitor)) AS user_monitor FROM tbl_task WHERE display_week = 1 AND date_start <= '$date' 
                                    AND date_end >= '$date' AND (FIND_IN_SET('$str_user', user_id_process) OR FIND_IN_SET(user_id_monitor, '$str_user')) ORDER BY id DESC
                                    LIMIT 1, 1000");
        return $query->fetchAll();
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_total_muster_of_class_pass_date($classid, $date){
        $query = $this->db->query("SELECT COUNT(student_id) AS Total FROM tbl_student_muster WHERE class_id = $classid AND date_muster = '$date'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_total_muster_of_date($date){
        $query = $this->db->query("SELECT COUNT(student_id) AS Total FROM tbl_student_muster WHERE date_muster = '$date'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }

    function get_total_muster_of_student_pass_date($studentid, $date){
        $query = $this->db->query("SELECT COUNT(*) AS Total FROM tbl_student_muster WHERE student_id = $studentid AND date_muster = '$date'");
        $row = $query->fetchAll();
        return $row[0]['Total'];
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_proof_validate_pass_proof_dt($stand_id, $criteria_id){
        $query = $this->db->query("SELECT proof_id, year_proof, (SELECT encode FROM tbl_validate_proof WHERE tbl_validate_proof.id = proof_id) AS encode,
                                    (SELECT tbl_validate_period_dt.title FROM tbl_validate_period_dt WHERE tbl_validate_period_dt.id = year_proof) AS year_title 
                                    FROM tbl_validate_proof_dt WHERE status = 1 AND proof_id IN (SELECT tbl_validate_proof.id FROM tbl_validate_proof
                                    WHERE stand_id = $stand_id AND criteria_id = $criteria_id AND status = 1) GROUP BY proof_id, year_proof");
        return $query->fetchAll();
    }

    function get_proof_validate_dt_pass_proof_id_and_year_proof($proof_id, $year_proof, $start, $end){
        $query = $this->db->query("SELECT code, title FROM tbl_validate_proof_dt WHERE proof_id = $proof_id AND year_proof = $year_proof AND status = 1 ORDER BY id ASC 
                                    LIMIT $start, $end");
        return $query->fetchAll();
    }
}

?>
