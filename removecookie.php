<?php
ob_start();
setcookie("UserName");
header("Location: index.php" );
ob_end_flush();
?>