<?php require_once('nevbar.php');
Nevbar(); ?>

<?php require_once('Connections/myconnect.php'); ?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

// if($_GET["txtKeyword"] != ""){
// 	// $objConnect = mysql_connect("localhost","root","12345678") or die("Error Connect to Database");
// 	$objDB = mysql_select_db($database_myconnect, $myconnect);
// 	// Search By Name or Email
// 	$strSQL = "SELECT * FROM tb_waybill
//   LEFT JOIN tb_customer 
//   ON tb_waybill.customer_id = tb_customer.cus_id
//   LEFT JOIN tb_car
//   ON tb_waybill.car_id = tb_car.car_id
//   WHERE (tb_customer.cus_sub LIKE '%".$_GET["txtKeyword"]."%' or tb_customer.cus_area LIKE '%".$_GET["txtKeyword"]."%' )";
//   $waybill = mysql_query($strSQL, $myconnect) or die(mysql_error());
//   $row_waybill = mysql_fetch_assoc($waybill);
// }
  

mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill 
LEFT JOIN tb_customer 
ON tb_waybill.customer_id = tb_customer.cus_id 
LEFT JOIN tb_car
ON tb_waybill.car_id = tb_car.car_id
WHERE (tb_customer.cus_sub LIKE '%".$_GET["txtKeyword"]."%' or tb_customer.cus_area LIKE '%".$_GET["txtKeyword"]."%' or wb_payment LIKE '%".$_GET["txtKeyword"]."%' )
ORDER BY wb_id";
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());

$query_carId = "SELECT * FROM tb_car";
$carId = mysql_query($query_carId, $myconnect) or die(mysql_error());

$query_staff = "SELECT * FROM tb_staff";
$staffId = mysql_query($query_staff, $myconnect) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ใบส่งสินค้า</title>
<link rel="stylesheet" href="index.css">

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
    <td colspan="2"><h2 align="center">ใบส่งสินค้า</td>
  </tr>
  <tr>
    <td height="22" colspan="2">
    <!-- <form id="form2" name="form2" method="post" action="waybill_show.php"> -->
      <div align="left">

        <div align="center">
          <table  width="1265">
            <tr>
              <td width="226">
 

              <!-- <input type="text" name="word" id="word" /> -->
              
            <form name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
               <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $_GET["txtKeyword"];?>">
               <button type="submit"><i class="fa fa-search"></i></button>
            
                <label for="select2"></label>
                <select name="dd_input" id="select2">
                  <option value="All">ทั้งหมด</option>
                  <option value="cus_compan">ชื่อบริษัท</option>
                  <option value="cus_sub">ตำบล</option>
                  <option value="wb_payment">ยังไม่ได้ชำระ</option>
                </select></td>
             </form>


             <form name="myForm" action="waybill_insert_pdf.php" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">
              <td width="291"><div align="right">
              
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
                
                              <button class="buttonadd" >ตรวจสอบใบส่งสินค้า</button>
                              </div>
                   
                </div></td>
              </tr>
          </table>
        </div>
      </div>
    <!-- </form> -->
    </td>
  </tr>
  <tr>
    <td height="27" colspan="2">
    <!-- <form id="form1" name="form1" method="post" action=""> -->
      <div align="center">
        <table  width="1244">
          <tr>
            <td width="906"><div align="center">
              <table id='customers' width="1236" height="67">
                <tr >
                  <th ><div> </div></th>
                  <th ><div align="center">รหัสใบรับสินค้า</div></th>
                  <th ><div align="center">วันที่</div></th>
                  <th ><div align="center">ชื่อบริษัท</div></th>
                  <th ><div align="center">เลขที่ใบรับสินค้า</div></th>
                  <th ><div align="center">อำเภอ</div></th>
                  <th ><div align="center">ตำบล</div></th>
                  <th ><div align="center">ยอดเงินค่าขนส่ง</div></th>
                  <!-- <th ><div align="center">สถานะการชำระเงิน</div></th> -->
                  <th ><div align="center">จัดการ</div></th>
                </tr>
                <tr>
                  <?php while($row_waybill = mysql_fetch_array($waybill)) { ?>
                  <td><input type='checkbox' name='listData[]' value='<?php echo $row_waybill["wb_id"]; ?>'></td>
                  <td height="33"><div align="center"><?php echo $row_waybill["wb_id_set"]; ?></div></td>
                  <td><div align="center"><?php $date=date_create($row_waybill['wb_date']); echo date_format($date,"d/m/Y"); ?></td>
                  <td><div ><?php echo $row_waybill['cus_compan']; ?></div></td>
                  <td><div ><?php echo $row_waybill['wb_nbook']; ?></div></td>
                  <td><div align="center"><?php echo $row_waybill['cus_area']; ?></div></td>
                  <td><div align="center"><?php echo $row_waybill['cus_sub']; ?></div></td>
                  <td><div align="center"><?php echo $row_waybill['wb_money']; ?></div></td>
                  <!-- <td><div ><?php echo $row_waybill['wb_payment']; ?></td> -->
           
                      <td ><div align="center">
                      <!-- <a class="buttondetail" href="waybill_detail.php?id=<?php echo $row_waybill['wb_id']; ?>" >รายละเอียด</a> -->
                      <a class="btndel" href="waybill_del.php?id=<?php echo $row_waybill['wb_id']; ?>?staff_id=<?php echo $row_waybill['waybill_id']; ?>"onclick="return confirm('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a>
                      </td>
                   
                  </tr>
                <? } ?>
              </table>
            </div></td>
            </tr>
        </table>
    </div>
    </form>
      <p>&nbsp;</p>
    <!-- </form> -->
    </td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($waybill);
?>
