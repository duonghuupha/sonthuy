<?php
$path = DIR_BASIC.'/controllers';
$files = array_diff(scandir($path), array(".", ".."));
$html = '[';
$array[] = '{"id": "#", "title": "#"}';
foreach($files as $row){
    $link = explode(".", $row);
    $array[] = '{"id": "'.$link[0].'", "title": "'.$link[0].'"}';
    //echo "<option value='".$link[0]."'>".$link[0]."</option>";
}
$html .= implode(", ", $array).']';
echo $html;
?>