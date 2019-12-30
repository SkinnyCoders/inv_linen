<?php 

require 'controller/config/connection.php';

$id_penerimaan = $_GET['id'];

//get sisa
$sqlSisa = mysqli_query($conn, "SELECT penerimaan_linen_baru.jml_diterima, permintaan_linen_baru.jml_permintaan, linen.jml_linen FROM penerimaan_linen_baru INNER JOIN permintaan_linen_baru ON permintaan_linen_baru.id_permintaan_linen_baru=penerimaan_linen_baru.id_permintaan_linen_baru INNER JOIN linen ON linen.id_penerimaan_linen_baru=penerimaan_linen_baru.id_penerimaan_linen_baru WHERE penerimaan_linen_baru.id_penerimaan_linen_baru = $id_penerimaan");
$rows = mysqli_num_rows($sqlSisa);

if ($rows > 0) {
	$dataSisa = mysqli_fetch_assoc($sqlSisa);
	$sisa = $dataSisa['jml_diterima'] - $dataSisa['jml_permintaan'];
	$sisaTotal = $dataSisa['jml_diterima'] - $sisa;
	$totalFix = $dataSisa['jml_linen'] - $sisa;

	$sqlUpdate = mysqli_query($conn, "UPDATE `penerimaan_linen_baru` SET `jml_diterima` = $sisaTotal WHERE penerimaan_linen_baru.id_penerimaan_linen_baru = $id_penerimaan");
	if ($sqlUpdate) {
		$sqlUpdateLinen = mysqli_query($conn, "UPDATE `linen` SET `jml_linen`= $totalFix WHERE `id_penerimaan_linen_baru` = $id_penerimaan");
		if ($sqlUpdateLinen) {
			http_response_code(200);
		}else{
			http_response_code(404);
		}	
	}else{
		http_response_code(404);
	}

}
