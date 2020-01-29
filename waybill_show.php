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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
    <td colspan="2"><h2 align="center">ใบรับ-ส่งสินค้า</td>
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
               <input type="submit" value="Search"></th>
            
                <label for="select2"></label>
                <select name="dd_input" id="select2">
                  <option value="All">ทั้งหมด</option>
                  <option value="cus_compan">ชื่อบริษัท</option>
                  <option value="cus_sub">ตำบล</option>
                  <option value="wb_payment">สถานะ</option>
                </select></td>
             </form>

      <form  action="waybill_invoice.php" method="post">
              <td width="291"><div align="right">
                
                              <button class="buttonadd" type="submit">ตรวจสอบใบส่งสินค้า</button>
                              <button class="buttonadd"><a href="waybill_insert.php">เพิ่มเอกสาร</a></button>
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
                  <th ><div align="center">รหัสใบรับ-ส่งสินค้า</div></th>
                  <th ><div align="center">วันที่</div></th>
                  <th ><div align="center">เลขที่ใบรับ-ส่งสินค้า</div></th>
                  <th ><div align="center">ชื่อบริษัท</div></th>
                  <th ><div align="center">จำนวนเงินทั้งสิ้น</div></th>
                  <th ><div align="center">สถานะการชำระเงิน</div></th>
                  <th ><div align="center">จัดการ</div></th>
                </tr>
                <tr>
                  <?php while($row_waybill = mysql_fetch_array($waybill)) { ?>
                  <td><input type='checkbox' name='checkIdList[]' value='<?php echo $row_waybill["wb_id"]; ?>'></td>
                  <td height="33"><div ><?php echo $row_waybill["wb_id_set"]; ?></div></td>
                  <td><div ><?php echo $row_waybill['wb_date']; ?></td>
                  <td><div ><?php echo $row_waybill['wb_nbook']; ?></div></td>
                  <td><div ><?php echo $row_waybill['cus_compan']; ?></div></td>
                  <td><div ><?php echo $row_waybill['wb_money']; ?></div></td>
                  <td><div ><?php echo $row_waybill['wb_payment']; ?></td>
           
                      <td ><div align="center">
                      <a class="buttondetail" href="waybill_detail.php?id=<?php echo $row_waybill['wb_id']; ?>" >รายละเอียด</a>
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
