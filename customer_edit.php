<?php require_once('Connections/myconnect.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_customer SET cus_compan=%s, cus_house=%s, cus_vill=%s, cus_sub=%s, cus_area=%s, cus_pro=%s, cus_pos=%s, cus_tle=%s, cus_tin=%s WHERE cus_id=%s",
                       GetSQLValueString($_POST['cus_compan'], "text"),
                       GetSQLValueString($_POST['cus_vill'], "text"),
                       GetSQLValueString($_POST['cus_vill'], "int"),
                       GetSQLValueString($_POST['cus_sub'], "text"),
                       GetSQLValueString($_POST['cus_area'], "text"),
                       GetSQLValueString($_POST['cus_pro'], "text"),
                       GetSQLValueString($_POST['cus_pos'], "text"),
                       GetSQLValueString($_POST['cus_tle'], "text"),
                       GetSQLValueString($_POST['cus_tin'], "text"),
                       GetSQLValueString($_POST['cus_id'], "int"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($updateSQL, $myconnect) or die(mysql_error());

  $updateGoTo = "customer_detail.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

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
if (isset($_GET['id'])) {
  $colname_customer = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);

$colname_customer = "-1";
if (isset($_GET['id'])) {
  $colname_customer = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);

$colname_customer1 = "-1";
if (isset($_GET['cus_id'])) {
  $colname_customer1 = $_GET['cus_id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer1 = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer1, "int"));
$customer1 = mysql_query($query_customer1, $myconnect) or die(mysql_error());
$row_customer1 = mysql_fetch_assoc($customer1);

$colname_customer = "-1";
if (isset($_GET['id'])) {
  $colname_customer = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);

$colname_customer = "-1";
if (isset($_GET['id'])) {
  $colname_customer = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$colname_customer = "-1";
if (isset($_GET['cus_id'])) {
  $colname_customer = $_GET['cus_id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);

$colname_customer = "-1";
if (isset($_GET['cus_id'])) {
  $colname_customer = $_GET['cus_id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);

$colname_customer = "-1";
if (isset($_GET['cus_id'])) {
  $colname_customer = $_GET['cus_id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$colname_customer = "-1";
if (isset($_GET['id'])) {
  $colname_customer = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);

mysql_select_db($database_myconnect, $myconnect);
$query_customer = "SELECT * FROM tb_customer";
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = "-1";
if (isset($_GET['id'])) {
  $totalRows_customer = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$colname_customer = "-1";
if (isset($_GET['cus_id'])) {
  $colname_customer = $_GET['cus_id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);

mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);

mysql_select_db($database_myconnect, $myconnect);
$query_customer = "SELECT * FROM tb_customer";
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แก้ไขข้อมูลลูกค้า</title>
<style type="text/css">
#form1 div table tr td table tr td {
	color: #FFF;
}
#form1 div table tr td table tr td table tr td {
	color: #F00;
}
#form1 div table tr td table tr td {
	color: #000;
}
</style>
</head>

<body>
<?php echo $row_customer['cus_id']; ?>
<table width="1352" height="521" align="center">
  <tr>
    <td height="32" colspan="3" bgcolor="#000033"><table width="300">
      <tr>
        <td height="236"><img src="img/loko.png" alt="" width="283" height="252" /></td>
      </tr>
    </table></td>
    <td colspan="6" bgcolor="#000033"><img src="img/salee.png" alt="" width="600" height="100" /></td>
  </tr>
  <tr>
    <td width="183"><div align="center">
      <h3><a href="indexhome.php">หน้าแรก</a></h3>
    </div></td>
    <td width="183" height="22"><h3 align="center"><a href="staff_show.php">ข้อมูลพนักงาน</a></h3></td>
    <td width="126"><h3 align="center"><a href="car_show.php">ข้อมูลรถ</a></h3></td>
    <td width="133"><h3 align="center"><a href="customer_show.php">ข้อมูลลูกค้า</a></h3></td>
    <td width="154"><h3 align="center"><a href="waybill_show.php">เอกสารใบส่งของ</a></h3></td>
    <td width="142"><h3 align="center">&nbsp;</h3></td>
    <td width="112"><h3>&nbsp;</h3></td>
    <td width="116"><h3 align="center">Admin</h3></td>
    <td width="145"><h3 align="center">ออกจากระบบ</h3></td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9"><div align="center">
      <h2>แก้ไขข้อมูลลูกค้า</h2>
    </div></td>
  </tr>
  <tr>
    <td colspan="9"><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
      <div align="center">
        <table width="774">
          <tr>
            <td width="712"><table width="721" border="0" align="center">
              <tr>
                <td width="98" height="33"><div align="left">รหัสลูกค้า </div></td>
                <td width="190"><label>
                  <input name="cus_id" type="text" id="cus_id" value="<?php echo $row_customer['cus_id']; ?>" readonly="readonly" />
                  </label></td>
                <td><div align="left">เลขประจำตัวผู้เสียภาษี </div></td>
                <td><label>
                  <input name="cus_tin" type="text" id="cus_tin" value="<?php echo $row_customer['cus_tin']; ?>" />
                  </label></td>
                </tr>
              <tr>
                <td><div align="left">ชื่อบริษัท </div></td>
                <td><input name="cus_compan" type="text" id="cus_compan" value="<?php echo $row_customer['cus_compan']; ?>" /></td>
                <td height="32"><div align="left">เบอร์โทรศัพท์ </div></td>
                <td><label>
                  <input name="cus_tle" type="text" id="cus_tle" value="<?php echo $row_customer['cus_tle']; ?>" />
                  </label></td>
                </tr>
              <tr>
                <td height="37"><div align="left">บ้านเลขที่ </div></td>
                <td><input name="cus_hose" type="text" id="cus_hose" value="<?php echo $row_customer['cus_house']; ?>" /></td>
                <td><div align="left">หมู่ </div></td>
                <td><input name="cus_vill" type="text" id="cus_vill" value="<?php echo $row_customer['cus_vill']; ?>" /></td>
                </tr>
              <tr>
                <td height="34"><div align="left">ตำบล </div></td>
                <td><label>
                  <input name="cus_sub" type="text" id="cus_sub" value="<?php echo $row_customer['cus_sub']; ?>" />
                  </label></td>
                <td><div align="left">อำเภอ </div></td>
                <td><input name="cus_area" type="text" id="cus_area" value="<?php echo $row_customer['cus_area']; ?>" /></td>
                </tr>
              <tr>
                <td height="36"><div align="left">จังหวัด </div></td>
                <td><select name="cus_pro" id="cus_pro">
                  <option value="" selected="selected">--------- เลือกจังหวัด ---------</option>
                  <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                  <option value="กระบี่">กระบี่ </option>
                  <option value="กาญจนบุรี">กาญจนบุรี </option>
                  <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
                  <option value="กำแพงเพชร">กำแพงเพชร </option>
                  <option value="ขอนแก่น">ขอนแก่น</option>
                  <option value="จันทบุรี">จันทบุรี</option>
                  <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
                  <option value="ชัยนาท">ชัยนาท </option>
                  <option value="ชัยภูมิ">ชัยภูมิ </option>
                  <option value="ชุมพร">ชุมพร </option>
                  <option value="ชลบุรี">ชลบุรี </option>
                  <option value="เชียงใหม่">เชียงใหม่ </option>
                  <option value="เชียงราย">เชียงราย </option>
                  <option value="ตรัง">ตรัง </option>
                  <option value="ตราด">ตราด </option>
                  <option value="ตาก">ตาก </option>
                  <option value="นครนายก">นครนายก </option>
                  <option value="นครปฐม">นครปฐม </option>
                  <option value="นครพนม">นครพนม </option>
                  <option value="นครราชสีมา">นครราชสีมา </option>
                  <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
                  <option value="นครสวรรค์">นครสวรรค์ </option>
                  <option value="นราธิวาส">นราธิวาส </option>
                  <option value="น่าน">น่าน </option>
                  <option value="นนทบุรี">นนทบุรี </option>
                  <option value="บึงกาฬ">บึงกาฬ</option>
                  <option value="บุรีรัมย์">บุรีรัมย์</option>
                  <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
                  <option value="ปทุมธานี">ปทุมธานี </option>
                  <option value="ปราจีนบุรี">ปราจีนบุรี </option>
                  <option value="ปัตตานี">ปัตตานี </option>
                  <option value="พะเยา">พะเยา </option>
                  <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
                  <option value="พังงา">พังงา </option>
                  <option value="พิจิตร">พิจิตร </option>
                  <option value="พิษณุโลก">พิษณุโลก </option>
                  <option value="เพชรบุรี">เพชรบุรี </option>
                  <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
                  <option value="แพร่">แพร่ </option>
                  <option value="พัทลุง">พัทลุง </option>
                  <option value="ภูเก็ต">ภูเก็ต </option>
                  <option value="มหาสารคาม">มหาสารคาม </option>
                  <option value="มุกดาหาร">มุกดาหาร </option>
                  <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
                  <option value="ยโสธร">ยโสธร </option>
                  <option value="ยะลา">ยะลา </option>
                  <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
                  <option value="ระนอง">ระนอง </option>
                  <option value="ระยอง">ระยอง </option>
                  <option value="ราชบุรี">ราชบุรี</option>
                  <option value="ลพบุรี">ลพบุรี </option>
                  <option value="ลำปาง">ลำปาง </option>
                  <option value="ลำพูน">ลำพูน </option>
                  <option value="เลย">เลย </option>
                  <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                  <option value="สกลนคร">สกลนคร</option>
                  <option value="สงขลา">สงขลา </option>
                  <option value="สมุทรสาคร">สมุทรสาคร </option>
                  <option value="สมุทรปราการ">สมุทรปราการ </option>
                  <option value="สมุทรสงคราม">สมุทรสงคราม </option>
                  <option value="สระแก้ว">สระแก้ว </option>
                  <option value="สระบุรี">สระบุรี </option>
                  <option value="สิงห์บุรี">สิงห์บุรี </option>
                  <option value="สุโขทัย">สุโขทัย </option>
                  <option value="สุพรรณบุรี">สุพรรณบุรี </option>
                  <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
                  <option value="สุรินทร์">สุรินทร์ </option>
                  <option value="สตูล">สตูล </option>
                  <option value="หนองคาย">หนองคาย </option>
                  <option value="หนองบัวลำภู">หนองบัวลำภู </option>
                  <option value="อำนาจเจริญ">อำนาจเจริญ </option>
                  <option value="อุดรธานี">อุดรธานี </option>
                  <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
                  <option value="อุทัยธานี">อุทัยธานี </option>
                  <option value="อุบลราชธานี">อุบลราชธานี</option>
                  <option value="อ่างทอง">อ่างทอง </option>
                  <option value="อื่นๆ">อื่นๆ</option>
                  </select></td>
                <td height="34"><div align="left">รหัสไปรษณีย์ </div></td>
                <td height="34"><div align="left">
                  <input name="cus_pos" type="text" id="cus_pos" value="<?php echo $row_customer['cus_pos']; ?>" />
                  </div></td>
                </tr>
              <tr>
                <td height="34" colspan="4"><div align="center">
                  <input type="submit" name="cus_bt" id="cus_bt" value="บันทึกข้อมูลลูกค้า" />
                  </div></td>
                </tr>
              </table>
              <div align="center"></div></td>
            </tr>
        </table>
        <p>
          <input type="hidden" name="MM_update" value="form1" />
          <input name="cus_id" type="hidden" id="cus_id" value="<?php echo $row_customer['cus_id']; ?>" />
        </p>
      </div>
      <p></p>
    </form></td>
  </tr>
  <tr>
    <td height="21" colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($customer);
?>
