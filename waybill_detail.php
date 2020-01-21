<?php require_once('Connections/myconnect.php'); ?>
<?php require_once('waybill_edit.php'); ?>

<?php require_once('nevbar.php');
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



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_waybill SET wb_nbook=%s, wb_date=%s, wb_money=%s, wb_payment=%s, wb_img=%s, wb_nber=%s WHERE wb_id=%s",
                       GetSQLValueString($_POST['wb_nbook'], "text"),
                       GetSQLValueString($_POST['wb_date'], "text"),
                       GetSQLValueString($_POST['wb_money'], "double"),
                       GetSQLValueString($_POST['wb_payment'], "text"),
                       GetSQLValueString($_POST['wb_img'], "text"),
                       GetSQLValueString($_POST['wb_nber'], "text"),
                       GetSQLValueString($_POST['wb_id'], "int"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($updateSQL, $myconnect) or die(mysql_error());

  // $updateGoTo = "waybill_show.php";
  // if (isset($_SERVER['QUERY_STRING'])) {
  //   $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
  //   $updateGoTo .= $_SERVER['QUERY_STRING'];
  // }
  // header(sprintf("Location: %s", $updateGoTo));
}

$colname_waybill = "-1";
if (isset($_GET['wb_id'])) {
  $colname_waybill = $_GET['wb_id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_waybill = sprintf("SELECT * FROM tb_waybill LEFT JOIN tb_customer ON tb_waybill.customer_id=tb_customer.cus_id WHERE wb_id = %s", GetSQLValueString($colname_waybill, "int"));
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());
$row_waybill = mysql_fetch_assoc($waybill);
$colname_waybill = "-1";
if (isset($_GET['id'])) {
  $colname_waybill = $_GET['id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_waybill = sprintf("SELECT * FROM tb_waybill LEFT JOIN tb_customer ON tb_waybill.customer_id=tb_customer.cus_id WHERE wb_id = %s", GetSQLValueString($colname_waybill, "int"));
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());
$row_waybill = mysql_fetch_assoc($waybill);
$totalRows_waybill = mysql_num_rows($waybill);

$query_customer = "SELECT cus_id ,cus_compan FROM tb_customer";
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<STYLE type=text/css>
A:link {COLOR: #FFFFFF; TEXT-DECORATION: none}
A:visited {COLOR: #FFFF00; TEXT-DECORATION: none}
A:hover {
	COLOR: #FFFFFF;
	TEXT-DECORATION: none
}
</STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายละเอียดใบส่งของ</title>
<style type="text/css">
.หัวข้อ {
	font-family: "angsana New";
	font-size: 30px;
	color: #FF0;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body>
<table width="100%" height="477" align="center">
  
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
 
  <tr>
    <td height="22" colspan="6"><h2 align="center">รายละเอียดใบส่งของ</h2></td>
  </tr>
  <tr>
    <td height="27" colspan="6">
    <!-- <form method="POST" name="form1" id="form1" action="<?php echo $editFormAction; ?>"> -->
      <div align="center">
      <div id="hide">
        <table  width="525" border="1">
    
            <td><table width="519" align="center">
            <div align="center">
             <img src="picture/<?php echo $row_waybill['wb_img']; ?>" width="100" height="150"/>
            </div> 
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">รหัสใบส่งของ:</td>
                <td><?php echo $row_waybill['wb_id_set']; ?></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">เลขที่ใบส่งของ:</td>
                <td><?php echo $row_waybill['wb_nber']; ?></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">เลมที่:</td>
                <td><?php echo $row_waybill['wb_nbook']; ?></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">ชื่อบริษัท:</td>
                <td><?php echo $row_waybill['cus_compan']; ?></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">วันที่:</td>
                <td><?php echo date('d/m/Y');?></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">จำนวนเงินทั้งสิ้น:</td>
                <td><?php echo $row_waybill['wb_money']; ?></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">สถานะการชำระเงิน:</td>
                <td><?php echo $row_waybill['wb_payment']; ?></td>
              </tr>
              <!-- <tr valign="baseline">
                <td nowrap="nowrap" align="right">รูปภาพ:</td>
                <td><input type="file" name="wb_img" value="" size="32" /></td>
              </tr> -->
              <tr valign="baseline">
                <td colspan="2" align="right" nowrap="nowrap"><div align="center">
                
                </div>
                </td>
              </tr>
            </table>
              <div align="center"></div></td>
          </tr>
          </tr>
        </table>
        <br/>
        <button onclick="editdata()">แก้ไขข้อมูล</button>
        <button onclick="window.location.href='waybill_show.php'">ย้อนกลับ</button>
        </div>
        <br/>
        <div id='show' style="display:none;"  >
        <?php Editdata($row_waybill,$customer); ?>
        <button onclick="editdata()">ยกเลิก</button>
        </div>
        
        
                    <script>
                        function editdata() {
                          var hide = document.getElementById("hide");
                               if (hide.style.display === "none") {
                                hide.style.display = "block";
                               } else {
                                hide.style.display = "none";
                               }
                           var show = document.getElementById("show");
                            if (show.style.display === "none") {
                              show.style.display = "block";
                           } else {
                            show.style.display = "none";
                            }
                        
                        }
                    </script>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
    <!-- </form> -->
    </td>
  </tr>
  <tr>
    <td colspan="6"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>