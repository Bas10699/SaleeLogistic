<?php
require_once('Connections/myconnect.php');
// ob_start();
// print_r($_POST["staff_id"]);
// print_r(':');
// print_r($_POST["car_id"]);
// $columns = implode(",",$_POST["listData"]);
// print_r($columns);
if($_POST["listData"] && $_POST["staff_id"] && $_POST["car_id"]){
    $staff_id = $_POST["staff_id"];
    $car_id = $_POST["car_id"];
    $list = $_POST["listData"];
    // $ids = join("','",$_POST["listData"]);
    $columns = implode(",",$_POST["listData"]);
    // $escaped_values = array_map('mysql_real_escape_string', array_values($insData));
    // $values  = implode(", ", $escaped_values);
    mysql_select_db($database_myconnect, $myconnect);

    $query_insert = "INSERT INTO tb_invoice (inv_car_id, inv_staff_id, inv_detail) 
                     VALUES ($car_id,$staff_id,'$columns')";
    $insertData = mysql_query($query_insert, $myconnect) or die(mysql_error());
    $inv_id = mysql_insert_id();

    for($test = 0; $test < count($list); $test++){
        $query_insert = "INSERT INTO tb_inv_wb (tiw_wb_id,tiw_inv_id) 
                     VALUES ('$list[$test]',$inv_id)";
    $insertData = mysql_query($query_insert, $myconnect) or die(mysql_error());

    $query_update = "UPDATE tb_waybill SET tb_inv_status=1, car_id=$car_id, staff_id=$staff_id WHERE wb_id=$list[$test]";
    $updateData = mysql_query($query_update, $myconnect) or die(mysql_error());
    }
    
    

    $id = mysql_insert_id();
    $insertGoTo = "pdf_real.php?id=$id";
    header(sprintf("Location: %s", $insertGoTo));
}
?>

