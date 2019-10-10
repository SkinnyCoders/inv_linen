<?php 
require 'controller/config/connection.php';

$id_linen = $_POST['id_linen'];

//ambil data user
$sql_linen = mysqli_query($conn, "SELECT `id_linen`, `nama_linen`, `id_ruang`, `id_kelas`, `id_kategori`, `jml_linen` FROM `linen` WHERE `id_linen`=$id_linen");
$data_user = mysqli_fetch_assoc($sql_linen);

$data = [
		'id_linen' => $data_user['id_linen'],
		'nama_linen' => $data_user['nama_linen'],
		'id_ruang' => $data_user['id_ruang'],
		'id_kelas' => $data_user['id_kelas'],
		'id_kategori' => $data_user['id_kategori'],
		'jumlah' => $data_user['jml_linen']
		];
if (mysqli_num_rows($sql_linen) > 0) {
	echo json_encode($data);
}

 ?>