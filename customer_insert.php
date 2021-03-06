
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

// $editFormAction = $_SERVER['PHP_SELF'];
// if (isset($_SERVER['QUERY_STRING'])) {
//   $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
// }

// if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_customer (  cus_compan, cus_house, cus_vill, cus_sub, cus_area, cus_pro, cus_pos, cus_tle) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cus_compan'], "text"),
                       GetSQLValueString($_POST['cus_hose'], "text"),
                       GetSQLValueString($_POST['cus_vill'], "text"),
                       GetSQLValueString($_POST['cus_sub'], "text"),
                       GetSQLValueString($_POST['cus_area'], "text"),
                       GetSQLValueString($_POST['cus_pro'], "text"),
                       GetSQLValueString($_POST['cus_pos'], "text"),
                       GetSQLValueString($_POST['cus_tle'], "text"));
                      //  GetSQLValueString($_POST['cus_tin'], "text"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());

  
  $id = mysql_insert_id();
  $id_SET = sprintf('C-%04d', $id);
  $insertSQL1 = sprintf("UPDATE tb_customer SET customer_id=%s WHERE cus_id=%s",
                    GetSQLValueString($id_SET,"text"),
                    GetSQLValueString($id,"text"));
  mysql_select_db($database_myconnect, $myconnect);
  $Result2 = mysql_query($insertSQL1, $myconnect) or die(mysql_error());

  // $insertGoTo = "customer_show.php";
  // if (isset($_SERVER['QUERY_STRING'])) {
  //   $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
  //   $insertGoTo .= $_SERVER['QUERY_STRING'];
  // }
  // header("Location: customer_show.php");
  echo '<script type="text/javascript">
  window.location.href="customer_show.php"
  </script>';
// }

?>
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<STYLE type=text/css>
A:link {COLOR: #FFFFFF; TEXT-DECORATION: none}
A:visited {COLOR: #FFFF00; TEXT-DECORATION: none}
A:hover {COLOR: #FFFFFF; TEXT-DECORATION: underline}
</STYLE>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เพิ่มข้อมูลลูกค้า</title>

</head>

<body>
<table width="100%" height="579" align="center">
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <h2 align="center">เพิ่มข้อมูลลูกค้า</h2>
      <div align="center">
        <table width="774" border="1">
          <tr>
            <td width="712" ><table width="721" border="0" align="center">
              <tr>
                <td ><div align="left">ชื่อบริษัท :</div></td>
                <td ><input type="text" name="cus_compan" id="cus_compan" /></td>
                <td height="32" ><div align="left">เบอร์โทรศัพท์ :</div></td>
                <td ><label>
                  <input name="cus_tle" type="text" id="cus_tle" maxlength="10" />
                  </label></td>
                </tr>
              <tr>
                <td height="37" ><div align="left">บ้านเลขที่ :</div></td>
                <td ><input type="text" name="cus_hose" id="cus_hose" /></td>
                <td ><div align="left">หมู่ :</div></td>
                <td ><input type="text" name="cus_vill" id="cus_vill" /></td>
                </tr>
              <tr>
                <td height="34" ><div align="left">อำเภอ :</div></td>
                <td ><label>
                  <select name="cus_area" id="cus_area">
                  <option value="" selected="selected">------- กรุณาเลือกอำเภอ -------</option>
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
                  </label></td>
                <td ><div align="left">ตำบล :</div></td>
                <td ><input type="text" name="cus_sub" id="cus_sub" /></td>
                </tr>
              <tr>
                <td height="36" ><div align="left">จังหวัด :</div></td>
                <td ><select name="cus_pro" id="cus_pro">
                  <option value="" selected="selected">------- กรุณาเลือกจังหวัด -------</option>
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
                <td height="34" ><div align="left">รหัสไปรษณีย์ :</div></td>
                <td height="34" ><div align="left">
                  <input name="cus_pos" type="text" id="cus_pos" maxlength="5" />
                  </div></td>
                </tr>
              <tr>
                <td height="34" colspan="4" ><div align="center">
                  <input name="cus_bt" type="submit" id="cus_bt" onclick="MM_popupMsg('เพิ่มข้อมูลลูกค้าเรียบร้อยแล้ว')" value="บันทึกข้อมูลลูกค้า" />
                  </div></td>
                </tr>
              </table>
              <div align="center"></div></td>
            </tr>
        </table>
      </div>
      <p align="center">&nbsp;</p>
      <p>&nbsp;</p>
      <input type="hidden" name="MM_insert" value="form1" />
    </form></td>
  </tr>
  <tr>
    <td height="79" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html> -->
