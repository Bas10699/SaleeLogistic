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
A:hover {COLOR: #FFFF00; TEXT-DECORATION: underline}
.ตัวหนังสือ {
	font-size: 19px;
	color: #000;
}
.หัวข้อใหญ่ {
	font-size: 22px;
	color: #FFF;
}
</STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลพนักงาน</title>
<style type="text/css">
#form1 div table tr td div table tr td {
	color: #000;
}
#form1 div table tr td div table tr td div table tr td {
	color: #FFF;
}
#form1 div table tr td div table {
	font-size: 16px;
}
#form1 div table tr td div table tr td table tr td {
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
}
</style>
<script type="text/javascript">
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
</script>
</head>

<body>
<table width="100%" height="628" align="center">
  <tr>
    <td height="32" bgcolor="#000033"><img src="img/logodaichuar2.png" alt="" width="207" height="199" /></td>
  </tr>
  <tr>
    <td height="29" bgcolor="#000033"><table width="100%">
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
    <td height="29">&nbsp;</td>
  </tr>
  <tr>
    <td height="29">&nbsp;</td>
  </tr>
  <tr>
    <td height="45"><div align="center">
      <h2>ข้อมูลพนักงาน</h2>
    </div></td>
  </tr>
  <tr>
    <td height="43"><div align="right">
      <table width="159" border="1">
        <tr>
          <td width="108" bgcolor="#660033"><div align="center"><a href="staff_insert.php">เพิ่มข้อมูลพนักงาน</a></div></td>
          </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="169"><div align="center">
      <form id="form1" name="form1" method="post" action="">
      <div align="center">
          <table width="1036">
            <tr>
              <td><div align="left">
                <table width="1312" height="84">
                  <tr bgcolor="#339966" class="หัวข้อใหญ่">
                    <td width="169" bgcolor="#000033"><table width="169">
                      <tr>
                        <td bgcolor="#000033"><div align="center" class="หัวหน้าแสดง">รหัสพนักงาน</div></td>
                      </tr>
                    </table></td>
                    <td width="207" height="46" bgcolor="#000033"><div align="center">
                      <table width="169">
                        <tr>
                          <td bgcolor="#000033"><div align="center" class="หัวหน้าแสดง">เลขบัตรประชาชน</div></td>
                          </tr>
                        </table>
                    </div></td>
                    <td width="163" bgcolor="#000033"><div align="center">
                      <table width="135">
                        <tr>
                          <td bgcolor="#000033"><div align="center" class="หัวหน้าแสดง">ชื่อ</div></td>
                          </tr>
                      </table>
                    </div></td>
                    <td width="200" bgcolor="#000033">
                      <div align="center">
                        <table width="100">
                          <tr>
                            <td><div align="center" class="หัวหน้าแสดง">นามสกุล</div></td>
                            </tr>
                        </table>
                      </div>
                    </td>
                    <td width="154" bgcolor="#000033"><div align="center">
                      <table width="100">
                        <tr>
                          <td bgcolor="#000033"><div align="center" class="หัวหน้าแสดง">ตำแแหน่ง</div></td>
                          </tr>
                      </table>
                    </div></td>
                    <td width="204" bgcolor="#000033"><div align="center">
                      <table width="152" height="33">
                        <tr>
                          <td bgcolor="#000033"><div align="center" class="หัวหน้าแสดง">เบอร์โทรศัพท์</div></td>
                          </tr>
                      </table>
                    </div></td>
                    <td colspan="2" bgcolor="#000033"><div align="center">
                      <table width="146" height="31">
                        <tr>
                          <td><div align="center" class="หัวหน้าแสดง">จัดการ</div></td>
                          </tr>
                      </table>
                    </div></td>
                    </tr>
                  <?php do { ?>
                    <tr>
                      <td><div align="center"><span class="ตัวหนังสือ"><?php echo $row_staff['staff_id_set']; ?></span></div></td>
                      <td height="30"><div align="center" class="ตัวหนังสือ"><?php echo $row_staff['staff_card']; ?></div></td>
                      <td><div align="left" class="ตัวหนังสือ"><?php echo $row_staff['staff_name']; ?></div></td>
                      <td><div align="left" class="ตัวหนังสือ"><?php echo $row_staff['staff_lastname']; ?></div></td>
                      <td><div align="center" class="ตัวหนังสือ"><?php echo $row_staff['staff_position']; ?></div></td>
                      <td><div align="center" class="ตัวหนังสือ"><?php echo $row_staff['staff_tel']; ?></div></td>
                      <td width="99" bgcolor="#006600"><div align="center" class="สำหรับลิงค์"><a href="staff_edit.php<?php echo $row_staff['']; ?>?id=<?php echo $row_staff['staff_id']; ?>">แก้ไข</a></div></td>
                      <td width="80" bgcolor="#990000"><div align="center" class="สำหรับลิงค์"><a href="staff_del.php?id=<?php echo $row_staff['staff_id']; ?>?staff_id=<?php echo $row_staff['staff_id']; ?>" onclick="MM_popupMsg('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a></div></td>
                      </tr>
                    <?php } while ($row_staff = mysql_fetch_assoc($staff)); ?>
                  </table>
                <div align="center"></div>
                </div></td>
              </tr>
        </table>
      </div>
        <p>&nbsp;</p>
      </form>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($staff);
?>