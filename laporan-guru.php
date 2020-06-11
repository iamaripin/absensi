<?php
include_once 'header.php';
include_once 'includes/guru.inc.php';
$pro = new Guru($db);
$stmt = $pro->readAll();
$count = $pro->countAll();
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
            <li class="active"><span class="fa fa-users"></span> Laporan guru</li>
       	</ol>
        <div class="row">
            <div class="col-md-6 text-left">
           		<strong style="font-size:18pt;"><span class="fa fa-users"></span> Laporan guru</strong>
           	</div>
        </div>
       	<br/>
       	<table width="100%" class="table table-striped table-bordered">
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
                </tr>
            </thead>
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
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <div class="text-right">
            <a href="laporan-guru-cetak.php" target="_blank" class="btn btn-primary" style="width: 20%"><span class="fa fa-print"></span> Print</a>
        </div>
    </div>
</div>			
<?php
include_once 'footer.php';
?>