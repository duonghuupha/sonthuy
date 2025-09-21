<?php
$item = $this->question; $target = $this->target; $answer = $this->answer;
foreach($target as $row_t){
    $array_target[] = '{"text": "'.$row_t['title'].'", "accept": "'.$row_t['id'].'", "file": "'.$row_t['file'].'"}';
}
foreach($answer as $row_a){
    $array_answer[] = '{"text": "'.$row_a['title'].'", "image": "'.$row_a['file'].'", "match": "'.$row_a['target_id'].'"}';
}
echo '{
    "question": "'.$item[0]['title'].'", "file": "'.$item[0]['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'",
    "targets": ['.implode(",", $array_target).'],
    "options": ['.implode(",", $array_answer).']';
echo '}';
?>