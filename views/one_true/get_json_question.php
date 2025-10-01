<?php
$item = $this->jsonObj;
if($item[0]['type'] == 'lesson'){
    $url = URL.'/public/lesson/'.$item[0]['lesson_id'].'/question';
}elseif($item[0]['type'] == 'vocab'){
    $url = URL.'/public/vocab/'.$item[0]['code'].'/question';
}else{
    $url = URL.'/public/test/'.$item[0]['code'].'/question';
}
$html = '[{"question": "'.$item[0]['title'].'", "file": "'.$item[0]['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'",
            "url_file": "'.$url.'",';
    foreach($this->detail as $row){
        $array[] = '{"title": "'.$row['title'].'", "file_detail": "'.$row['file'].'"}';
        $answer[] = $row['answer'];
    }

$html .= '"options": ['.implode(",", $array).'], "answer": '.array_search(1, $answer).'}]';
echo $html;
?>