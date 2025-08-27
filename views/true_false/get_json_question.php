<?php
$item = $this->jsonObj;
$answer = ($item[0]['answer'] == 1) ? 'true' : 'false';
$html = '[{"type": "text", "question": "'.$item[0]['title'].'", "answer": '.$answer.', "file": "'.$item[0]['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'"}]';
echo $html;
?>