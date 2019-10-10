<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$nama_linen = trim(strtolower(filterString($_POST['linen_baru'])));
$id_ruang = filterString($_POST['ruang']);
$id_kategori = filterString($_POST['kategori']);
$jumlah = filterString($_POST['jumlah_linen']);
$diajukan = filterString($_POST['diajukan']);
$keterangan = trim(strtolower(filterString($_POST['keterangan'])));
$id_permintaan = $_POST['id_permintaan'];


if (isset($_POST['kelas']) && !empty($_POST['kelas']) ) {
	echo 'ada';
	$id_kelas = $_POST['kelas'];
	$update_permintaan = mysqli_query($conn, "UPDATE `permintaan_linen_baru` SET `nama_linen_baru`='$nama_linen',`id_user`=$diajukan,`id_ruang`=$id_ruang,`id_kelas`=$id_kelas,`jml_permintaan`=$jumlah,`id_kategori`=$id_kategori,`keterangan`=$keterangan WHERE `id_permintaan_linen_baru`= $id_permintaan");
	if ($update_permintaan) {
		header('location:'.$base_url.'perawat/permintaan/linen/?message_success');
	}else{
		header('location:'.$base_url.'perawat/permintaan/linen/?message_failed'.mysqli_error($conn));
	}
	
}else{
	echo 'gk ada';
	$update_permintaan = $conn->prepare("UPDATE `permintaan_linen_baru` SET `nama_linen_baru`=?,`id_user`=?,`id_ruang`=?,`jml_permintaan`=?,`id_kategori`=?,`keterangan`=? WHERE `id_permintaan_linen_baru` = ?");
	$update_permintaan->bind_param('sssssss', $nama_linen, $diajukan, $id_ruang, $jumlah, $id_kategori, $keterangan, $id_permintaan);
	if ($update_permintaan->execute()) {
		$update_permintaan->close();
		header('location:'.$base_url.'perawat/permintaan/linen/?message_success');
	}else{
		header('location:'.$base_url.'perawat/permintaan/linen/?message_failed'.mysqli_error($conn));
	}
}
	
