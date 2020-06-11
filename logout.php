<?php
session_start();
		echo "<script>alert('Anda Telah Keluar dari Sistem.');</script>";
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
session_destroy();
?>