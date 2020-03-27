<?php require_once('upload.php'); ?>
<?php

function Editdata($row_waybill,$customer){
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แก้ไข</title>
</head>

<body>
<div align="center" >

        
        <form name="myForm" action="waybilledit.php"  method="POST" enctype="multipart/form-data">
        <table class="" width="525" border="1">
          <tr>
            <td><table width="519" align="center">
            <div align="center">
            <img src="picture/<?php echo $row_waybill['wb_img']; ?>" width="100" height="150"/>
            </div>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">รหัสใบส่งของ:</td>
                <td><input name="wb_id_set" id="wb_id_set" value='<?php echo $row_waybill['wb_id_set']; ?>' disabled/>
                <input type="hidden" name="wb_id_set" id="wb_id_set" value='<?php echo $row_waybill['wb_id_set']; ?>' />
                <input type="hidden" name="wb_id" id="wb_id" value='<?php echo $_GET['id']; ?>' /></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">เลขที่ใบส่งของ:</td>
                <td><input name="wb_nber" id="wb_nber" value='<?php echo $row_waybill['wb_nber']; ?>'/></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">เล่มที่:</td>
                <td><input name="wb_nbook" id="wb_nbook" value='<?php echo $row_waybill['wb_nbook']; ?>'/></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">ชื่อบริษัท:</td>
                <td>
                <select name="cus_compan" id="cus_compan">
                      <option value=<?php echo $row_waybill["cus_id"]; ?> selected><?php echo $row_waybill['cus_compan']; ?></option>
                     <?php while($row_customer = mysql_fetch_array($customer)) { ?>
                       <option value=<?php echo $row_customer["cus_id"]; ?>><?php echo $row_customer["cus_compan"]; ?></option>
                     <? } ?>
                    </select>
                   </td> 
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">วันที่:</td>
                <td><input type='date' name="wb_date" id="wb_date" value='<?php echo $row_waybill['wb_date'];?>'/></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">จำนวนเงินทั้งสิ้น:</td>
                <td><input name="wb_money" id="wb_money" value='<?php echo $row_waybill['wb_money']; ?>'/></td>
              </tr>
<<<<<<< HEAD
=======
              <!-- <tr valign="baseline">
                <td nowrap="nowrap" align="right">สถานะการชำระเงิน:</td>
                <td>
                    <?php switch ($row_waybill['wb_payment']) {
                        case "ยังไม่ได้ชำระ":?>
                          <input type="radio" name="wb_payment" value="ยังไม่ได้ชำระ"  checked>ยังไม่ได้ชำระ
                          <input type="radio" name="wb_payment" value="ชำระแล้ว">ชำระแล้ว
                        <?php break;
                        default: ?>
                          <input type="radio" name="wb_payment" value="ยังไม่ได้ชำระ"  >ยังไม่ได้ชำระ
                          <input type="radio" name="wb_payment" value="ชำระแล้ว" checked>ชำระแล้ว
                      <?php } ?>
                    
              </tr> -->
>>>>>>> bad6ad242e508f3cca3b64cd88ce66cc24a067bb
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">รูปภาพ:</td>
                <td><input type="file" name="wb_img" id="wb_img" value='<?php echo $row_waybill['wb_img']; ?>' size="32" /></td>
              </tr> 
              <tr valign="baseline">
                <td colspan="2" align="right" nowrap="nowrap"><div align="center">
                
                </div>
                </td>
              </tr>
              <tr valign="baseline">
                <td colspan="2" align="right" nowrap="nowrap"><div align="center">
                  
                </div>
                </td>
              </tr>
            </table>
              <div align="center"></div></td>
          </tr>
          
        </table><button type="submit" >ยืนยัน</button>
        <br/>
        </form>

      </div>
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      <script>
      $(document).ready(function(){
        $('#btn_edit').on('click',function(){
    
          $.ajaxSetup({
            
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
      
          $.ajax({
            method: "POST",
            url: "waybilledit.php",
            data: {
              wb_id_set: $('#wb_id_set').val(),
              wb_nber: $('#wb_nber').val(),
              wb_nbook: $('#wb_nbook').val(),
              cus_compan: $('#cus_compan').val(),
              wb_date: $('#wb_date').val(),
              wb_money: $('#wb_money').val(),
              wb_payment: $('#wb_payment').val(),
              wb_img: $('#wb_img')[0].files[0]
            }
          }).done(function(msg){
              console.log(msg)
              // location.reload()
          });
        
        
          console.log($('#wb_img')[0].files[0])

          /*console.log($('#wb_id_set').val())
          console.log($('#wb_nber').val())
          console.log($('#wb_nbook').val())
          console.log($('#cus_compan').val())
          console.log($('#wb_date').val())
          console.log($('#wb_money').val())
          console.log($('#wb_payment').val())*/
        })
      })

      
      </script> -->
</body>
</html>
<?php } ?>