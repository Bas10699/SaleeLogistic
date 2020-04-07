<?php require_once('nevbar.php');
ob_start();
Nevbar(); ?>
<?php require_once('Connections/myconnect.php'); ?>
<?php require_once('upload.php'); ?>



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



// print_r($_FILES['wb_img']);
  $insertSQL = sprintf("INSERT INTO tb_waybill (wb_id, wb_nbook, wb_date, wb_money, wb_nber, customer_id) VALUES ( %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['wb_id'], "int"),
                       GetSQLValueString($_POST['wb_nbook'], "text"),
                       GetSQLValueString($_POST['wb_date'], "text"),
                       GetSQLValueString($_POST['wb_money'], "double"),
                      //  GetSQLValueString($_POST['wb_payment'], "text"),
                       GetSQLValueString($_POST['wb_nber'], "text"),
					             GetSQLValueString($_POST['cus_compan'], "text"));

  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());

  $id = mysql_insert_id();
  $id_SET = sprintf('B-%04d', $id);
  
  

  $path="./picture/";
  $last = strtolower(end(explode('.',$_FILES['wb_img']['name'])));
	$name = $id_SET.'.'.$last;
  Upload($_FILES['wb_img'],$path.$name);

  $insertSQL1 = sprintf("UPDATE tb_waybill SET wb_id_set=%s, wb_img=%s WHERE wb_id=%s",
                    GetSQLValueString($id_SET,"text"),
                    GetSQLValueString($name,"text"),
                    GetSQLValueString($id,"text"));
  mysql_select_db($database_myconnect, $myconnect);
  $Result2 = mysql_query($insertSQL1, $myconnect) or die(mysql_error());

  $insertGoTo = "waybill_show.php";

  header(sprintf("Location: %s", $insertGoTo));
  // echo "<script>window.location.herf='/waybill_show.php'</script>";



?>

