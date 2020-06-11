<?php
include_once 'header.php';
include_once 'includes/guru.inc.php';
$pro = new Guru($db);
$stmt = $pro->readAll();
$count = $pro->countAll();

if(isset($_POST['hapus-contengan'])){
    $imp = "('".implode("','",array_values($_POST['checkbox']))."')";
    $result = $pro->hapusell($imp);
    if($result){
            ?>
            <script type="text/javascript">
            window.onload=function(){
                showSuccessToast();
                setTimeout(function(){
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
            };
            </script>
            <?php
    } else{
            ?>
            <script type="text/javascript">
            window.onload=function(){
                showErrorToast();
                setTimeout(function(){
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
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
	  <li class="active"><span class="fa fa-user"></span> Data guru</li>
	</ol>
<form method="post">
	<div class="row">
		<div class="col-md-6 text-left">
			<strong style="font-size:18pt;"><span class="fa fa-user"></span> Data guru</strong>
		</div>
		<div class="col-md-6 text-right">
            <button type="submit" name="hapus-contengan" class="btn btn-danger"><span class="fa fa-close"></span> Hapus Contengan</button>
			<button type="button" onclick="location.href='data-guru-baru.php'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
		</div>
	</div>
	<br/>

	<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama Guru</th>
                <th>Tempat Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Pangkat</th>
                <th>Golongan</th>
                <th>Status</th>
                <th width="100px">Aksi</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>NIP</th>
                <th>Nama Guru</th>
                <th>Tempat Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Pangkat</th>
                <th>Golongan</th>
                <th>Status</th>
                <th width="100px">Aksi</th>
            </tr>
        </tfoot>

        <tbody>
<?php
$no=1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
            <tr>
                <td style="vertical-align:middle;"><?php echo $row['nip'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_guru'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['tempat_lahir'].", ".$row['tanggal_lahir'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['jenis_kelamin'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['alamat'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['pangkat'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['golongan'] ?></td>
                <td style="vertical-align:middle;"><?php echo $row['status'] ?></td>
                <td style="text-align:center;vertical-align:middle;">
					<a href="data-guru-ubah.php?nip=<?php echo $row['nip'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
					<a href="data-guru-hapus.php?nip=<?php echo $row['nip'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
			    </td>
            </tr>
<?php
}
?>
        </tbody>

    </table>
</form>
</div>
</div>			
<?php
include_once 'footer.php';
?>