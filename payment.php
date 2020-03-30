<?php require_once('nevbar.php');
Nevbar();
require_once('Connections/myconnect.php');

$id = $_GET["id"];


?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>จัดการการชำระเงิน</title>
    <link rel="stylesheet" href="css/custom.css" />
</head>

<body>

    <div class="container">
        <br />
        <h2>การจัดการการชำระเงิน</h2>
        <br />
        <form method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
            <div class="form-group">
                <label for="usr">เลขที่ใบส่งของ:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="usr" name="id" value="<?php echo $_GET["id"];?>" />
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </div>
                </div>
            </div>
        </form>
        <?php
if($_GET["id"]){
    mysql_select_db($database_myconnect, $myconnect);
  $query_payment = "SELECT * FROM `tb_inv_wb` 
                    INNER JOIN tb_waybill 
                    ON tb_waybill.wb_id=tb_inv_wb.tiw_wb_id 
                    INNER JOIN tb_customer
                    ON tb_customer.cus_id=tb_waybill.	customer_id
                    WHERE tiw_id=$id";
  $PaymentDetail = mysql_query($query_payment, $myconnect) or die(mysql_error());
  $PaymentDetailID = mysql_fetch_assoc($PaymentDetail);
if(!$PaymentDetailID['wb_id_set']){
    echo '<div class="card">
             <div class="card-body">
                 <br />
                <h2>ไม่พบรายการ...<h2>
                <br />
             </div>
        </div>';
}
else{
  ?>


        <div class="card">
            <div class="card-body">
                <div class=row>
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3">
                        <div>ใบส่งของเลขที่ <?php echo $_GET["id"] ?> </div>
                        <div>วันที่ <?php echo date_format(date_create($PaymentDetailID['tiw_date']),"d/m/Y") ?></div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <div>อ้างอิงรหัสใบรับสินค้า: <?php echo $PaymentDetailID['wb_id_set'] ?></div>
                        <div>ชื่อบริษัท: <?php echo $PaymentDetailID['cus_compan'] ?></div>
                        <div>ยอดเงินค่าขนส่ง: <?php echo $PaymentDetailID['wb_money'] ?></div>
                        <br />
                    </div>
                    <div class="col-sm-4">
                        <label for="money">จำนวนเงินที่ได้รับ:</label>
                        <input type="number" class="form-control" id="money" />
                        <br />
                        <button class="btn btn-success float-right">ตกลง</button>
                    </div>
                </div>
                <br />

            </div>
        </div>
        <?php
}
}
else{
    ?>
        <div class="card">
            <div class="card-body">
                <br />
                <h2>กรุณากรอกเลขที่ใบส่งของ...<h2>
                        <br />
            </div>
        </div>

        <?php }?>
        <br />
        <h2>การจัดการการชำระเงิน</h2>
        <br />
        <form method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
            <div class="form-group">
                <label for="usr">เลขที่ใบส่งของ:</label>
                <div class="row">
                    <div class="col-3">
                        <input type="text" class="form-control" id="usr" name="id" value="<?php echo $_GET["id"];?>" />
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <div class=row>
                    <div class="col-10"></div>
                    <div class="col-2">
                        <div>ใบส่งของเลขที่ <?php echo $_GET["id"] ?> </div>
                        <div>วันที่ <?php echo date_format(date_create($PaymentDetailID['tiw_date']),"d/m/Y") ?></div>
                    </div>
                </div>
                <div>อ้างอิงรหัสใบรับสินค้า <?php echo $PaymentDetailID['wb_id_set'] ?></div>
                <div><?php echo $PaymentDetailID['wb_nbook'] ?></div>
                <div>ยอดเงินค่าขนส่ง <?php echo $PaymentDetailID['wb_money'] ?></div>
                <br />
            </div>
        </div>
>>>>>>> master
        <br />
    </div>
</body>

</html>