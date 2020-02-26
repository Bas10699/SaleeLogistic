<?php require_once('nevbar.php');
Nevbar(); ?>

<?php require_once('Connections/myconnect.php'); ?>

<?php

mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill 
LEFT JOIN tb_customer 
ON tb_waybill.customer_id = tb_customer.cus_id 
LEFT JOIN tb_car
ON tb_waybill.car_id = tb_car.car_id
WHERE (tb_customer.cus_sub LIKE '%".$_GET["txtKeyword"]."%' or tb_customer.cus_area LIKE '%".$_GET["txtKeyword"]."%' or wb_payment LIKE '%".$_GET["txtKeyword"]."%' )
ORDER BY wb_id";
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>รายงานสรุปยอด</title>
<link rel="stylesheet" href="index.css">

</head>

<body>
<table  width="100%" height="477" align="center">
<tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2"> <h2 align="center">รายงานสรุปยอด</h2></td>
    <tr>
</table>
</body>
</html>
<?php
mysql_free_result($waybill);
?>
