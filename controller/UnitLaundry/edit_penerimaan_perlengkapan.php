<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (isset($_POST['simpan'])) {
	$nama_perlengkapan = filterString($_POST['perlengkapan']);
	$jumlah = filterString($_POST['jumlah_perlengkapan']);
	$id = $_POST['id_perlengkapan'];

	//ambil jumlah yang diajukan
	$getJumlahPengajuan = mysqli_query($conn, "SELECT permintaan_perlengkapan.jml_permintaan FROM `penerimaan_perlengkapan` INNER JOIN permintaan_perlengkapan ON permintaan_perlengkapan.id_permintaan_perlengkapan=penerimaan_perlengkapan.id_permintaan_perlengkapan WHERE `id_penerimaan_perlengkapan` = $id");
	$jumlahPengajuan = mysqli_fetch_assoc($getJumlahPengajuan);

	if ($jumlah > $jumlahPengajuan) {
		header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_failed=Jumlah tidak boleh melebihi dari jumlah yang diajukan');
	}else{
		//update ke table penerimaan
		$sqlUpdate = mysqli_query($conn, "UPDATE `penerimaan_perlengkapan` SET `jml_diterima`=$jumlah WHERE `id_penerimaan_perlengkapan` = $id");
		if ($sqlUpdate) {
			//update ke table perlengkapan
			$update = mysqli_query($conn, "UPDATE `perlengkapan` SET `jumlah`=$jumlah WHERE `id_penerima` = $id");
			if ($update) {
				header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_success');
			}else{
				header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_failed='.mysqli_error($conn));
			}
		}else{
			header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_failed='.mysqli_error($conn));
		}
	}
}

 ?>