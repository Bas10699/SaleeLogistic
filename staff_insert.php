<?php require_once('Connections/myconnect.php'); ?>
<?php
  $staff_name = $_POST['staff_name'];
  $staff_lastname = $_POST['staff_lastname'];
  $staff_card = $_POST['staff_card'];
  $staff_position = $_POST['staff_position'];
  $staff_tel = $_POST['staff_tel'];
  $staff_title_name = $_POST['staff_title_name'];
  $insertSQL = "INSERT INTO tb_staff SET staff_name='$staff_name', 
                                         staff_lastname='$staff_lastname',
                                         staff_card='$staff_card',
                                         staff_position='$staff_position',
                                         staff_tel='$staff_tel',
                                         staff_title_name='$staff_title_name'";
                
  mysql_select_db($database_myconnect, $myconnect);
  $Result1 = mysql_query($insertSQL, $myconnect) or die(mysql_error());
    
  $id = mysql_insert_id();
  $id_SET = sprintf('S-%03d', $id);
  $insertSQL1 = "UPDATE tb_staff SET staff_id_set='$id_SET' WHERE staff_id=$id";
  mysql_select_db($database_myconnect, $myconnect);
  $Result2 = mysql_query($insertSQL1, $myconnect) or die(mysql_error());

  header("Location: staff_show.php");

?>
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>เพิ่มข้อมูลพนักงาน</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
<table width="100%" height="579" align="center">
 
  <tr>
    <td colspan="9">&nbsp;</td>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="79" colspan="9"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <h2 align="center">เพิ่มข้อมูลพนักงาน</h2>
      <div align="center">
        <table width="539" height="201" style=' border-collapse: collapse; border: 1px solid black;'>
          <tr>
            <td ><table width="533" height="228" align="center">
              <tr>
                <td ><div align="left">รหัสพนักงาน :</div></td>
                <td height="35" ><input name="staff_id" type="text" disabled="disabled" id="staff_id" size="20" style="background-color:#CCC" /></td>
                </tr>
              <tr>
                <td width="165" ><div align="left">คำนำหน้าชื่อ :</div></td>
                <td height="36" ><select name="staff_title_name" id="staff_title_name">
                  <option value="นาย">นาย</option>
                  <option value="นาง">นาง</option>
                  <option value="นางสาว">นางสาว</option>
                  
                </select></td>
                </tr>
              <tr>
              <tr>
                <td width="165" ><div align="left">ชื่อ :</div></td>
                <td width="356" height="36" ><input name="staff_name" type="text" id="staff_name" /></td>
                </tr>
              <tr>
              <tr>
                <td width="165" ><div align="left">นามสกุล :</div></td>
                <td width="356" height="36" >
                  <input name="staff_lastname" type="text" id="staff_lastname" size="21" /></td>
                </tr>
              <tr>
                <td ><div align="left">เลขบัตรประชาชน :</div></td>
                <td height="35" ><input name="staff_card" type="text" id="staff_card" pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" size="47" maxlength="13" /></td>
                </tr>
              <tr>
                <td ><div align="left">ตำแหน่ง :</div></td>
                <td height="36" ><select name="staff_position" id="staff_position">
                  <option value="Manager">Manager</option>
                  <option value="Driver">Driver</option>
                </select></td>
                </tr>
              <tr>
                <td ><div align="left">เบอร์โทรศัพท์ : </div></td>
                <td height="33" ><input name="staff_tel" type="text" id="staff_tel" pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" size="47" maxlength="10" /></td>
                </tr>
              <tr>
                <td height="37" colspan="2" ><div align="center">
                  <input name="staff_bt" type="submit" id="staff_bt" value="บันทึกข้อมูลพนักงาน" />
                </div></td>
                </tr>
              </table></td>
            </tr>
        </table>
        
        
        <input type="hidden" name="MM_insert" value="form1" />
      </div>
    </form></td>
  </tr>
  <tr>
    <td colspan="9"><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html> -->

