<?php 

require 'controller/config/connection.php';

$id_linen_hilang = $_POST['id_linen'];

if (!empty($id_linen_hilang)) {

	//get jumlah sebelum
	$sqlStokHilang = mysqli_query($conn, "SELECT id_linen, jumlah FROM linen_hilang WHERE id_linen_hilang = $id_linen_hilang");
	$dataStokHilang = mysqli_fetch_assoc($sqlStokHilang);
	$stokHilang = $dataStokHilang['jumlah'];
	$id_linen 	= $dataStokHilang['id_linen'];

	//get stok linen
	$sqlStok = mysqli_query($conn, "SELECT `jml_linen` FROM `linen` WHERE `id_linen` = $id_linen");
	$stokLinen = mysqli_fetch_assoc($sqlStok);
	$stokLinen = $stokLinen['jml_linen'];

	$jumlahAkhir = $stokLinen + $stokHilang;

	$deleteLinen = mysqli_query($conn, "DELETE FROM `linen_hilang` WHERE `id_linen_hilang` = $id_linen_hilang");
	
	if ($deleteLinen) {
		//update stoke linen
		$sqlUpdate = mysqli_query($conn, "UPDATE `linen` SET `jml_linen`=$jumlahAkhir WHERE `id_linen` = $id_linen");
			
		if ($sqlUpdate) {
			http_response_code(200);
		}else{
			http_response_code(404);
		}
	}else{
			http_response_code(404);
	}
}

 ?>