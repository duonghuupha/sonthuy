<?php
// Hàm đệ quy tính level
function getLevel($parentId, $level = 0) {
    $sql = new Model();
    if ($parentId == 0) {
        return $level; // root node
    }
    $query = $sql->db->query("SELECT parent_id FROM tbl_test_cate WHERE id = $parentId");
    $row = $query->fetch(PDO::FETCH_ASSOC); 
    if ($row && $row['parent_id'] !== null){
        return getLevel($row['parent_id'], $level + 1);
    }
    return $level + 1;
}

$sql = new Model();
$query = $sql->db->query("SELECT code, id, title, parent_id, content, status FROM tbl_test_cate ORDER BY id ASC");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$rows = [];
foreach($result as $row){
    // Tính level cho mỗi mục
    $level = getLevel($row['parent_id'], 0);
    // kiem tra co con khong
    $query = $sql->db->query("SELECT COUNT(*) as count FROM tbl_test_cate WHERE parent_id = ".$row['id']);
    $haschild = $query->fetchColumn() > 0;

    $rows[] = [
        "code" => $row['code'],
        "id" => $row['id'],
        "title" => $row['title'],
        "content" => $row['content'],
        "level" => strval($level),
        "status" => $row['status'],
        "parent_title" => $sql->get_parent_title($row['parent_id']),
        "parent" => $row['parent_id'] ? strval($row['parent_id']) : null,
        "isLeaf" => $haschild ? false : true,
        "expanded" => true
    ];
}

echo json_encode(["rows" => $rows], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>