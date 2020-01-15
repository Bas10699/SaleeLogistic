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
        <table class="" width="525" border="1">
          <tr>
            <td><table width="519" align="center">
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">รหัสใบส่งของ:</td>
                <td><input name="wb_id_set" id="wb_id_set" value='<?php echo $row_waybill['wb_id_set']; ?>' disabled/></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">เลขที่ใบส่งของ:</td>
                <td><input name="wb_nber" id="wb_nber" value='<?php echo $row_waybill['wb_nber']; ?>'/></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">เลมที่:</td>
                <td><input name="wb_nbook" id="wb_nbook" value='<?php echo $row_waybill['wb_nbook']; ?>'/></td>
              </tr>
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">ชื่อบริษัท:</td>
                <td>
                <select name="cus_compan" id="cus_compan">
                        <option selected disabled hidden><?php echo $row_waybill['cus_compan']; ?></option>
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
              <tr valign="baseline">
                <td nowrap="nowrap" align="right">สถานะการชำระเงิน:</td>
                <td>
                <select name="wb_payment" id="wb_payment">
                      <option selected disabled hidden><?php echo $row_waybill['wb_payment']; ?></option>
                      <option value="ยังไม่ได้ชำระ">ยังไม่ได้ชำระ</option>
                      <option value="ชำระแล้ว">ชำระแล้ว</option>
                    </select>
                    
              </tr>
              <!-- <tr valign="baseline">
                <td nowrap="nowrap" align="right">รูปภาพ:</td>
                <td><input type="file" name="wb_img" value="" size="32" /></td>
              </tr> -->
              <tr valign="baseline">
                <td colspan="2" align="right" nowrap="nowrap"><div align="center">
                
                </div>
                </td>
              </tr>
            </table>
              <div align="center"></div></td>
          </tr>
        </table>
        <br/>
        
      </div>
</body>
</html>
<?php } ?>