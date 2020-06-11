<?php
require('includes/fpdf/fpdf.php');

class PDF extends FPDF{
	
	function PDF($orientation='P', $unit='mm', $size='A4'){
	    $this->FPDF($orientation,$unit,$size);
	}
	
	function Header(){
	    $this->SetFont('Times','B',14);
	    $this->Cell(80);
	    $this->Cell(30,10,'LAPORAN SISTEM INFORMASI ABSENSI',0,0,'C');
	    $this->Ln(20);
	}
	
	function Footer(){
	    $this->SetY(-15);
	    $this->SetFont('Times','',8);
	    $this->Cell(0,10,$this->PageNo(),0,0,'R');
	}
	
}

include "includes/config.php";
session_start();
if(!isset($_SESSION['nama_pengguna'])){
	echo "<script>location.href='index.php'</script>";
}
$config = new Config();
$db = $config->getConnection();
 
include_once 'includes/guru.inc.php';
$pro1 = new Guru($db);
$stmt1 = $pro1->readAll();

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->Cell(40,10,'Laporan Data Guru',0,0,'L');
$pdf->ln();
$pdf->SetFont('Times','B',10);
$pdf->Cell(20,7,'NIP',1,0,'L');
$pdf->Cell(30,7,'Nama Guru',1,0,'L');
$pdf->Cell(30,7,'Jenis Kelamin',1,0,'L');
$pdf->Cell(50,7,'Tempat Tanggal Lahir',1,0,'L');
$pdf->Cell(60,7,'Alamat',1,0,'L');

while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
	$pdf->ln();
	$pdf->SetFont('Times','',10);
	$pdf->Cell(20,7,$row1['nip'],1,0,'L');
	$pdf->Cell(30,7,$row1['nama_guru'],1,0,'L');
	$pdf->Cell(30,7,$row1['jenis_kelamin'],1,0,'L');
	$pdf->Cell(50,7,$row1['tempat_lahir'].', '.$row1['tanggal_lahir'],1,0,'L');
	$pdf->Cell(60,7,$row1['alamat'],1,0,'L');
}

$pdf->ln();

$pdf->Output();
?>
