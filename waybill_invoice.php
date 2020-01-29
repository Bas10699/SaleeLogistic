<?php require_once('nevbar.php');
Nevbar(); ?>

<?php require_once('Connections/myconnect.php'); ?>

<?
if($_POST["checkIdList"])
{
$ids = join("','",$_POST["checkIdList"]);
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
<body>
<table  width="100%" height="100" align="center">

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><h2 align="center">รายการส่งสินค้า</td>
    
  </tr>
  </table>
  <table id='customers' style="width: 80%" align="center">
                <tr >
                  <th ><div align="center">ลำดับ</div></th>
                  <!-- <th ><div align="center">รหัสใบรับ-ส่งสินค้า</div></th> -->
                  <th ><div align="center">วันที่</div></th>
                  <th ><div align="center">เลขที่ใบรับ-ส่งสินค้า</div></th>
                  <th ><div align="center">ชื่อบริษัท</div></th>
                  <th ><div align="center">จำนวนเงินทั้งสิ้น</div></th>
                  <th ><div align="center">สถานะการชำระเงิน</div></th>
                  <!-- <th ><div align="center">จัดการ</div></th> -->
                  <th ><div align="center">หมายเหตุ</div></th>
                </tr>
                <tr>
                  <?php while($row_waybill = mysql_fetch_array($waybill)) { $i++?>
                    <td height="33"><div ><?php echo $i; ?></div></td>
                  <!-- <td height="33"><div ><?php echo $row_waybill["wb_id_set"]; ?></div></td> -->
                  <td><div ><?php echo $row_waybill['wb_date']; ?></td>
                  <td><div ><?php echo $row_waybill['wb_nbook']; ?></div></td>
                  <td><div ><?php echo $row_waybill['cus_compan']; ?></div></td>
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
                  </tr>
              </table>\

                    <br/>
              <div align="center">
              <select name="cus_area" id="cus_area">
                  <option selected disabled hidden>กรุณาเลือกอำเภอ</option>
                  <option value="อำเภอเมือง"> อำเภอเมือง </option>
                  <option value="อำเภอบางระกำ">อำเภอบางระกำ</option>
                  <option value="อำเภอบางกระทุ่ม">อำเภอบางกระทุ่ม </option>
                  <option value="อำเภอนครไทย">อำเภอนครไทย </option>
                  <option value="อำเภอชาติตระการ">อำเภอชาติตระการ </option>
                  <option value="อำเภอพรหมพิราม">อำเภอพรหมพิราม </option>
                  <option value="อำเภอวังทอง">อำเภอวังทอง</option>
                  <option value="อำเภอเนินมะปราง">อำเภอเนินมะปราง</option>
                  <option value="อำเภอวัดโบสถ์">อำเภอวัดโบสถ์ </option>
              </div>
              </select>
              
              <select name="car_id" id="car_id">
              <option selected disabled hidden>กรุณาเลือกทะเบียนรถ</option>
              <?php while($row_carId = mysql_fetch_array($carId)) { ?>
                <option value="<?php echo $row_carId['car_id']; ?>"> <?php echo $row_carId['car_register']; ?> </option>
              <? } ?>
              </select>

              <select name="tb_staff" id="car_id">
              <option selected disabled hidden>กรุณาเลือกพนักงานขับรถ</option>
              <?php while($row_staffId = mysql_fetch_array($staffId)) { ?>
                <option value="<?php echo $row_carId['staff_id']; ?>"> <?php echo $row_staffId['staff_title_name']; ?><?php echo $row_staffId['staff_name']; ?> <?php echo $row_staffId['staff_lastname']; ?> </option>
              <? } ?>
              </select>

              <button class="btnsh">แสดง</button>
              
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


