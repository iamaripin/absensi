<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/guru.inc.php';
$pro = new Guru($db);
$nip = isset($_GET['nip']) ? $_GET['nip'] : die('ERROR: missing nip.');
$pro->nip = $nip;
	
if($pro->delete()){
	echo "<script>location.href='data-guru.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='data-guru.php';</script>";
}
?>
