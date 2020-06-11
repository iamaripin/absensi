<?php
include_once 'includes/config.php';
$config = new Config();
$db = $config->getConnection();

date_default_timezone_set('Asia/Jakarta');
$tgl=date("Y-m-d");
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function hai(){
		$b = time();
		$hour = date("G",$b);

		if ($hour>=0 && $hour<=11)
			{
				echo "Selamat Pagi,";
			}
				elseif ($hour >=12 && $hour<=14)
			{
				echo "Selamat Siang,";
			}
				elseif ($hour >=15 && $hour<=17)
			{
				echo "Selamat Sore,";
			}
				elseif ($hour >=17 && $hour<=18)
			{
				echo "Selamat Petang,";
			}
				elseif ($hour >=19 && $hour<=23)
			{
				echo "Selamat Malam,";
			}
}

include_once 'includes/tanggal.inc.php';
$pro2 = new Tanggal($db);
$pro2->tgl = $tgl;
$stmt21 = $pro2->count();
	
if($_POST){
	include_once 'includes/absen.inc.php';
	$pro1 = new Absen($db);

	$pro1->tgl = $tgl;
	$pro1->ab = "Hadir";
	$pro1->nip = $_POST['nip'];
	
	include_once 'includes/guru.inc.php';
	$pro3 = new Guru($db);
	$pro3->nip = $_POST['nip'];
	$stmt31 = $pro3->countOne();

	if($stmt31==0){
		echo "<script>alert('Gagal! NIP Tidak Ditemukan');location.href='home-absen.php';</script>";
	}else{
		$pro1->absen();
		$pro3->readOne();
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sistem Informasi Absen</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background: #ffffff url(images/back1.jpg) left bottom fixed;">
  
	<nav class="navbar navbar-default navbar-static-top">
	  <div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="index.php">Sistem Informasi Absen</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav navbar-right">		  	
			<li><a href="home-absen.php">Absensi</a></li>
		  	<li><a href="data-pegawai.php">Data Pegawai</a></li>
			<li><a href="login.php">Login Admin</a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<?php
	if ($stmt21==0) {
	?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-2"></div>
			<div class="col-xs-12 col-sm-4 col-md-8">

				<div style="margin-top: 10px;" class="panel panel-default"><div class="panel-body">
				<h3></h3>
				<hr>
					<p><center><h4>Tanggal : <?php echo tgl_indo(date('Y-m-d')); ?>, Absen Untuk Hari Ini Belum Dibuka</h4></center></p>
					<p style="text-align: right;">TTD. Admin</p>
				</div>
				</div>	
			</div>
			<div class="col-xs-12 col-sm-4 col-md-2"></div>
		</div>
	</div>
	<?php	
	}else{
		if ($_POST) {
		?>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-2"></div>
				<div class="col-xs-12 col-sm-4 col-md-8">
					<div class="panel panel-success">
				      <div class="panel-heading">
				        <b><h4><?php echo hai()." ". $pro3->nm;?></h4></b>
				      </div> 
				      <div style="padding-top: 10px" class="panel-body">
					<form method="post" enctype="multipart/form-data" action="">
						<table class="table table-bordered">
							<tr>
								<td>Tanggal</td>
								<td><?php echo $pro2->tgl; ?></td>
							</tr>
							<tr>
								<td>Nama Lengkap</td>
								<td><?php echo " : ".$pro3->nm; ?></td>
							</tr>
							<tr>
								<td>NIP</td>
								<td><?php echo " : ".$pro3->nip; ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td><?php echo " : ".$pro3->jk; ?></td>
							</tr>
							<tr>
								<td>Tempat Tanggal Lahir</td>
								<td><?php echo " : ".$pro3->te.", ".$pro3->ta; ?></td>
							</tr>
							<tr>
								<td>Foto</td>
								<td>
									<img src="<?php echo $pro3->ft ?>" width="250" height="170" class="img-rounded"><br></td>
							</tr>
							<input class="form-control" type="hidden" name="level" value="<?=$level?>" required>
							<tr>
								<td colspan="2">
									<button type="button" onclick="location.href='home-absen.php'" style="width: 100%" class="btn btn-success" onclick="return confirm('Terimaksih')">OK</button>
								</td>
							</tr>
						</table>
					</form>
					</div>
				</div>	
				
				</div>
				<div class="col-xs-12 col-sm-4 col-md-2"></div>
			</div>
		</div>
		<?php	
		}else{
		?>
	    <div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-2"></div>
				<div class="col-xs-12 col-sm-4 col-md-8">
				  	<div style="margin-top: 50px;" class="panel panel-default"><div class="panel-body">
				  		<div class="text-center"><h3><?php echo hai(); ?></h3></div>
				  			
							<form class="form-horizontal" method="POST">
  
							  <div class="form-group">
							    <label class="control-label col-sm-2" for="pwd">NIP : </label>
							    <div class="col-sm-10"> 
							      <input type="text" class="form-control" name="nip" placeholder="Masukan NIP" required="">
							    </div>
							  </div>
							<div class="form-group">
							    <label class="control-label col-sm-2" for="email">Tanggal : </label>
							    <div class="col-sm-10">
							      <input type="date" class="form-control" value="<?php echo $tgl; ?>" readonly>
							    </div>
							  </div>
							  <div class="form-group"> 
							    <div class="col-sm-offset-2 col-sm-10">
							    	<button type="submit" style="width: 49%" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Submit</button>
							      	<button type="reset" style="width: 49%" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Reset</button>
							    </div>
							  </div>
							</form>
				  		</div>
					</div>

					<div style="margin-top: 10px;" class="panel panel-default"><div class="panel-body">
						<div class="alert alert-success" role="alert">
						  <h4 class="alert-heading">Well done!</h4>
						  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
						  <hr>
						  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
						</div>
				  	</div>
				</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-2"></div>
			</div>
		</div>
		<?php
		}
	}
	?>
	
<div class="footer">
	<?php
include_once 'footer.php';
?>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
setTimeout(
function ( )
{
  self.close();
}, 5000 );
</script>
  </body>
</html>