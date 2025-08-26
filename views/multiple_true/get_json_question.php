<?php
$item = $this->jsonObj;
$html = '[{"question": "'.$item[0]['title'].'", "file": "'.$item[0]['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'",';
    foreach($this->detail as $row){
        $array[] = '{"title": "'.$row['title'].'", "file_detail": "'.$row['file'].'"}';
        $answer[] = $row['answer'];
    }

$html .= '"options": ['.implode(",", $array).'], "answers": ['.implode(",", array_keys($answer, 1)).']}]';
echo $html;
?>