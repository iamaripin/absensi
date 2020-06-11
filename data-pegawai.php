<?php
include "includes/config.php";
include_once 'includes/guru.inc.php';
    
    $config = new Config();
    $db = $config->getConnection();
    $pro = new Guru($db);
    $stmt = $pro->readAll();
    $count = $pro->countAll();

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
      <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="css/jquery.toastmessage.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <script src="js/ajax.min.js"></script>
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

    <div class="container">
        <div class="row">
            <div class="col-md-12"></div>
            <div class="col-md-12">
                <div style="margin-top: 50px;" class="panel panel-default"><div class="panel-body">
                    <div class="text-center"><h3><u>Data Pegawai</u></h3></div>
                    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>Tempat Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Pangkat</th>
                                <th>Golongan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no=1;
                            while ($row = $stmt->fetch(PDO::FETCH_BOTH)){
                            ?>
                            <tr>
                                <td style="vertical-align:middle;"><?php echo $row['nip'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['nama_guru'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['tempat_lahir'].", ".$row['tanggal_lahir'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['jenis_kelamin'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['alamat'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['pangkat'] ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['golongan'] ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php
include_once 'footer.php';
?>