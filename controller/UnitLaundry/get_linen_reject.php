<?php 
require 'controller/config/connection.php';

$id_linen = $_POST['id_linen'];

//ambil data user
$sql_linen = mysqli_query($conn, "SELECT cuci.id_pencucian AS id, linen.nama_linen, kelas.nama_kelas, ruang.nama_ruang FROM pencucian AS cuci INNER JOIN linen_kotor AS kotor ON kotor.id_linen_kotor=cuci.id_linen_kotor INNER JOIN linen ON linen.id_linen=kotor.id_linen INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang WHERE cuci.id_pencucian =$id_linen");
$data_linen = mysqli_fetch_assoc($sql_linen);

$ruang_kelas = ucwords($data_linen['nama_ruang']).' - '.ucwords($data_linen['nama_kelas']);

$data = [
		'id_cuci' => $data_linen['id'],
		'nama_linen' => ucwords($data_linen['nama_linen']),
		'ruang_kelas' => $ruang_kelas
		];
if (mysqli_num_rows($sql_linen) > 0) {
	echo json_encode($data);
}

 ?>