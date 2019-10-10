<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$petugas = $_POST['id_petugas'];
$ruang = $_POST['ruang'];
$ambil = $_POST['ambil'];

if (isset($ambil)) {
	foreach ($ambil as $a) {
		$jumlah = $_POST['jumlah'.$a];
		$jenis_linen = $_POST['jenis_linen'.$a];
		$id_linen = $_POST['id_linen'.$a];

		$insertLinen = mysqli_query($conn, "INSERT INTO `linen_kotor`(`id_linen`, `jml_linen_kotor`, `id_user`, `jenis_linen_kotor`) VALUES ($id_linen, $jumlah, $petugas, '$jenis_linen')");
	}
	header('location:'.$base_url.'laundry/linen-kotor/?message_success');
}else{
	header('location:'.$base_url.'laundry/linen-kotor/?message_failed');
}
 ?>