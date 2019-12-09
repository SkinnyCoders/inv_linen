<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$id_penerimaan = $_POST['id_penerimaan_linen'];

$jumlah = $_POST['jumlah_linen'];

if (isset($_POST['id_penerimaan_linen']) && !empty($_POST['id_penerimaan_linen']) ) {
	//cek jumlah sebelumnya

	$sqlJumlahPast = mysqli_query($conn, "SELECT permintaan_linen_baru.jml_permintaan FROM `penerimaan_linen_baru` INNER JOIN permintaan_linen_baru ON permintaan_linen_baru.id_permintaan_linen_baru=penerimaan_linen_baru.id_permintaan_linen_baru WHERE `id_penerimaan_linen_baru` = $id_penerimaan");
	$jumlahPast = mysqli_fetch_assoc($sqlJumlahPast);
	if ($jumlah > $jumlahPast['jml_permintaan']) {
	 	//tidak boleh melebihi jumlah yang diajukan
	 	header('location:'.$base_url.'perawat/penerimaan/linen/?message_failed=Jumlah tidak boleh melebihi dari jumlah yang diajukan'); 	
	 } else {
	 	//jika tidak melebihi maka bisa diupdate
	 	$updatePenerimaan = mysqli_query($conn, "UPDATE `penerimaan_linen_baru` SET `jml_diterima`=$jumlah WHERE `id_penerimaan_linen_baru` = $id_penerimaan");
	 	if ($updatePenerimaan) {
	 		//update juga jumlah di table linen
	 		$sqlUpdate = mysqli_query($conn, "UPDATE `linen` SET `jml_linen`=$jumlah WHERE `id_penerimaan_linen_baru` = $id_penerimaan");

	 		if ($sqlUpdate) {
	 			header('location:'.$base_url.'perawat/penerimaan/linen/?message_success=Selamat, Data Penerimaan Linen Baru Berhasil Diedit!!!');
	 		}else{
	 			header('location:'.$base_url.'perawat/penerimaan/linen/?message_failed=Maaf, Data Penerimaan Linen Baru Gagal Diedit!!!'); 
	 		}
	 		
	 	}else{
	 		header('location:'.$base_url.'perawat/penerimaan/linen/?message_failed=Maaf, Data Penerimaan Linen Baru Gagal Diedit!!!'); 
	 	}

	 }
}
	
