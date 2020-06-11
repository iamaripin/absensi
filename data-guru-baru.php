<?php
include_once 'header.php';
if($_POST){

	$allowed_ext=array('png', 'jpg');
    $file_name=$_FILES['file']['name'];
    $file_ext=strtolower(end(explode('.', $file_name)));
    $file_size=$_FILES['file']['size'];
    $file_tmp=$_FILES['file']['tmp_name'];

    if (in_array($file_ext, $allowed_ext)==true) {
    	if ($file_size < 1048576) {
    		$lokasi='foto/'.$_POST['nip'].'.'.$file_ext;
    		move_uploaded_file($file_tmp, $lokasi);

			include_once 'includes/guru.inc.php';
			$eks = new Guru($db);
			$eks->nip = $_POST['nip'];
			$eks->nm = $_POST['nm'];
			$eks->te = $_POST['te'];
			$eks->ta = $_POST['ta'];
			$eks->jk = $_POST['jk'];
			$eks->al = $_POST['al'];
			$eks->pa = $_POST['pa'];
			$eks->go = $_POST['go'];
			$eks->st = $_POST['st'];
			$eks->ft = $lokasi;

       		if($eks->insert()){
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
    	}else{
        ?>
			<script type="text/javascript">
			window.onload=function(){
				showStickyErrorToastMax();
			};
			</script>
		<?php
    	}
    }else{
    ?>
		<script type="text/javascript">
		window.onload=function(){
			showStickyErrorToastExt();
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
			  		<li><a href="data-guru.php"><span class="fa fa-user"></span> Data Guru</a></li>
			  		<li class="active"><span class="fa fa-clone"></span> Tambah Data</li>
				</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Guru</strong>
		  	</p>
		  	<div class="panel panel-default">
				<div class="panel-body">
			    	<form method="post" enctype="multipart/form-data">
						<div class="form-group">
				    		<label for="nm">NIP</label>
				    		<input type="text" class="form-control" name="nip" required>
				  		</div>
				  		<div class="form-group">
				    		<label for="nm">Nama Guru</label>
				    		<input type="text" class="form-control" name="nm" required>
				  		</div>
				  		<div class="form-group">
				    		<label for="nm">Tempat Lahir</label>
				    		<input type="text" class="form-control" name="te" required>
				  		</div>
				  		<div class="form-group">
				    		<label for="nm">Tanggal Lahir</label>
				    		<input type="date" class="form-control" name="ta" required>
				  		</div>
				  		<div class="form-group">
				    		<label for="nm">Jenis Kelamin</label>
				    		<select class="form-control" name="jk" required>
				    			<option>--Pilih Jenis Kelamin--</option>
				    			<option value="Laki-laki">Laki-laki</option>
				    			<option value="Perempuan">Perempuan</option>
				    		</select>
				  		</div>
				  		<div class="form-group">
				    		<label>Alamat</label>
				    		<textarea class="form-control" name="al" required></textarea>
				  		</div>
				  		<div class="form-group">
				    		<label>Pangkat</label>
				    		<select class="form-control" name="pa" required>
				    			<option>--Pilih Pangkat--</option>
				    			<option value="Kepala Sekolah">Kepala Sekolah</option>
				    			<option value="Wakil Kepala Sekolah">Wakil Kepala Sekolah</option>
				    			<option value="Guru">Guru</option>
				    		</select>
				  		</div>
				  		<div class="form-group">
				    		<label>Golongan</label>
				    		<select class="form-control" name="go" required>
				    			<option>--Pilih Golongan--</option>
				    			<option value="A1">A1</option>
				    			<option value="A2">A2</option>
				    		</select>
				  		</div>
				  		<div class="form-group">
				    		<label>Status</label>
				    		<select class="form-control" name="st" required>
				    			<option>--Pilih Status--</option>
				    			<option value="Menikah">Menikah</option>
				    			<option value="Belum Menikah">Belum Menikah</option>
				    		</select>
				  		</div>
				  		<div class="form-group">
				    		<label>Foto</label>
				    		<input type="file" name="file" class="form-control" required="">
				  		</div>
				  		<small>* Ukuran Maksimal Foto 1Mb</small><br>
				  		<small>* File yang Diterima .jpg .png</small><br><br>
				  		<button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
				  		<button type="button" onclick="location.href='data-guru.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
					</form>	  
		  		</div>
			</div>
		</div>
	</div>
	<?php
	include_once 'footer.php';
	?>