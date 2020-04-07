<?php require_once('Connections/myconnect.php'); 
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
  $updateSQL = sprintf("UPDATE tb_customer SET cus_compan=%s, cus_house=%s, cus_vill=%s, cus_sub=%s, cus_area=%s, cus_pro=%s, cus_pos=%s, cus_tle=%s WHERE cus_id=%s",
                       GetSQLValueString($_POST['cus_compan'], "text"),
                       GetSQLValueString($_POST['cus_hose'], "text"),
                       GetSQLValueString($_POST['cus_vill'], "int"),
                       GetSQLValueString($_POST['cus_sub'], "text"),
                       GetSQLValueString($_POST['cus_area'], "text"),
                       GetSQLValueString($_POST['cus_pro'], "text"),
                       GetSQLValueString($_POST['cus_pos'], "text"),
                       GetSQLValueString($_POST['cus_tle'], "text"),
                      //  GetSQLValueString($_POST['cus_tin'], "text"),
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
$totalRows_customer = mysql_num_rows($customer);
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>รายละเอียดข้อมูลลูกค้า</title>
    <link rel="stylesheet" href="css/custom.css" />
</head>

<body>
    <div class="container">
        <br />
        <?php if($_COOKIE["UserType"] == 2){?>
        <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#exampleModalCenter">
            แก้ไขข้อมูล
        </button>
        <?php } ?>
        <h2>รายละเอียดลูกค้า</h2>
        <br />
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <lable class="col-sm-2">รหัสลูกค้า: </lable>
                            <div class="col-sm-10">
                                <p><?php echo $row_customer['cus_id']; ?></p>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <lable class="col-sm-2">ชื่อบริษัท: </lable>
                            <div class="col-sm-10">
                                <p><?php echo $row_customer['cus_compan']; ?></p>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <lable class="col-sm-2">เบอร์โทรศัพท์: </lable>
                            <div class="col-sm-10">
                                <p><?php echo $row_customer['cus_tle']; ?></p>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <lable class="col-sm-2">ที่อยู่: </lable>
                            <div class="col-sm-10">
                                <p>เลขที่ <?php echo $row_customer['cus_house']; ?> หมู่
                                    <?php echo $row_customer['cus_vill']; ?>
                                    ต.<?php echo $row_customer['cus_sub']; ?> อ.<?php echo $row_customer['cus_area']; ?>
                                    จ.<?php echo $row_customer['cus_pro']; ?> <?php echo $row_customer['cus_pos']; ?>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลลูกค้า</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">

                            <div class="form-group row">
                                <lable for="cus_id" class="col-sm-2 col-form-label">รหัสลูกค้า :</lable>
                                <div class="col-sm-10">
                                    <input name="cus_id" type="text" class="form-control" id="cus_id"
                                        style="background-color:#CCC" value="<?php echo $row_customer['cus_id']; ?>"
                                        readonly />
                                </div>
                            </div>


                            <div class="form-group row">
                                <lable for="cus_id" class="col-sm-2 col-form-label">ชื่อบริษัท :</lable>
                                <div class="col-sm-4">
                                    <input name="cus_compan" type="text" class="form-control" id="cus_compan"
                                        value="<?php echo $row_customer['cus_compan']; ?>" />
                                </div>


                                <lable for="cus_id" class="col-sm-2 col-form-label">เบอร์โทรศัพท์ :</lable>
                                <div class="col-sm-4">
                                    <input name="cus_tle" type="text" class="form-control" id="cus_tle"
                                        value="<?php echo $row_customer['cus_tle']; ?>" maxlength="10" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <lable class="col-sm-2 col-form-label">ที่อยู่ :</lable>

                            </div>
                            <div class="form-group row">
                                <lable for="cus_id" class="col-sm-2 col-form-label">บ้านเลขที่:</lable>
                                <div class="col-sm-2">
                                    <input name="cus_hose" type="text" class="form-control" id="cus_hose"
                                        value="<?php echo $row_customer['cus_house']; ?>" />
                                </div>

                                <lable for="cus_id" class="col-sm-1 col-form-label">หมู่ที่:</lable>
                                <div class="col-sm-2">
                                    <input name="cus_vill" type="text" class="form-control" id="cus_vill"
                                        value="<?php echo $row_customer['cus_vill']; ?>" />
                                </div>

                                <lable for="cus_id" class="col-sm-1 col-form-label">ตำบล:</lable>
                                <div class="col-sm-4">
                                    <input name="cus_sub" type="text" class="form-control" id="cus_sub"
                                        value="<?php echo $row_customer['cus_sub']; ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <lable for="cus_id" class="col-sm-2 col-form-label">อำเภอ :</lable>

                                <div class="col-sm-4">
                                    <select name="cus_area" class="form-control" id="cus_area">
                                        <option value="<?php echo $row_customer['cus_area']; ?>" selected="selected">
                                            <?php echo $row_customer['cus_area']; ?>
                                        </option>
                                        <option value="เมือง"> เมือง
                                        </option>
                                        <option value="บางระกำ">บางระกำ
                                        </option>
                                        <option value="บางกระทุ่ม">
                                            บางกระทุ่ม
                                        </option>
                                        <option value="นครไทย">นครไทย
                                        </option>
                                        <option value="ชาติตระการ">
                                            ชาติตระการ
                                        </option>
                                        <option value="พรหมพิราม">พรหมพิราม
                                        </option>
                                        <option value="วังทอง">วังทอง
                                        </option>
                                        <option value="เนินมะปราง">
                                            เนินมะปราง
                                        </option>
                                        <option value="วัดโบสถ์">วัดโบสถ์
                                        </option>
                                        <option value="อื่นๆ">อื่นๆ</option>
                                    </select>
                                </div>

                                <lable for="cus_id" class="col-sm-2 col-form-label">จังหวัด :</lable>
                                <div class="col-sm-4">
                                    <select name="cus_pro" class="form-control" id="cus_pro">
                                        <option value="<?php echo $row_customer['cus_pro']; ?>" selected="selected">
                                            <?php echo $row_customer['cus_pro']; ?>
                                        </option>
                                        <option value="กรุงเทพมหานคร">
                                            กรุงเทพมหานคร
                                        </option>
                                        <option value="กระบี่">กระบี่
                                        </option>
                                        <option value="กาญจนบุรี">กาญจนบุรี
                                        </option>
                                        <option value="กาฬสินธุ์">กาฬสินธุ์
                                        </option>
                                        <option value="กำแพงเพชร">กำแพงเพชร
                                        </option>
                                        <option value="ขอนแก่น">ขอนแก่น
                                        </option>
                                        <option value="จันทบุรี">จันทบุรี
                                        </option>
                                        <option value="ฉะเชิงเทรา">
                                            ฉะเชิงเทรา
                                        </option>
                                        <option value="ชัยนาท">ชัยนาท
                                        </option>
                                        <option value="ชัยภูมิ">ชัยภูมิ
                                        </option>
                                        <option value="ชุมพร">ชุมพร
                                        </option>
                                        <option value="ชลบุรี">ชลบุรี
                                        </option>
                                        <option value="เชียงใหม่">เชียงใหม่
                                        </option>
                                        <option value="เชียงราย">เชียงราย
                                        </option>
                                        <option value="ตรัง">ตรัง </option>
                                        <option value="ตราด">ตราด </option>
                                        <option value="ตาก">ตาก </option>
                                        <option value="นครนายก">นครนายก
                                        </option>
                                        <option value="นครปฐม">นครปฐม
                                        </option>
                                        <option value="นครพนม">นครพนม
                                        </option>
                                        <option value="นครราชสีมา">
                                            นครราชสีมา
                                        </option>
                                        <option value="นครศรีธรรมราช">
                                            นครศรีธรรมราช
                                        </option>
                                        <option value="นครสวรรค์">นครสวรรค์
                                        </option>
                                        <option value="นราธิวาส">นราธิวาส
                                        </option>
                                        <option value="น่าน">น่าน </option>
                                        <option value="นนทบุรี">นนทบุรี
                                        </option>
                                        <option value="บึงกาฬ">บึงกาฬ
                                        </option>
                                        <option value="บุรีรัมย์">บุรีรัมย์
                                        </option>
                                        <option value="ประจวบคีรีขันธ์">
                                            ประจวบคีรีขันธ์
                                        </option>
                                        <option value="ปทุมธานี">ปทุมธานี
                                        </option>
                                        <option value="ปราจีนบุรี">
                                            ปราจีนบุรี
                                        </option>
                                        <option value="ปัตตานี">ปัตตานี
                                        </option>
                                        <option value="พะเยา">พะเยา
                                        </option>
                                        <option value="พระนครศรีอยุธยา">
                                            พระนครศรีอยุธยา
                                        </option>
                                        <option value="พังงา">พังงา
                                        </option>
                                        <option value="พิจิตร">พิจิตร
                                        </option>
                                        <option value="พิษณุโลก">พิษณุโลก
                                        </option>
                                        <option value="เพชรบุรี">เพชรบุรี
                                        </option>
                                        <option value="เพชรบูรณ์">เพชรบูรณ์
                                        </option>
                                        <option value="แพร่">แพร่ </option>
                                        <option value="พัทลุง">พัทลุง
                                        </option>
                                        <option value="ภูเก็ต">ภูเก็ต
                                        </option>
                                        <option value="มหาสารคาม">มหาสารคาม
                                        </option>
                                        <option value="มุกดาหาร">มุกดาหาร
                                        </option>
                                        <option value="แม่ฮ่องสอน">
                                            แม่ฮ่องสอน
                                        </option>
                                        <option value="ยโสธร">ยโสธร
                                        </option>
                                        <option value="ยะลา">ยะลา </option>
                                        <option value="ร้อยเอ็ด">ร้อยเอ็ด
                                        </option>
                                        <option value="ระนอง">ระนอง
                                        </option>
                                        <option value="ระยอง">ระยอง
                                        </option>
                                        <option value="ราชบุรี">ราชบุรี
                                        </option>
                                        <option value="ลพบุรี">ลพบุรี
                                        </option>
                                        <option value="ลำปาง">ลำปาง
                                        </option>
                                        <option value="ลำพูน">ลำพูน
                                        </option>
                                        <option value="เลย">เลย </option>
                                        <option value="ศรีสะเกษ">ศรีสะเกษ
                                        </option>
                                        <option value="สกลนคร">สกลนคร
                                        </option>
                                        <option value="สงขลา">สงขลา
                                        </option>
                                        <option value="สมุทรสาคร">สมุทรสาคร
                                        </option>
                                        <option value="สมุทรปราการ">
                                            สมุทรปราการ
                                        </option>
                                        <option value="สมุทรสงคราม">
                                            สมุทรสงคราม
                                        </option>
                                        <option value="สระแก้ว">สระแก้ว
                                        </option>
                                        <option value="สระบุรี">สระบุรี
                                        </option>
                                        <option value="สิงห์บุรี">สิงห์บุรี
                                        </option>
                                        <option value="สุโขทัย">สุโขทัย
                                        </option>
                                        <option value="สุพรรณบุรี">
                                            สุพรรณบุรี
                                        </option>
                                        <option value="สุราษฎร์ธานี">
                                            สุราษฎร์ธานี
                                        </option>
                                        <option value="สุรินทร์">สุรินทร์
                                        </option>
                                        <option value="สตูล">สตูล </option>
                                        <option value="หนองคาย">หนองคาย
                                        </option>
                                        <option value="หนองบัวลำภู">
                                            หนองบัวลำภู
                                        </option>
                                        <option value="อำนาจเจริญ">
                                            อำนาจเจริญ
                                        </option>
                                        <option value="อุดรธานี">อุดรธานี
                                        </option>
                                        <option value="อุตรดิตถ์">อุตรดิตถ์
                                        </option>
                                        <option value="อุทัยธานี">อุทัยธานี
                                        </option>
                                        <option value="อุบลราชธานี">
                                            อุบลราชธานี
                                        </option>
                                        <option value="อ่างทอง">อ่างทอง
                                        </option>
                                        <option value="อื่นๆ">อื่นๆ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <lable for="cus_id" class="col-sm-2 col-form-label">รหัสไปรษณีย์ :</lable>
                                <div class="col-sm-4">
                                    <input name="cus_pos" type="text" class="form-control" id="cus_pos"
                                        value="<?php echo $row_customer['cus_pos']; ?>" />
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                <input name="cus_bt" type="submit" class="btn btn-primary " id="cus_bt"
                                    value="บันทึกข้อมูลลูกค้า" />
                            </div>


                            <input type="hidden" name="MM_update" value="form1" />

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
mysql_free_result($customer);
?>