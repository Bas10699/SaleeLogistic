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
function DateDiff($strDate1,$strDate2)
	 {
				return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
	 }

mysql_select_db($database_myconnect, $myconnect);
$query_car = "SELECT * FROM tb_car";
$car = mysql_query($query_car, $myconnect) or die(mysql_error());
$row_car = mysql_fetch_assoc($car);
$totalRows_car = mysql_num_rows($car);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="index.css">
  <title>ข้อมูลรถ</title>


</head>

<body>
  <table width="80%" height="521" align="center">

    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>

    <tr>
        <div align="left">
        <h2><FONT SIZE=3 COLOR=#FF4500>หมายเหตุ : สีเหลืองเตือนให้ต่อภาษีรถยนต์ภายใน 90 วัน / สีแดงเตือนว่าภาษีหมดอายุแล้ว</FONT></h2>
        </div>
    </tr>

    <tr>
      <td height="33" colspan="8">
        <div align="center">
          <h2>ข้อมูลรถ</h2>
        </div>
      </td>
    </tr>
    <tr>
      <td height="29" colspan="8">
        <div align="right">
          <table >
            <tr>
              
                <div class="buttonadd"><a href="car_insert.php">เพิ่มข้อมูลรถ</a></div>
             
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td >
        <form id="form1" name="form1" method="post" action="">
          <div align="center">
            <table id='customers'> 
              <tr>
                <th >
                  <div align="center">รหัสรถ</div>
                </th>
                <th >
                  <div align="center"><span>ทะเบียนรถ</span></div>
                </th>
                <th>
                  <div align="center"><span>วันหมดอายุภาษีรถยนต์</span></div>
                </th>
                <th colspan="2">
                  <div align="center">จัดการ</div>
                </th>
              </tr>
              <?php do { ?>
                <tr>
                  <td >
                    <div align="center"><?php echo $row_car['car_id_set']; ?></div>
                  </td>
                  <td >
                    <div align="left"><?php echo $row_car['car_register']; ?> / <?php echo $row_car['car_province']; ?></div>
                  </td>
                  <td >
                  <?php
                      if (round(DateDiff(date('y-m-d'),$row_car['car_date_end'])) < '0' ){
                  ?>
                    <div align="center" style='color:red'><? echo  date_format(date_create($row_car['car_date_end']),"d/m/Y") ?> (ภาษีหมดอายุ)</div>
                  <?php }

                        
                        else if(round(DateDiff(date('y-m-d'),$row_car['car_date_end'])) <= '90' ){
                    ?>
                    <div align="center" style='background-color:#ffcc00'><?php $date=date_create($row_car['car_date_end']); echo date_format($date,"d/m/Y")."( ".round(DateDiff(date('y-m-d'),$row_car['car_date_end']))." วัน)"; ?> </div>
                    <?php
                  } 
                      else{
                  ?>
                      <div align="center" ><?php $date=date_create($row_car['car_date_end']); echo date_format($date,"d/m/Y")."( ".round(DateDiff(date('y-m-d'),$row_car['car_date_end']))." วัน)"; ?> </div>
                  <?php }?>
                  </td>
                  <td >
                    <div align="center">
                      <a class="buttondetail" href="car_edit.php<?php echo $row_car['']; ?>?id=<?php echo $row_car['car_id']; ?>">แก้ไข</a>
                      <a class="btndel" href="car_del.php?id=<?php echo $row_car['car_id']; ?>" onclick="return confirm('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a>
                    </div>
                    </td>
                </tr>
              <?php } while ($row_car = mysql_fetch_assoc($car)); ?>
            </table>
          </div>
        </form>
      </td>
    </tr>
    <tr>
      <td colspan="8">
        <div align="center"></div>
      </td>
    </tr>
    <tr>
      <td colspan="8">
        <p>&nbsp;</p>
      </td>
    </tr>
  </table>
</body>

</html>
<?php
mysql_free_result($car);
?>