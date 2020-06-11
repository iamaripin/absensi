<?php
include_once 'header.php';
include_once 'includes/absen.inc.php';
$pro1 = new Absen($db);

include_once 'includes/guru.inc.php';
$pro2 = new Guru($db);

if ($_POST) {
    $bln = $_POST['bln'];
    $thn = $_POST['thn'];

    if ($bln==1) {
        $nb="Januari";
    }elseif ($bln==2) {
        $nb="Februari";
    }elseif ($bln==3) {
        $nb="Maret";
    }elseif ($bln==4) {
        $nb="April";
    }elseif ($bln==5) {
        $nb="Mei";
    }elseif ($bln==6) {
        $nb="Juni";
    }elseif ($bln==7) {
        $nb="Juli";
    }elseif ($bln==8) {
        $nb="Agustus";
    }elseif ($bln==9) {
        $nb="September";
    }elseif ($bln==10) {
        $nb="Oktober";
    }elseif ($bln==11) {
        $nb="November";
    }else{
        $nb="Desember";
    }

    $pro1->bln = $bln;
    $pro1->thn = $thn;
    $stmt21 = $pro2->readAll();
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
            <li class="active"><span class="fa fa-table"></span> Laporan Absen</li>
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
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="bln" required>
                                    <option>--Pilih Bulan--</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="thn" required>
                                    <option>--Pilih Tahun--</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                                <button type="submit" class="btn btn-primary" width="100%" ><span class="fa fa-search"></span> Pilih Tanggal</button>
                        </div>
                    </div>
                </form>
                
                <div class="row">
                    <div class="col-md-6 text-left">
                        <strong style="font-size:18pt;"><span class="fa fa-table"></span> Laporan Absen</strong>
                    </div>
                </div>
                <br/>
                <?php
                    if ($_POST) {
                ?>
                <strong style="font-size: 16">Laporan <?php echo $nb." ".$thn ?></strong><br>
                <table width="100%" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Hadir</th>
                            <th>Tidak Hadir</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no=1;
                    while ($row = $stmt21->fetch(PDO::FETCH_ASSOC)){
                        $pro1->nip = $row['nip'];
                    ?>
                         <tr>
                            <td style="vertical-align:middle;"><?php echo $row['nip'] ?></td>
                            <td style="vertical-align:middle;"><?php echo $row['nama_guru'] ?></td>
                            <?php
                            
                            $stmt11 = $pro1->hadir();
                            ?>
                            <td style="vertical-align:middle;"><?php echo $stmt11 ?></td>
                            <?php
                            $stmt12 = $pro1->tidak_hadir();
                            ?>
                            <td style="vertical-align:middle;"><?php echo $stmt12 ?></td>
                            <?php
                            $stmt13 = $pro1->sakit();
                            ?>
                            <td style="vertical-align:middle;"><?php echo $stmt13 ?></td>
                            <?php
                            $stmt14 = $pro1->izin();
                            ?>
                            <td style="vertical-align:middle;"><?php echo $stmt14 ?></td>
                            <?php
                            $stmt15 = $pro1->total();
                            ?>
                            <td style="vertical-align:middle;"><?php echo $stmt15 ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>             
                </table>
                <div class="text-right">
                    <a href="laporan-absen-cetak.php?bln=<?php echo $bln ?>&thn=<?php echo $thn ?>" target="_blank" class="btn btn-primary" style="width: 20%"><span class="fa fa-print"></span> Print</a>
                </div>
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