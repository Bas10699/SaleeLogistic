<?php require_once('Connections/myconnect.php');
 require_once('nevbar.php');
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

  echo '<script type="text/javascript">
  Swal.fire({
      title: "แก้ไขข้อมูลเรียบร้อย",
      icon: "success",
      showConfirmButton: false,
      timer: 1500
    }).then(()=> window.location.href="staff_show.php")
  </script>';

  // $updateGoTo = "staff_show.php";
 
  // header(sprintf("Location: %s", $updateGoTo));
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แก้ไขข้อมูลพนักงาน</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<link rel="stylesheet" href="index.css">

</head>

<body>
<table width="100%" height="769" align="center">
  
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
        <table width="670" height="187" style=' border-collapse: collapse; border: 1px solid black;'>
          <tr>
            <td ><div align="center">
              <table width="570" align="center">
                <tr>
                  <td height="24" ><div align="left">
                    <h4>รหัสพนักงาน </h4>
                    </div></td>
                  <td ><label>
                    <input style="display:none;" name="staff_id" type="text" id="staff_id" value="<?php echo $row_staff['staff_id']; ?>" size="10" readonly="readonly" style="background-color:#CCC" />
                    </label>
                    <?php echo $row_staff['staff_id_set']; ?>
                  </td>
                  </tr>
                <tr>
                  <td width="129" height="24" ><div align="left">
                    <h4>ชื่อ - นามสกุล </h4>
                    </div></td>
                  <td width="352" ><label>
                  <select name="staff_title_name" id="staff_title_name">
                       <option selected disabled hidden><?php echo $row_staff['staff_title_name']; ?></option>
                       <option value="นาย">นาย</option>
                       <option value="นาง">นาง</option>
                       <option value="นางสาว">นางสาว</option>
                  </select>
                    <input name="staff_name" type="text" id="staff_name" value="<?php echo $row_staff['staff_name']; ?>" />
                    <input name="staff_lastname" type="text" id="staff_lastname" value="<?php echo $row_staff['staff_lastname']; ?>" size="20" />
                    </label></td>
                  </tr>
                <tr>
                  <td height="25" ><div align="left">
                    <h4>เลขบัตรประชาชน </h4>
                    </div></td>
                  <td ><label>
                    <input name="staff_card" type="text" id="staff_card" value="<?php echo $row_staff['staff_card']; ?>" size="30" maxlength="13" />
                    </label></td>
                  </tr>
                <tr>
                  <td height="26" ><div align="left">
                    <h4>ตำแหน่ง </h4>
                    </div></td>
                  <td ><select name="staff_position" id="staff_position">
                    <option value="Manager">Manager</option>
                    <option value="Driver">Driver</option>
                    </select></td>
                  </tr>
                <tr>
                  <td height="26" ><div align="left">
                    <h4>เบอร์โทรศัพท์ </h4>
                    </div></td>
                  <td ><label>
                    <input name="staff_tel" type="text" id="staff_tel" value="<?php echo $row_staff['staff_tel']; ?>" size="30" maxlength="10" />
                    </label></td>
                  </tr>
                <tr>
                  <td height="35" colspan="2" ><div align="center">
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
