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

// if($_GET["txtKeyword"] != ""){
// 	// $objConnect = mysql_connect("localhost","root","12345678") or die("Error Connect to Database");
// 	$objDB = mysql_select_db($database_myconnect, $myconnect);
// 	// Search By Name or Email
// 	$strSQL = "SELECT * FROM tb_waybill
//   LEFT JOIN tb_customer 
//   ON tb_waybill.customer_id = tb_customer.cus_id
//   LEFT JOIN tb_car
//   ON tb_waybill.car_id = tb_car.car_id
//   WHERE (tb_customer.cus_sub LIKE '%".$_GET["txtKeyword"]."%' or tb_customer.cus_area LIKE '%".$_GET["txtKeyword"]."%' )";
//   $waybill = mysql_query($strSQL, $myconnect) or die(mysql_error());
//   $row_waybill = mysql_fetch_assoc($waybill);
// }
$txtSearch = isset($_GET["txtKeyword"]) ? $_GET["txtKeyword"] : '';

mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill 
LEFT JOIN tb_customer 
ON tb_waybill.customer_id = tb_customer.cus_id 
LEFT JOIN tb_car
ON tb_waybill.car_id = tb_car.car_id
WHERE (tb_customer.cus_sub LIKE '%".$txtSearch."%' or tb_customer.cus_area LIKE '%".$txtSearch."%' or cus_compan LIKE '%".$txtSearch."%' or wb_payment LIKE '%".$txtSearch."%' )
ORDER BY wb_id";
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());



?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>ใบรับสินค้า</title>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/custom.css" />

</head>

<body>
    <div class="container">
        <br />
        <div class="row">
            <div class="col-sm-8">
                <h2>ใบรับสินค้า</h2>
            </div>
            <div class="col-sm-4 ">
                <?php if($_COOKIE["UserType"] == 2){?>
                <button type="button" class="btn btn-info float-right" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    เพิ่มเอกสาร
                </button>
                <?php } ?>
                <!-- <div class="float-right"><a class="btn btn-info" href="waybill_insert.php">เพิ่มเอกสาร</a></button> -->

            </div>
        </div>
        <br />
        <div class="table-responsive">
            <table id="example" class="table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <!-- <th ><div> </div></th> -->
                        <!-- <th class="min">
                            <div align="center">รหัสใบรับสินค้า</div>
                        </th> -->
                        <th class="min">
                            <div align="center">วันที่</div>
                        </th>
                        <th class="min">
                            <div align="center">ชื่อบริษัท</div>
                        </th>
                        <th class="min">
                            <div align="center">เลขที่ใบรับสินค้า</div>
                        </th>
                        <th class="min">
                            <div align="center">ยอดเงินค่าขนส่ง</div>
                        </th>
                        <!-- <th ><div align="center">สถานะการชำระเงิน</div></th> -->

                        <th class="min">
                            <div align="center">จัดการ</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row_waybill = mysql_fetch_array($waybill)) { ?>
                    <tr>
                        <!-- <td><input type='checkbox' name='checkIdList[]' value='<?php echo $row_waybill["wb_id"]; ?>'></td> -->
                        <!-- <td>
                            <div align="center"><?php echo $row_waybill["wb_id_set"]; ?></div>
                        </td> -->
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
                            <div align="right"><?php echo $row_waybill['wb_money']; ?></div>
                        </td>
                        <!-- <td><div ><?php echo $row_waybill['wb_payment']; ?></td> -->

                        <td class="min">
                            <div align="center">
                                <a class="btn btn-warning btn-sm" role="button"
                                    href="waybill_detail.php?id=<?php echo $row_waybill['wb_id']; ?>">รายละเอียด</a>
                                <?php if($_COOKIE["UserType"] == 2){?>
                                <button class="btn btn-danger btn-sm" role="button"
                                    onclick="myFunction(<?php echo $row_waybill['wb_id']; ?>)">ลบ</button>

                                <script>
                                function myFunction(id) {
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: "You won't be able to revert this!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, delete it!'
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location.href = "waybill_del.php?id=" + id
                                        }
                                    })
                                }
                                </script>
                                <?php } ?>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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
            $('#example').DataTable({
                "order": [[ 3, "desc" ]]
            });
            
        });
        </script>
        <?php mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill";
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());
$row_waybill = mysql_fetch_assoc($waybill);
$totalRows_waybill = mysql_num_rows($waybill);mysql_select_db($database_myconnect, $myconnect);

$query_customer = "SELECT cus_id ,cus_compan FROM tb_customer";
$customer = mysql_query($query_customer, $myconnect) or die(mysql_error());
?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มใบรับสินค้า(ที่มาจากกรุงเทพฯ)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="waybill_insert.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="wb_nber">เลขที่ใบรับส่งสินค้า</label>
                                    <input name="wb_nber" type="text" id="wb_nber" class="form-control" />

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="wb_nbook">เล่มที่</label>
                                    <input name="wb_nbook" type="text" id="wb_nbook" class="form-control" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cus_compan">ชื่อบริษัท</label>
                                    <select name="cus_compan" id="cus_compan" class="form-control">
                                        <option selected disabled hidden>--กรุณาเลือก--</option>
                                        <?php while($row_customer = mysql_fetch_array($customer)) { ?>
                                        <option value=<?php echo $row_customer["cus_id"]; ?>>
                                            <?php echo $row_customer["cus_compan"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <label for="staff_card">วันที่ตามใบเสร็จ</label>
                            <input type="date" name="wb_date" value="<?php echo date('d/m/Y');?>"
                                class="form-control" />

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="wb_money">ยอดเงินค่าขนส่ง</label>
                                    <input name="wb_money" type="text" id="wb_money" class="form-control" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="wb_img">รูปภาพ</label>
                                    <input type="file" name="wb_img" id="wb_img" class="form-control-file" />
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <button class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
mysql_free_result($waybill);
?>