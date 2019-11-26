<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$ambil = $_POST['ambil'];

if (isset($ambil)) {
	foreach ($ambil as $a) {
		$jumlah = $_POST['jumlah'.$a];
		$status = $_POST['status_hilang'.$a];
		$id_linen = $_POST['id_linen'.$a];

		//get stok linen
		$sqlStok = mysqli_query($conn, "SELECT `jml_linen` FROM `linen` WHERE `id_linen` = $id_linen");
		$stokLinen = mysqli_fetch_assoc($sqlStok);
		$stokLinen = $stokLinen['jml_linen'];

		//cek jumlah yang diinputkan
		if ($jumlah > $stokLinen) {
			header('location:'.$base_url.'perawat/linen/hilang-rusak/?message_failed');
			return false;
		}else{
			$jumlahAkhir = $stokLinen - $jumlah;
		}

		$insertLinen = mysqli_query($conn, "INSERT INTO `linen_hilang`(`id_linen`, `jumlah`, `status`) VALUES ($id_linen, $jumlah, '$status')");

		//update pengurangan setok ke data linen
		$sqlUpdateStok = mysqli_query($conn, "UPDATE `linen` SET `jml_linen`=$jumlahAkhir WHERE `id_linen` = $id_linen");
		if ($sqlUpdateStok == false) {
			header('location:'.$base_url.'perawat/linen/hilang-rusak/?message_failed');
		}
	}

	header('location:'.$base_url.'perawat/linen/hilang-rusak/?message_success');
}else{
	header('location:'.$base_url.'perawat/linen/hilang-rusak/?message_failed');
}
 ?>