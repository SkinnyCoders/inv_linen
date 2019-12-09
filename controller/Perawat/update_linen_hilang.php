<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';


if (isset($_POST['simpan'])) {
	$id_linen_hilang = $_POST['id_linen'];
	$jumlah = trim(htmlspecialchars($_POST['jumlah_linen']));
	$status = $_POST['status'];


	$getId = mysqli_query($conn, "SELECT id_linen FROM linen_hilang WHERE id_linen_hilang = $id_linen_hilang");
	$id_linen = mysqli_fetch_assoc($getId);
	$id_linen = $id_linen['id_linen'];

	//get stok linen
	$sqlStok = mysqli_query($conn, "SELECT `jml_linen` FROM `linen` WHERE `id_linen` = $id_linen");
	$stokLinen = mysqli_fetch_assoc($sqlStok);
	$stokLinen = $stokLinen['jml_linen'];

	//get jumlah sebelum
	$sqlStokHilang = mysqli_query($conn, "SELECT jumlah FROM linen_hilang WHERE id_linen_hilang = $id_linen_hilang");
	$stokHilang = mysqli_fetch_assoc($sqlStokHilang);
	$stokHilang = $stokHilang['jumlah'];

	if ($jumlah > $stokLinen) {
		header('location:'.$base_url.'perawat/linen/hilang-rusak/?message_failed1');
	}else{
		if ($jumlah < $stokHilang) {
			$sisa = $stokHilang - $jumlah;
			$jumlahAkhir = $stokLinen+$sisa;
		}elseif ($jumlah > $stokHilang) {
			$sisa = $jumlah - $stokHilang;
			$jumlahAkhir = $stokLinen-$sisa;
		}

		//update 
		$sqlUpdateHilang = mysqli_query($conn, "UPDATE `linen_hilang` SET `jumlah`= $jumlah,`status`='$status' WHERE `id_linen_hilang` = $id_linen_hilang");
		if ($sqlUpdateHilang) {
			//update stok linen
			$sqlUpdateLinen = mysqli_query($conn, "UPDATE `linen` SET `jml_linen`=$jumlahAkhir WHERE `id_linen` = $id_linen");

			if ($sqlUpdateLinen) {
				header('location:'.$base_url.'perawat/linen/hilang-rusak/?message_success=Selamat, Data Berhasil Diedit!!!');
			}else{
				header('location:'.$base_url.'perawat/linen/hilang-rusak/?message_failed2=Maaf, Data Gagal Diedit!!!');
			}
		}
	}
}else{
	header('location:'.$base_url.'perawat/linen/hilang-rusak/?message_failed3');
}

