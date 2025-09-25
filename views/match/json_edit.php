<?php
if(count($this->jsonObj) != 0){
    $html = "[";
    foreach($this->jsonObj as $row){
        $array[] = '{"id": "'.$row['id'].'", "answer_a": "'.$row['answer_a'].'", "file_a": "'.$row['file_a'].'", "answer_b": "'.$row['answer_b'].'", "file_b": "'.$row['file_b'].'",
                        "file_a_old": "'.$row['file_a'].'", "file_b_old": "'.$row['file_b'].'"}';
    }
    $html .= implode(",", $array);
    echo $html."]";
}
?>