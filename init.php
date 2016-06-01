<?php
//set http characterset
header("Content-type: text/html; charset=utf-8");

//load configuration file
require("config.php");

//set timezone
date_default_timezone_set($timezone);

require("functions.php");

//set session cookie parameters


//traditional sessions - begin session
session_start();

//load session variables if set
if(isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
}

//define mysql connection object
$con = mysqli_connect($dbhost, $dbuser, $dbpass);

//select database and set character set
mysqli_select_db($con, $database) or die ("mysql couldn't select the database for you"." ".mysqli_error());
mysqli_query($con, "SET NAMES utf8 COLLATE 'utf8_unicode_ci'");

//import facebook sdk
require_once __DIR__ . '/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';

?>
