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

$bln = isset($_GET['bln']) ? $_GET['bln'] : die('ERROR: missing Bulan.');
$thn = isset($_GET['thn']) ? $_GET['thn'] : die('ERROR: missing Tahun.');

	if ($bln==1) {
        $nb="Januari";
    }elseif ($bln==2) {
        $nb="Februari";
    }elseif ($bln==3) {
        $nb="Maret";
    }elseif ($bln==4) {
        $nb="April";
    }elseif ($bln==5) {
        $nb="Mei";
    }elseif ($bln==6) {
        $nb="Juni";
    }elseif ($bln==7) {
        $nb="Juli";
    }elseif ($bln==8) {
        $nb="Agustus";
    }elseif ($bln==9) {
        $nb="September";
    }elseif ($bln==10) {
        $nb="Oktober";
    }elseif ($bln==11) {
        $nb="November";
    }else{
        $nb="Desember";
    }
 
include_once 'includes/absen.inc.php';
$pro1 = new Absen($db);
$pro1->bln = $bln;
$pro1->thn = $thn;

include_once 'includes/guru.inc.php';
$pro2 = new Guru($db);
$stmt21 = $pro2->readAll();

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->Cell(40,10,'Laporan Absen '.$nb.' '.$thn,0,0,'L');
$pdf->ln();
$pdf->SetFont('Times','B',10);
$pdf->Cell(20,7,'NIP',1,0,'L');
$pdf->Cell(40,7,'Nama Guru',1,0,'L');
$pdf->Cell(25,7,'Hadir',1,0,'L');
$pdf->Cell(25,7,'Tidak Hadir',1,0,'L');
$pdf->Cell(25,7,'Sakit',1,0,'L');
$pdf->Cell(25,7,'Izin',1,0,'L');
$pdf->Cell(25,7,'Total',1,0,'L');


while ($row1 = $stmt21->fetch(PDO::FETCH_ASSOC)){
	$pro1->nip = $row1['nip'];
	$pdf->ln();
	$pdf->SetFont('Times','',10);
	$pdf->Cell(20,7,$row1['nip'],1,0,'L');
	$pdf->Cell(40,7,$row1['nama_guru'],1,0,'L');
	$stmt11 = $pro1->hadir();
	$pdf->Cell(25,7,$stmt11,1,0,'L');
	$stmt12 = $pro1->tidak_hadir();
	$pdf->Cell(25,7,$stmt12,1,0,'L');
	$stmt13 = $pro1->sakit();
	$pdf->Cell(25,7,$stmt13,1,0,'L');
	$stmt14 = $pro1->izin();
	$pdf->Cell(25,7,$stmt14,1,0,'L');
	$stmt15 = $pro1->total();
	$pdf->Cell(25,7,$stmt15,1,0,'L');
}

$pdf->ln();

$pdf->Output();
?>
