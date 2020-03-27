<?php
	// require('./fpdf/fpdf.php');
    require_once('Connections/myconnect.php');
    require('./pagegroup.php');

    define('FPDF_FONTPATH','font/');


    $id = $_GET["id"];
    mysql_select_db($database_myconnect, $myconnect);
      $query_data = "SELECT * FROM tb_invoice  WHERE inv_id=$id";
      $data = mysql_query($query_data, $myconnect) or die(mysql_error());
      $data1 = mysql_query($query_data, $myconnect) or die(mysql_error());

    class PDF extends PDF_PageGroup
	{
		function Header(){

            $num = (int)$_GET["id"]+$this->PageNo();
			
			$this->AddFont('angsa','','angsa.php');
         
            $this->SetFont('angsa','',18);
            $this->Cell(85);
            $this->Cell(30,10,iconv( 'UTF-8','TIS-620','ห้างหุ้นส่วนจำจัด โชคดีสาลี่ขนส่ง'),0,0,'C');
            $this->Ln(10);
            $this->Cell(85);
            $this->Cell(30,10,iconv( 'UTF-8','TIS-620','113 หมู่1 ตำบลพลายชุมพล อำเภอเมือง จังหวัดพิษณุโลก 65000'),0,0,'C');
            $this->Ln(10);
            $this->Cell(85);
            $this->Cell(30,10,iconv( 'UTF-8','TIS-620','เลขประจำตัวผู้เสียภาษี  0653557001657'),0,0,'C');
            $this->Ln(10);
            
            
		}

		function Footer(){
			$this->AddFont('angsa','','angsa.php');
			$this->SetFont('angsa','',16);
			$this->SetY(-50);
            $this->Cell(0,0,iconv( 'UTF-8','TIS-620','ลงชื่อ .......................................                '),0,1,"R");
            $this->Ln(10);
            $this->Cell(0,0,iconv( 'UTF-8','TIS-620','(......................................................)            '),0,1,"R");
            $this->Ln(10);
            $this->Cell(0,0,iconv( 'UTF-8','TIS-620','(ผู้รับ)                                   '),0,1,"R");
            
            $this->Ln(10);
            $this->SetY(-20);
            $this->Cell(0, 6, iconv( 'UTF-8','TIS-620','หน้า '.$this->GroupPageNo().'/'.$this->PageGroupAlias()), 0, 0, 'C');
            
		}
	 
	}

    $pdf=new PDF();
    $pdf->StartPageGroup();
	$pdf->SetMargins( 5,5,5 );
	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
    $pdf->SetFont('angsa','',15);
    


    while($row_data = mysql_fetch_array($data1)) { 
        $car_id = $row_data['inv_car_id'];
        $staff_id = $row_data['inv_staff_id'];
    
        $inv_detail = $row_data['inv_detail'];
        $query_data_inv = "SELECT * FROM tb_waybill 
        LEFT JOIN tb_customer 
        ON tb_waybill.customer_id = tb_customer.cus_id 
        LEFT JOIN tb_car
        ON tb_waybill.car_id = tb_car.car_id
        WHERE `wb_id` IN ($inv_detail)";
        $data_inv = mysql_query($query_data_inv, $myconnect) or die(mysql_error());

        $query_data_tiw_wb_id = "SELECT * FROM tb_inv_wb 
            WHERE `tiw_wb_id` IN ($inv_detail)";
            $tiw_id = mysql_query($query_data_tiw_wb_id, $myconnect) or die(mysql_error());
        
        
            $pdf->SetFont('angsa','',18);
            $pdf->Ln(10);
            $pdf->Cell(85);
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','รายการส่งสินค้า'),0,0,'C');
            $pdf->Ln(5);
            $pdf->SetFont('angsa','',15);
            
            $pdf->Ln(15);
            $pdf->Cell(22,10,iconv( 'UTF-8','TIS-620','ลำดับ'),1,0,"C");
            // $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','รหัสใบรับสินค้า'),1,0,"C");
            $pdf->Cell(50,10,iconv( 'UTF-8','TIS-620','รหัสใบส่งสินค้า'),1,0,"C");
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','วันที่'),1,0,"C");
            $pdf->Cell(40,10,iconv( 'UTF-8','TIS-620','ชื่อบริษัท'),1,0,"C");
            $pdf->Cell(28,10,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,0,"C");
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','หมายเหตุ'),1,0,"C");
            $pdf->Ln();
            
        while($row_data_inv = mysql_fetch_array($data_inv)) { 
            $i++;
            

            $date=date_create($row_data_inv['wb_date']);

            $pdf->Cell(22,10,iconv( 'UTF-8','TIS-620',$i),'LR',0,'C');
            // $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',$row_data_inv['wb_id_set']),'LR',0,'C');
            $pdf->Cell(50,10,iconv( 'UTF-8','TIS-620',mysql_fetch_array($tiw_id)[0]),'LR',0,'C');
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',date("Y-m-d")),'LR',0,'C');
            $pdf->Cell(40,10,iconv( 'UTF-8','TIS-620',$row_data_inv['cus_compan']),'LR',0,'C');
            $pdf->Cell(28,10,iconv( 'UTF-8','TIS-620',$row_data_inv['wb_money'].' '),'LR',0,'R');
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',''),'LR',0,'R');
            $pdf->Ln();
            
            }
        $pdf->Cell(200,0,'','T');
        $pdf->Ln(20);

            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','ทะเบียนรถ '),0,0,'L');
            $query_carId = "SELECT * FROM tb_car WHERE car_id=$car_id";
            $carId = mysql_query($query_carId, $myconnect) or die(mysql_error());
            while($row_carId = mysql_fetch_array($carId)) { 
                $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',$row_carId['car_register']),0,0,'C');
            }
            $pdf->Ln();
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','ชื่อ '),0,0,'L');
            $query_staff = "SELECT * FROM tb_staff WHERE staff_id=$staff_id";
            $staffId = mysql_query($query_staff, $myconnect) or die(mysql_error());
            while($row_staffId = mysql_fetch_array($staffId)) { 
                $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',$row_staffId['staff_title_name'].' '.$row_staffId['staff_name'].' '.$row_staffId['staff_lastname']),0,0,'C');
            }
            $pdf->Ln();
            $pdf->Ln(100);
           
            mysql_free_result($data_inv);
        }

        $pdf->StartPageGroup();
        $pdf->SetMargins( 5,5,5 );
        $pdf->AddPage();
        $pdf->AddFont('angsa','','angsa.php');
        $pdf->SetFont('angsa','',15);

        while($row_data = mysql_fetch_array($data)) { 
            $car_id = $row_data['inv_car_id'];
            $staff_id = $row_data['inv_staff_id'];
        
            $inv_detail = $row_data['inv_detail'];
            $query_data_inv = "SELECT * FROM tb_waybill 
            LEFT JOIN tb_customer 
            ON tb_waybill.customer_id = tb_customer.cus_id 
            LEFT JOIN tb_car
            ON tb_waybill.car_id = tb_car.car_id
            WHERE `wb_id` IN ($inv_detail)";
            $data_inv2 = mysql_query($query_data_inv, $myconnect) or die(mysql_error());

            $query_data_tiw_wb_id = "SELECT * FROM tb_inv_wb 
            WHERE `tiw_wb_id` IN ($inv_detail)";
            $tiw_id = mysql_query($query_data_tiw_wb_id, $myconnect) or die(mysql_error());

        
           
    
        while($row_data_inv = mysql_fetch_array($data_inv2)) { 
            $i++;
            // $pdf->SetY(50);
            $pdf->SetFont('angsa','',16);
            $pdf->Ln(5);
            $pdf->Cell(155);
            $pdf->Cell(0,0,iconv( 'UTF-8','TIS-620','เลขที่ใบส่งสินค้า   '.mysql_fetch_array($tiw_id)[0]),0,1,"L");
            
            $pdf->Ln(10);
            $pdf->Cell(155);
            $pdf->Cell(0,0,iconv( 'UTF-8','TIS-620','วันที่ '.date("Y-m-d")),0,1,"L");
            $pdf->Ln(5);
            $pdf->Cell(85);
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','รายการส่งสินค้า'),0,0,'C');
            $pdf->Ln(20);

            $pdf->SetFont('angsa','',15);
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','ลำดับ'),1,0,"C");
            $pdf->Cell(40,10,iconv( 'UTF-8','TIS-620','รหัสใบรับสินค้า'),1,0,"C");
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','วันที่'),1,0,"C");
            $pdf->Cell(40,10,iconv( 'UTF-8','TIS-620','ชื่อบริษัท'),1,0,"C");
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,0,"C");
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','หมายเหตุ'),1,0,"C");
            $pdf->Ln();

            $date=date_create($row_data_inv['wb_date']);

            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','1'),'LR',0,'C');
            $pdf->Cell(40,10,iconv( 'UTF-8','TIS-620',$row_data_inv['wb_id_set']),'LR',0,'C');
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',date_format($date,"d/m/Y")),'LR',0,'C');
            $pdf->Cell(40,10,iconv( 'UTF-8','TIS-620',$row_data_inv['cus_compan']),'LR',0,'C');
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',$row_data_inv['wb_money'].' '),'LR',0,'R');
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',''),'LR',0,'R');
            $pdf->Ln();
            $pdf->Cell(30,50,iconv( 'UTF-8','TIS-620',''),'LR',0,'R');
            $pdf->Cell(40,50,iconv( 'UTF-8','TIS-620',''),'LR',0,'R');
            $pdf->Cell(30,50,iconv( 'UTF-8','TIS-620',''),'LR',0,'R');
            $pdf->Cell(40,50,iconv( 'UTF-8','TIS-620',''),'LR',0,'R');
            $pdf->Cell(30,50,iconv( 'UTF-8','TIS-620',''),'LR',0,'R');
            $pdf->Cell(30,50,iconv( 'UTF-8','TIS-620',''),'LR',0,'R');
            $pdf->Ln();
            $pdf->Cell(200,0,'','T');
            $pdf->Ln(30);


            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','ทะเบียนรถ '),0,0,'L');
            $query_carId = "SELECT * FROM tb_car WHERE car_id=$car_id";
            $carId = mysql_query($query_carId, $myconnect) or die(mysql_error());
            while($row_carId = mysql_fetch_array($carId)) { 
                $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',$row_carId['car_register']),0,0,'C');
            }
            $pdf->Ln();
            $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620','ชื่อ '),0,0,'L');
            $query_staff = "SELECT * FROM tb_staff WHERE staff_id=$staff_id";
            $staffId = mysql_query($query_staff, $myconnect) or die(mysql_error());
            while($row_staffId = mysql_fetch_array($staffId)) { 
                $pdf->Cell(30,10,iconv( 'UTF-8','TIS-620',$row_staffId['staff_title_name'].' '.$row_staffId['staff_name'].' '.$row_staffId['staff_lastname']),0,0,'C');
            }
            $pdf->Ln();
            $pdf->Ln(100);
            }
        }


	$pdf->Output();
?>