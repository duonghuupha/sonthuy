<?php
$item = $this->question; $detail = $this->detail;
$html = '{';
    // noi dung cau hoi
    $html .= '"questionText": "'.$item[0]['title'].'", "file_question": "'.$item[0]['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'",';
    foreach($detail as $row){
        $quest[] = '{"id": '.$row['id'].', "content": "'.$row['answer_a'].'", "file_a": "'.$row['file_a'].'", "lesson_id": "'.$item[0]['lesson_id'].'"}';
        $answ[] = '{"id": '.$row['id'].', "content": "'.$row['answer_b'].'", "file_b": "'.$row['file_b'].'", "lesson_id": "'.$item[0]['lesson_id'].'"}';
        $corr[] = '{"left": '.$row['id'].', "right": '.$row['id'].'}';
    }
    $html .= '"questions": ['.implode(",", $quest).'],';
    $html .= '"answers": ['.implode(",", $answ).'],';
    $html .= '"correct": ['.implode(",", $corr).']';
$html .= '}';
echo $html;
?>