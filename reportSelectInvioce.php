<?php 
require_once('Connections/myconnect.php');

$id = $_POST['id'];
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
// echo $date_end;
mysql_select_db($database_myconnect, $myconnect);
$query_payment_date = "SELECT * FROM tb_waybill 
                        INNER JOIN tb_customer ON tb_customer.cus_id=tb_waybill.customer_id
                        INNER JOIN tb_inv_wb ON tb_inv_wb.tiw_wb_id = tb_waybill.wb_id
                        INNER JOIN tb_invoice ON tb_inv_wb.tiw_inv_id = tb_invoice.inv_id
                        INNER JOIN tb_car ON tb_car.car_id = tb_invoice.inv_car_id
                        INNER JOIN tb_staff ON tb_staff.staff_id = tb_invoice.inv_staff_id
                        WHERE `tiw_inv_id` =$id AND `tiw_payment_status`!='ยกเลิกรายการส่งสินค้า'";
$PaymentDateDetail = mysql_query($query_payment_date, $myconnect) or die(mysql_error());
$detail=mysql_fetch_assoc($PaymentDateDetail);
mysql_free_result($PaymentDateDetail);
$outp.= "<div class='row'>
            <div class='col-sm-1'></div>
            <div class='col-sm-5'>
                <div><b>ชื่อ-สกุล:</b> ".$detail['staff_name']." ".$detail['staff_lastname']."</div>
            </div>
            <div class='col-sm-5'>
                <div class='float-right'><b>ทะเบียนรถ:</b> ".$detail['car_register']." ".$detail['car_province']."</div>
            </div>
            <div class='col-sm-1'></div>
        </div><br/>";
mysql_select_db($database_myconnect, $myconnect);
$query_payment_date = "SELECT * FROM tb_waybill 
                        INNER JOIN tb_customer ON tb_customer.cus_id=tb_waybill.customer_id
                        INNER JOIN tb_inv_wb ON tb_inv_wb.tiw_wb_id = tb_waybill.wb_id
                        INNER JOIN tb_invoice ON tb_inv_wb.tiw_inv_id = tb_invoice.inv_id
                        INNER JOIN tb_car ON tb_car.car_id = tb_invoice.inv_car_id
                        INNER JOIN tb_staff ON tb_staff.staff_id = tb_invoice.inv_staff_id
                        WHERE `tiw_inv_id` =$id AND `tiw_payment_status`!='ยกเลิกรายการส่งสินค้า'";
$PaymentDateDetail = mysql_query($query_payment_date, $myconnect) or die(mysql_error());
$outp.= "<div class='table-responsive'>
<table class='table'><tr><th>เลขที่ส่งสินค้า</th><th>รหัสใบรับสินค้า</th><th>ชื่อบริษัท</th><th>จำนวนเงินที่ได้รับ</th><th>สถานะ</th></tr>";
while($row=mysql_fetch_array($PaymentDateDetail)){
    $outp.="<tr><td>".$row['tiw_id']."</td><td>".$row['wb_nber']."</td><td>".$row['cus_compan']."</td><td>".$row['tiw_money']." บาท</td><td>".$row['tiw_payment_status']."</td></tr>";
}
$outp.= "</table></div>";
mysql_free_result($PaymentDateDetail);
echo $outp;
?>