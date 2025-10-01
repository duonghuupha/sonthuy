<?php
$item = $this->question; $target = $this->target; $answer = $this->answer;
if($item[0]['type'] == 'lesson'){
    $url = URL.'/public/lesson/'.$item[0]['lesson_id'].'/question';
}elseif($item[0]['type'] == 'vocab'){
    $url = URL.'/public/vocab/'.$item[0]['code'].'/question';
}else{
    $url = URL.'/public/test/'.$item[0]['code'].'/question';
}
foreach($target as $row_t){
    $array_target[] = '{"text": "'.$row_t['title'].'", "accept": "'.$row_t['id_temp'].'", "file": "'.$row_t['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'", "url_file": "'.$url.'"}';
}
foreach($answer as $row_a){
    $array_answer[] = '{"text": "'.$row_a['title'].'", "image": "'.$row_a['file'].'", "match": "'.$row_a['target_id'].'", "lesson_id": "'.$item[0]['lesson_id'].'", "url_file": "'.$url.'"}';
}
echo '{
    "question": "'.$item[0]['title'].'", "file": "'.$item[0]['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'", "url_file": "'.$url.'",
    "targets": ['.implode(",", $array_target).'],
    "options": ['.implode(",", $array_answer).']';
echo '}';
?>