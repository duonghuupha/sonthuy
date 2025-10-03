<?php
$item = $this->jsonObj;
if($item[0]['type'] == 'lesson'){
    $url = URL.'/public/lesson/'.$item[0]['lesson_id'].'/question';
}elseif($item[0]['type'] == 'vocab'){
    $url = URL.'/public/vocab/'.$item[0]['code'].'/question';
}else{
    $url = URL.'/public/test/'.$item[0]['code'].'/question';
}
echo '{
    "instruction": "'.$item[0]['title'].'",
    "word": "'.$item[0]['answer'].'",
    "file": "'.$item[0]['file'].'",
    "url_file": "'.$url.'"
}'
?>