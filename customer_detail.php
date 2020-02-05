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
  $updateSQL = sprintf("UPDATE tb_customer SET cus_compan=%s, cus_house=%s, cus_vill=%s, cus_sub=%s, cus_area=%s, cus_pro=%s, cus_pos=%s, cus_tle=%s, cus_tin=%s WHERE cus_id=%s",
                       GetSQLValueString($_POST['cus_compan'], "text"),
                       GetSQLValueString($_POST['cus_hose'], "text"),
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>รายละเอียดข้อมูลลูกค้า</title>

</head>

<body>
<table width="100%" height="477" align="center">
 
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="3"><div align="center">
      <h2>รายละเอียดลูกค้า</h2>
    </div></td>
  </tr>
  <tr>
    <td height="27" colspan="3"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <div align="center">
        <table width="642" border="1">
          <tr>
            <td ><table width="623">
              <tr>
                <td width="202"  class="ตัวหนังสือสีขาว"><div align="left">รหัสลูกค้า :</div></td>
                <td ><input name="cus_id" type="text" class="ตัวหนังสือสีดำ" id="cus_id" style="background-color:#CCC" value="<?php echo $row_customer['cus_id']; ?>" size="10" readonly="readonly" />
                  <span class="ไม่สามารถแก้ไข">                  *ไม่สามารถแก้ไขได้</span></td>
              </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="left">เลขประจำตัวผู้เสียภาษี :</div></td>
                <td ><input name="cus_tin" type="text" class="ตัวหนังสือสีดำ" id="cus_tin" value="<?php echo $row_customer['cus_tin']; ?>" maxlength="13" /></td>
              </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="left">ชื่อบริษัท :</div></td>
                <td ><input name="cus_compan" type="text" class="ตัวหนังสือสีดำ" id="cus_compan" value="<?php echo $row_customer['cus_compan']; ?>" /></td>
              </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="left">เบอร์โทรศัพท์ :</div></td>
                <td ><input name="cus_tle" type="text" class="ตัวหนังสือสีดำ" id="cus_tle" value="<?php echo $row_customer['cus_tle']; ?>" maxlength="10" /></td>
              </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="left">ที่อยู่ :</div></td>
                <td >&nbsp;</td>
                </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="right">บ้านเลขที่ :</div></td>
                <td width="409" ><input name="cus_hose" type="text" class="ตัวหนังสือสีดำ" id="cus_hose" value="<?php echo $row_customer['cus_house']; ?>" /></td>
                </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="right">หมู่ที่ :</div></td>
                <td ><input name="cus_vill" type="text" class="ตัวหนังสือสีดำ" id="cus_vill" value="<?php echo $row_customer['cus_vill']; ?>" /></td>
                </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="right">ตำบล :</div></td>
                <td ><input name="cus_sub" type="text" class="ตัวหนังสือสีดำ" id="cus_sub" value="<?php echo $row_customer['cus_sub']; ?>" /></td>
                </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="right">อำเภอ : </div></td>
                <td ><p>
                  <label for="cus_area"></label>
                  <input name="cus_area" type="text" class="ตัวหนังสือสีดำ" id="cus_area" value="<?php echo $row_customer['cus_area']; ?>" readonly="readonly" />
                  </p>
                  <p>
                    <select name="cus_area" class="ตัวหนังสือสีดำ" id="cus_area">
                      <option value="<?php echo $row_customer['cus_area']; ?>" selected="selected">--------- เลือกอำเภอ ---------</option>
                      <option value="เมือง"> เมือง </option>
                      <option value="บางระกำ">บางระกำ</option>
                      <option value="บางกระทุ่ม">บางกระทุ่ม </option>
                      <option value="นครไทย">นครไทย </option>
                      <option value="ชาติตระการ">ชาติตระการ </option>
                      <option value="พรหมพิราม">พรหมพิราม </option>
                      <option value="วังทอง">วังทอง</option>
                      <option value="เนินมะปราง">เนินมะปราง</option>
                      <option value="วัดโบสถ์">วัดโบสถ์ </option>
                      <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                    <span class="มีไว้แก้ไข">*มีไว้สำหรับแก้ไข</span></p></td>
                </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="right">จังหวัด :</div></td>
                <td ><p>
                  <input name="cus_pro" type="text" class="ตัวหนังสือสีดำ" id="cus_pro" value="<?php echo $row_customer['cus_pro']; ?>" readonly="readonly" />
                  </p>
                  <p>
                    <select name="cus_pro" class="ตัวหนังสือสีดำ" id="cus_pro">
                      <option value="<?php echo $row_customer['cus_pro']; ?>" selected="selected">--------- เลือกจังหวัด ---------</option>
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
                      </select>
                    <span class="มีไว้แก้ไข">*มีไว้สำหรับแก้ไข</span></p></td>
                </tr>
              <tr>
                <td  class="ตัวหนังสือสีขาว"><div align="right">รหัสไปรษณีย์ :</div></td>
                <td ><input name="cus_pos" type="text" class="ตัวหนังสือสีดำ" id="cus_pos" value="<?php echo $row_customer['cus_pos']; ?>" /></td>
                </tr>
              <tr>
                <td ><table width="100%">
                  <tr>
                    <td><div align="center">
                    <button><a href="customer_show.php" class="ฟอน">ย้อนกลับ</a></button></div></td>
                  </tr>
                </table></td>
                <td ><div align="left">
                  <input name="cus_bt" type="submit" class="ตัวหนังสือสีดำ" id="cus_bt" value="บันทึกข้อมูลลูกค้า" />
                </div></td>
                </tr>
            </table></td>
          </tr>
        </table>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
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
mysql_free_result($customer);
?>
