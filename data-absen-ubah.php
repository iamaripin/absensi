<?php
include_once 'header.php';
$tgl = isset($_GET['tgl']) ? $_GET['tgl'] : die('ERROR: missing tgl.');
$nip = isset($_GET['nip']) ? $_GET['nip'] : die('ERROR: missing nip.');

include_once 'includes/absen.inc.php';
$eks = new Absen($db);
$eks->nip = $nip;
$eks->tgl = $tgl;

$eks->readOne();

if($_POST){

	$eks->ab = $_POST['ab'];
	
	if($eks->update()){
		echo "<script>location.href='data-absen.php?tgl=$tgl'</script>";
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
				<li><a href="data-absen.php"><span class="fa fa-book"></span> Data Absen</a></li>
				<li class="active"><span class="fa fa-pencil"></span> Ubah Absen</li>
			</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-pencil"></span> Ubah Data Absen</strong>
		  	</p>
		  	<div class="panel panel-default">
				<div class="panel-body">
			    	<form method="post">
				  		<div class="form-group">
				    		<label>Tanggal</label>
				    		<input type="date" class="form-control" name="tgl" value="<?php echo $eks->tgl; ?>" readonly>
				  		</div>
				 		<div class="form-group">
				    		<label>NIP</label>
				    		<input type="text" class="form-control" name="nip" value="<?php echo $eks->nip; ?>" readonly>
				  		</div>
				  		<div class="form-group">
				    		<label>Nama Guru</label>
				    		<input type="text" class="form-control" name="nm" value="<?php echo $eks->nip; ?>" readonly>
				  		</div>
				  		<div class="form-group">
				    		<label>Absensi</label>
				    		<select class="form-control" name="ab">
				    			<option><?php echo $eks->ab; ?></option>
				    			<option>Sakit</option>
				    			<option>Izin</option>
				    			<option>Tidak Hadir</option>
				    		</select>
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