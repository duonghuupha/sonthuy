<?php
function show_parent_test_cate($categories, $parent_id = 0, $char = ''){
    foreach ($categories as $key => $item){
        if ($item['parent_id'] == $parent_id){
            echo '{';
                echo '"title": "'.$char.$item['title'].'", "id": "'.$item['id'].'"';
            echo '}';
            unset($categories[$key]);
            show_parent_test_cate($categories, $item['id'], $char.'|---');
        }
    }
}
echo '[';
show_parent_test_cate($this->jsonObj);
echo ']';
?>