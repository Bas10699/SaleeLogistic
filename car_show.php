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

if($_GET["textfield"] != ""){
    mysql_select_db($database_myconnect, $myconnect);
    $query_car = "SELECT * FROM tb_car  
    WHERE car_id_set LIKE '%".$_GET["textfield"]."%'
    or car_register LIKE '%".$_GET["textfield"]."%'
    or car_province LIKE '%".$_GET["textfield"]."%'";
    $car = mysql_query($query_car, $myconnect) or die(mysql_error());
    $row_car = mysql_fetch_assoc($car);
    $totalRows_car = mysql_num_rows($car);
  
}
?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>ข้อมูลรถ</title>
    <link rel="stylesheet" href="css/custom.css" />

</head>

<body>
    <div class="container">
        <br />
        <h2>ข้อมูลรถ</h2>
        <FONT SIZE=3 COLOR=#FF4500>หมายเหตุ : สีเหลืองเตือนให้ต่อภาษีรถยนต์ภายใน 90 วัน /
            สีแดงเตือนว่าภาษีหมดอายุแล้ว
        </FONT>
        <br /> <br />
        <div class="row">
            <div class="col-sm-8">

                <form id="form2" name="form2" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                    <input type="text" name="textfield" id="textfield" />
                    <button type="submit"><i class="fa fa-search"></i></button>

                </form>

            </div>
            <div class="col-sm-4 ">
                <button type="button" class="btn btn-info float-right" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    เพิ่มข้อมูลรถ
                </button>
                <!-- <div class="float-right"><a class="btn btn-info" href="car_insert.php">เพิ่มข้อมูลรถ</a></div> -->
            </div>
        </div>
        <br />
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            <div align="center">รหัสรถ</div>
                        </th>
                        <th>
                            <div align="center"><span>ทะเบียนรถ</span></div>
                        </th>
                        <th>
                            <div align="center"><span>วันหมดอายุภาษีรถยนต์</span></div>
                        </th>
                        <th colspan="2">
                            <div align="center">จัดการ</div>
                        </th>
                    </tr>
                </thead>
                <?php do { ?>
                <tr>
                    <td>
                        <div align="center"><?php echo $row_car['car_id_set']; ?></div>
                    </td>
                    <td>
                        <div align="center"><?php echo $row_car['car_register']; ?> /
                            <?php echo $row_car['car_province']; ?></div>
                    </td>
                    <td>
                        <?php
                      if (round(DateDiff(date('y-m-d'),$row_car['car_date_end'])) < '0' ){
                  ?>
                        <div align="center" style='color:red'>
                            <? echo  date_format(date_create($row_car['car_date_end']),"d/m/Y") ?>
                            (ภาษีหมดอายุ)</div>
                        <?php }

                        
                        else if(round(DateDiff(date('y-m-d'),$row_car['car_date_end'])) <= '90' ){
                    ?>
                        <div align="center" style='background-color:#ffcc00'>
                            <?php $date=date_create($row_car['car_date_end']); echo date_format($date,"d/m/Y")."( ".round(DateDiff(date('y-m-d'),$row_car['car_date_end']))." วัน)"; ?>
                        </div>
                        <?php
                  } 
                      else{
                  ?>
                        <div align="center">
                            <?php $date=date_create($row_car['car_date_end']); echo date_format($date,"d/m/Y")."( ".round(DateDiff(date('y-m-d'),$row_car['car_date_end']))." วัน)"; ?>
                        </div>
                        <?php }?>
                    </td>
                    <td>
                        <div align="center">
                            <a class="btn btn-warning btn-sm" role="button"
                                href="car_edit.php<?php echo $row_car['']; ?>?id=<?php echo $row_car['car_id']; ?>">แก้ไข</a>
                            <a class="btn btn-danger btn-sm" role="button"
                                href="car_del.php?id=<?php echo $row_car['car_id']; ?>"
                                onclick="return confirm('ยืนยันที่จะลบข้อมูลหรือไม่ ?')">ลบ</a>
                        </div>
                    </td>
                </tr>
                <?php } while ($row_car = mysql_fetch_assoc($car)); ?>
            </table>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มข้อมูลรถ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="car_insert.php">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="car_register">ทะเบียนรถ</label>
                                    <input type="text" name="car_register" id="car_register" class="form-control" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="car_province">-</label>
                                    <select name="car_province" id="car_province" class="form-control">
                                        <option value="" selected>--------- เลือกจังหวัด ---------</option>
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
                            </div>
                            <div align="left">วันหมดอายุ</div>
                            <input type="date" name="car_date_end" id="car_date_end" class="form-control" />

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
mysql_free_result($car);
?>