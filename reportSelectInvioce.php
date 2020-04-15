<?php 
require_once('Connections/myconnect.php');

$id = $_POST['id'];

mysql_select_db($database_myconnect, $myconnect);
$query_payment_date = "SELECT * FROM tb_waybill 
                        INNER JOIN tb_inv_wb ON tb_inv_wb.tiw_wb_id = tb_waybill.wb_id
                        WHERE `wb_id` IN ($id)";
$PaymentDateDetail = mysql_query($query_payment_date, $myconnect) or die(mysql_error());
$outp.= "<div class='table-responsive'>
<table class='table'><tr><th>เลขที่</th><th>จำนวนเงิน</th><th>สถานะ</th></tr>";
while($row=mysql_fetch_array($PaymentDateDetail)){
    $outp.="<tr><td>".$row['tiw_id']."</td><td>".$row['tiw_money']."</td><td>".$row['tiw_payment_status']."</td></tr>";
}
$outp.= "</table></div>";
echo $outp;
?>