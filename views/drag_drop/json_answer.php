<?php
if(count($this->jsonObj) != 0){
    $html = "[";
    foreach($this->jsonObj as $row){
        $array[] = '{"id": "'.$row['id'].'", "title": "'.$row['title'].'", "file": "'.$row['file'].'",
                        "file_old": "'.$row['file'].'", "target_id": "'.$row['target_id'].'"}';
    }
    $html .= implode(",", $array);
    echo $html."]";
}
?>