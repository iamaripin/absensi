<?php
include_once 'header.php';
$nip = isset($_GET['nip']) ? $_GET['nip'] : die('ERROR: missing nip.');

include_once 'includes/guru.inc.php';
$eks = new Guru($db);

$eks->nip = $nip;

$eks->readOne();

if($_POST){

	$eks->nm = $_POST['nm'];
	$eks->te = $_POST['te'];
	$eks->ta = $_POST['ta'];
	$eks->jk = $_POST['jk'];
	$eks->al = $_POST['al'];
	$eks->pa = $_POST['pa'];
	$eks->go = $_POST['go'];
	$eks->st = $_POST['st'];
	
	if($eks->update()){
		echo "<script>location.href='data-guru.php'</script>";
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
				<li><a href="data-guru.php"><span class="fa fa-user"></span> Data guru</a></li>
				<li class="active"><span class="fa fa-pencil"></span> Ubah Data</li>
			</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-pencil"></span> Ubah guru</strong>
		  	</p>
		  	<div class="panel panel-default">
				<div class="panel-body">
			    	<form method="post">
			    		<div class="form-group">
				    		<label>NIP</label>
				    		<input type="text" class="form-control" name="nip" value="<?php echo $eks->nip; ?>" readonly>
				  		</div>
				 		<div class="form-group">
				    		<label>Nama guru</label>
				    		<input type="text" class="form-control" name="nm" value="<?php echo $eks->nm; ?>" required>
				  		</div>
				  		<div class="form-group">
				    		<label>Tempat Lahir</label>
				    		<input type="text" class="form-control" name="te" value="<?php echo $eks->te; ?>" required>
				  		</div>
				  		<div class="form-group">
				    		<label>Tanggal Lahir</label>
				    		<input type="date" class="form-control" name="ta" value="<?php echo $eks->ta; ?>" required>
				  		</div>
				  		<div class="form-group">
				    		<label>Jenis Kelamin</label>
				    		<select class="form-control" name="jk" required>
				    			<option value="<?php echo $eks->jk; ?>"><?php echo $eks->jk; ?></option>
				    			<option>--Pilih Jenis Kelamin--</option>
				    			<option value="Laki-laki">Laki-laki</option>
				    			<option value="Perempuan">Perempuan</option>
				    		</select>
				  		</div>
				  		<div class="form-group">
				    		<label>Alamat</label>
				    		<textarea class="form-control" name="al" required=""><?php echo $eks->al; ?></textarea>
				  		</div>
				  		<div class="form-group">
				    		<label>Pangkat</label>
				    		<select class="form-control" name="pa" required>
				    			<option value="<?php echo $eks->pa; ?>"><?php echo $eks->pa; ?></option>
				    			<option>--Pilih Pangkat--</option>
				    			<option value="Kepala Sekolah">Kepala Sekolah</option>
				    			<option value="Wakil Kepala Sekolah">Wakil Kepala Sekolah</option>
				    			<option value="Guru">Guru</option>
				    		</select>
				  		</div>
				  		<div class="form-group">
				    		<label>Gologan</label>
				    		<select class="form-control" name="go" required>
				    			<option value="<?php echo $eks->go; ?>"><?php echo $eks->go; ?></option>
				    			<option>--Pilih Golongan--</option>
				    			<option value="A1">A1</option>
				    			<option value="A2">A2</option>
				    		</select>
				  		</div>
				  		<div class="form-group">
				    		<label>Status</label>
				    		<select class="form-control" name="st" required>
				    			<option value="<?php echo $eks->st; ?>"><?php echo $eks->st; ?></option>
				    			<option>--Pilih Status--</option>
				    			<option value="Menikah">Menikah</option>
				    			<option value="Belum Menikah">Belum Menikah</option>
				    		</select>
				  		</div>
				  		<button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Ubah</button>
				  		<button type="button" onclick="location.href='data-guru.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
					</form>
		  		</div>
		  	</div>
		</div>
	</div>
<?php
include_once 'footer.php';
?>