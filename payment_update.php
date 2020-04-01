<?php 
require_once('Connections/myconnect.php');
$id = $_POST['id'];
$money = $_POST['money'];
$wb_money = $_POST['wb_money'];
$tiw_money = $_POST['tiw_money'];
$sum = $money+$tiw_money;
// echo $sum;
mysql_select_db($database_myconnect, $myconnect);
if(($wb_money-$sum)<=0){

    $payUpdate = "UPDATE tb_inv_wb SET tiw_money=$sum, tiw_payment_status='ชำระเงินแล้ว' WHERE tiw_id=$id";
}
else{
    
    $payUpdate = "UPDATE tb_inv_wb SET tiw_money=$sum WHERE tiw_id=$id";
    
}
mysql_query($payUpdate,$myconnect) or die(mysql_error());
header('Location: payment.php?id='.$id);
?>