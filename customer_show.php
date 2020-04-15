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

$id = isset($_GET["textfield"]) ? $_GET["textfield"] : '';
if($id != ""){
    mysql_select_db($database_myconnect, $myconnect);
    $query_customer = "SELECT * FROM tb_customer  
    WHERE customer_id LIKE '%".$id."%'
    or cus_tin LIKE '%".$id."%'
    or cus_compan LIKE '%".$id."%'
    or cus_tle LIKE '%".$id."%'";
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
            <h2>ข้อมูลลูกค้า</h2>
            <br />
                <!-- <form id="form2" name="form2" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                    <input type="text" name="textfield" id="textfield" value="<?php echo $id ?>" />
                    <button type="submit"><i class="fa fa-search"></i></button>

                </form> -->
            </div>
            <div class="col-sm-4 ">
                <?php if($_COOKIE["UserType"] == 2){?>
                <button type="button" class="btn btn-info float-right" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    เพิ่มข้อมูลลูกค้า
                </button>
                <?php } ?>
                <!-- <div class="float-right"><a class="btn btn-info" href="customer_insert.php">เพิ่มข้อมูลลูกค้า</a></div> -->
            </div>
        </div>
        <br />
        <?php if($totalRows_customer == 0){
            echo '<script type="text/javascript">
            Swal.fire(
                "",
                "ตรวจสอบไม่พบข้อมูล",
                "error"
              ).then(()=> window.location.href="customer_show.php")
            </script>';
        }else{ ?>
        <div class="table-responsive">
            <table id="example" class="table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <!-- <th>
                            <div align="center">รหัสลูกค้า</div>
                        </th> -->
                        <!-- <th>
                            <div align="center">เลขประจำตัวผู้เสียภาษี</div>
                        </th> -->
                        <th>ชื่อบริษัท</th>

                        <th>เบอร์โทรศัพท์</th>
                        <th>อำเภอ</th>
                        <th>ตำบล</th>

                        <th>
                            <div align="center">จัดการ</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php do { ?>
                    <tr>
                        <!-- <td class="ตัวอักษร" align="center"><?php echo $row_customer['customer_id']; ?></td> -->
                        <!-- <td height="35">
                            <div align="center" class="ตัวอักษร"><?php echo $row_customer['cus_tin']; ?></div>
                        </td> -->
                        <td class="ตัวอักษร"><?php echo $row_customer['cus_compan']; ?></td>
                        <td class="ตัวอักษร"><?php echo $row_customer['cus_tle']; ?></td>
                        <td class="ตัวอักษร"><?php echo $row_customer['cus_area']; ?></td>
                        <td class="ตัวอักษร"><?php echo $row_customer['cus_sub']; ?></td>
                        <td align="center">
                            <a class="btn btn-warning btn-sm" role="button"
                                href="customer_detail.php?id=<?php echo $row_customer['cus_id']; ?>">ดูรายละเอียด</a>
                            <?php if($_COOKIE["UserType"] == 2){?>
                            <button class="btn btn-danger btn-sm"
                                onclick="myFunction(<?php echo $row_customer['cus_id']; ?>)">ลบ</button>

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
                                        window.location.href = "customer_del.php?id=" + id
                                    }
                                })
                            }
                            </script>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } while ($row_customer = mysql_fetch_assoc($customer)); ?>
                </tbody>
            </table>
        </div>
        <?php } ?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มข้อมูลลูกค้า</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="customer_insert.php">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">

                                    <div align="left">ชื่อบริษัท :</div>
                                    <input type="text" name="cus_compan" id="cus_compan" class="form-control" />
                                </div>
                                <div class="form-group col-md-6">

                                    <div align="left">เบอร์โทรศัพท์ :</div>
                                    <input name="cus_tle" type="text" id="cus_tle" maxlength="10"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div align="left">บ้านเลขที่ :</div>
                                    <input type="text" name="cus_hose" id="cus_hose" class="form-control" />
                                </div>
                                <div class="form-group col-md-6">
                                    <div align="left">หมู่ :</div>
                                    <input type="text" name="cus_vill" id="cus_vill" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div align="left">อำเภอ :</div>
                                    <select name="cus_area" id="cus_area" class="form-control">
                                        <option value="" selected="selected">------- กรุณาเลือกอำเภอ
                                            -------</option>
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
                                </div>
                                <div class="form-group col-md-6">
                                    <div align="left">ตำบล :</div>
                                    <input type="text" name="cus_sub" id="cus_sub" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div align="left">จังหวัด :</div>
                                    <select name="cus_pro" id="cus_pro" class="form-control">
                                        <option value="" selected="selected">------- กรุณาเลือกจังหวัด
                                            -------</option>
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
                                </div>
                                <div class="form-group col-md-6">
                                    <div align="left">รหัสไปรษณีย์ :</div>

                                    <input name="cus_pos" type="text" id="cus_pos" maxlength="5" class="form-control" />
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button class="btn btn-success">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
            $('#example').DataTable();
        });
        </script>
</body>

</html>
<?php
mysql_free_result($customer);
?>