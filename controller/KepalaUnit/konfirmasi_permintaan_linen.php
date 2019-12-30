<?php 
require 'controller/config/connection.php';

$id_Permintaan = $_POST['id_permintaan'];
$status = $_POST['konfirm'];
if (isset($id_Permintaan)) {
	$konfirmasi = mysqli_query($conn, "UPDATE `permintaan_linen_baru` SET `status`='$status' WHERE id_permintaan_linen_baru = $id_Permintaan");
	if ($konfirmasi == true) {
		header('location:'.$base_url.'kepala-unit/linen/permintaan/?message_success=Selamat, Konfirmasi permintaan linen berhasil !!!');
	}else{
		header('location:'.$base_url.'kepala-unit/linen/permintaan/?message_failed=Maaf, Konfirmasi permintaan linen gagal !!!');
	}
}

 ?>