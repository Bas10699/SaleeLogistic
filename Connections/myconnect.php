<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_myconnect = "localhost";
$database_myconnect = "saleelogistic";
$username_myconnect = "root";
$password_myconnect = "12345678";
date_default_timezone_set('Asia/Bangkok');

//  $hostname_myconnect = "142.4.201.250";
//  $database_myconnect = "saleelogistic";
//  $username_myconnect = "skimp";
//  $password_myconnect = "12345678";

$myconnect = mysql_pconnect($hostname_myconnect, $username_myconnect, $password_myconnect) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8"); //Extension By DwThai.Com
?>