<?php
// Hàm đệ quy tính level
function getLevel($parentId, $level = 0) {
    $sql = new Model();
    if ($parentId === null) {
        return $level; // root node
    }
    $res = $sql->db->query("SELECT parent_id FROM tbl_test_cate WHERE id=" . intval($parentId));
    if ($res && $row = $res->fetchAll(PDO::FETCH_ASSOC)) {
        return getLevel($row['parent_id'], $level + 1);
    }
    return $level;
}
$sql = new Model();
$query = $sql->db->query("SELECT id, title, parent_id FROM tbl_test_cate ORDER BY id ASC");
$rows = [];
while($row = $query->fetchAll(PDO::FETCH_ASSOC)) {
    // tinh level bang de quy
    $level = getLevel($row['parent_id'], 0);
    // Kiem tra node co con hay khong
    $checkchild = $sql->db->query("SELECT COUNT(*) AS Total FROM tbl_test_cate WHERE parent_id=" . intval($row['id']));
    $hasChild = $checkchild->fetchAll(PDO::FETCH_ASSOC)['Total'] > 0;

    $rows[] = [
        "id" => $row['id'],
        "title" => $row['title'],
        "level" => strval($level),
        "parent" => $row['parent_id'] ? strval($row['parent_id']) : null,
        "isLeaf" => $hasChild ? false : true,
        "expanded" => false
    ];
}
echo json_encode(["rows" => $rows], JSON_UNESCAPED_UNICODE);;
?>