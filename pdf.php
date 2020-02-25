<?php require_once('nevbar.php');
Nevbar(); ?>
<?php
// Require composer autoload
require_once('vendor/autoload.php');
require_once('Connections/myconnect.php');
ob_start(); // Start get HTML code

$id = $_GET["id"];
mysql_select_db($database_myconnect, $myconnect);
      $query_data = "SELECT * FROM tb_invoice  WHERE inv_id=$id";
      $data = mysql_query($query_data, $myconnect) or die(mysql_error());

?>

<!DOCTYPE html>
<html>
<head>
<title>PDF</title>
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">

<style>
body {
    font-family: "Garuda";
    font-size: 11pt;
    
}
table {
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #000000;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
hr.new4 {
  border: 1px solid #000000;
  background-color: #000000;
  width: 80%;
}
</style>

</head>
<body>
<div margin-right=10%; margin-left=10%;>
<p style="text-align:center">ห้างหุ้นส่วนจำจัด โชคดีสาลี่ขนส่ง</p>
<p style="text-align:center">113 หมู่1 ตำบลพลายชุมพล อำเภอเมือง จังหวัดพิษณุโลก 65000</p>
<p style="text-align:center">เลขประจำตัวผู้เสียภาษี  0653557001657</p>
<hr class="new6"> <br>
<h3 style="text-align:center">รายการส่งสินค้า</h3>
<h3 style="text-align:right">เลขที่ No.</h3>
<table>
  <tr >
    <th style="text-align:center">ลำดับ</th>
    <th style="text-align:center">รหัสใบรับสินค้า</th></th>
    <th style="text-align:center">วันที่</th>
    <th style="text-align:center">ชื่อบริษัท</th>
    <th style="text-align:center">เลขที่ใบรับสินค้า</th>
    <th style="text-align:center">จำนวนเงิน</th>
    <th style="text-align:center">หมายเหตุ</th>
  </tr>
  
  <?php while($row_data = mysql_fetch_array($data)) { 
    $car_id = $row_data['inv_car_id'];
    $staff_id = $row_data['inv_staff_id'];

    $inv_detail = $row_data['inv_detail'];
    $query_data_inv = "SELECT * FROM tb_waybill 
    LEFT JOIN tb_customer 
    ON tb_waybill.customer_id = tb_customer.cus_id 
    LEFT JOIN tb_car
    ON tb_waybill.car_id = tb_car.car_id
    WHERE `wb_id` IN ($inv_detail)";
    $data_inv = mysql_query($query_data_inv, $myconnect) or die(mysql_error());

    while($row_data_inv = mysql_fetch_array($data_inv)) { 
        $i++;
    ?>
  <tr>
  
    <td style="text-align:center"><?php echo $i; ?></td>
    <td style="text-align:center"><?php echo $row_data_inv['wb_id_set']; ?></td>
    <td style="text-align:center"><?php $date=date_create($row_data_inv['wb_date']); echo date_format($date,"d/m/Y"); ?></td>
    <td><?php echo $row_data_inv['cus_compan']; ?></td>
    <td><?php echo $row_data_inv['wb_nbook']; ?></td>
    <td style="text-align:center"><?php echo $row_data_inv['wb_money']; ?></td>
    <td></td>
  </tr>
  </tr>
  <? $sum +=$row_data_inv['wb_money']; } ?>
                  <tr>
                  <td colspan="5">
                  <div align="center"><b>รวมเงินทั้งหมด</b></div>
                  </td>
                  <td style="text-align:center"><b><font size="3"><?php echo $sum ?></font></b></td>
                  <td></td>
                  </tr>
  <?php } ?>
</table>

<?php
  $query_carId = "SELECT * FROM tb_car WHERE car_id=$car_id";
  $carId = mysql_query($query_carId, $myconnect) or die(mysql_error());
  while($row_carId = mysql_fetch_array($carId)) { 
  ?>
  <h5 style="margin-right:80px; text-align:right;">ทะเบียนรถ: <?php echo $row_carId['car_register']; ?></h5>
<?php } ?>
<?php
  $query_staff = "SELECT * FROM tb_staff WHERE staff_id=$staff_id";
  $staffId = mysql_query($query_staff, $myconnect) or die(mysql_error());
  
  while($row_staffId = mysql_fetch_array($staffId)) { 
  ?>
  <h5 style="margin-right:80px; text-align:right;"> <?php echo $row_staffId['staff_title_name']; ?><?php echo $row_staffId['staff_name']; ?> <?php echo $row_staffId['staff_lastname']; ?></h5>
<?php } ?>
</div>
</body>
</html>

<?php
$html = ob_get_contents(); // ทำการเก็บค่า HTML จากคำสั่ง ob_start()
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html); // ทำการสร้าง PDF ไฟล์
$mpdf->Output("MyPDF.pdf"); // ให้ทำการบันทึกโค้ด HTML เป็น PDF โดยบันทึกเป็นไฟล์ชื่อ MyPDF.pdf
ob_end_flush();
// header("Location: MyPDF.pdf");
?>

<div style="margin-left:20px;">
ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF.pdf">คลิกที่นี้</a> <a href="MyPDF.pdf" download>Download</a>
</div>