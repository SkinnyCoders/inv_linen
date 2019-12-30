<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (isset($_POST['simpan'])) {
	//insert table formula
	$nama_formula = filterString($_POST['nama_formula']);
	$keterangan = filterString($_POST['keterangan']);
	$jenis_formula = filterString($_POST['jenis']);

	//query insert
	$insertFormula = mysqli_query($conn, "INSERT INTO `formula_perlengkapan`(`nama_formula`, `jenis_formula`, `keterangan`) VALUES ('$nama_formula', '$jenis_formula', '$keterangan')");
	//get id linen kotor
	$getIDLinen = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
	while ($id = mysqli_fetch_array($getIDLinen)) {
		$id_formula = $id[0];
	}
	
	
	if ($insertFormula) {
		//insert takaran
		if (isset($_POST['perlengkapan'])) {
			//hilangkan index 0
			array_pop($_POST['perlengkapan']);

			$id_perlengkapan = $_POST['perlengkapan'];
			$key = 0;

			foreach ($id_perlengkapan as $id) {
				//insert ke table takaran
				$jumlah = $_POST['jumlah_perlengkapan'][$key++];

				$insertTakaran = mysqli_query($conn, "INSERT INTO `takaran_formula`(`id_formula`, `id_perlengkapan`, `jumlah`) VALUES ($id_formula, $id, $jumlah)");
			}
		}

		if ($insertTakaran) {
			header('location:'.$base_url.'laundry/formula/?message_success=Selamat, formula perlengkapan berhasil ditambahkan!!!');
		}else{
			header('location:'.$base_url.'laundry/formula/?message_failed=Maaf, formula perlengkapan gagal ditambahkan!!!');
		}
	}else{
		header('location:'.$base_url.'laundry/formula/?message_failed');
	}
}