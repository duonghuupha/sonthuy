<?php
$item = $this->question; $detail = $this->detail;
if($item[0]['type'] == 'lesson'){
    $url = URL.'/public/lesson/'.$item[0]['lesson_id'].'/question';
}elseif($item[0]['type'] == 'vocab'){
    $url = URL.'/public/vocab/'.$item[0]['code'].'/question';
}else{
    $url = URL.'/public/test/'.$item[0]['code'].'/question';
}
$html = '{';
    // noi dung cau hoi
    $html .= '"questionText": "'.$item[0]['title'].'", "file_question": "'.$item[0]['file'].'", "lesson_id": "'.$item[0]['lesson_id'].'", "url_file": "'.$url.'",';
    foreach($detail as $row){
        $quest[] = '{"id": '.$row['id'].', "content": "'.$row['answer_a'].'", "file_a": "'.$row['file_a'].'", "lesson_id": "'.$item[0]['lesson_id'].'", "url_file": "'.$url.'"}';
        $answ[] = '{"id": '.$row['id'].', "content": "'.$row['answer_b'].'", "file_b": "'.$row['file_b'].'", "lesson_id": "'.$item[0]['lesson_id'].'", "url_file": "'.$url.'"}';
        $corr[] = '{"left": '.$row['id'].', "right": '.$row['id'].'}';
    }
    $html .= '"questions": ['.implode(",", $quest).'],';
    $html .= '"answers": ['.implode(",", $answ).'],';
    $html .= '"correct": ['.implode(",", $corr).']';
$html .= '}';
echo $html;
?>