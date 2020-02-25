<?ob_start();?>
<?php session_start();?>
<?php  function Nevbar(){?>
  <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif, 'angsana New';
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #FF0;;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .toplogout{
    float: right;
  }
}
</style>
</head>
<body>

<div class="topnav" id="myTopnav">
<a href="indexhome.php"><img src="img/logodaichuar2.png" height="50"/></a>
          <a href="staff_show.php">ข้อมูลพนักงาน</a>
         <a href="car_show.php">ข้อมูลรถ</a>
          <a href="customer_show.php">ข้อมูลลูกค้า</a>
          <a href="waybill_show.php">ใบรับสินค้า</a>
          <a href="receipt_show.php">ใบส่งสินค้า</a>
          <a href="waybill_show.php">รายงานสรุปยอด</a>
          
        <a href="index.php" style="float:right">ออกจากระบบ</a>
        <a style="float:right"><?php echo $_SESSION['MM_Username']; ?></a>
        
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

</body>
</html>


<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<STYLE type=text/css>
A:link {COLOR: #FFFFFF; TEXT-DECORATION: none}
A:visited {COLOR: #FFFF00; TEXT-DECORATION: none}
A:hover {COLOR: #FFFFFF; TEXT-DECORATION: underline}
</STYLE>
<STYLE type=text/css>
A:link {
	TEXT-DECORATION: none
}
A:visited {
	TEXT-DECORATION: none
}
A:hover {
	TEXT-DECORATION: none
}
</STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>หน้าแรก</title>
<style type="text/css">

.หัวข้อ {
	font-family: "angsana New";
	font-size: 30px;
	color: #FF0;
}
a:active {
	text-decoration: none;
}
</style>

<body>
<table width="100%"  align="center">
  <tr>
    <td width="1320" height="32" bgcolor="#000033"><table width="100%">
      <tr>
        <td height="201"><div align="left"><img src="img/logodaichuar2.png" width="207" height="199" /></div></td>
      </tr>
    </table></td>
  </tr>
  <tr bgcolor="#000033">
    <td height="46"><div align="center">
      <table width="100%">
        <tr>
          <td width="9%" height="42" class="หัวข้อ"><a href="indexhome.php">หน้าแรก</a></td>
          <td width="12%" class="หัวข้อ"><a href="staff_show.php">ข้อมูลพนักงาน</a></td>
          <td width="9%" class="หัวข้อ"><a href="car_show.php">ข้อมูลรถ</a></td>
          <td width="9%" class="หัวข้อ"><a href="customer_show.php">ข้อมูลลูกค้า</a></td>
          <td width="20%" class="หัวข้อ"><a href="waybill_show.php">เอกสารใบส่งของ</a></td>
          <td width="20%" class="หัวข้อ"><a href="waybill_show.php"></a></td>
          <td width="41%">&nbsp;</td>
          
          </tr>
      </table>
    </div></td>
  </tr>
  
</table>
</body>
</html> -->
<?php } ?>