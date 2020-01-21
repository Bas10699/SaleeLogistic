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

$colname_customer = "-1";
if (isset($_GET['cus_id'])) {
  $colname_customer = $_GET['cus_id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);
$query_customer = "SELECT * FROM tb_customer";
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<STYLE type=text/css>
A:link {COLOR: #FFFFFF; TEXT-DECORATION: none}
A:visited {COLOR: #FFFF00; TEXT-DECORATION: none}
A:hover {COLOR: #FFFFFF; TEXT-DECORATION: underline}
</STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลลูกค้า</title>
<style type="text/css">
.หัวข้อ {
	font-family: "angsana New";
	font-size: 30px;
	color: #FF0;
}
.หัวข้อสีน้ำเงิน {
	font-family: "angsana New";
	font-size: 24px;
	color: #FFF;
}
.ตัวอักษร {
	font-size: 27px;
	color: #000;
	font-family: "angsana New";
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
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
<table width="100%" height="581" align="center" >
  
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><div align="center">
      <h2>ข้อมูลลูกค้า</h2>
    </div></td>
  </tr>
  <tr>
    <td colspan="5"><div align="right">
      <table width="155" height="33" border="1">
        <tr>
          <td bgcolor="#660033"><div align="center"><a href="customer_insert.php">เพิ่มข้อมูลลูกค้า</a></div></td>
          </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="5"><form id="form1" name="form1" method="post" action="">
      <div align="center">
        <table width="862" border="1"  bordercolor="#FFF" cellspacing="1" cellpadding="0">
          <tr bgcolor="#339966" class="หัวข้อสีน้ำเงิน">
            <td width="189" height="34" bgcolor="#000033"><div align="center">
              <table width="188">
                <tr>
                  <td><div align="center">รหัสลูกค้า</div></td>
                  </tr>
                </table>
            </div></td>
            <td width="189" height="34" bgcolor="#000033"><div align="center">
              <table width="188">
                <tr>
                  <td><div align="center">เลขประจำตัวผู้เสียภาษี</div></td>
                  </tr>
                </table>
            </div></td>
            <td width="179" bgcolor="#000033"><div align="center">
              <table width="100">
                <tr>
                  <td>ชื่อบริษัท</td>
                </tr>
            </table>
              </div></td>
            <td width="139" bgcolor="#000033"><div align="center">
              <table width="100">
                <tr>
                  <td>เบอร์โทรศัพท์</td>
                </tr>
            </table>
              </div></td>
            <td colspan="2" bgcolor="#000033"><div align="center">
              <table width="100">
                <tr>
                  <td><div align="center">จัดการ</div></td>
                </tr>
            </table>
            </div></td>
            </tr>
          <?php do { ?>
            <tr>
              <td class="ตัวอักษร" align="center" ><?php echo $row_customer['customer_id']; ?></td>
              <td height="35"><div align="center" class="ตัวอักษร"><?php echo $row_customer['cus_tin']; ?></div></td>
              <td class="ตัวอักษร"><?php echo $row_customer['cus_compan']; ?></td>
              <td class="ตัวอักษร"><?php echo $row_customer['cus_tle']; ?></td>
              <td width="107" bgcolor="#006600"><div align="center"><a href="customer_detail.php?id=<?php echo $row_customer['cus_id']; ?>" >ดูรายละเอียด</a></div></td>
              <td width="48" bgcolor="#990000"><div align="center"><a href="customer_del.php?id=<?php echo $row_customer['cus_id']; ?>" onclick="MM_popupMsg('ลบข้อมูลเรียบร้อยแล้ว')">ลบ</a></div></td>
              </tr>
            <?php } while ($row_customer = mysql_fetch_assoc($customer)); ?>
        </table>

      </div>
    </form></td>
  </tr>
  <tr>
    <td height="79" colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($customer);
?>
