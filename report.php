<?php require_once('nevbar.php');
Nevbar(); ?>

<?php require_once('Connections/myconnect.php'); ?>

<?php

$list = isset($_GET["list"]) ? $_GET["list"] : '';
$date_start = isset($_GET["date_start"]) ? $_GET["date_start"] : '';
$date_end = isset($_GET["date_end"]) ? $_GET["date_end"] : '';

mysql_select_db($database_myconnect, $myconnect);
$query_date = "SELECT sum(tiw_money) AS SumMoney FROM `tb_inv_wb` WHERE (`tiw_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')";
$DateDetailAll = mysql_query($query_date, $myconnect) or die(mysql_error());
$Date_detail = mysql_fetch_assoc($DateDetailAll);

mysql_select_db($database_myconnect, $myconnect);
$query_payment_date = "SELECT sum(wb_money) AS SumMoneyWb FROM tb_inv_wb
                        INNER JOIN tb_waybill 
                        ON tb_waybill.wb_id=tb_inv_wb.tiw_wb_id
                        WHERE `tiw_payment_status`!='ยกเลิกรายการส่งสินค้า' AND (`tiw_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')";
$PaymentDateDetail = mysql_query($query_payment_date, $myconnect) or die(mysql_error());
$PaymentDate_detail = mysql_fetch_assoc($PaymentDateDetail);
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>รายงานสรุปยอด</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/custom.css" />

    <style>
    .small-box {
        border-radius: 0.25rem;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
        display: block;
        margin-bottom: 20px;
        position: relative;
    }

    .small-box>.inner {
        padding: 10px;
    }

    .small-box>.small-box-footer {
        background: rgba(0, 0, 0, 0.1);
        color: rgba(255, 255, 255, 0.8);
        display: block;
        padding: 3px 0;
        position: relative;
        text-align: center;
        text-decoration: none;
        z-index: 10;
    }

    .small-box>.small-box-footer:hover {
        background: rgba(0, 0, 0, 0.15);
        color: #ffffff;
    }

    .small-box h3 {
        font-size: 2.2rem;
        font-weight: bold;
        margin: 0 0 10px 0;
        padding: 0;
        white-space: nowrap;
    }

    @media (min-width: 992px) {

        .col-xl-2 .small-box h3,
        .col-lg-2 .small-box h3,
        .col-md-2 .small-box h3 {
            font-size: 1.6rem;
        }

        .col-xl-3 .small-box h3,
        .col-lg-3 .small-box h3,
        .col-md-3 .small-box h3 {
            font-size: 1.6rem;
        }
    }

    @media (min-width: 1200px) {

        .col-xl-2 .small-box h3,
        .col-lg-2 .small-box h3,
        .col-md-2 .small-box h3 {
            font-size: 2.2rem;
        }

        .col-xl-3 .small-box h3,
        .col-lg-3 .small-box h3,
        .col-md-3 .small-box h3 {
            font-size: 2.2rem;
        }
    }

    .small-box p {
        font-size: 1rem;
    }

    .small-box p>small {
        color: #f8f9fa;
        display: block;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .small-box h3,
    .small-box p {
        z-index: 5;
    }

    .small-box .icon {
        color: rgba(0, 0, 0, 0.15);
        z-index: 0;
    }

    .small-box .icon>i {
        font-size: 90px;
        position: absolute;
        right: 15px;
        top: 15px;
        transition: all 0.3s linear;
    }

    .small-box .icon>i.fa,
    .small-box .icon>i.fas,
    .small-box .icon>i.far,
    .small-box .icon>i.fab,
    .small-box .icon>i.glyphicon,
    .small-box .icon>i.ion {
        font-size: 70px;
        top: 20px;
    }

    .small-box:hover {
        text-decoration: none;
    }

    .small-box:hover .icon>i {
        font-size: 95px;
    }

    .small-box:hover .icon>i.fa,
    .small-box:hover .icon>i.fas,
    .small-box:hover .icon>i.far,
    .small-box:hover .icon>i.fab,
    .small-box:hover .icon>i.glyphicon,
    .small-box:hover .icon>i.ion {
        font-size: 75px;
    }

    @media (max-width: 767.98px) {
        .small-box {
            text-align: center;
        }

        .small-box .icon {
            display: none;
        }

        .small-box p {
            font-size: 12px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <br />
        <h2>รายงานสรุปยอด</h2>
        <br />
        <div class="row">

            <div class="col-sm-3 pt-1">
                <form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" name="myForm" method="get"
                    onsubmit="return validateForm()">
                    <input type="date" name="date_start" class="form-control" value="<?php echo $date_start ?>">

            </div>
            ถึง
            <div class="col-sm-3 pt-1">
                <input type="date" name="date_end" class="form-control" value="<?php echo $date_end ?>">
            </div>
            <div class="col-sm-1 pt-1">
                <button class="btn btn-primary">สรุปยอด</button>
                </form>
            </div>
            <script type="text/javascript">
            function validateForm() {
                var x = document.forms["myForm"]["date_start"].value;
                var y = document.forms["myForm"]["date_end"].value;
                var g1 = new Date(x);
                var g2 = new Date(y);
                if (!x) {
                    Swal.fire(
                        "",
                        "กรุณากรอกข้อมูลให้ครบถ้วน",
                        "warning"
                    )
                    return false;
                }
                if (!y) {
                    Swal.fire(
                        "",
                        "กรุณากรอกข้อมูลให้ครบถ้วน",
                        "warning"
                    )
                    return false;
                }
                if (g1.getTime() > g2.getTime()) {
                    // Swal.fire(
                    //     '',
                    //     'กรุณาใส่วันที่ให้ถูกต้อง',
                    //     'warning'
                    // )
                    Swal.fire(
                        "",
                        "กรุณากรอกข้อมูลให้ถูกต้อง",
                        "warning"
                    )
                    return false;
                }

            }
            $(function() {
                $('[type="date"]').prop('max', function() {
                    return new Date().toJSON().split('T')[0];
                });
            });
            </script>
        </div>

        <br />
        <div class="row">
            <?php if($date_start){?>
            <div class="col-lg-3">
                <div class="row">

                    <div class="col-lg-12 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <?php 
                                    mysql_select_db($database_myconnect, $myconnect);
                                    $query_count_list = "SELECT tiw_payment_status, COUNT(*) AS count_status
                                    FROM tb_inv_wb WHERE tiw_payment_status='ค้างชำระ' AND (`tiw_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')";
                                    $count_listAll = mysql_query($query_count_list, $myconnect) or die(mysql_error());
                                    $list_detail = mysql_fetch_assoc($count_listAll);
                                    $count_status = $list_detail['count_status'];
                                    $status = $list_detail['tiw_payment_status'];
                                    echo "<h3>$count_status</h3>";
                                    mysql_free_result($count_listAll);
                                ?>
                                <p>ค้างชำระ</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file"></i>
                            </div>
                            <a href="report.php?list=ค้างชำระ&date_start=<?php echo $date_start.'&date_end='.$date_end ?>"
                                class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <?php 
                                    mysql_select_db($database_myconnect, $myconnect);
                                    $query_count_list = "SELECT tiw_payment_status, COUNT(*) AS count_status
                                    FROM tb_inv_wb WHERE tiw_payment_status='ชำระเงินแล้ว'AND (`tiw_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')";
                                    $count_listAll = mysql_query($query_count_list, $myconnect) or die(mysql_error());
                                    $list_detail = mysql_fetch_assoc($count_listAll);
                                    $count_status = $list_detail['count_status'];
                                    $status = $list_detail['tiw_payment_status'];
                                    echo "<h3>$count_status</h3>";
                                    mysql_free_result($count_listAll);
                                ?>
                                <p>ชำระเงินแล้ว</p>
                            </div>
                            <div class="icon">
                                <i class="material-icons">&#xe227;</i>
                            </div>
                            <a href="report.php?list=ชำระเงินแล้ว&date_start=<?php echo $date_start.'&date_end='.$date_end ?>"
                                class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">

                                <?php 
                                    mysql_select_db($database_myconnect, $myconnect);
                                    $query_count_list = "SELECT COUNT(*) AS count_status
                                    FROM tb_invoice WHERE (`inv_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')";
                                    $count_listAll = mysql_query($query_count_list, $myconnect) or die(mysql_error());
                                    $list_detail = mysql_fetch_assoc($count_listAll);
                                    $count_status = $list_detail['count_status'];
                                    
                                    echo "<h3>$count_status</h3>";
                                    mysql_free_result($count_listAll);
                                ?>
                                <p>พนักงานส่งสินค้า</p>
                            </div>
                            <div class="icon">
                                <i class="material-icons">&#xe227;</i>
                            </div>
                            <a href="report.php?list=พนักงานส่งสินค้า&date_start=<?php echo $date_start.'&date_end='.$date_end ?>"
                                class="small-box-footer">ข้อมูลเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- <div class="col-sm-3">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h3>150</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-file fa-5x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
                </div>
            </div>
            <div class="col-lg-9">


                <div class="card">
                    <div class="card-body">
                        <h5>รายงานสรุปยอด วันที่ <?php echo date_format(date_create($date_start),"d-m-Y")?> ถึงวันที่ <?php echo date_format(date_create($date_end),"d-m-Y")?>
                        </h5><br />
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th>จำนวนเงินที่ชำระแล้ว</th>
                                    <td><?php echo $Date_detail['SumMoney']?></td>
                                    <td> บาท</td>
                                </tr>
                                <tr>
                                    <th>จำนวนเงินที่ต้องชำระ </th>
                                    <td><?php echo $PaymentDate_detail['SumMoneyWb']?></td>
                                    <td> บาท</td>
                                </tr>
                                <tr>
                                    <th>ค้างชำระ</th>
                                    <td>
                                        <?php echo $PaymentDate_detail['SumMoneyWb']-$Date_detail['SumMoney'];?>
                                    </td>
                                    <td>บาท
                                    </td>
                                </tr>
                            <tbody>
                        </table>
                    </div>
                </div>
                <br />



                <?php if($list === "ค้างชำระ"){
                            mysql_select_db($database_myconnect, $myconnect);
                            $query_payment_all = "SELECT * FROM tb_inv_wb
                            INNER JOIN tb_waybill 
                            ON tb_waybill.wb_id=tb_inv_wb.tiw_wb_id
                            WHERE tiw_payment_status='ค้างชำระ'AND (`tiw_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')
                            ORDER BY tiw_payment_status ASC";
                            $PaymentDetailAll = mysql_query($query_payment_all, $myconnect) or die(mysql_error());
                            ?>
                <div class="card">
                    <div class="card-body">
                        <h4>รายการค้างชำระ</h4>
                        <table id="example" class="table table-hover table-sm table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>เลขที่</th>
                                    <th>จำนวนเงินที่ต้องชำระ</th>
                                    <th>สถานะการชำระเงิน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        while($row_PaymentDetailAll = mysql_fetch_array($PaymentDetailAll)) {
                    ?>
                                <tr>
                                    <td><?php echo $row_PaymentDetailAll["tiw_id"]; ?></td>
                                    <td><?php echo number_format($row_PaymentDetailAll['wb_money']) ?></td>
                                    <td><?php echo $row_PaymentDetailAll['tiw_payment_status'] ?>
                                        (<?php echo number_format($row_PaymentDetailAll['wb_money']-$row_PaymentDetailAll['tiw_money']) ?>)
                                    </td>
                                </tr>
                                <?php }  mysql_free_result($PaymentDetailAll);?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php }
                        else if($list === "ชำระเงินแล้ว"){
                            mysql_select_db($database_myconnect, $myconnect);
                            $query_payment_all = "SELECT * FROM tb_inv_wb
                            INNER JOIN tb_waybill 
                            ON tb_waybill.wb_id=tb_inv_wb.tiw_wb_id
                            WHERE tiw_payment_status='ชำระเงินแล้ว' AND (`tiw_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')
                            ORDER BY tiw_payment_status ASC";
                            $PaymentDetailAll = mysql_query($query_payment_all, $myconnect) or die(mysql_error());
                            ?>
                <div class="card">
                    <div class="card-body">
                        <h4>รายการชำระเงินแล้ว</h4>
                        <table id="example" class="table table-hover table-sm table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>เลขที่</th>
                                    <th>จำนวนเงินที่ต้องชำระ</th>
                                    <th>สถานะการชำระเงิน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        while($row_PaymentDetailAll = mysql_fetch_array($PaymentDetailAll)) {
                    ?>
                                <tr>
                                    <td><?php echo $row_PaymentDetailAll["tiw_id"]; ?></td>
                                    <td><?php echo number_format($row_PaymentDetailAll['wb_money']) ?></td>
                                    <td><?php echo $row_PaymentDetailAll['tiw_payment_status']?>
                                        (<?php echo number_format($row_PaymentDetailAll['tiw_money']) ?>)</td>
                                </tr>
                                <?php }  mysql_free_result($PaymentDetailAll);?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php }
                        else if($list === "พนักงานส่งสินค้า"){
                            ?>
                <div class="card">
                    <div class="card-body">
                        <h4>รายการพนักงานส่งสินค้า</h4>
                        <table id="example1" class="table table-hover table-sm table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <!-- <th>เลขที่</th> -->
                                    <th>วันที่</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>ทะเบียนรถ</th>
                                    <th>จำนวนเงินที่ชำระ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    mysql_select_db($database_myconnect, $myconnect);
                                    $query_invoice_all = "SELECT *,sum(tiw_money) AS sum_tiw_money FROM tb_invoice
                                    INNER JOIN tb_car ON tb_car.car_id = tb_invoice.inv_car_id
                                    INNER JOIN tb_staff ON tb_staff.staff_id = tb_invoice.inv_staff_id
                                    INNER JOIN tb_inv_wb ON tb_inv_wb.tiw_inv_id = tb_invoice.inv_id
                                    WHERE (`tiw_date` BETWEEN '$date_start.00:00:00' AND '$date_end.23:59:59')
                                    GROUP BY tb_invoice.inv_id";
                                    $InvoiceDetailAll = mysql_query($query_invoice_all, $myconnect) or die(mysql_error());
                                    while($row_InvoiceDetailAll = mysql_fetch_array($InvoiceDetailAll)) {
                                ?>
                                <tr>
                                    <!-- <td><?php echo $row_InvoiceDetailAll["inv_id"]; ?></td> -->
                                    <td><?php echo date_format(date_create($row_InvoiceDetailAll['inv_date']),"d/m/Y") ?>
                                    </td>
                                    <td><?php echo $row_InvoiceDetailAll['staff_name']?>
                                        <?php echo $row_InvoiceDetailAll['staff_lastname']?></td>
                                    <td><?php echo $row_InvoiceDetailAll['car_register']?> /
                                        <?php echo $row_InvoiceDetailAll['car_province']?></td>
                                    <td><?php echo number_format($row_InvoiceDetailAll['sum_tiw_money']) ?></td>
                                    <td class="text-primary">
                                        <div style="cursor:pointer" class="viwe_data"
                                            id="<?php echo $row_InvoiceDetailAll['inv_id'] ?>">
                                            ข้อมูลเพิ่มเติม...
                                        </div>
                                    </td>
                                </tr>
                                <?php }  mysql_free_result($InvoiceDetailAll);?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>

                <br />
                <!-- <div class="card">
                    <div class="card-body">
                        <div class="resposive">

                        </div>
                        
                    </div>
                </div> -->
                <?php require('ReportModal.php') ?>
            </div>
            <?php }
                else{ ?>
            <div class="col-4"></div>
            <h4>กรุณาเลือกวันที่เพื่อดูรายงาน...</h4>
            <?php } ?>
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
        $('#example1').DataTable();


    });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {

        $('.viwe_data').click(function() {
            var wid = $(this).attr('id');
            var date_start = <?php echo  json_encode($date_start); ?>;
            var date_end = <?php echo  json_encode($date_end); ?>;
            $.ajax({
                url: 'reportSelectInvioce.php',
                method: 'post',
                data: {
                    id: wid,
                    date_start: date_start,
                    date_end: date_end

                },
                success: function(data) {
                    $('#detail').html(data);
                    $('#dataModal').modal('show');
                }
            })
        })
    });
    </script>
</body>

</html>