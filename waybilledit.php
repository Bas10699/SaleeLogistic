<?php require_once('upload.php'); ?>
<?php
ob_start();
require_once('Connections/myconnect.php');
  $wb_id = $_POST["wb_id"];
  $wb_id_set = $_POST["wb_id_set"];
  $wb_nber = $_POST["wb_nber"];
  $wb_nbook = $_POST["wb_nbook"];
  $cus_compan = $_POST["cus_compan"];
  $wb_date = $_POST["wb_date"];
  $wb_money = $_POST["wb_money"];
  $wb_img = $_FILES['wb_img'];
  // print_r($wb_img);
if(!$wb_img['name']){

  $sql = "UPDATE tb_waybill SET 
  wb_nber = '$wb_nber', 
  wb_nbook = '$wb_nbook', 
  customer_id = '$cus_compan',
  wb_date = '$wb_date',
  wb_money = '$wb_money'
WHERE wb_id = $wb_id";

mysql_select_db($database_myconnect, $myconnect);
mysql_query($sql, $myconnect) or die(mysql_error());
header("Location: waybill_detail.php?id=$wb_id");
}
else{

  // echo $wb_img;
  $id_SET = $wb_id_set;
  $path="./picture/";
  $last = strtolower(end(explode('.',$_FILES['wb_img']['name'])));
	$name = $id_SET.'.'.$last;
  Upload($_FILES['wb_img'],$path.$name);

  $sql = "UPDATE tb_waybill SET 
            wb_nber = '$wb_nber', 
            wb_nbook = '$wb_nbook', 
            customer_id = '$cus_compan',
            wb_date = '$wb_date',
            wb_money = '$wb_money',
            wb_img = '$name'
          WHERE wb_id = $wb_id";
mysql_select_db($database_myconnect, $myconnect);
mysql_query($sql, $myconnect) or die(mysql_error());

header("Location: waybill_detail.php?id=$wb_id");
  
}
  

  

/*
  echo $_POST["wb_id_set"];
  echo $_POST["wb_nber"];
  echo $_POST["wb_nbook"];
  echo $_POST["cus_compan"];
  echo $_POST["wb_date"];
  echo $_POST["wb_money"];
  echo $_POST["wb_payment"];*/

?>