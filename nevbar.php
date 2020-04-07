<?php  function Nevbar(){
  $UserName = isset($_COOKIE["UserName"]) ? $_COOKIE["UserName"] : '';
  if(!$UserName){
    header("Location: index.php");
  }
  ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="indexhome.php">Chockdee Salee Logistic</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="staff_show.php">ข้อมูลพนักงาน</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="car_show.php">ข้อมูลรถ</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="customer_show.php">ข้อมูลลูกค้า</a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        เอกสารใบรับ-ส่งสินค้า
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="waybill_show.php">ใบรับสินค้า</a>
                        <a class="dropdown-item" href="receipt_show.php">ใบส่งสินค้า</a>
                        <!-- <a class="dropdown-item" href="sending_show.php">รายการกำลังส่ง</a> -->
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="payment.php">การจัดการการชำระเงิน</a>
                </li>
                <?php if($_COOKIE["UserName"]){?>
                <li class="nav-item ">
                    <a class="nav-link" href="report.php">รายงานสรุปยอด</a>
                </li>
                <?php } ?>

                <!-- <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        รายงานสรุปยอด
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href=report.php>รายงานค้างชำระ</a>
                        <a class="dropdown-item" href=report.php>รายงานส่งสินค้าแล้ว</a>
                    </div>
                </li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item active"><a class="nav-link" href="#">
                        <span class="fas fa-user"></span> <?php echo $_COOKIE["UserName"]; ?></a>
                </li>
                <li class="nav-item active"><a class="nav-link" href="removecookie.php">
                        <span class="fas fa-sign-out-alt"></span> ออกจากระบบ</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- <nav class="navbar navbar-inverse">
   
      
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['MM_Username']; ?></a></li>
      <li><a href="removecookie.php"><span class="glyphicon glyphicon-log-in"></span> ออกจากระบบ</a></li>
    </ul>
  </div>
</nav> -->

</body>

</html>

<?php } ?>