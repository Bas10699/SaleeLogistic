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

$colname_Recordset1 = "-1";
if (isset($_POST['word'])) {
  $colname_Recordset1 = $_POST['word'];
}
mysql_select_db($database_myconnect, $myconnect);
$query_Recordset1 = sprintf("SELECT * FROM tb_waybill WHERE wb_nbook LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $myconnect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1" align="center">
  <tr>
    <td>wb_id</td>
    <td>wb_nbook</td>
    <td>wb_date</td>
    <td>wb_money</td>
    <td>wb_payment</td>
    <td>wb_img</td>
    <td>wb_nber</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['wb_id']; ?></td>
      <td><?php echo $row_Recordset1['wb_nbook']; ?></td>
      <td><?php echo $row_Recordset1['wb_date']; ?></td>
      <td><?php echo $row_Recordset1['wb_money']; ?></td>
      <td><?php echo $row_Recordset1['wb_payment']; ?></td>
      <td><?php echo $row_Recordset1['wb_img']; ?></td>
      <td><?php echo $row_Recordset1['wb_nber']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
