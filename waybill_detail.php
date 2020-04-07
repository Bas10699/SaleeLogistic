<?php require_once('nevbar.php');
Nevbar(); ?>

<?php require_once('Connections/myconnect.php'); ?>
<?php require_once('waybill_edit.php'); ?>



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
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>รายละเอียดใบรับ-ส่งสินค้า</title>
    <link rel="stylesheet" href="css/custom.css" />
</head>

<body>
    <div class="container">
        <br />
        <h2>รายละเอียดใบรับสินค้า</h2>
        <br />
        <div id="hide">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="picture/<?php echo $row_waybill['wb_img']."?v=".date("YmdHis"); ?>"
                                        class="img-fluid" width="460" height="345">
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <lable class="col-sm-3">รหัสใบส่งของ:</lable>
                                        <div class="col-sm-9">
                                            <b><?php echo $row_waybill['wb_id_set']; ?></b>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <lable class="col-sm-3">เลขที่ใบรับส่งสินค้า:</lable>
                                        <div class="col-sm-9">
                                            <b><?php echo $row_waybill['wb_nber']; ?></b>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <lable class="col-sm-3">เล่มที่:</lable>
                                        <div class="col-sm-9">
                                            <b><?php echo $row_waybill['wb_nbook']; ?></b>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <lable class="col-sm-3">ชื่อบริษัท:</lable>
                                        <div class="col-sm-9">
                                            <b><?php echo $row_waybill['cus_compan']; ?></b>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <lable class="col-sm-3">วันที่:</lable>
                                        <div class="col-sm-9">
                                            <b><?php echo date('d/m/Y');?></b>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <lable class="col-sm-3">ยอดเงินค่าขนส่ง:</lable>
                                        <div class="col-sm-9">
                                            <b><?php echo $row_waybill['wb_money']; ?></b>
                                        </div>
                                    </div>
                                    <hr />
                                    <tr valign="baseline">
                                        <td colspan="2" align="right" nowrap="nowrap">
                                            <div align="center">

                                            </div>
                                        </td>
                                    </tr>

                                    <br />
                                    <div class="float-right">
                                        <?php if($_COOKIE["UserType"] == 2){?>
                                        <button class="btn btn-warning" onclick="editdata()">แก้ไขข้อมูล</button>
                                        <?php } ?>
                                        <button class="btn "
                                            onclick="window.location.href='waybill_show.php'">ย้อนกลับ</button>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
        <div id='show' style="display:none;">
            <?php Editdata($row_waybill,$customer); ?>
            <!-- <button onclick="editdata()">ยกเลิก</button> -->
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
</body>

</html>