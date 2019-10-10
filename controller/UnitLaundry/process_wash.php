<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$petugas = $_POST['id_petugas'];
$id_proses = $_POST['id_proses'];
$jenis_cuci = $_POST['jenis'];
$perlengkapan = $_POST['perlengkapan'];
$jml_perlengkapan = $_POST['jumlah_perlengkapan'];
$ambil = $_POST['ambil'];
$jumlah = 10;

if (isset($ambil)) {
	foreach ($ambil as $a) {
		// $jumlah = $_POST['jumlah'.$a];
		$id_linen_kotor = $_POST['id_linen'.$a];

		$insertLinen = mysqli_query($conn, "INSERT INTO `pencucian`(`id_proses_cuci`, `id_linen_kotor`,`jml_cuci`) VALUES ($id_proses, $id_linen_kotor, $jumlah)");
	}

	if ($insertLinen) {
		//inser ke proses pencucian
		$insertProses = mysqli_query($conn, "INSERT INTO `jumlah_proses_pencucian`(`id_proses_cuci`, `jenis_pencucian`) VALUES ($id_proses, '$jenis_cuci')");
		//get last insert id
		$lastId = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
		while ($d = mysqli_fetch_array($lastId)) {
			$id = $d[0];
		}
		if ($insertProses) {
			//insert ke perlengkapan
			$insertPerlengkapan = mysqli_query($conn, "INSERT INTO `penggunaan_perlengkapan`(`id_jumlah_proses_pencucian`, `id_perlengkapan`, `jml_penggunaan`) VALUES ($id,$perlengkapan,$jml_perlengkapan)");
			if ($insertPerlengkapan) {
				header('location:'.$base_url.'laundry/pencucian/?message_success');
			}else{
				header('location:'.$base_url.'laundry/pencucian/?message_failed');
			}
		}else{
			header('location:'.$base_url.'laundry/pencucian/?message_failed');
		}
	}else{
		header('location:'.$base_url.'laundry/pencucian/?message_failed');
	}
	
}else{
	header('location:'.$base_url.'laundry/pencucian/?message_failed');
}
 ?>