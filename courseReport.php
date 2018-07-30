
<?php
	require('fpdf/fpdf.php');
	require_once 'php_action/connection.php';
 	require_once 'php_action/connect.php';
 	$db = new PDO('mysql:host=localhost;dbname=evaluation_system','root','');
 	$output = '';
 	class myPDF extends FPDF
 	{
 		function header()
 		{
 			$this->SetFont('Arial','B',16);
			$this->SetTextColor(0,0,250);
			$this->Cell(0,10,"All Course ",1,0,'C');
			$this->ln();
			$this->SetFont('times','',12);
			$this->SetTextColor(0,0,0);
			$this->Cell(176,10,"",0,0,'C');
			$this->ln(20);
 		}
 		function footer()
 		{
 			$this->SetY(-15);
	    	$this->SetFont('Arial','I',8);
	   		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    	
 		}
 		function headerTable()
 		{
 			$this->SetFont('Times','B',12);
 			$this->Cell(50,10,'Course Name',1,0,'c');
 			$this->Cell(20,10,'Credit',1,0,'c');
 			$this->Cell(30,10,'Frist Name',1,0,'c');
 			$this->Cell(30,10,'Last Name',1,0,'c');
 			$this->Cell(100,10,'Departement Name',1,0,'c');
 			$this->Cell(15,10,'Level',1,0,'c');
 			$this->ln();
 		}
 		function viewTable($db)
 		{
 			$this->SetFont('Times','',12);
 			$stmt = $db->query("SELECT * FROM  course where action<>1");
              while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
              	$rs = $db->query("SELECT * FROM departement where dept_id='".$data->dept_id."'");
              		$record = $rs->fetch(PDO::FETCH_OBJ);
              		$lect = $db->query("SELECT * FROM Lecturer where lecturer_id='".$data->lecturer_id."'");
              		$record_lect = $lect->fetch(PDO::FETCH_OBJ);
 				{
		 			$this->Cell(50,10,$data->course_name,1,0,'L');
		 			$this->Cell(20,10,$data->credit,1,0,'L');
		 			$this->Cell(30,10,$record_lect->first_name,1,0,'L');
		 			$this->Cell(30,10,$record_lect->last_name,1,0,'L');
		 			$this->Cell(100,10,$record->dept_name,1,0,'L');
		 			$this->Cell(15,10,$data->level,1,0,'L');
		 			$this->ln();
 				}

 		}
 	}
 }
 	    $pdf = new myPDF();
 	    $pdf->AliasNbPages();
 		$pdf->AddPage('L','A4',0);
 		$pdf->headerTable();
 		$pdf->viewTable($db);
	 		
 	$pdf->output();
 			
 		
	    	
 	
?>