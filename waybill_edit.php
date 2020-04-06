<?php require_once('upload.php'); ?>
<?php

function Editdata($row_waybill,$customer){
  ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>แก้ไข</title>
</head>

<body>

    <form name="myForm" action="waybilledit.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <img id="photo_profile" src="picture/<?php echo $row_waybill['wb_img']; ?>"
                                    class="img-fluid" width="460" height="345" />
                                <input type="file" name="wb_img" id="wb_img" class="form-control-file border"
                                    onChange="readURL(this);" value='<?php echo $row_waybill['wb_img']; ?>' size="32" />

                                <script>
                                function readURL(input) {
                                    OnUploadCheck();
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            $("#photo_profile").attr("src", e.target.result);
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                function OnUploadCheck() {
                                    var extall = "jpg,jpeg,png";
                                    file = $("#wb_img").val();
                                    ext = file.split('.').pop().toLowerCase();
                                    if (parseInt(extall.indexOf(ext)) < 0) {
                                        alert(es + extall);
                                        $("#wb_img").val("").focus();
                                        // $("#photo_profile").attr("src", "../../img/profile-default.png");
                                        return false;
                                    }


                                    return true;
                                }
                                </script>

                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <lable class="col-sm-3">รหัสใบส่งของ:</lable>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="wb_id" id="wb_id"
                                            value='<?php echo $row_waybill['wb_id']; ?>' />

                                        <td><input name="wb_id_set" id="wb_id_set"
                                                value='<?php echo $row_waybill['wb_id_set']; ?>' disabled
                                                class="form-control" />
                                            <input type="hidden" name="wb_id_set" id="wb_id_set"
                                                value='<?php echo $row_waybill['wb_id_set']; ?>' />
                                            <input type="hidden" name="wb_id" id="wb_id"
                                                value='<?php echo $_GET['id']; ?>' />
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <lable class="col-sm-3">เลขที่ใบส่งของ:</lable>
                                    <div class="col-sm-9">
                                        <input name="wb_nber" id="wb_nber" class="form-control"
                                            value='<?php echo $row_waybill['wb_nber']; ?>' />
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <lable class="col-sm-3">เล่มที่:</lable>
                                    <div class="col-sm-9"><input name="wb_nbook" id="wb_nbook" class="form-control"
                                            value='<?php echo $row_waybill['wb_nbook']; ?>' /> </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <lable class="col-sm-3">ชื่อบริษัท:</lable>
                                    <div class="col-sm-9">
                                        <select name="cus_compan" id="cus_compan" class="form-control">
                                            <option value=<?php echo $row_waybill["cus_id"]; ?> selected>
                                                <?php echo $row_waybill['cus_compan']; ?></option>
                                            <?php while($row_customer = mysql_fetch_array($customer)) { ?>
                                            <option value=<?php echo $row_customer["cus_id"]; ?>>
                                                <?php echo $row_customer["cus_compan"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <lable class="col-sm-3">วันที่:</lable>
                                    <div class="col-sm-9"><input type='date' name="wb_date" id="wb_date"
                                            class="form-control" value='<?php echo $row_waybill['wb_date'];?>' />
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <lable class="col-sm-3">จำนวนเงินทั้งสิ้น:</lable>
                                    <div class="col-sm-9"><input name="wb_money" id="wb_money" class="form-control"
                                            value='<?php echo $row_waybill['wb_money']; ?>' />
                                    </div>
                                </div>
                                <hr />
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                    <div class="btn btn-danger" onclick="window.location.reload()">ยกเลิก</div>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
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