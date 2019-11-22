<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$nama_linen = trim(strtolower(filterString($_POST['linen_baru'])));
$id_ruang = filterString($_POST['ruang']);
$id_kelas = filterString($_POST['kelas']);
$id_kategori = filterString($_POST['kategori']);
$jumlah = filterString($_POST['jumlah_linen']);
$diajukan = filterString($_POST['diajukan']);
$keterangan = trim(strtolower(filterString($_POST['keterangan'])));


	$insertLinenPengajuan = mysqli_query($conn, "INSERT INTO `permintaan_linen_baru`(`nama_linen_baru`, `id_user`, `id_ruang`, `id_kelas`,`jml_permintaan`,`id_kategori`, `keterangan`) VALUES ('$nama_linen', $diajukan, $id_ruang, $id_kelas, $jumlah, $id_kategori, '$keterangan')");
	if ($insertLinenPengajuan) {
		header('location:'.$base_url.'perawat/permintaan/linen/?message_success=Selamat, Permintaan Linen Berhasil ditambahkan!!!');
	}else{
		header('location:'.$base_url.'perawat/permintaan/linen/?message_failed=Maaf, Permintaan Linen Gagal ditambahkan'.mysqli_error($conn));
	}
