<?php require_once('nevbar.php');
Nevbar(); 
 require_once('Connections/myconnect.php');
 
 
mysql_select_db($database_myconnect, $myconnect);
$query_waybill = "SELECT * FROM tb_waybill 
LEFT JOIN tb_customer 
ON tb_waybill.customer_id = tb_customer.cus_id 
LEFT JOIN tb_car
ON tb_waybill.car_id = tb_car.car_id
WHERE tb_inv_status=1 and (tb_customer.cus_sub LIKE '%".$_GET["txtKeyword"]."%' or cus_compan LIKE '%".$_GET["txtKeyword"]."%' or tb_customer.cus_area LIKE '%".$_GET["txtKeyword"]."%' or wb_payment LIKE '%".$_GET["txtKeyword"]."%' )
ORDER BY wb_id";
$waybill = mysql_query($query_waybill, $myconnect) or die(mysql_error());
?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>รายการกำลังส่ง</title>
    <link rel="stylesheet" href="css/custom.css" />

</head>

<body>
    <div class="container">
        <br />
        <h2 align="center">รายการสินค้ากำลังส่ง</h2>
        <div class="row">
            <div class="col-sm-6">

                <form name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                    <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $_GET["txtKeyword"];?>">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="col-sm-6 ">
            </div>
        </div>
        <br />

        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            <div align="center">เลขที่ใบส่งของ</div>
                        </th>
                        <th>
                            <div align="center">รหัสใบรับสินค้า</div>
                        </th>
                        <th>
                            <div align="center">วันที่</div>
                        </th>
                        <th>
                            <div align="center">ชื่อบริษัท</div>
                        </th>
                        <th>
                            <div align="center">เลขที่ใบรับสินค้า</div>
                        </th>
                        <th>
                            <div align="center">อำเภอ</div>
                        </th>
                        <th>
                            <div align="center">ตำบล</div>
                        </th>
                        <th>
                            <div align="center">ยอดเงินค่าขนส่ง</div>
                        </th>
                        <!-- <th ><div align="center">จัดการ</div></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php while($row_waybill = mysql_fetch_array($waybill)) { 
                    $inv_detail = $row_waybill["wb_id"];
                            $query_data_tiw_wb_id = "SELECT * FROM tb_inv_wb 
                            WHERE `tiw_wb_id` IN ($inv_detail)";
                            $tiw_id = mysql_query($query_data_tiw_wb_id, $myconnect) or die(mysql_error());
                            ?>
                    <tr>

                        <td>
                            <div align="center"><?php echo mysql_fetch_array($tiw_id)[0] ?>
                            </div>
                        </td>
                        <td height="33">
                            <div align="center"><?php echo $row_waybill["wb_id_set"]; ?></div>
                        </td>
                        <td>
                            <div align="center">
                                <?php $date=date_create($row_waybill['wb_date']); echo date_format($date,"d/m/Y"); ?>
                        </td>
                        <td>
                            <div><?php echo $row_waybill['cus_compan']; ?></div>
                        </td>
                        <td>
                            <div><?php echo $row_waybill['wb_nbook']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['cus_area']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['cus_sub']; ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo $row_waybill['wb_money']; ?></div>
                        </td>

                        <!-- <td ><div align="center">
                      <a class="buttondetail" >ส่งแล้ว</a>
                      </td> -->

                    </tr>
                    <? } mysql_free_result($waybill); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>