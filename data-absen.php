<?php
include_once 'header.php';
include_once 'includes/absen.inc.php';
$pro = new Absen($db);

if ($_POST) {
    $tgl = $_POST['tgl'];
    $pro->tgl = $tgl;
    $stmt = $pro->read1();
}else if ($_GET){
    $tgl = $_GET['tgl'];
    $pro->tgl = $tgl;
    $stmt = $pro->read1();
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
            <li class="active"><span class="fa fa-check"></span> Data Absen</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post">    
                    <div class="row">
                        <div class="col-xs-12 col-md-2">
                            <div class="form-group">
                                <h4>Pilih Tanggal</h4>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <input type="date" name="tgl" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                                <button type="submit" class="btn btn-primary" width="100%" ><span class="fa fa-search"></span> Pilih Tanggal</button>
                        </div>
                    </div>
                </form>
                
                <div class="row">
                    <div class="col-md-6 text-left">
                        <strong style="font-size:18pt;"><span class="fa fa-check"></span> Data Absen</strong>
                    </div>
                </div>
                <br/>
                <?php
                    if ($_POST||$_GET) {
                ?>
                <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Tanggal</th>
                            <th>Absen</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Tanggal</th>
                            <th>Absen</th>
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
                            <td style="vertical-align:middle;"><?php echo $row['tanggal'] ?></td>
                            <td style="vertical-align:middle;"><?php echo $row['absensi'] ?></td>
                            <td style="text-align:center;vertical-align:middle;">
                                <a href="data-absen-ubah.php?tgl=<?php echo $row['tanggal'] ?>&nip=<?php echo $row['nip'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>             
                </table>
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