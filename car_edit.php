<?php require_once('Connections/myconnect.php'); 
ob_start();
 require_once('nevbar.php');
 Nevbar();?>

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
  $updateSQL = sprintf("UPDATE tb_car SET car_register=%s, car_province=%s, car_date_end=%s WHERE car_id=%s",
                       GetSQLValueString($_POST['car_register'], "text"),
                       GetSQLValueString($_POST['car_province'], "text"),
                       GetSQLValueString($_POST['car_date_end'], "text"),
                       GetSQLValueString($_POST['car_id'], "int"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($updateSQL, $myconnect) or die(mysql_error());
// 
  // $updateGoTo = "car_show.php";
  // if (isset($_SERVER['QUERY_STRING'])) {
  //   $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
  //   $updateGoTo .= $_SERVER['QUERY_STRING'];
  // }
  // header(sprintf("Location: %s", $updateGoTo));
  echo '<script type="text/javascript">
  Swal.fire({
      title: "แก้ไขข้อมูลเรียบร้อย",
      icon: "success",
      showConfirmButton: false,
      timer: 1500
    }).then(()=> window.location.href="car_show.php")
  </script>';
}

$colname_car = "-1";
if (isset($_GET['id'])) {
  $colname_car = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_car = sprintf("SELECT * FROM tb_car WHERE car_id = %s", GetSQLValueString($colname_car, "int"));
$car = mysql_query($query_car, $myconnect) or die(mysql_error());
$row_car = mysql_fetch_assoc($car);
$totalRows_car = mysql_num_rows($car);

mysql_select_db($database_myconnect, $myconnect);
$query_car = "SELECT * FROM tb_car";
$car = mysql_query($query_car, $myconnect) or die(mysql_error());
$row_car = mysql_fetch_assoc($car);
$colname_car = "-1";
if (isset($_GET['id'])) {
  $colname_car = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_car = sprintf("SELECT * FROM tb_car WHERE car_id = %s", GetSQLValueString($colname_car, "int"));
$car = mysql_query($query_car, $myconnect) or die(mysql_error());
$row_car = mysql_fetch_assoc($car);
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>แก้ไขข้อมูลรถ</title>
    <link rel="stylesheet" href="css/custom.css" />

</head>

<body>
    <div class="container">
        <br />
        <h2>แก้ไขข้อมูลรถ</h2>
        <br />
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-body">
                        <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
                            <div class="row">

                                <lable class="col-sm-3">รหัสรถ :</lable>
                                </lable>
                                <div class="col-sm-9">
                                    <input style="display:none;" name="car_id" type="text" id="car_id"
                                        class="form-control" value="<?php echo $row_car['car_id']; ?>" size="15"
                                        readonly="readonly" style="background-color:#CCC" />
                                    <!-- *ไม่สามารถแก้ไขได้ -->
                                    </label>
                                    <?php echo $row_car['car_id_set']; ?>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <lable class="col-sm-3">ทะเบียนรถ :</lable>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input name="car_register" type="text" id="car_register"
                                                class="form-control" value="<?php echo $row_car['car_register']; ?>" />
                                        </div>
                                        <div class="col-6"><input style="display:none;" name="car_province"
                                                class="form-control" type="text" id="car_province"
                                                value="<?php echo $row_car['car_province']; ?>" />
                                            <select name="car_province" id="car_province" class="form-control">
                                                <option value="<?php echo $row_car['car_province']; ?>"
                                                    selected="selected">
                                                    <?php echo $row_car['car_province']; ?></option>
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
                                            </select></div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <lable class="col-sm-3">วันหมดอายุภาษีรถ:</lable>
                                <div class="col-sm-9">
                                    <input name="car_date_end" type="date" id="car_date_end" class="form-control"
                                        value="<?php echo $row_car['car_date_end']; ?>" />
                                </div>
                            </div>
                            <br />
                            <input name="car_bt" class="btn btn-primary float-right" type="submit" id="car_bt"
                                value="บันทึกข้อมูล" />
                            <input type="hidden" name="MM_update" value="form1" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</body>

</html>
<?php
mysql_free_result($car);
?>