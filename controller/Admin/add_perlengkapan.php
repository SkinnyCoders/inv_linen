<?php

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (isset($_POST['simpan'])) {
	$nama_perlengkapan = trim(strtolower(filterString($_POST['perlengkapan'])));
	$jenis = trim(strtolower(filterString($_POST['jenis'])));
	$manfaat = trim(strtolower(filterString($_POST['manfaat'])));

	//cek nama kategori sudah ada belum
	$sql_cek = mysqli_query($conn, "SELECT `nama_perlengkapan` FROM `perlengkapan` WHERE `nama_perlengkapan` = '$nama_perlengkapan'");
	$cek_perlengkapan = mysqli_num_rows($sql_cek);
	// cek ada datanya atau tidak
	if ($cek_perlengkapan > 0) {
		//kalo ada 
		header('location:' . $base_url . 'admin/perlengkapan/?message_failed');
	}else{
		//klo gk ada
		$insert_data = $conn->prepare("INSERT INTO `perlengkapan`(`nama_perlengkapan`, `jenis`, `manfaat`) VALUES (?,?,?)");
		$insert_data->bind_param('sss', $nama_perlengkapan, $jenis, $manfaat);
		if ($insert_data->execute()) {
			$insert_data->close();
			header('location:' . $base_url . 'admin/perlengkapan/?message_success');
		}else{
			header('location:' . $base_url . 'admin/perlengkapan/?message_failed');
		}
	}
}