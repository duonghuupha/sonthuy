<?php
function getAllParents($childId){
    $sql = new Model();
    $parents = [];
    while ($childId !== null){
        $query = $sql->db->query("SELECT id, title, parent_id FROM tbl_lesson_cate WHERE id = $childId");
        $menu = $query->fetch(PDO::FETCH_ASSOC);
        if($menu){
            $parents[] = $menu;
            $childId = $menu['parent_id'];
        }else{
            break;
        }
    }
    return $parents;
}

$parents = getAllParents($_REQUEST['id']); $parents = array_reverse($parents);
foreach($parents as $row){
    $array_title[] = $row['title'];
}
echo implode("->", $array_title);
?>