<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$petugas = $_POST['id_petugas'];
$ruang = $_POST['ruang'];
$ambil = $_POST['ambil'];
$ketepatan = $_POST['tepat'];

if (isset($ambil)) {
	foreach ($ambil as $a) {
		$infeksius = $_POST['infeksius'.$a];
		$noninfeksius = $_POST['noninfeksius'.$a];
		$id_linen = $_POST['id_linen'.$a];

		$insertLinen = mysqli_query($conn, "INSERT INTO `linen_kotor`(`id_linen`, `id_user`) VALUES ($id_linen, $petugas)");
		//get id linen kotor
		$getIDLinen = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
		while ($id = mysqli_fetch_array($getIDLinen)) {
			$id_linen = $id[0];
		}

		if (!empty($noninfeksius) || $noninfeksius > 0) {
			//insert jenis linen kotor non infeksius
			$status = "non infeksius";
			$insertJenis = mysqli_query($conn, "INSERT INTO `jenis_linen_kotor` (`id_linen_kotor`, `jumlah`,`jenis`) VALUES ($id_linen, $noninfeksius, '$status')");
		}

		if (!empty($infeksius) || $infeksius > 0) {
			//insert jenis linen kotor infeksius
			$status = "infeksius";
			$insertJenis2 = mysqli_query($conn, "INSERT INTO `jenis_linen_kotor` (`id_linen_kotor`, `jumlah`,`jenis`) VALUES ($id_linen, $infeksius, '$status')");
		}
		
	}

	//insert ketepatan
	if (!empty($ketepatan)) {
		$insertKetepatan = mysqli_query($conn, "INSERT INTO `ketepatan`(`id_ruang`, `status`,`id_petugas`) VALUES ($ruang, '$ketepatan', $petugas)");
	}else{
		$status = "tidak tepat";
		$insertKetepatan = mysqli_query($conn, "INSERT INTO `ketepatan`(`id_ruang`, `status`,`id_petugas`) VALUES ($ruang, '$status', $petugas)");
	}

	header('location:'.$base_url.'laundry/linen-kotor/?message_success');
}else{
	header('location:'.$base_url.'laundry/linen-kotor/?message_failed');
}
 ?>