<?php 
include_once 'controller/config/connection.php';


if (isset($_POST['simpan'])) {
	$jumlah = htmlspecialchars($_POST['jumlah_linen']);
	$keterangan = htmlspecialchars(trim($_POST['keterangan']));
}
 ?>