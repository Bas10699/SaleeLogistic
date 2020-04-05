<?php require_once('nevbar.php');
Nevbar();
require_once('Connections/myconnect.php');

$id = isset($_GET["id"]) ? $_GET["id"] : '';


?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>จัดการการชำระเงิน</title>
    <link rel="stylesheet" href="css/custom.css" />
    <style>
    table,
    tbody {
        display: block;
        height: 380px;
        width: 100%;
        overflow: auto;
    }

    thead,
    tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }


    table {
        /* width: 100%; */
        height: 100%
    }

    ::-webkit-scrollbar {
        width: 10px;
    }


    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }


    ::-webkit-scrollbar-thumb {
        background: #888;
    }


    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    </style>
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
                        <input type="text" class="form-control" id="usr" name="id" value="<?php echo $id;?>" />
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-primary">ค้นหา</button>
                    </div>
                </div>
            </div>
        </form>
        <div class=row>
            <div class=col-sm-6>
                <?php
if($id ){
    mysql_select_db($database_myconnect, $myconnect);
  $query_payment = "SELECT * FROM `tb_inv_wb`
                    INNER JOIN tb_waybill 
                    ON tb_waybill.wb_id=tb_inv_wb.tiw_wb_id 
                    INNER JOIN tb_customer
                    ON tb_customer.cus_id=tb_waybill.customer_id
                    WHERE tiw_id=$id";
  $PaymentDetail = mysql_query($query_payment, $myconnect) or die(mysql_error());
  $PaymentDetailID = mysql_fetch_assoc($PaymentDetail);
if(!$PaymentDetailID['wb_id_set']){
    echo '<div class="card" style="height: 100%">
             <div class="card-body" >
                 <br />
                <h2>ไม่พบรายการ...<h2>
                <br />
             </div>
        </div>';
}
else{
  ?>


                <div class="card" style="height: 100%">
                    <div class="card-body">
                        <div class=row>
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                                <div>ใบส่งของเลขที่ <?php echo $id ?> </div>
                                <div>วันที่ <?php echo date_format(date_create($PaymentDetailID['tiw_date']),"d/m/Y") ?>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-6">
                                <div>อ้างอิงรหัสใบรับสินค้า: <?php echo $PaymentDetailID['wb_id_set'] ?></div>
                                <div>ชื่อบริษัท: <?php echo $PaymentDetailID['cus_compan'] ?></div>
                                <div>ยอดเงินค่าขนส่ง: <?php echo $PaymentDetailID['wb_money'] ?></div>
                                <div>ยอดเงินที่ชำระแล้ว: <?php echo $PaymentDetailID['tiw_money'] ?></div>
                                <br />
                            </div>
                            <?php if($PaymentDetailID['wb_money'] <= $PaymentDetailID['tiw_money']){
echo '<div class="col-sm-4">
<label for="money">จำนวนเงินที่ได้รับ:</label>
    <p class="text-success">ได้รับเงินครบตามจำนวนแล้ว</p>
                        </div>';
                        }else{
                        ?>
                            <div class="col-sm-4">
                                <label for="money">จำนวนเงินที่ได้รับ:</label>
                                <form action="payment_update.php" method="post">
                                    <input type="hidden" name="id" id="id"
                                        value="<?php echo $PaymentDetailID['tiw_id']?>" />
                                    <input type="hidden" name="wb_money" id="wb_money"
                                        value="<?php echo $PaymentDetailID['wb_money'] ?>" />
                                    <input type="hidden" name="tiw_money" id="tiw_money"
                                        value="<?php echo $PaymentDetailID['tiw_money']?>" />
                                    <input type="number" class="form-control" id="money" name="money" />
                                    <br />
                                    <button class="btn btn-success float-right">ตกลง</button>
                                </form>
                            </div>
                            <?php } ?>
                        </div>
                        <br />

                    </div>
                </div>
                <?php
}
}
else{
    ?>
                <div class="card" style="height: 100%">
                    <div class="card-body">
                        <br />
                        <h2>กรุณากรอกเลขที่ใบส่งของ...<h2>
                                <br />
                    </div>
                </div>

                <?php }
                mysql_select_db($database_myconnect, $myconnect);
                $query_payment_all = "SELECT * FROM tb_inv_wb
                INNER JOIN tb_waybill 
                ON tb_waybill.wb_id=tb_inv_wb.tiw_wb_id
                ORDER BY tiw_payment_status ASC";
                $PaymentDetailAll = mysql_query($query_payment_all, $myconnect) or die(mysql_error());
?>
            </div>
            <div class="col-sm-6">
                <table class="table table-hover table-sm table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>เลขที่</th>
                            <th>จำนวนเงินที่จ้องชำระ</th>
                            <th>สถานะการชำระเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while($row_PaymentDetailAll = mysql_fetch_array($PaymentDetailAll)) {
                    ?>
                        <tr>
                            <td><?php echo $row_PaymentDetailAll["tiw_id"]; ?></td>
                            <td><?php echo $row_PaymentDetailAll['wb_money'] ?></td>
                            <td><?php echo $row_PaymentDetailAll['tiw_payment_status'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br />
    </div>
</body>

</html>