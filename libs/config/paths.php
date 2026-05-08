<?php
define('URL', 'http://'.$_SERVER['HTTP_HOST']);
define('URL_SIGNATURE', 'https://mncukhoi.quanly.edu.vn/public/signature_food_class');
$dirtionary = dirname(realpath($_SERVER['DOCUMENT_ROOT']));
define('DIR_SIGNATURE', $dirtionary.'/cukhoi/public/signature_food_class');
?>
