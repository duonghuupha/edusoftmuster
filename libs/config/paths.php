<?php
define('URL', 'http://'.$_SERVER['HTTP_HOST']);
define('URL_SIGNATURE', 'http://edusoft:81/public/signature_food_class');
$dirtionary = dirname(realpath($_SERVER['DOCUMENT_ROOT']));
define('DIR_SIGNATURE', $dirtionary.'/edusoft/public/signature_food_class');
?>
