<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$ruang = trim(filterString($_POST['ruang_name']));

if (!empty($ruang)) {
	//insert data
	$insert = mysqli_query($conn, "INSERT INTO `ruang`(`nama_ruang`) VALUES ('$ruang')");

	if ($insert) {
		header('location:'.$base_url.'admin/ruang_kelas/?message_success=Selamat, Data Ruang Kelas Berhasil Ditambahkan!.');
	}else{
		header('location:'.$base_url.'admin/ruang_kelas/?message_failed=  Maaf, Data Ruang Kelas gagal ditambahkan!, harap periksa lagi informasi yang diinputkan!.');
	}
}