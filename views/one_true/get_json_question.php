<?php
$item = $this->jsonObj;
$html = '[{"question": "'.$item[0]['title'].'", "file": "'.$item[0]['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'",';
    foreach($this->detail as $row){
        $array[] = '"'.$row['title'].'"';
        $answer[] = $row['answer'];
    }

$html .= '"options": ['.implode(",", $array).'], "answer": '.array_search(1, $answer).'}]';
echo $html;
?>