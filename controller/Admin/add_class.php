<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (isset($_POST['simpan'])) {
	$kelas = trim(strtolower(filterString($_POST['kelas_name'])));

	//insert data
	$sql_insert = mysqli_query($conn, "INSERT INTO `kelas`(`nama_kelas`) VALUES ('$kelas')");
	if ($sql_insert) {
		header('location:'.$base_url.'admin/ruang_kelas/?message_success');
	}else{
		header('location:'.$base_url.'admin/ruang_kelas/?message_failed='.mysqli_error($conn));
	}
}

 ?>