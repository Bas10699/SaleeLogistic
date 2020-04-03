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


mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill 
LEFT JOIN tb_customer 
ON tb_waybill.customer_id = tb_customer.cus_id 
LEFT JOIN tb_car
ON tb_waybill.car_id = tb_car.car_id
WHERE tb_inv_status=0 and (tb_customer.cus_sub LIKE '%".$_GET["txtKeyword"]."%' or cus_compan LIKE '%".$_GET["txtKeyword"]."%' or tb_customer.cus_area LIKE '%".$_GET["txtKeyword"]."%' or wb_payment LIKE '%".$_GET["txtKeyword"]."%' )
ORDER BY wb_id";
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());

$query_carId = "SELECT * FROM tb_car";
$carId = mysql_query($query_carId, $myconnect) or die(mysql_error());

$query_staff = "SELECT * FROM tb_staff";
$staffId = mysql_query($query_staff, $myconnect) or die(mysql_error());

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>ใบส่งสินค้า</title>
    <link rel="stylesheet" href="css/custom.css" />

    <script>
    function validateForm() {
        var x = document.forms["myForm"]["car_id"].value;
        var y = document.forms["myForm"]["staff_id"].value;
        if (x === "กรุณาเลือกทะเบียนรถ") {
            alert("กรุณาเลือกทะเบียนรถ");
            return false;
        }
        if (y === "กรุณาเลือกพนักงานขับรถ") {
            alert("กรุณาเลือกพนักงานขับรถ");
            return false;
        }
    }
    </script>

</head>

<body>
    <div class="container">
        <br />
        <h2 align="center">ใบส่งสินค้า</h2>
        <div class="row">
            <div class="col-sm-6">

                <form name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                    <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $_GET["txtKeyword"];?>">
                    <button type="submit"><i class="fa fa-search"></i></button>

                    <!-- <label for="select2"></label>
                    <select name="dd_input" id="select2">
                        <option value="All">ทั้งหมด</option>
                        <option value="cus_compan">ชื่อบริษัท</option>
                        <option value="cus_sub">ตำบล</option>
                        <option value="wb_payment">ยังไม่ได้ชำระ</option>
                    </select> -->
                </form>
            </div>
            <div class="col-sm-6 ">
                <form name="myForm" action="waybill_insert_pdf.php" autocomplete="off" onsubmit="return validateForm()"
                    method="POST" enctype="multipart/form-data">


                    <select name="car_id" id="car_id">
                        <option selected disabled hidden>กรุณาเลือกทะเบียนรถ</option>
                        <?php while($row_carId = mysql_fetch_array($carId)) { ?>
                        <option value="<?php echo $row_carId['car_id']; ?>"> <?php echo $row_carId['car_register']; ?>
                        </option>
                        <? } ?>
                    </select>

                    <select name="staff_id" id="staff_id">
                        <option selected disabled hidden>กรุณาเลือกพนักงานขับรถ</option>
                        <?php while($row_staffId = mysql_fetch_array($staffId)) { ?>
                        <option value="<?php echo $row_staffId['staff_id']; ?>">
                            <?php echo $row_staffId['staff_title_name']; ?><?php echo $row_staffId['staff_name']; ?>
                            <?php echo $row_staffId['staff_lastname']; ?> </option>
                        <? } ?>
                    </select>

                    <button class="btn btn-info">ตรวจสอบใบส่งสินค้า</button>
            </div>
        </div>
        <br />
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            <div> </div>
                        </th>
                        <th>
                            <div align="center">รหัสใบรับสินค้า</div>
                        </th>
                        <th>
                            <div align="center">วันที่</div>
                        </th>
                        <th>
                            <div align="center">ชื่อบริษัท</div>
                        </th>
                        <th>
                            <div align="center">เลขที่ใบรับสินค้า</div>
                        </th>
                        <th>
                            <div align="center">อำเภอ</div>
                        </th>
                        <th>
                            <div align="center">ตำบล</div>
                        </th>
                        <th>
                            <div align="center">ยอดเงินค่าขนส่ง</div>
                        </th>
                        <!-- <th ><div align="center">สถานะการชำระเงิน</div></th> -->
                        <th>
                            <div align="center">จัดการ</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row_waybill = mysql_fetch_array($waybill)) { ?>
                    <tr>
                        <td><input type='checkbox' name='listData[]' value='<?php echo $row_waybill["wb_id"]; ?>'></td>
                        <td height="33">
                            <div align="center"><?php echo $row_waybill["wb_id_set"]; ?></div>
                        </td>
                        <td>
                            <div align="center">
                                <?php $date=date_create($row_waybill['wb_date']); echo date_format($date,"d/m/Y"); ?>
                        </td>
                        <td>
                            <div><?php echo $row_waybill['cus_compan']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['wb_nbook']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['cus_area']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['cus_sub']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['wb_money']; ?></div>
                        </td>
                        <!-- <td><div ><?php echo $row_waybill['wb_payment']; ?></td> -->

                        <td>
                            <div align="center">
                                <!-- <a class="buttondetail" href="waybill_detail.php?id=<?php echo $row_waybill['wb_id']; ?>" >รายละเอียด</a> -->
                                <a class="btn btn-danger btn-sm" role="button"
                                    href="waybill_del.php?id=<?php echo $row_waybill['wb_id']; ?>?staff_id=<?php echo $row_waybill['waybill_id']; ?>"
                                    onclick="return confirm('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a>
                        </td>

                    </tr>
                    <? } mysql_free_result($waybill); ?>
                </tbody>
            </table>


            </form>

        </div>
</body>

</html>