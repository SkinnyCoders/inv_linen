<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$kelas = $_POST['ruang_kelas'];
$nama_ruang = trim(filterString($_POST['ruang']));


$insertRuang = mysqli_query($conn, "INSERT INTO `ruang`(`nama_ruang`) VALUES ('$nama_ruang')");
if ($insertRuang) {
	$getID = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
	while ($id = mysqli_fetch_array($getID)) {
		$id_ruang = $id[0];
	}

	foreach ($kelas as $k) {
		$konfigRuang = mysqli_query($conn, "INSERT INTO `ruang_kelas`(`id_kelas`, `id_ruang`) VALUES ($k,$id_ruang)");
	}

	header('location:'.$base_url.'admin/ruang_kelas/?message_success=Selamat, Data Ruang Kelas Berhasil Ditambahkan!.');
	
}else{
	header('location:'.$base_url.'admin/ruang_kelas/?message_failed=  Maaf, Data Ruang Kelas gagal ditambahkan!, harap periksa lagi informasi yang diinputkan!.');
}




 ?>