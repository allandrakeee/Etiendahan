<?php  
	require "../../fpdf/fpdf.php";
	$db = new PDO('mysql:host=localhost;dbname=db_etiendahan', 'root', 'Wcfajmeojnapa1');

	class PDF extends FPDF {
		function header() {
			$this->Image('../../../temp-img/etiendahan-logo-half.png', 10, 10, 15);
			$this->SetFont('Arial', 'B', 16);
			$this->Cell(80, 16, 'SALES REPORT', 0, 1, 'C');
			$this->Ln(5);
		}	

		function footer() {
			$this->SetY(-15);
			$this->SetFont('Arial', '', 8);
			$this->Cell(0, 10, 'Page'.$this->PageNo().'/{nb}', 0, 0, 'C');
		}

		function headerTable() {
			$this->SetFont('Times', 'B', 11);
			$this->SetFillColor(220,220,220);
			$this->SetDrawColor(0, 0, 0);
			$this->Cell(43, 10, 'ORDER ID', 1, 0, 'C', true);
			$this->Cell(100, 10, 'PRODUCT NAME', 1, 0, 'C', true);
			$this->Cell(30, 10, 'QUANTITY', 1, 0, 'C', true);
			$this->Cell(60, 10, 'EMAIL', 1, 0, 'C', true);
			$this->Cell(43, 10, 'DATE PLACED', 1, 0, 'C', true);
			$this->Ln();
		}

		function viewTable($db) {
			$this->SetFont('Times', '', 10);

			$result = $db->query("SELECT o.unique_hash_id, p.name, o.quantity, o.email, DATE_FORMAT(o.created_at, '%M %d, %Y') AS date_placed FROM tbl_orders o join tbl_products p on(o.product_id = p.id)");
			while($row = $result->fetch(PDO::FETCH_OBJ)) {
				$this->Cell(43, 10, $row->unique_hash_id, 1, 0, 'C');
				
				if($this->GetStringWidth($row->name) >= 98) {
					$this->SetFont('Times', '', 8);
					$this->Cell(100, 10, $row->name, 1, 0, 'L');
					$this->SetFont('Times', '', 10);
				} else {
					$this->Cell(100, 10, $row->name, 1, 0, 'L');
				}
				
				$this->Cell(30, 10, $row->quantity, 1, 0, 'C');

				if($this->GetStringWidth($row->email) >= 58) {
					$this->SetFont('Times', '', 8);
					$this->Cell(60, 10, $row->email, 1, 0, 'C');
					$this->SetFont('Times', '', 10);
				} else {
					$this->Cell(60, 10, $row->email, 1, 0, 'C');
				}

				$this->Cell(43, 10, $row->date_placed, 1, 0, 'C');
				$this->Ln();
			}
		}
	}

	$pdf = new PDF();
	$pdf->AliasNbPages();
	// $pdf->SetAutoPageBreak(true, 15);
	$pdf->AddPage('L', 'A4', 0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	$pdf->Output();
?>