<?php require_once('upload.php'); ?>
<?php

  $servername = "localhost";
  $username = "root";
  $password = "12345678";
  $dbname = "saleelogistic";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  $conn->set_charset("utf8");

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $wb_id_set = $_POST["wb_id_set"];
  $wb_nber = $_POST["wb_nber"];
  $wb_nbook = $_POST["wb_nbook"];
  $cus_compan = $_POST["cus_compan"];
  $wb_date = $_POST["wb_date"];
  $wb_money = $_POST["wb_money"];
  $wb_payment = $_POST["wb_payment"];
  $wb_img = $_POST['wb_img'];

Upload($_POST['wb_img']);


  $sql = "UPDATE tb_waybill SET 
            wb_nber = '$wb_nber', 
            wb_nbook = '$wb_nbook', 
            customer_id = '$cus_compan',
            wb_date = '$wb_date',
            wb_money = '$wb_money',
            wb_img = '$wb_img',
            wb_payment = '$wb_payment' 
          WHERE wb_id_set = '$wb_id_set'";

  if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }

  $conn->close();

/*
  echo $_POST["wb_id_set"];
  echo $_POST["wb_nber"];
  echo $_POST["wb_nbook"];
  echo $_POST["cus_compan"];
  echo $_POST["wb_date"];
  echo $_POST["wb_money"];
  echo $_POST["wb_payment"];*/

?>