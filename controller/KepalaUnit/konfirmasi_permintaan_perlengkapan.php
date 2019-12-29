<?php 
require 'controller/config/connection.php';

$id_Permintaan = $_POST['id_permintaan'];
$status = $_POST['konfirm'];
if (isset($id_Permintaan)) {
	$konfirmasi = mysqli_query($conn, "UPDATE `permintaan_perlengkapan` SET `status`='$status' WHERE `id_permintaan_perlengkapan` =  $id_Permintaan");
	if ($konfirmasi == true) {
		header('location:'.$base_url.'kepala-unit/perlengkapan/permintaan/?message_success=Selamat, konfirmasi permintaan perlengkapan berhasil !!!');
	}else{
		header('location:'.$base_url.'kepala-unit/perlengkapan/permintaan/?message_failed=Maaf, konfirmasi permintaan perlengkapan gagal !!!');
	}
}

 ?>