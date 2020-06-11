<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/tanggal.inc.php';
$pro = new Tanggal($db);
$tgl = isset($_GET['tgl']) ? $_GET['tgl'] : die('ERROR: missing tgl.');
$pro->tgl = $tgl;

include_once 'includes/absen.inc.php';
$pro2 = new Absen($db);
$pro2->tgl = $tgl;
	
if($pro->delete()){
	$pro2->delete();
	echo "<script>location.href='data-tanggal.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='data-tanggal.php';</script>";
}
?>
