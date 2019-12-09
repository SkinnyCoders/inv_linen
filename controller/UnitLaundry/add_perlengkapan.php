<?php
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';
if (isset($_POST['simpan'])) {

	$nama_perlengkapan = trim(strtolower(filterString($_POST['perlengkapan'])));
	$jenis = trim(strtolower(filterString($_POST['jenis'])));
	$manfaat = trim(strtolower(filterString($_POST['manfaat'])));
	$jumlah = trim(htmlspecialchars($_POST['jumlah']));
	//cek nama kategori sudah ada belum
	$sql_cek = mysqli_query($conn, "SELECT `nama_perlengkapan` FROM `perlengkapan` WHERE `nama_perlengkapan` = '$nama_perlengkapan'");
	$cek_perlengkapan = mysqli_num_rows($sql_cek);
	// cek ada datanya atau tidak
	if ($cek_perlengkapan > 0) {
		//kalo ada 
		header('location:' . $base_url . 'laundry/perlengkapan/?message_failed');
	}else{
		//klo gk ada
		$insert_data = mysqli_query($conn, "INSERT INTO `perlengkapan`(`nama_perlengkapan`, `jenis`, `manfaat`, `jumlah`) VALUES ('$nama_perlengkapan', '$jenis','$manfaat', $jumlah)");
		if ($insert_data == true) {
			header('location:' . $base_url . 'laundry/perlengkapan/?message_success=Selamat, Data Perlengkapan berhasil ditambahkan!.');
		}else{
			header('location:' . $base_url . 'laundry/perlengkapan/?message_failed=Maaf, Data Perlengkapan gagal ditambahkan!, harap periksa lagi informasi yang diinputkan!.');
		}
	}
}