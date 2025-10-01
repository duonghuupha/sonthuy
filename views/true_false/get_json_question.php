<?php
$item = $this->jsonObj;
if($item[0]['type'] == 'lesson'){
    $url = URL.'/public/lesson/'.$item[0]['lesson_id'].'/question';
}elseif($item[0]['type'] == 'vocab'){
    $url = URL.'/public/vocab/'.$item[0]['code'].'/question';
}else{
    $url = URL.'/public/test/'.$item[0]['code'].'/question';
}
$answer = ($item[0]['answer'] == 1) ? 'true' : 'false';
$html = '[{"type": "text", "question": "'.$item[0]['title'].'", "answer": '.$answer.', "file": "'.$item[0]['file'].'", 
            "lesson_id": "'.$item[0]['lesson_id'].'", "url_file": "'.$url.'"}]';
echo $html;
?>