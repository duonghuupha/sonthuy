<?php
//$jsonObj['msg'] = base64_decode($_REQUEST['data']);
$data = json_decode(base64_decode($_REQUEST['data']), true); $type = $_REQUEST['type'];
if($type == 'lesson'){
    $dir_temp = DIR_UPLOAD.'/lesson/temp';
}elseif($type == 'vocab'){
    $dir_temp = DIR_UPLOAD.'/vocab/temp';
}else{
    $dir_temp = DIR_UPLOAD.'/test/temp';
}
foreach($data as $row){
    @unlink($dir_temp.'/'.$row['file_a']);
    @unlink($dir_temp.'/'.$row['file_b']);
}
$jsonObj['success'] = true;
echo json_encode($jsonObj);
?>