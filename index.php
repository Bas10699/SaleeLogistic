<?php require_once('Connections/myconnect.php'); ?>
<?php session_start();
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

mysql_select_db($database_myconnect, $myconnect);
$query_login = "SELECT * FROM tb_login";
$login = mysql_query($query_login, $myconnect) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['login_user'])) {
  $loginUsername=$_POST['login_user'];
  $password=$_POST['login_pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "indexhome.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_myconnect, $myconnect);
  
  $LoginRS__query=sprintf("SELECT login_use, login_pass FROM tb_login WHERE login_use=%s AND login_pass=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $myconnect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="506" height="446" align="center">
    <tr align="center">
      <td height="30" colspan="2" bgcolor=""><table width="100">
        <tr>
          <td><img src="img/เข้าสู่ระบบ.gif" width="500" height="100" /></td>
        </tr>
      </table>
      <p><img src="img/login.png" alt="" width="205" height="181" class="img-responsive" /></p></td>
    </tr>
    <tr>
      <td width="171" height="31" align="right" bgcolor="#CCCCCC"><h4>ชื่อผู้ใช้งาน :</h4></td>
      <td width="350" bgcolor="#CCCCCC"><label>
        <input name="login_user" type="text" id="login_user" size="30" required="required"/>
      </label></td>
    </tr>
    <tr>
      <td height="32" align="right" bgcolor="#CCCCCC"><h4>รหัสผ่าน :</h4></td>
      <td bgcolor="#CCCCCC"><label>
        <input name="login_pass" type="password" id="login_pass" size="30" required="required" />
      </label></td>
    </tr>
    <tr>
      <td height="66" colspan="2" bgcolor=""><div align="center">
        <input name="bt_login" type="image" id="bt_login" src="img/ตกลง.png" align="middle" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
<?php
mysql_free_result($login);
?>
