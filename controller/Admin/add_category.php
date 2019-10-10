<?php

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (isset($_POST['simpan'])) {
	$nama_kategori = trim(strtolower(filterString($_POST['kategori'])));

	//cek nama kategori sudah ada belum
	$sql_cek = mysqli_query($conn, "SELECT `nama_kategori` FROM `kategori` WHERE `nama_kategori` = '$nama_kategori'");
	$cek_kategori = mysqli_num_rows($sql_cek);
	// cek ada datanya atau tidak
	if ($cek_kategori > 0) {
		//kalo ada 
		header('location:' . $base_url . 'admin/linen/kategori/?message_failed');
	}else{
		//klo gk ada
		$insert_data = $conn->prepare("INSERT INTO `kategori`(`nama_kategori`) VALUES (?)");
		$insert_data->bind_param('s', $nama_kategori);
		if ($insert_data->execute()) {
			$insert_data->close();
			header('location:' . $base_url . 'admin/linen/kategori/?message_success');
		}else{
			header('location:' . $base_url . 'admin/linen/kategori/?message_failed');
		}
	}
}