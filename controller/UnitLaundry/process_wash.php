<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$petugas = $_POST['id_petugas'];
$id_proses = $_POST['id_proses'];
$jenis_cuci = $_POST['jenis'];
$perlengkapan = $_POST['perlengkapan'];
$id_formula = $_POST['formula'];
$ambil = $_POST['ambil'];


//get id perlengkapan dan jumlah dalam takaran untuk dikurangi dengan stok perlengkapan
$sqlPerlengkapan = mysqli_query($conn, "SELECT id_perlengkapan, jumlah FROM takaran_formula WHERE id_formula = $id_formula");
if (mysqli_num_rows($sqlPerlengkapan) > 0) {
	while ($data_takaran = mysqli_fetch_assoc($sqlPerlengkapan)) {
		$takaran[] = [
			'id_perlengkapan' => $data_takaran['id_perlengkapan'],
			'jumlah' => $data_takaran['jumlah']
		];
	}
}

if (isset($ambil)) {
	foreach ($ambil as $a) {
		// $jumlah = $_POST['jumlah'.$a];
		$id_linen_kotor = $_POST['id_linen'.$a];
		$id_jenis_linen_kotor = $_POST['id_jenis_linen'.$a];

		$insertLinen = mysqli_query($conn, "INSERT INTO `pencucian`(`id_proses_cuci`, `id_linen_kotor`,`id_jenis_linen_kotor`) VALUES ($id_proses, $id_linen_kotor, $id_jenis_linen_kotor)");
	}

	if ($insertLinen) {
		//inser ke proses pencucian
		$insertProses = mysqli_query($conn, "INSERT INTO `jumlah_proses_pencucian`(`id_proses_cuci`, `jenis_pencucian`,`id_formula`) VALUES ($id_proses, '$jenis_cuci', $id_formula)");
		//get last insert id
		$lastId = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
		while ($d = mysqli_fetch_array($lastId)) {
			$id = $d[0];
		}

	
		//get id perlengkapan berdasarkan formula
		$sqlGetidPerlengkapan = mysqli_query($conn, "SELECT `id_perlengkapan`,`jumlah` FROM `takaran_formula` WHERE `id_formula` = $id_formula");
		if (mysqli_num_rows($sqlGetidPerlengkapan) > 0) {
			while ($dataPerlengkapan = mysqli_fetch_assoc($sqlGetidPerlengkapan)) {
				$id_perlengkapan = $dataPerlengkapan['id_perlengkapan'];
				$jumlah = $dataPerlengkapan['jumlah'];
				//input penggunaan linen
				$insertPenggunaan = mysqli_query($conn, "INSERT INTO `penggunaan_perlengkapan`(`id_jumlah_proses_pencucian`, `id_perlengkapan`, `jml_penggunaan`) VALUES ($id,$id_perlengkapan,$jumlah)");
			}
		}

		if ($insertProses) {
			//pengurangan stok perlengkapan
			foreach ($takaran as $takar) {
				$id_perlengkapan_takar = $takar['id_perlengkapan'];
				$jumlah = $takar['jumlah'];
				//get jumlah actualnya
				$sqlGetJumlah = mysqli_query($conn, "SELECT jumlah FROM perlengkapan WHERE `id_perlengkapan` = $id_perlengkapan_takar");
				$jumlahPerlengkapan = mysqli_fetch_assoc($sqlGetJumlah);

				$jumlahTotal = $jumlahPerlengkapan['jumlah'] - $jumlah;

				$sqlUpdatePerlengkapan = mysqli_query($conn, "UPDATE `perlengkapan` SET `jumlah`=$jumlahTotal WHERE `id_perlengkapan` = $id_perlengkapan_takar");
			}

			header('location:'.$base_url.'laundry/pencucian/?message_success=Selamat, proses pencucian berhasil ditambahkan!!!');

			//insert penggunaan perlengkapan
			
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