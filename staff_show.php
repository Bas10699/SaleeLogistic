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

if($_GET["textfield"] != ""){
  if($_GET["select"] == "staff_name"){
      mysql_select_db($database_myconnect, $myconnect);
      $query_staff = "SELECT * FROM tb_staff  WHERE staff_name LIKE '%".$_GET["textfield"]."%'";
      $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
      $row_staff = mysql_fetch_assoc($staff);
      $totalRows_staff = mysql_num_rows($staff);
  }
  else if($_GET["select"] == "staff_lastname"){
    mysql_select_db($database_myconnect, $myconnect);
      $query_staff = "SELECT * FROM tb_staff  WHERE staff_lastname LIKE '%".$_GET["textfield"]."%'";
      $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
      $row_staff = mysql_fetch_assoc($staff);
      $totalRows_staff = mysql_num_rows($staff);
  }
  else if($_GET["select"] == "staff_card"){
    mysql_select_db($database_myconnect, $myconnect);
      $query_staff = "SELECT * FROM tb_staff  WHERE staff_card LIKE '%".$_GET["textfield"]."%'";
      $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
      $row_staff = mysql_fetch_assoc($staff);
      $totalRows_staff = mysql_num_rows($staff);
  }
  else if($_GET["select"] == "staff_tel"){
    mysql_select_db($database_myconnect, $myconnect);
      $query_staff = "SELECT * FROM tb_staff  WHERE staff_tel LIKE '%".$_GET["textfield"]."%'";
      $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
      $row_staff = mysql_fetch_assoc($staff);
      $totalRows_staff = mysql_num_rows($staff);
  }
  else if($_GET["select"] == "all"){
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
  }
  else{
     mysql_select_db($database_myconnect, $myconnect);
      $query_staff = "SELECT * FROM tb_staff ";
      $staff = mysql_query($query_staff, $myconnect) or die(mysql_error());
      $row_staff = mysql_fetch_assoc($staff);
      $totalRows_staff = mysql_num_rows($staff);
  }
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/custom.css" />
  <title>ข้อมูลพนักงาน</title>
</head>

<body>

<div class="container">
  <br/>
      <h2>ข้อมูลพนักงาน</h2>
     <br/>
        <form id="form2" name="form2" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
        <div class="row">
         <div class="col-sm-8">
            <input type="text" name="textfield" id="textfield" />
            <button type="submit"><i class="fa fa-search"></i></button>
            <label for="select"></label>
            <select name="select" id="select">
              <option value="all" selected="selected">ทั้งหมด</option>
              <option value="staff_name">ชื่อ</option>
              <option value="staff_lastname">นามสกุล</option>
              <option value="staff_card">เลขบัตรประชาชน</option>
              <option value="staff_tel">เบอร์โทรศัพท์</option>
              </select>
            </form>
          </div>
          <div class="col-sm-4 ">
           <div class="float-right"><a class="btn btn-info" href="staff_insert.php">เพิ่มข้อมูลพนักงาน</a></div>
           </div>
      </div>
      <br/>
      <div class="table-responsive">
                <table id='customers' class="table table-hover table-sm">
                <thead class="thead-dark">
                      <tr>
                        <th><div align="center" >รหัสพนักงาน</div></th>
                        <th ><div align="center" >เลขบัตรประชาชน</div></th>
                        <th ><div align="center" >คำนำหน้าชื่อ</div></th>
                        <th ><div align="center" >ชื่อ</div></th>
                        <th><div align="center" >นามสกุล</div></th>
                        <th ><div align="center" >ตำแแหน่ง</div></th>
                        <th ><div align="center" >เบอร์โทรศัพท์</div></th>
                        <th><div align="center" >จัดการ</div></th>
                    </tr>
                    </thead>
                    <tbody>
                  <?php do { ?>
                    <tr>
                      <td><div align="center"><span ><?php echo $row_staff['staff_id_set']; ?></span></div></td>
                      <td height="30"><div align="center" ><?php echo $row_staff['staff_card']; ?></div></td>
                      <td><div align="center" ><?php echo $row_staff['staff_title_name']; ?></div></td>
                      <td><div align="left" ><?php echo $row_staff['staff_name']; ?></div></td>
                      <td><div align="left" ><?php echo $row_staff['staff_lastname']; ?></div></td>
                      <td><div align="center" ><?php echo $row_staff['staff_position']; ?></div></td>
                      <td><div align="center" ><?php echo $row_staff['staff_tel']; ?></div></td>
                      <td ><div align="center" >
                          <a  class="btn btn-warning btn-sm" role="button" href="staff_edit.php<?php echo $row_staff['']; ?>?id=<?php echo $row_staff['staff_id']; ?>">แก้ไข</a>
                          <a class="btn btn-danger btn-sm" role="button" href="staff_del.php?id=<?php echo $row_staff['staff_id']; ?>?staff_id=<?php echo $row_staff['staff_id']; ?>" onclick="return confirm('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a>
                          </div>
                        </td>
                      </tr>
                    <?php } while ($row_staff = mysql_fetch_assoc($staff)); ?>
                    </tbody>
             
        </table>
     </div>
</div>
</body>
</html>
<?php
mysql_free_result($staff);
?>