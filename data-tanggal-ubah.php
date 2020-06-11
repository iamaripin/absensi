<?php
include_once 'header.php';
$tgl = isset($_GET['tgl']) ? $_GET['tgl'] : die('ERROR: missing tgl.');

include_once 'includes/tanggal.inc.php';
$eks = new Tanggal($db);

$eks->tgl = $tgl;

$eks->readOne();

if($_POST){

	$eks->ket = $_POST['ket'];
	
	if($eks->update()){
		echo "<script>location.href='data-tanggal.php'</script>";
	} else{
	?>
	<script type="text/javascript">
	window.onload=function(){
		showStickyErrorToast();
	};
	</script>
	<?php
	}
}
?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-2">
		<?php
		include_once 'sidebar.php';
		?>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-10">
			<ol class="breadcrumb">
				<li><a href="index.php"><span class="fa fa-home"></span> Beranda</a></li>
				<li><a href="data-tanggal.php"><span class="fa fa-book"></span> Tanggal Absen</a></li>
				<li class="active"><span class="fa fa-pencil"></span> Ubah Data</li>
			</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-pencil"></span> Ubah Tanggal Absen</strong>
		  	</p>
		  	<div class="panel panel-default">
				<div class="panel-body">
			    	<form method="post">
				  		<div class="form-group">
				    		<label>Tanggal Absen</label>
				    		<input type="date" class="form-control" name="tgl" value="<?php echo $eks->tgl; ?>" required>
				  		</div>
				 		<div class="form-group">
				    		<label>Keterangan</label>
				    		<input type="text" class="form-control" name="ket" value="<?php echo $eks->ket; ?>" required>
				  		</div>
				  		<button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Ubah</button>
				  		<button type="button" onclick="location.href='data-tanggal.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
					</form>
		  		</div>
		  	</div>
		</div>
	</div>
<?php
include_once 'footer.php';
?>