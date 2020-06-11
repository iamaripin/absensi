<?php

include_once 'header.php';
$id = $_SESSION['id_pengguna'];
include_once 'includes/periode.inc.php';
$pro = new Periode($db);
$stmtp1 = $pro->readAll2();

if (isset($_POST['idp'])) {
	$pro->idp = $_POST['idp'];
	$pro->readOne();
	$idp = $pro->idp;
	$nm = $pro->nm;
}else{
	$row1 = $stmtp1->fetch(PDO::FETCH_ASSOC);
	$idp = $row1['id_periode'];
	$nm = $row1['nama_periode'];
}

include_once 'includes/bobot_alternatif.inc.php';
$pro1 = new Bobot_alternatif($db);
$pro1->idp = $idp;
$pro1->id = $id;
$stmt1 = $pro1->read();
$stmty1 = $pro1->read();

include_once 'includes/bobot_kriteria.inc.php';
$pro2 = new Bobot_kriteria($db);
$pro2->idp = $idp;
$stmt2 = $pro2->read2();
$stmt22 = $pro2->read2();
$stmt23 = $pro2->read2();
$stmty2 = $pro2->read2();
$stmty22 = $pro2->read2();

include_once 'includes/jum_alt_kri.inc.php';
$pro3 = new Jum_alt_kri($db);
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
				<li class="active"><span class="fa fa-bank"></span> Laporan</li>
			</ol>
			<p style="margin-bottom:10px;">
				<strong style="font-size:18pt;"><span class="fa fa-bank"></span> Laporan</strong>
			</p>
			
			<div class="panel panel-default">
				<div class="panel-body">
					<form action="laporan.php" method="post">	
						<div class="row">
							<div class="col-xs-12 col-md-2">
								<div class="form-group">
									<h4>Pilih Periode</h4>
								</div>
							</div>
							<div class="col-xs-12 col-md-8">
								<div class="form-group">
									<select class="form-control" name="idp">
										<?php
											$stmtp2 = $pro->readAll2();
											while ($row2 = $stmtp2->fetch(PDO::FETCH_ASSOC)){
										?>
										<option value="<?php echo $row2['id_periode'] ?>"><?php echo $row2['nama_periode'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
					  		</div>
					  		<div class="col-md-2 text-right">
					            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Pilih Periode</button>
							</div>
						</div>
					</form>
					<?php
					if (isset($_POST['idp'])) {
					?>
		            <strong style="font-size:16pt;">Laporan periode : <?php echo $nm ?></strong>
					<h4>Data Ranking</h4>
					<table width="100%" class="table table-striped table-bordered">
					    <thead>
					        <tr>
				                <th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
				                <th colspan="<?php echo $stmt2->rowCount(); ?>" class="text-center">Kriteria</th>
				            </tr>
				            <tr>
				            <?php
							while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
							?>
				                <th><?php echo $row2['nama_kriteria'] ?></th>
				            <?php
							}
							?>
				            </tr>
				        </thead>	
				        <tbody>
							<?php
							while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
							?>
					            <tr>
					                <th><?php echo $row1['nama_alternatif'] ?></th>
					                <?php
					                $a= $row1['nis'];
									$stmt21 = $pro2->read2();
									while ($row21 = $stmt21->fetch(PDO::FETCH_ASSOC)){
										$b= $row21['id_kriteria'];
										$pro3->readR($a,$b,$idp);
										?>
							            <td>
								            <?php
								            $nor = $pro3->sk; 
								            echo $nor;
								            ?>
							            </td>
							            <?php
					                }
									?>
					            </tr>
							<?php
							}
							?>
							<tr>
								<th>Bobot</th>
								<?php
								while ($row22 = $stmt22->fetch(PDO::FETCH_ASSOC)){
								?>
						            <td><?php echo $row22['bobot_kriteria'] ?></td>
						        <?php
								}
								?>
							</tr>
							<tr>
								<th>Jumlah</th>
								<?php
								while ($row23 = $stmt23->fetch(PDO::FETCH_ASSOC)){
								?>
						            <td>
									<?php 
									$pro3->readSum2($row23['id_kriteria'],$idp,$id);
									echo number_format($pro3->mnr1, 3, '.', ',');
									?>
									</td>
					            <?php
								}
								?>
							</tr>
					    </tbody>
					</table>

					<br/>
					<h4>Hasil Ranking</h4>
					<table width="100%" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
					            <th colspan="<?php echo $stmt2->rowCount(); ?>" class="text-center">Kriteria</th>
					            <th rowspan="2" style="vertical-align: middle" class="text-center">Hasil</th>
							</tr>
							<tr>
								<?php
								while ($row2 = $stmty2->fetch(PDO::FETCH_ASSOC)){
								?>
					                <th><?php echo $row2['nama_kriteria'] ?></th>
					            <?php
								}
								?>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row1 = $stmty1->fetch(PDO::FETCH_ASSOC)){
							?>
							<tr>
								<th><?php echo $row1['nama_alternatif'] ?></th>
								<?php
					            $a1= $row1['nis'];
								$stmty21 = $pro2->read2();
								while ($row21 = $stmty21->fetch(PDO::FETCH_ASSOC)){
									$b2= $row21['id_kriteria'];
									$pro3->readR($a1,$b2,$idp);
								?>
								<td>
					               	<?php 
					               	echo $norx = $pro3->sk*$row21['bobot_kriteria'];
									$pro3->normalisasi1($a1,$b2,$norx,$idp);
					               	?>
					            </td>
					            <?php
					            }
								?>
								<td>
									<?php 
									$stmthasil = $pro3->readHasil1($a1,$idp);
									$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
									echo $hasil['bbn'];
									$pro1->hasil1($a1,$hasil['bbn'],$idp);
									?>
								</td>
							</tr>
							<?php
							}
							?>
							<tr>
								<th>Jumlah</th>
								<?php
								while ($rowx2 = $stmty22->fetch(PDO::FETCH_ASSOC)){
								?>
					            <td>
									<?php 
									$stmty23 = $pro3->readMax1($rowx2['id_kriteria'],$idp,$id);
									$rowx3 = $stmty23->fetch(PDO::FETCH_ASSOC);
									echo number_format($rowx3['mnr1'], 3, '.', ',');
									?>
								</td>
					            <?php
								}
								?>
								<td style="color: red">
									<?php 
									$stmty24 = $pro1->readMax1($id, $idp);
									$rowx4 = $stmty24->fetch(PDO::FETCH_ASSOC);
									echo number_format($rowx4['mnr2'], 3, '.', ',');
									$a=number_format($rowx4['mnr2'], 3, '.', ',');
									?>
								</td>
							</tr>
						</tbody>
					</table>
					<?php
						if ($a=='1') {
						?>
						<div class="col-md-13 text-right">
					        <a href="laporan-cetak.php?idp=<?php echo $idp ?>" target="_blank" class="btn btn-primary"><span class="fa fa-print"></span> Cetak Laporan</a>
						</div>
						<?php

						}else{
						?>
						<div class="col-md-13 text-right">
					        <strong style="font-size:10pt;">Jumlah dari nilai Hasil harus bernilai 1</strong><br>
					        <strong style="font-size:10pt;">Periksa perhitungan kembali</strong>
						</div>
						<?php
						}
					?>
					<?php
					}
					?>
				</div>
			</div>
		</div>
</div>			
<?php
include_once 'footer.php';
?>