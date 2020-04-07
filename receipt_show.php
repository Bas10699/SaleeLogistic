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

$txtSearch = isset($_GET["txtKeyword"]) ? $_GET["txtKeyword"] : '';

mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill 
LEFT JOIN tb_customer 
ON tb_waybill.customer_id = tb_customer.cus_id 
LEFT JOIN tb_car
ON tb_waybill.car_id = tb_car.car_id
WHERE tb_inv_status=0 and (tb_customer.cus_sub LIKE '%".$txtSearch."%' or cus_compan LIKE '%".$txtSearch."%' or tb_customer.cus_area LIKE '%".$txtSearch."%' or wb_payment LIKE '%".$txtSearch."%' )
ORDER BY wb_id DESC";
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

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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

        <div class="row">
            <div class="col-sm-6">

                <h2>ใบส่งสินค้า</h2>
            </div>
            <div class="col-sm-6 ">
                <?php if($_COOKIE["UserType"] == 2){?>
                <form name="myForm" action="waybill_insert_pdf.php" autocomplete="off" onsubmit="return validateForm()"
                    method="POST" enctype="multipart/form-data">


                    <select name="car_id" id="car_id">
                        <option selected disabled hidden>กรุณาเลือกทะเบียนรถ</option>
                        <?php while($row_carId = mysql_fetch_array($carId)) { ?>
                        <option value="<?php echo $row_carId['car_id']; ?>"> <?php echo $row_carId['car_register']; ?>
                        </option>
                        <?php } ?>
                    </select>

                    <select name="staff_id" id="staff_id">
                        <option selected disabled hidden>กรุณาเลือกพนักงานขับรถ</option>
                        <?php while($row_staffId = mysql_fetch_array($staffId)) { ?>
                        <option value="<?php echo $row_staffId['staff_id']; ?>">
                            <?php echo $row_staffId['staff_title_name']; ?><?php echo $row_staffId['staff_name']; ?>
                            <?php echo $row_staffId['staff_lastname']; ?> </option>
                        <?php } ?>
                    </select>

                    <button class="btn btn-info">ตรวจสอบใบส่งสินค้า</button>
                    <?php } ?>
            </div>
        </div>
        <br />
        <!-- <div class="row">
            <div class="col-9"> -->
        <div class="table-responsive">
            <table  class="table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <?php if($_COOKIE["UserType"] == 2){?>
                        <th>
                            <div> </div>
                        </th>
                        <?php } ?>
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

                    </tr>
                </thead>
                <tbody>
                    <?php while($row_waybill = mysql_fetch_array($waybill)) { ?>
                    <tr>
                        <?php if($_COOKIE["UserType"] == 2){?>
                        <td><input type='checkbox' name='listData[]'
                                value='<?php echo $row_waybill["wb_id"]; ?>'>
                        </td>
                        <?php } ?>
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
                            <div align="center"><?php echo $row_waybill['wb_nber']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['cus_area']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['cus_sub']; ?></div>
                        </td>
                        <td>
                            <div align="right"><?php echo $row_waybill['wb_money']; ?></div>
                        </td>


                    </tr>
                    <?php } mysql_free_result($waybill); ?>
                </tbody>
            </table>


            </form>

        </div>
        <!-- </div>
            <div class="col-3">
                <p id="demo"></p>
            </div>
        </div> -->
        <script>
        var yourArray = []

        function getComboA(selectObject) {
            var value = selectObject.value;
            console.log(value);
            document.getElementById("demo").innerHTML = "You selected: " + value;
        }
        </script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js">
        </script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
        </script>
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
        </script>
        <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        </script>
</body>

</html>