<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$ruang = $_POST['ruang'];
$ambil = $_POST['ambil'];
$status = 'bersih';

if (isset($ambil)) {
	foreach ($ambil as $a) {
		$jumlah = $_POST['jumlah'.$a];
		$id_cuci = $_POST['id_cuci'.$a];

		$insertLinen = mysqli_query($conn, "INSERT INTO `linen_bersih`(`id_pencucian`, `jumlah`) VALUES ($id_cuci, $jumlah)");

		if ($insertLinen) {
			//ubah status dipencucian menjadi bersih
			$updateBersih = mysqli_query($conn, "UPDATE `pencucian` SET `status`='$status' WHERE `id_pencucian`=$id_cuci");
		}
	}
	header('location:'.$base_url.'laundry/linen-bersih/?message_success');
}else{
	header('location:'.$base_url.'laundry/linen-bersih/?message_failed');
}
 ?>