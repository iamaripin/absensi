<?php
include_once 'header.php';
include_once 'includes/user.inc.php';
$eks = new User($db);

$eks->id = $_SESSION['id_pengguna'];

$eks->readOne();

if($_POST){

    $eks->np = $_POST['np'];
    $eks->un = $_POST['un'];
    
    if($eks->update()){
?>
<script type="text/javascript">
window.onload=function(){
  showStickySuccessToast();
};
</script>
<?php
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
	  <li class="active"><span class="fa fa-user"></span> Profil</li>
	</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-pencil"></span> Ubah Profil</strong>
		  	</p>
                <form method="post">
                  <div class="form-group">
                    <label for="nl">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nl" name="np" value="<?php echo $eks->np; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="un">Username</label>
                    <input type="text" class="form-control" id="un" name="un" value="<?php echo $eks->un; ?>" required>
                  </div>
                  <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Ubah</button>
                </form>
              
          </div>
        </div>
        <?php
include_once 'footer.php';
?>