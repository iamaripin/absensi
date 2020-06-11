<?php
include_once 'header.php';
if($_POST){
	include_once 'includes/tanggal.inc.php';
	$eks = new Tanggal($db);
	$eks->tgl = $_POST['tgl'];
	$eks->ket = $_POST['ket'];

    if($eks->insert()){
    	include_once 'includes/guru.inc.php';
		$pro1 = new Guru($db);
		$stmt11 = $pro1->readAll();

		include_once 'includes/absen.inc.php';
		$pro2 = new Absen($db);

		while ($row = $stmt11->fetch(PDO::FETCH_ASSOC)){
			$pro2->nip = $row['nip'];
			$pro2->tgl = $_POST['tgl'];
			$pro2->ab = "Tidak Hadir";
			$pro2->insert();
		}
	?>
		<script type="text/javascript">
		window.onload=function(){
		showStickySuccessToast();
		};
		</script>
	<?php
	}else{
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
			  		<li><a href="data-tanggal.php"><span class="fa fa-bank"></span> Data Tanggal</a></li>
			  		<li class="active"><span class="fa fa-clone"></span> Tambah Data</li>
				</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Tanggal</strong>
		  	</p>
		  	<div class="panel panel-default">
				<div class="panel-body">
			    	<form method="post">
				  		<div class="form-group">
				    		<label for="nm">Tanggal Absen</label>
				    		<input type="date" class="form-control" name="tgl" required>
				  		</div>
				  		<div class="form-group">
				    		<label for="nm">Keterangan</label>
				    		<input type="text" class="form-control" name="ket" required>
				  		</div>
				  		<button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
				  		<button type="button" onclick="location.href='data-tanggal.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
					</form>	  
		  		</div>
			</div>
		</div>
	</div>
	<?php
	include_once 'footer.php';
	?>