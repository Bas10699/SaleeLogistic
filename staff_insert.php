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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_staff (staff_id, staff_name, staff_lastname, staff_card, staff_position, staff_tel) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['staff_id'], "text"),
                       GetSQLValueString($_POST['staff_name'], "text"),
                       GetSQLValueString($_POST['staff_lastname'], "text"),
                       GetSQLValueString($_POST['staff_card'], "text"),
                       GetSQLValueString($_POST['staff_position'], "text"),
                       GetSQLValueString($_POST['staff_tel'], "text"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());
    
  $id = mysql_insert_id();
  $id_SET = sprintf('S-%03d', $id);
  $insertSQL1 = sprintf("UPDATE tb_staff SET staff_id_set=%s WHERE staff_id=%s",
                    GetSQLValueString($id_SET,"text"),
                    GetSQLValueString($id,"text"));
  mysql_select_db($database_myconnect, $myconnect);
  $Result2 = mysql_query($insertSQL1, $myconnect) or die(mysql_error());

  $insertGoTo = "staff_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_myconnect, $myconnect);
$query_staff = "SELECT * FROM tb_staff";
$staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
$totalRows_staff = mysql_num_rows($staff);
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
<title>เพิ่มข้อมูลพนักงาน</title>
<style type="text/css">
#form1 div table tr td table tr td {
	color: #FFF;
}
.หัวข้อ {
	font-size: 30px;
	color: #FF0;
	font-family: "angsana New";
}
a:link {
	color: #FF0;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FF0;
}
a:hover {
	text-decoration: none;
	color: #FFF;
}
a:active {
	text-decoration: none;
	color: #FF0;
}
</style>
</head>

<body>
<table width="100%" height="579" align="center">
  <tr>
    <td height="32" colspan="9" bgcolor="#000033"><img src="img/logodaichuar2.png" alt="" width="207" height="199" /></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#000033"><table width="100%">
      <tr>
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
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="79" colspan="9"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <h2 align="center">เพิ่มข้อมูลพนักงาน</h2>
      <div align="center">
        <table width="539" height="201">
          <tr>
            <td bgcolor="#000033"><table width="533" height="228" align="center">
              <tr>
                <td bgcolor="#000033"><div align="left">รหัสพนักงาน :</div></td>
                <td height="35" bgcolor="#000033"><input name="staff_id" type="text" disabled="disabled" id="staff_id" size="20" style="background-color:#CCC" /></td>
                </tr>
              <tr>
                <td width="165" bgcolor="#000033"><div align="left">ชื่อ - นามสกุล :</div></td>
                <td width="356" height="36" bgcolor="#000033"><input name="staff_name" type="text" id="staff_name" />
                  <input name="staff_lastname" type="text" id="staff_lastname" size="21" /></td>
                </tr>
              <tr>
                <td bgcolor="#000033"><div align="left">เลขบัตรประชาชน :</div></td>
                <td height="35" bgcolor="#000033"><input name="staff_card" type="text" id="staff_card" pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" size="47" maxlength="13" /></td>
                </tr>
              <tr>
                <td bgcolor="#000033"><div align="left">ตำแหน่ง :</div></td>
                <td height="36" bgcolor="#000033"><select name="staff_position" id="staff_position">
                  <option value="Manager">Manager</option>
                  <option value="Driver">Driver</option>
                </select></td>
                </tr>
              <tr>
                <td bgcolor="#000033"><div align="left">เบอร์โทรศัพท์ : </div></td>
                <td height="33" bgcolor="#000033"><input name="staff_tel" type="text" id="staff_tel" pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" size="47" maxlength="10" /></td>
                </tr>
              <tr>
                <td height="37" colspan="2" bgcolor="#000033"><div align="center">
                  <input name="staff_bt" type="submit" id="staff_bt" value="บันทึกข้อมูลพนักงาน" />
                </div></td>
                </tr>
              </table></td>
            </tr>
        </table>
        
        
        <input type="hidden" name="MM_insert" value="form1" />
        <input type="hidden" name="MM_insert" value="form1" />
      </div>
    </form></td>
  </tr>
  <tr>
    <td colspan="9"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($staff);

?>
