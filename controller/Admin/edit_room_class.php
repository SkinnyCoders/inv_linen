<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (!empty($_POST['id_ruang'])) {
	$id_ruang = $_POST['id_ruang'];
	$id_kelas = $_POST['ruang_kelas'];

	//hapus data sebelumnya
	$delete = mysqli_query($conn, "DELETE FROM ruang_kelas WHERE id_ruang = $id_ruang");

	if ($delete) {
		foreach ($id_kelas as $kelas) {
			$insert = mysqli_query($conn, "INSERT INTO ruang_kelas (`id_kelas`, `id_ruang`) VALUES ($kelas, $id_ruang)");
		}

		header('location:'.$base_url.'admin/ruang_kelas/?message_success=Data Ruang Kelas Berhasil Diedit!!!');
	}else{
		header('location:'.$base_url.'admin/ruang_kelas/?message_failed=Maaf, data ruang kelas gagal diedit!!!');
	}
}

 ?>