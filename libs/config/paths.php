<?php
define('URL', 'http://'.$_SERVER['HTTP_HOST']);
define('URL_FILE', 'http://'.$_SERVER['HTTP_HOST'].'/public');
$dirtionary = realpath($_SERVER['DOCUMENT_ROOT']);
define('DIR_UPLOAD', $dirtionary.'/public');
define('DIR_BASIC', $dirtionary);
?>
