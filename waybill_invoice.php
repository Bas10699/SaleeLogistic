<?php require_once('nevbar.php');
Nevbar(); ?>

<?php require_once('Connections/myconnect.php'); ?>

<?
if($_GET["checkIdList"])
{
$ids = join("','",$_GET["checkIdList"]);
mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill 
LEFT JOIN tb_customer 
ON tb_waybill.customer_id = tb_customer.cus_id 
LEFT JOIN tb_car
ON tb_waybill.car_id = tb_car.car_id
WHERE `wb_id` IN ('$ids')";

$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());


$query_carId = "SELECT * FROM tb_car";
$carId = mysql_query($query_carId, $myconnect) or die(mysql_error());

$query_staff = "SELECT * FROM tb_staff";
$staffId = mysql_query($query_staff, $myconnect) or die(mysql_error());


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" href="index.css">

</head>

<script>
function validateForm() {
  var x = document.forms["myForm"]["car_id"].value;
  var y = document.forms["myForm"]["staff_id"].value;
  if (x === "กรุณาเลือกทะเบียนรถ") {
    alert("กรุณาเลือกทะเบียนรถ");
    return false;
  }
  if(y === "กรุณาเลือกพนักงานขับรถ"){
    alert("กรุณาเลือกพนักงานขับรถ");
    return false;
  }
}
</script>

<body>
<table  width="100%" height="100" align="center">

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><h2 align="center">รายการส่งสินค้า</td>
    
  </tr>
  </table>
  <div align="center">
            
            <form name="myForm" action="waybill_insert_pdf.php" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">

              <select name="car_id" id="car_id">
              <option selected disabled hidden>กรุณาเลือกทะเบียนรถ</option>
              <?php while($row_carId = mysql_fetch_array($carId)) { ?>
                <option value="<?php echo $row_carId['car_id']; ?>"> <?php echo $row_carId['car_register']; ?> </option>
              <? } ?>
              </select>

              <select name="staff_id" id="staff_id">
              <option selected disabled hidden>กรุณาเลือกพนักงานขับรถ</option>
              <?php while($row_staffId = mysql_fetch_array($staffId)) { ?>
                <option value="<?php echo $row_staffId['staff_id']; ?>"><?php echo $row_staffId['staff_title_name']; ?><?php echo $row_staffId['staff_name']; ?> <?php echo $row_staffId['staff_lastname']; ?> </option>
              <? } ?>
              </select>

              <button type="submit" class="btnsh">แสดง</button>
              </div>
  <table id='customers' style="width: 80%" align="center">
                <tr >
                  <th ><div align="center">ลำดับ</div></th>
                  <!-- <th ><div align="center">รหัสใบรับ-ส่งสินค้า</div></th> -->
                  <th ><div align="center">วันที่</div></th>
                  <th ><div align="center">เลขที่ใบรับ-ส่งสินค้า</div></th>
                  <th ><div align="center">ชื่อบริษัท</div></th>
                  <th ><div align="center">อำเภอ</div></th>
                  <th ><div align="center">จำนวนเงินทั้งสิ้น</div></th>
                  <th ><div align="center">สถานะการชำระเงิน</div></th>
                  <!-- <th ><div align="center">จัดการ</div></th> -->
                  <th ><div align="center">หมายเหตุ</div></th>
                </tr>
                <tr>
                  <?php while($row_waybill = mysql_fetch_array($waybill)) { $i++?>
                    <td height="33"><div ><?php echo $i; ?></div></td>
                    <input type="hidden" name="listData[]" value="<?php echo $row_waybill["wb_id"]; ?>" />
                  <!-- <td height="33"><div ><?php echo $row_waybill["wb_id_set"]; ?></div></td> -->
                  <td><div ><?php echo $row_waybill['wb_date']; ?></td>
                  <td><div ><?php echo $row_waybill['wb_nbook']; ?></div></td>
                  <td><div ><?php echo $row_waybill['cus_compan']; ?></div></td>
                  <td><div ><?php echo $row_waybill['cus_area']; ?></div></td>
                  <td><div ><?php echo $row_waybill['wb_money']; ?></div></td>
                  <td><div ><?php echo $row_waybill['wb_payment']; ?></td>
           
                      <!-- <td ><div align="center">
                      <a class="buttondetail" href="waybill_detail.php?id=<?php echo $row_waybill['wb_id']; ?>" >รายละเอียด</a>
                      <a class="btndel" href="waybill_del.php?id=<?php echo $row_waybill['wb_id']; ?>?staff_id=<?php echo $row_waybill['waybill_id']; ?>"onclick="return confirm('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a>
                      </td> -->
                  <td></td>
                   
                  </tr>
                <? $sum +=$row_waybill['wb_money']; } ?>
                
                  <tr>
                  <td colspan="4">
                  <div align="center">จำนวนเงินทั้งหมด</div>
                  </td>
                  <td><?php echo $sum ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  </tr>
                  
              </table>
</form>
                    <br/>
              
              
  </body>
  </html>

<?
}
else{
  echo '<table  width="100%" height="100" align="center">

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><h2 align="center">ไม่ได้เลือกรายการ</td>
    
  </tr>
  </table>';
}

?>


