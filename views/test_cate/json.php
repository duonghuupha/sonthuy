<?php
/*
// Hàm đệ quy tính level
function getLevel($parentId, $level = 0) {
    $sql = new Model();
    if ($parentId === null) {
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
$query = $sql->db->query("SELECT code, id, title, parent_id, content, status, (SELECT tbl_test_cate.title FROM tbl_test_cate 
                        WHERE tbl_test_cate.id = tbl_test_cate.parent_id) AS parent_title FROM tbl_test_cate ORDER BY id ASC");
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
        "parent_title" => $row['parent_title'],
        "parent" => $row['parent_id'] ? strval($row['parent_id']) : null,
        "isLeaf" => $haschild ? false : true,
        "expanded" => true
    ];
}

echo json_encode(["rows" => $rows], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);*/
?>
{
  "rows": [
    { "id": "1", "name": "Thư mục A", "level": "0", "parent": null, "isLeaf": false, "expanded": true },
    { "id": "2", "name": "Tệp A1", "level": "1", "parent": "1", "isLeaf": true, "expanded": true },
    { "id": "3", "name": "Tệp A2", "level": "1", "parent": "1", "isLeaf": true, "expanded": true },
    { "id": "4", "name": "Thư mục B", "level": "0", "parent": null, "isLeaf": false, "expanded": true },
    { "id": "5", "name": "Tệp B1", "level": "1", "parent": "4", "isLeaf": true, "expanded": true }
  ]
}
