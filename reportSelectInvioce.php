<?php 
require_once('Connections/myconnect.php');

$id = $_POST['id'];
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
// echo $date_end;
mysql_select_db($database_myconnect, $myconnect);
$query_payment_date = "SELECT * FROM tb_waybill 
                        INNER JOIN tb_inv_wb ON tb_inv_wb.tiw_wb_id = tb_waybill.wb_id
                        INNER JOIN tb_invoice ON tb_inv_wb.tiw_inv_id = tb_invoice.inv_id
                        WHERE `tiw_inv_id` =$id AND (`tiw_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')";
$PaymentDateDetail = mysql_query($query_payment_date, $myconnect) or die(mysql_error());
$outp.= "<div class='table-responsive'>
<table class='table'><tr><th>เลขที่</th><th>รหัสใบรับสินค้า</th><th>จำนวนเงินที่ได้รับ</th><th>สถานะ</th></tr>";
while($row=mysql_fetch_array($PaymentDateDetail)){
    $outp.="<tr><td>".$row['tiw_id']."</td><td>".$row['wb_nber']."</td><td>".$row['tiw_money']."</td><td>".$row['tiw_payment_status']."</td></tr>";
}
$outp.= "</table></div>";
echo $outp;
?>