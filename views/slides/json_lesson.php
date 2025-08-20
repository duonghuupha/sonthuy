<?php
foreach($this->jsonObj as $row_lesson){
    echo '
    <li><a href="javascript:void(0)" onclick="load_lesson('.$row_lesson['id'].')" title="'.$row_lesson['title'].'"><i class="fa fa-cubes"></i>'.$row_lesson['title'].'</a></li>
    ';
}
?>