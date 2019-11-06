<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$nama_perlengkapan = trim(strtolower(filterString($_POST['perlengkapan_baru'])));
$kategori = filterString($_POST['kategori']);
$jumlah = filterString($_POST['jumlah_perlengkapan']);
$diajukan = filterString($_POST['diajukan']);
$keterangan = trim(strtolower(filterString($_POST['keterangan'])));

	$insertLinenPengajuan = mysqli_query($conn, "INSERT INTO `permintaan_perlengkapan`(`nama_perlengkapan`, `id_user`,`jml_permintaan`,`keterangan`) VALUES ('$nama_perlengkapan','$diajukan', '$jumlah', '$keterangan')");
	if ($insertLinenPengajuan) {
		header('location:'.$base_url.'laundry/permintaan/perlengkapan/?message_success');
	}else{
		header('location:'.$base_url.'laundry/permintaan/perlengkapan/?message_failed'.mysqli_error($conn));
	}
