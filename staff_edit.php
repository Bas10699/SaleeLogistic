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
  $updateSQL = sprintf("UPDATE tb_staff SET staff_name=%s, staff_lastname=%s, staff_card=%s, staff_position=%s, staff_tel=%s WHERE staff_id=%s",
                       GetSQLValueString($_POST['staff_name'], "text"),
                       GetSQLValueString($_POST['staff_lastname'], "text"),
                       GetSQLValueString($_POST['staff_card'], "text"),
                       GetSQLValueString($_POST['staff_position'], "text"),
                       GetSQLValueString($_POST['staff_tel'], "text"),
                       GetSQLValueString($_POST['staff_id'], "int"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($updateSQL, $myconnect) or die(mysql_error());

  $updateGoTo = "staff_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_staff SET staff_name=%s, staff_lastname=%s, staff_card=%s, staff_position=%s, staff_tel=%s WHERE staff_id=%s",
                       GetSQLValueString($_POST['staff_name'], "text"),
                       GetSQLValueString($_POST['staff_lastname'], "text"),
                       GetSQLValueString($_POST['staff_card'], "text"),
                       GetSQLValueString($_POST['staff_position'], "text"),
                       GetSQLValueString($_POST['staff_tel'], "text"),
                       GetSQLValueString($_POST['staff_id'], "int"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($updateSQL, $myconnect) or die(mysql_error());

  $updateGoTo = "staff_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_staff = "-1";
if (isset($_GET['id'])) {
  $colname_staff = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_staff = sprintf("SELECT * FROM tb_staff WHERE staff_id = %s", GetSQLValueString($colname_staff, "int"));
$staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
$totalRows_staff = mysql_num_rows($staff);

$colname_staff = "-1";
if (isset($_GET['id'])) {
  $colname_staff = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_staff = sprintf("SELECT * FROM tb_staff WHERE staff_id = %s", GetSQLValueString($colname_staff, "int"));
$staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
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
<title>แก้ไขข้อมูลพนักงาน</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<style type="text/css">
#form1 table tr td label {
	color: #F00;
}
#form1 table tr td label {
	font-size: 10px;
}
#form1 table tr td label {
	font-size: 14px;
}
#form1 div table tr td div table tr td {
	color: #FFF;
}
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
<table width="100%" height="769" align="center">
  <tr>
    <td height="182" colspan="3" bgcolor="#000033"><img src="img/logodaichuar2.png" alt="" width="207" height="199" /></td>
  </tr>
  <tr bgcolor="#000033" class="หัวข้อ">
    <td height="41" colspan="3"><table width="100%">
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
    <td height="33" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="52" colspan="3"><div align="center">
      <h2>แก้ไขข้อมูลพนักงาน</h2>
    </div></td>
  </tr>
  <tr>
    <td height="250" colspan="3"><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
      <div align="center">
        <table width="564" height="187">
          <tr>
            <td bgcolor="#000033"><div align="center">
              <table width="515" align="center">
                <tr>
                  <td height="24" bgcolor="#000033"><div align="left">
                    <h4>รหัสพนักงาน </h4>
                    </div></td>
                  <td bgcolor="#000033"><label>
                    <input name="staff_id" type="text" id="staff_id" value="<?php echo $row_staff['staff_id']; ?>" size="10" readonly="readonly" style="background-color:#CCC" />
                    *ไม่สามารถแก้ไขรหัสพนักงานได้</label></td>
                  </tr>
                <tr>
                  <td width="129" height="24" bgcolor="#000033"><div align="left">
                    <h4>ชื่อ - นามสกุล </h4>
                    </div></td>
                  <td width="352" bgcolor="#000033"><label>
                    <input name="staff_name" type="text" id="staff_name" value="<?php echo $row_staff['staff_name']; ?>" />
                    <input name="staff_lastname" type="text" id="staff_lastname" value="<?php echo $row_staff['staff_lastname']; ?>" size="20" />
                    </label></td>
                  </tr>
                <tr>
                  <td height="25" bgcolor="#000033"><div align="left">
                    <h4>เลขบัตรประชาชน </h4>
                    </div></td>
                  <td bgcolor="#000033"><label>
                    <input name="staff_card" type="text" id="staff_card" value="<?php echo $row_staff['staff_card']; ?>" size="30" maxlength="13" />
                    </label></td>
                  </tr>
                <tr>
                  <td height="26" bgcolor="#000033"><div align="left">
                    <h4>ตำแหน่ง </h4>
                    </div></td>
                  <td bgcolor="#000033"><select name="staff_position" id="staff_position">
                    <option value="Manager">Manager</option>
                    <option value="Driver">Driver</option>
                    </select></td>
                  </tr>
                <tr>
                  <td height="26" bgcolor="#000033"><div align="left">
                    <h4>เบอร์โทรศัพท์ </h4>
                    </div></td>
                  <td bgcolor="#000033"><label>
                    <input name="staff_tel" type="text" id="staff_tel" value="<?php echo $row_staff['staff_tel']; ?>" size="30" maxlength="10" />
                    </label></td>
                  </tr>
                <tr>
                  <td height="35" colspan="2" bgcolor="#000033"><div align="center">
                    <input name="staff_bt" type="submit" id="staff_bt" value="บันทึกข้อมูลพนักงาน" />
                    </div></td>
                  </tr>
                </table>
              </div></td>
            </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
      </div>
    </form></td>
  </tr>
  <tr>
    <td colspan="3"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($staff);
?>
