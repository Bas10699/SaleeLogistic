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

if($_GET["txtKeyword"] != ""){
	// $objConnect = mysql_connect("localhost","root","12345678") or die("Error Connect to Database");
	$objDB = mysql_select_db($database_myconnect, $myconnect);
	// Search By Name or Email
	$strSQL = "SELECT * FROM tb_waybill
  LEFT JOIN tb_customer 
  ON tb_waybill.customer_id = tb_customer.cus_id
  LEFT JOIN tb_car
  ON tb_waybill.car_id = tb_car.car_id
  WHERE (tb_customer.cus_sub LIKE '%".$_GET["txtKeyword"]."%' or tb_customer.cus_area LIKE '%".$_GET["txtKeyword"]."%' )";
  $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
  $row_waybill = mysql_fetch_assoc($waybill);
}
  

mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill 
LEFT JOIN tb_customer 
ON tb_waybill.customer_id = tb_customer.cus_id 
LEFT JOIN tb_car
ON tb_waybill.car_id = tb_car.car_id";
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());
$row_waybill = mysql_fetch_assoc($waybill);
$totalRows_waybill = mysql_num_rows($waybill);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<STYLE type=text/css>
A:link {
	COLOR: #FFFF00;
	TEXT-DECORATION: none
}
A:visited {COLOR: #FFFF00; TEXT-DECORATION: none}
A:hover {
	COLOR: #FFFFFF;
	TEXT-DECORATION: none
}
</STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เอกสารใบส่งของ</title>
<style type="text/css">
.หัวข้อ {
	font-family: "angsana New";
	font-size: 30px;
	color: #FF0;
}
a:active {
	text-decoration: none;
}
.หัวข้อย่อย {
	font-size: 20px;
	color: #FFF;
}
</style>
</head>

<body>
<table width="100%" height="477" align="center">
  <tr>
    <td height="32" colspan="2" bgcolor="#000033"><img src="img/logodaichuar2.png" width="207" height="199" /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#000033"><table width="100%">
      <tr class="หัวข้อ">
        <td width="9%" class="หัวข้อ"><a href="indexhome.php">หน้าแรก</a></td>
        <td width="12%" class="หัวข้อ"><a href="staff_show.php">ข้อมูลพนักงาน</a></td>
        <td width="9%" class="หัวข้อ"><a href="car_show.php">ข้อมูลรถ</a></td>
        <td width="9%" class="หัวข้อ"><a href="customer_show.php">ข้อมูลลูกค้า</a></td>
        <td width="20%" class="หัวข้อ"><a href="waybill_show.php">เอกสารใบส่งของ</a></td>
        <td width="41%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><h2 align="center">เอกสารใบส่งของ</h2></td>
  </tr>
  <tr>
    <td height="22" colspan="2"><form id="form2" name="form2" method="post" action="waybill_show.php">
      <div align="left">
        <p>
          <label for="dd_input"></label>
        </p>
        <div align="center">
          <table width="1265">
            <tr>
              <td width="226">
 

              <!-- <input type="text" name="word" id="word" /> -->
              <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $_GET["txtKeyword"];?>">
                <input type="submit" name="btnSearch" id="btnSearch" value="ค้นหา" action="<?php echo $_SERVER['SCRIPT_NAME'];?>"/>
                <label for="select2"></label>
                <select name="dd_input" id="select2">
                  <option value="All">ทั้งหมด</option>
                  <option value="cus_compan">ชื่อบริษัท</option>
                  <option value="cus_sub">ตำบล</option>
                  <option value="wb_payment">สาถานะ</option>
                </select></td>
              


              <td width="291"><div align="right">
                <table width="137" border="1">
                  <tr>
                    <td width="116" bgcolor="#660033"><div align="center"><a href="waybill_insert.php">เพิ่มเอกสาร</a></div></td>
                    </tr>
                  </table>
                </div></td>
              </tr>
          </table>
        </div>
      </div>
    </form></td>
  </tr>
  <tr>
    <td height="27" colspan="2"><form id="form1" name="form1" method="post" action="">
      <div align="center">
        <table width="1244">
          <tr>
            <td width="906"><div align="center">
              <table width="1236" height="67">
                <tr class="หัวข้อย่อย">
                  <td width="169" bgcolor="#000033"><div align="center">รหัสใบส่งของ</div></td>
                  <td width="156" bgcolor="#000033"><div align="center">วันที่</div></td>
                  <td width="169" bgcolor="#000033"><div align="center">เลขที่ใบส่งของ</div></td>
                  <td width="191" bgcolor="#000033"><div align="center">ชื่อบริษัท</div></td>
                  <td width="172" bgcolor="#000033"><div align="center">จำนวนเงินทั้งสิ้น</div></td>
                  <td width="193" bgcolor="#000033"><div align="center">สถานะการชำระเงิน</div></td>
                  <td colspan="2" bgcolor="#000033"><div align="center">จัดการ</div></td>
                </tr>
                <tr>
                  <?php while($row_waybill = mysql_fetch_array($waybill)) { ?>
                  <td height="33"><div align="center"><?php echo $row_waybill["wb_id_set"]; ?></div></td>
                  <td><div align="center"><?php echo $row_waybill['wb_date']; ?></td>
                  <td><div align="center"><?php echo $row_waybill['wb_nbook']; ?></div></td>
                  <td><div align="center"><?php echo $row_waybill['cus_compan']; ?></div></td>
                  <td><div align="center"><?php echo $row_waybill['wb_money']; ?></div></td>
                  <td><div align="center"><?php echo $row_waybill['wb_payment']; ?></td>
                  <td width="95" bgcolor="#006600"><div align="center"><a href="waybill_detail.php?id=<?php echo $row_waybill['wb_id']; ?>">รายละเอียด</a></div></td>
                  <td width="75" bgcolor="#990000"><div align="center"><a href="waybill_del.php?id=<?php echo $row_waybill['wb_id']; ?>?staff_id=<?php echo $row_waybill['waybill_id']; ?>"onclick="MM_popupMsg('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a></div></td>
                </tr>
                <? } ?>
              </table>
            </div></td>
            </tr>
        </table>
    </div>
      <p>&nbsp;</p>
    </form></td>
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
