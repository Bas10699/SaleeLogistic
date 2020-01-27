<?php
require_once('upload.php');
require_once('Connections/myconnect.php');

$wb_id_set = $_POST["wb_id_set"];
$wb_nber = $_POST["wb_nber"];
$wb_nbook = $_POST["wb_nbook"];
$cus_compan = $_POST["cus_compan"];
$wb_date = $_POST["wb_date"];
$wb_money = $_POST["wb_money"];
$wb_payment = $_POST["wb_payment"];
$wb_img = $_POST["wb_id_set"];

$path="./picture/";
$last = strtolower(end(explode('.',$_FILES['wb_img']['name'])));
$name = $wb_id_set.'.'.$last;

$sql = "UPDATE tb_waybill SET 
wb_nber = '$wb_nber', 
wb_nbook = '$wb_nbook', 
customer_id = '$cus_compan',
wb_date = '$wb_date',
wb_money = '$wb_money',
wb_img = '$name',
wb_payment = '$wb_payment' 
WHERE wb_id_set = '$wb_id_set'";

mysql_select_db($database_myconnect, $myconnect);
$Result1 = mysql_query($sql, $myconnect) or die(mysql_error());


Upload($_FILES['wb_img'],$path.$name);
echo $wb_id_set."Copy/Upload Complete<br>";

?>