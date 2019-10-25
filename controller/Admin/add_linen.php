<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$nama_linen = trim(strtolower(filterString($_POST['linen'])));
$id_ruang = filterString($_POST['ruang']);
$id_kelas = filterString($_POST['kelas']);
$id_kategori = filterString($_POST['kategori']);
$jumlah = filterString($_POST['jumlah_linen']);

//cek nama linen
$sql_cek_linen = mysqli_query($conn, "SELECT nama_linen FROM linen WHERE nama_linen = '$nama_linen'");
$cek_linen = mysqli_num_rows($sql_cek_linen);

if ($cek_linen > 0) {
	header('location:'.$base_url.'admin/linen/list/?message_failed');
}else{
	$insertLinen = mysqli_query($conn, "INSERT INTO `linen`(`nama_linen`, `id_ruang`, `id_kelas`, `id_kategori`, `jml_linen`) VALUES ('$nama_linen',$id_ruang,$id_kelas,$id_kategori,$jumlah)");
	if ($insertLinen) {
		header('location:'.$base_url.'admin/linen/list/?message_success=Selamat, Data Linen Berhasil Ditambahkan!.');
	}else{
		header('location:'.$base_url.'admin/linen/list/?message_failed=Maaf, Data linen gagal ditambahkan!, harap periksa lagi informasi yang diinputkan!.'.mysqli_error($conn));
	}
}