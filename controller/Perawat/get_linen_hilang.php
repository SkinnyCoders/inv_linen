<?php 
require 'controller/config/connection.php';

$id_hilang = $_POST['id_linen_hilang'];

$sqlData = mysqli_query($conn, "SELECT linen_hilang.id_linen_hilang, linen.nama_linen, kategori.nama_kategori, ruang.nama_ruang, kelas.nama_kelas, linen_hilang.jumlah, linen_hilang.status FROM `linen_hilang` INNER JOIN linen ON linen.id_linen=linen_hilang.id_linen INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas WHERE linen_hilang.id_linen_hilang = $id_hilang");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = [ 	'id' => $getData['id_linen_hilang'],
				'nama_linen' => $getData['nama_linen'],
				'ruang' => $getData['nama_ruang'],
				'kelas' => $getData['nama_kelas'],
				'jumlah' => $getData['jumlah'],
				'kategori' => $getData['nama_kategori'],
				'status' => $getData['status']];
	echo json_encode($data);
}