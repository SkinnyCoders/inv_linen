<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (isset($_POST['simpan'])) {
	$nama_perlengkapan = filterString($_POST['perlengkapan_baru']);
	$jumlah = filterString($_POST['jumlah_perlengkapan']);
	$status = $_POST['status'];
	$diajukan = $_POST['diajukan'];
	$keterangan = filterString($_POST['keterangan']);
	$id = $_POST['id_permintaan'];


	//cek statusnya jika sudah disetujui maka tidak bisa diupdate
	if ($status !== 'setuju') {
		//jika belum disetujui
		$sqlUpdate = mysqli_query($conn, "UPDATE `permintaan_perlengkapan` SET `nama_perlengkapan`='$nama_perlengkapan',`id_user`=$diajukan,`jml_permintaan`=$jumlah,`keterangan`='$keterangan' WHERE `id_permintaan_perlengkapan` = $id");
		if ($sqlUpdate) {
			header('location:'.$base_url.'laundry/permintaan/perlengkapan/?message_success= Selamat, data permintaan perlengkapan berhasil diedit!!!');
		}else{
			header('location:'.$base_url.'laundry/permintaan/perlengkapan/?message_failed=Maaf, data permintaan perlengkapan gagal diedit!!!');
		}
	}else{
		header('location:'.$base_url.'laundry/permintaan/perlengkapan/?message_failed=Sudah tidak dapat diubah');
	}
}