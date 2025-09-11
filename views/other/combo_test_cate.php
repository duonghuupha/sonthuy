<?php
function buildFlat(array $elements, $parentId = 0, $prefix = '') {
    $branch = array();
    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $branch[] = [
                "id" => $element['id'],
                "title" => $prefix . $element['title']
            ];
            $children = buildFlat($elements, $element['id'], $prefix . '|---');
            $branch = array_merge($branch, $children);
        }
    }
    return $branch;
}
$data = buildFlat($this->jsonObj);
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>