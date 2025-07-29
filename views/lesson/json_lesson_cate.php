<?php
function buildTree($elements, $parentId = 0) {
    $branch = [];
    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildTree($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }
    return $branch;
}
$tree = buildTree($this->jsonObj);
echo json_encode($tree);
?>