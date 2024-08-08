<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
// Use an autoloader!
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';
require 'libs/Convert.php';
// Library
require 'libs/Database.php';
require 'libs/Session.php';
require 'libs/config/paths.php';
require 'libs/config/database.php';

// QRcode
include('libs/phpqrcode/qrlib.php'); 
/**
* PHPExcel_IOFactory
*/
require_once 'libs/PHPExcel/PHPExcel/IOFactory.php';
include ("libs/PHPExcel/PHPEXCHelper.php");
/**
* PHPExcel
*/
include 'libs/Excel.php';
require_once 'libs/PHPExcel/PHPExcel.php';
// Mail
require 'libs/Mail/class.phpmailer.php';
require 'libs/Mail/class.smtp.php';
require 'libs/Mail.php';
$app = new Bootstrap();

?>
