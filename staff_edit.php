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
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>แก้ไขข้อมูลพนักงาน</title>
    <link rel="stylesheet" href="css/custom.css" />

</head>

<body>
    <div class="container">
        <br />
        <h2>แก้ไขข้อมูลพนักงาน</h2>
        <br />
        <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <lable class="col-sm-2">รหัสพนักงาน: </lable>
                                <div class="col-sm-10">
                                    <input style="display:none;" name="staff_id" type="text" id="staff_id"
                                        value="<?php echo $row_staff['staff_id']; ?>" size="10" readonly="readonly"
                                        style="background-color:#CCC" />

                                    <?php echo $row_staff['staff_id_set']; ?>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <lable class="col-sm-2">ชื่อ - นามสกุล: </lable>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-2">
                                            <select name="staff_title_name" id="staff_title_name" class="form-control">
                                                <option selected disabled hidden>
                                                    <?php echo $row_staff['staff_title_name']; ?>
                                                </option>
                                                <option value="นาย">นาย</option>
                                                <option value="นาง">นาง</option>
                                                <option value="นางสาว">นางสาว</option>
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <input name="staff_name" type="text" id="staff_name" class="form-control"
                                                value="<?php echo $row_staff['staff_name']; ?>" />
                                        </div>
                                        <div class="col-5">
                                            <input name="staff_lastname" type="text" id="staff_lastname"
                                                class="form-control" value="<?php echo $row_staff['staff_lastname']; ?>"
                                                size="20" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <lable class="col-sm-2">เลขบัตรประชาชน </lable>
                                <div class="col-sm-10">
                                    <input name="staff_card" type="text" id="staff_card" class="form-control"
                                        value="<?php echo $row_staff['staff_card']; ?>" size="30" maxlength="13" />
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <lable class="col-sm-2">ตำแหน่ง </lable>
                                <div class="col-sm-10">
                                    <select name="staff_position" id="staff_position" class="form-control">
                                        <option value="พนักงานขับรถ">พนักงานขับรถ</option>
                                        <option value="พนักงานเอกสาร">พนักงานเอกสาร</option>
                                    </select>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <lable class="col-sm-2">เบอร์โทรศัพท์ </lable>
                                <div class="col-sm-10">
                                    <input name="staff_tel" type="text" id="staff_tel" class="form-control"
                                        value="<?php echo $row_staff['staff_tel']; ?>" size="30" maxlength="10" />
                                </div>
                            </div>
                            <hr />
                            <div class="float-right">
                                <input name="staff_bt" type="submit" id="staff_bt" value="บันทึกข้อมูลพนักงาน" />
                            </div>

                            <input type="hidden" name="MM_update" value="form1" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </form>
    </div>
</body>

</html>
<?php
mysql_free_result($staff);
?>