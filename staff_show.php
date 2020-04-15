<?php require_once('Connections/myconnect.php'); ?>
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

mysql_select_db($database_myconnect, $myconnect);
$query_staff = "SELECT * FROM tb_staff ";
$staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
$totalRows_staff = mysql_num_rows($staff);

$id = isset($_GET["textfield"]) ? $_GET["textfield"] : '';
if(isset($_GET["textfield"])){
    if($_GET["textfield"] != ""){
  // if($_GET["select"] == "staff_name"){
  //     mysql_select_db($database_myconnect, $myconnect);
  //     $query_staff = "SELECT * FROM tb_staff  WHERE staff_name LIKE '%".$_GET["textfield"]."%'";
  //     $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
  //     $row_staff = mysql_fetch_assoc($staff);
  //     $totalRows_staff = mysql_num_rows($staff);
  // }
  // else if($_GET["select"] == "staff_lastname"){
  //   mysql_select_db($database_myconnect, $myconnect);
  //     $query_staff = "SELECT * FROM tb_staff  WHERE staff_lastname LIKE '%".$_GET["textfield"]."%'";
  //     $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
  //     $row_staff = mysql_fetch_assoc($staff);
  //     $totalRows_staff = mysql_num_rows($staff);
  // }
  // else if($_GET["select"] == "staff_card"){
  //   mysql_select_db($database_myconnect, $myconnect);
  //     $query_staff = "SELECT * FROM tb_staff  WHERE staff_card LIKE '%".$_GET["textfield"]."%'";
  //     $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
  //     $row_staff = mysql_fetch_assoc($staff);
  //     $totalRows_staff = mysql_num_rows($staff);
  // }
  // else if($_GET["select"] == "staff_tel"){
  //   mysql_select_db($database_myconnect, $myconnect);
  //     $query_staff = "SELECT * FROM tb_staff  WHERE staff_tel LIKE '%".$_GET["textfield"]."%'";
  //     $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
  //     $row_staff = mysql_fetch_assoc($staff);
  //     $totalRows_staff = mysql_num_rows($staff);
  // }
  // else if($_GET["select"] == "all"){
    mysql_select_db($database_myconnect, $myconnect);
      $query_staff = "SELECT * FROM tb_staff  
      WHERE staff_id_set LIKE '%".$_GET["textfield"]."%'
      or staff_name LIKE '%".$_GET["textfield"]."%'
      or staff_lastname LIKE '%".$_GET["textfield"]."%'
      or staff_card LIKE '%".$_GET["textfield"]."%'
      or staff_position LIKE '%".$_GET["textfield"]."%'
      or staff_tel LIKE '%".$_GET["textfield"]."%'
      or staff_title_name LIKE '%".$_GET["textfield"]."%'";
      $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
      $row_staff = mysql_fetch_assoc($staff);
      $totalRows_staff = mysql_num_rows($staff);
  // }
  // else{
  //    mysql_select_db($database_myconnect, $myconnect);
  //     $query_staff = "SELECT * FROM tb_staff ";
  //     $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
  //     $row_staff = mysql_fetch_assoc($staff);
  //     $totalRows_staff = mysql_num_rows($staff);
  // }
	
}
}


?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>ข้อมูลพนักงาน</title>
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
                <h2>ข้อมูลพนักงาน</h2>
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
                    เพิ่มข้อมูลพนักงาน
                </button>
                <?php } ?>
                <!-- <div class="float-right"><a class="btn btn-info" href="staff_insert.php">เพิ่มข้อมูลพนักงาน</a></div> -->
            </div>
        </div>
        <br />
        <?php if($totalRows_staff == 0){
            echo '<script type="text/javascript">
            Swal.fire(
                "",
                "ตรวจสอบไม่พบข้อมูล",
                "error"
              ).then(()=> window.location.href="staff_show.php")
            </script>';
        }
            else{
                ?>
        <div class="table-responsive">
            <table id="example" class="table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <!-- <th>
                            <div align="center">รหัสพนักงาน</div>
                        </th> -->
                        <th>
                            <div align="center">เลขบัตรประชาชน</div>
                        </th>
                        <th>
                            <div align="center">คำนำหน้าชื่อ</div>
                        </th>
                        <th>
                            <div align="center">ชื่อ</div>
                        </th>
                        <th>
                            <div align="center">นามสกุล</div>
                        </th>
                        <th>
                            <div align="center">ตำแหน่ง</div>
                        </th>
                        <th>
                            <div align="center">เบอร์โทรศัพท์</div>
                        </th>
                        <?php if($_COOKIE["UserType"] == 2){?>
                        <th>
                            <div align="center">จัดการ</div>
                        </th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php do { ?>
                    <tr>
                        <!-- <td>
                            <div align="center"><span><?php echo $row_staff['staff_id_set']; ?></span></div>
                        </td> -->
                        <td height="30">
                            <div align="center"><?php echo $row_staff['staff_card']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_staff['staff_title_name']; ?></div>
                        </td>
                        <td>
                            <div align="left"><?php echo $row_staff['staff_name']; ?></div>
                        </td>
                        <td>
                            <div align="left"><?php echo $row_staff['staff_lastname']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_staff['staff_position']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_staff['staff_tel']; ?></div>
                        </td>
                        <?php if($_COOKIE["UserType"] == 2){?>
                        <td>
                            <div align="center">
                                <a class="btn btn-warning btn-sm" role="button"
                                    href="staff_edit.php?id=<?php echo $row_staff['staff_id']; ?>">แก้ไข</a>
                                <button class="btn btn-danger btn-sm" role="button"
                                    onclick="myFunction(<?php echo $row_staff['staff_id']; ?>)">ลบ</button>

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
                                            window.location.href = "staff_del.php?id=" + id
                                        }
                                    })
                                }
                                </script>
                            </div>
                        </td>
                        <? } ?>
                    </tr>
                    <?php } while ($row_staff = mysql_fetch_assoc($staff)); ?>
                </tbody>

            </table>
        </div>
        <?php }?>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มข้อมูลพนักงาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="staff_insert.php">
                        <div class="modal-body">

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="staff_title_name">คำนำหน้าชื่อ</label>

                                    <select name="staff_title_name" id="staff_title_name" class="form-control">
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="staff_name">ชื่อ</label>
                                    <input name="staff_name" type="text" id="staff_name" class="form-control" />
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="staff_lastname">นามสกุล</label>
                                    <input name="staff_lastname" type="text" id="staff_lastname" class="form-control" />
                                </div>
                            </div>
                            <label for="staff_card">เลขบัตรประชาชน</label>
                            <input name="staff_card" type="text" id="staff_card" pattern="[0-9]{1,}"
                                class="form-control" title="กรอกตัวเลขเท่านั้น" maxlength="13" />
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="staff_position">ตำแหน่ง</label>
                                    <select name="staff_position" id="staff_position" class="form-control">
                                        <option value="พนักงานขับรถ">พนักงานขับรถ</option>
                                        <option value="พนักงานเอกสาร">พนักงานเอกสาร</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="staff_tel">เบอร์โทรศัพท์</label>
                                    <input name="staff_tel" type="text" id="staff_tel" pattern="[0-9]{1,}"
                                        class="form-control" title="กรอกตัวเลขเท่านั้น" maxlength="10" />
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
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
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
mysql_free_result($staff);
?>