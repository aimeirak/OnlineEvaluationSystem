
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
			$this->Cell(0,10,"All Departement In IPRC SOUTH",1,0,'C');
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
 			$this->Cell(200,10,'Departement Name',1,0,'C');
 			$this->Cell(50,10,'Level',1,0,'C');
 			$this->ln();
 		}
 		function viewTable($db)
 		{
 			$this->SetFont('Times','',12);
 			$stmt = $db->query("SELECT * FROM  departement where action<>1");
              while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
 				{
 					
		 			$this->Cell(200,10,$data->dept_name,1,0,'C');
		 			$this->Cell(50,10,$data->level,1,0,'C');
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