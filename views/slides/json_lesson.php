<?php
foreach($this->jsonObj as $row_lesson){
    echo '
    <div class="lesson-item" onclick="load_lesson('.$row_lesson['id'].')" title="'.$row_lesson['title'].'">
        <i class="fa-solid fa-book-open"></i> '.$row_lesson['title'].'
    </div>
    ';
}
?>