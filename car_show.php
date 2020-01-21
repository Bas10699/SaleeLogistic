<?php require_once('Connections/myconnect.php'); ?>

<?php require_once('nevbar.php');
Nevbar(); ?>

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

mysql_select_db($database_myconnect, $myconnect);
$query_car = "SELECT * FROM tb_car";
$car = mysql_query($query_car, $myconnect) or die(mysql_error());
$row_car = mysql_fetch_assoc($car);
$totalRows_car = mysql_num_rows($car);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<STYLE type=text/css>
A:link {COLOR: #FFFFFF; TEXT-DECORATION: none}
A:visited {COLOR: #FFFF00; TEXT-DECORATION: none}
A:hover {COLOR: #FFFFFF; TEXT-DECORATION: underline}
.ปุ่มลบ {
	border-radius: 10px;
	background-color: #990000;
}
</STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลรถ</title>
<style type="text/css">
#form1 div table tr td table tr td {
	font-size: 24px;
}
#form1 div table tr td {
	font-size: 18px;
}
#form1 div table {
	font-size: 14px;
}
#form1 div table {
	font-size: 14px;
}
#form1 div table {
	font-size: 14px;
}
.หัวข้อ {	font-family: "angsana New";
	font-size: 30px;
	color: #FF0;
}
a:link {
	color: #FF0;
	text-decoration: none;
}
a:visited {
	color: #FF0;
	text-decoration: none;
}
a:hover {
	color: #FFF;
	text-decoration: none;
}
.กรอบแก้ไข {
	border-radius: 5px;
	background-color: #060;
	font-family: "Angsana New";
	font-size: 30px;
}
.กรอบหัวข้อ {
	border-radius: 10px;
	background-color: #003;
}
.หัวข้อตาราง {
	font-family: "Angsana New";
	font-size: 36px;
	color: #FFF;
}
a:active {
	color: #FF0;
	text-decoration: none;
}
</style>
<script type="text/javascript">
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
</script>
</head>

<body>
<table width="100%" height="521" align="center">
  
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td height="33" colspan="8"><div align="center">
      <h2>ข้อมูลรถ</h2>
    </div></td>
  </tr>
  <tr>
    <td height="29" colspan="8"><div align="right">
      <table width="100" border="1">
        <tr>
          <td bgcolor="#660033"><div align="center"><a href="car_insert.php">เพิ่มข้อมูลรถ</a></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="79" colspan="8"><form id="form1" name="form1" method="post" action="">
      <div align="center">
        <table width="546" height="76" border="0" bordercolor="FFFFFF" class="กรอบหัวข้อ">
          <tr bgcolor="" class="กรอบตาราง">
            <td width="336" height="37"><div align="center" class="หัวข้อตาราง">รหัสรถ            </div></td>
            <td width="336" height="37"><div align="center"><span class="หัวข้อตาราง">ทะเบียนรถ</span>            </div></td>
            <td colspan="2"><div align="center" class="หัวข้อตาราง">จัดการ            </div></td>
          </tr>
          <?php do { ?>
          <tr>
            <td height="33" bgcolor="#FFFFFF"><div align="center"><?php echo $row_car['car_id_set']; ?></div></td>
            <td height="33" bgcolor="#FFFFFF"><div align="left"><?php echo $row_car['car_register']; ?> / <?php echo $row_car['car_province']; ?></div></td>
            <td width="105" bgcolor="#006600"><div align="center"><span class="หัวข้อตาราง"><a href="car_edit.php<?php echo $row_car['']; ?>?id=<?php echo $row_car['car_id']; ?>" class="กรอบแก้ไข">แก้ไข</a></span></div></td>
            <td width="89" bgcolor="#990000"><div align="center"><span class="หัวข้อตาราง"><a href="car_del.php?id=<?php echo $row_car['car_id']; ?>" class="ปุ่มลบ" onclick="MM_popupMsg('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a></span></div></td>
          </tr>
          <?php } while ($row_car = mysql_fetch_assoc($car)); ?>
        </table>
      </div>
    </form></td>
  </tr>
  <tr>
    <td colspan="8"><div align="center"></div></td>
  </tr>
  <tr>
    <td colspan="8"><p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($car);
?>
