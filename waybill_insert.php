<?php require_once('nevbar.php');
Nevbar(); ?>
<?php require_once('Connections/myconnect.php'); ?>
<?php require_once('upload.php'); ?>



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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_waybill (wb_id, wb_nbook, wb_date, wb_money, wb_nber, customer_id) VALUES ( %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['wb_id'], "int"),
                       GetSQLValueString($_POST['wb_nbook'], "text"),
                       GetSQLValueString($_POST['wb_date'], "text"),
                       GetSQLValueString($_POST['wb_money'], "double"),
                      //  GetSQLValueString($_POST['wb_payment'], "text"),
                       GetSQLValueString($_POST['wb_nber'], "text"),
					             GetSQLValueString($_POST['cus_compan'], "text"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());

  $id = mysql_insert_id();
  $id_SET = sprintf('B-%04d', $id);
  
  $path="./picture/";
  $last = strtolower(end(explode('.',$_FILES['wb_img']['name'])));
	$name = $id_SET.'.'.$last;
  Upload($_FILES['wb_img'],$path.$name);

  $insertSQL1 = sprintf("UPDATE tb_waybill SET wb_id_set=%s, wb_img=%s WHERE wb_id=%s",
                    GetSQLValueString($id_SET,"text"),
                    GetSQLValueString($name,"text"),
                    GetSQLValueString($id,"text"));
  mysql_select_db($database_myconnect, $myconnect);
  $Result2 = mysql_query($insertSQL1, $myconnect) or die(mysql_error());

  $insertGoTo = "waybill_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
  // echo "<script>window.location.herf='/waybill_show.php'</script>";
}


mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill";
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());
$row_waybill = mysql_fetch_assoc($waybill);
$totalRows_waybill = mysql_num_rows($waybill);mysql_select_db($database_myconnect, $myconnect);

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
<title>เพิ่มใบรับ-ส่งสินค้า</title>
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
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="2"><div align="center">
      <h2>เพิ่มใบรับสินค้า</h2>
      <h3>(ที่มาจากกรุงเทพฯ)</h3>
    </div></td>
  </tr>
  <tr>
    <td height="22" colspan="2">
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
    <!-- <form action="upload.php" method="post" enctype="multipart/form-data"> -->
        <div align="center">
          <table width="525" border="1">
            <tr>
              <td bgcolor="#FFFFFF"><table width="519" align="center">
                <!-- <tr valign="baseline">
                  <td nowrap="nowrap" align="right">No:</td>
                  <td><input name="wb_id" type="text" id="wb_id" style="background-color:#CCC" value="" size="15" readonly="readonly" /></td>
                  </tr> -->
                <!-- <tr valign="baseline">
                  <td nowrap="nowrap" align="right">รหัสใบส่งของ:</td>
                  <td><label for="customer_id"></label>
                    <input name="customer_id" type="text" id="customer_id" size="15" /></td>
                </tr> -->
                <tr valign="baseline">
                <td nowrap="nowrap" align="right">รหัสใบส่งของ:</td>
                <td><input name="wb_id_set" type="text" readonly="readonly" id="wb_id" value="" size="20" style="background-color:#CCC" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">เลขที่ใบรับส่งสินค้า:</td>
                  <td><input name="wb_nber" type="text" id="wb_nber" value="" size="20" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">เล่มที่:</td>
                  <td><input name="wb_nbook" type="text"  id="wb_nbook" value="" size="20" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">ชื่อบริษัท:</td>
                  <td>
                  <label for="cus_compan"></label>
                  
                    <select name="cus_compan" id="cus_compan">
                        <option selected disabled hidden>--กรุณาเลือก--</option>
                     <?php while($row_customer = mysql_fetch_array($customer)) { ?>
                       <option value=<?php echo $row_customer["cus_id"]; ?>><?php echo $row_customer["cus_compan"]; ?></option>
                     <? } ?>
                    </select>
                    
                    </td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">วันที่ตามใบเสร็จ:</td>
                  <td>
                  <!-- <?php echo date('d/m/Y');?> -->
                  
                  <input type="date" name="wb_date" value="<?php echo date('d/m/Y');?>" size="20" /></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">ยอดเงินค่าขนส่ง:</td>
                  <td><input type="text" name="wb_money" value="" size="25" /></td>
                  </tr>
                <tr valign="baseline">
                  <!-- <td nowrap="nowrap" align="right">สถานะการชำระเงิน:</td>
                  <td>
                  <!-- <label for="wb_payment"></label> -->
                    <!-- <select name="wb_payment" id="wb_payment"> -->
                    <!-- <input type="radio" name="wb_payment" value="ยังไม่ได้ชำระ">ยังไม่ได้ชำระ
                    <input type="radio" name="wb_payment" value="ชำระแล้ว">ชำระแล้ว -->
                      <!-- <option selected disabled hidden>--กรุณาเลือก--</option> -->
                      <!-- <option value="ยังไม่ได้ชำระ">ยังไม่ได้ชำระ</option> -->
                      <!-- <option value="ชำระแล้ว">ชำระแล้ว</option> -->
                    </select></td>
                  </tr>
                <tr valign="baseline">
                  <td nowrap="nowrap" align="right">รูปภาพ:</td>
                  <td><input type="file" name="wb_img" value="" size="32" /></td>
                  </tr>
                <tr valign="baseline">
                  <td colspan="2" align="right" nowrap="nowrap"><div align="center">
                    <input type="submit" value="เพิ่มข้อมูล" />
                  </div></td>
                  </tr>
                </table>
              <div align="center"></div></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
        </div>
      </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td height="27" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($waybill);
?>
