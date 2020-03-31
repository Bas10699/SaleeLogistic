<?php require_once('nevbar.php');
Nevbar(); ?>

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

$colname_customer = "-1";
if (isset($_GET['cus_id'])) {
  $colname_customer = $_GET['cus_id'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_customer = sprintf("SELECT * FROM tb_customer WHERE cus_id = %s ", GetSQLValueString($colname_customer, "int"));
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);
$query_customer = "SELECT * FROM tb_customer";
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);

if($_GET["textfield"] != ""){
    mysql_select_db($database_myconnect, $myconnect);
    $query_customer = "SELECT * FROM tb_customer  
    WHERE customer_id LIKE '%".$_GET["textfield"]."%'
    or cus_tin LIKE '%".$_GET["textfield"]."%'
    or cus_compan LIKE '%".$_GET["textfield"]."%'
    or cus_tle LIKE '%".$_GET["textfield"]."%'";
    $customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
    $row_customer = mysql_fetch_assoc($customer);
    $totalRows_customer = mysql_num_rows($customer);
  
}
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ข้อมูลลูกค้า</title>
    <link rel="stylesheet" href="css/custom.css" />

</head>

<body>
    <div class="container">
        <br />
        <h2>ข้อมูลลูกค้า</h2>
        <br/>
        <div class="row">
            <div class="col-sm-8">
                <form id="form2" name="form2" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                    <input type="text" name="textfield" id="textfield" />
                    <button type="submit"><i class="fa fa-search"></i></button>

                </form>
            </div>
            <div class="col-sm-4 ">
                <div class="float-right"><a class="btn btn-info" href="customer_insert.php">เพิ่มข้อมูลลูกค้า</a></div>
            </div>
        </div>
        <br />
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            <div align="center">รหัสลูกค้า</div>
                        </th>
                        <th>
                            <div align="center">เลขประจำตัวผู้เสียภาษี</div>
                        </th>
                        <th>ชื่อบริษัท</th>

                        <th>เบอร์โทรศัพท์</th>
                        <th>
                            <div align="center">จัดการ</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php do { ?>
                    <tr>
                        <td class="ตัวอักษร" align="center"><?php echo $row_customer['customer_id']; ?></td>
                        <td height="35">
                            <div align="center" class="ตัวอักษร"><?php echo $row_customer['cus_tin']; ?></div>
                        </td>
                        <td class="ตัวอักษร"><?php echo $row_customer['cus_compan']; ?></td>
                        <td class="ตัวอักษร"><?php echo $row_customer['cus_tle']; ?></td>
                        <td align="center">
                            <a class="btn btn-warning btn-sm" role="button"
                                href="customer_detail.php?id=<?php echo $row_customer['cus_id']; ?>">ดูรายละเอียด</a>

                            <a class="btn btn-danger btn-sm" role="button"
                                href="customer_del.php?id=<?php echo $row_customer['cus_id']; ?>"
                                onclick="return confirm('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a>
                        </td>
                    </tr>
                    <?php } while ($row_customer = mysql_fetch_assoc($customer)); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<?php
mysql_free_result($customer);
?>