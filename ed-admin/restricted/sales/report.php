<?php  
	require "../../fpdf/fpdf.php";

	class PDF extends FPDF {
		function header() {
			$this->Image('../../../temp-img/etiendahan-logo.png', 118, 8);
			$this->SetFont('Arial', 'B', 16);
			$this->Cell(276, 45, 'SALES REPORT', 0, 0, 'C');
			$this->Ln();
		}	

		function footer() {
			$this->SetY(-15);
			$this->SetFont('Arial', '', 8);
			$this->Cell(0, 10, 'Page'.$this->PageNo().'/{nb}', 0, 0, 'C');
		}

		function headerTable() {
			$this->SetFont('Times', 'B', 12);
			$this->Cell(55, 10, 'Order ID', 1, 0, 'C');
			$this->Cell(55, 10, 'Product Name', 1, 0, 'C');
			$this->Cell(55, 10, 'Quantity', 1, 0, 'C');
			$this->Cell(55, 10, 'Email', 1, 0, 'C');
			$this->Cell(55, 10, 'Date Placed', 1, 0, 'C');
			$this->Ln();
		}
	}

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L', 'A4', 0);
	$pdf->headerTable();
	$pdf->Output();
?>