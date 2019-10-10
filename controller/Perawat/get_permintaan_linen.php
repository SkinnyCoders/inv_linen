<?php 
require 'controller/config/connection.php';

$id_permintaan = $_POST['id_permintaan'];

$sqlData = mysqli_query($conn, "SELECT `nama_ruang`,`nama_kelas`, `nama_user`, jml_permintaan, permintaan_linen_baru.id_ruang, permintaan_linen_baru.id_kelas, permintaan_linen_baru.id_kategori, permintaan_linen_baru.nama_linen_baru FROM `permintaan_linen_baru` INNER JOIN ruang ON ruang.id_ruang=permintaan_linen_baru.id_ruang INNER JOIN kelas ON kelas.id_kelas=permintaan_linen_baru.id_kelas INNER JOIN user ON user.id_user=permintaan_linen_baru.id_user WHERE `id_permintaan_linen_baru` = $id_permintaan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = ['jumlah' => $getData['jml_permintaan'],
			'ruang' => $getData['nama_ruang'], 
			'kelas'=> $getData['nama_kelas'], 
			'oleh'=> $getData['nama_user'],
			'id_ruang' => $getData['id_ruang'],
			'id_kelas' => $getData['id_kelas'],
			'id_kategori' => $getData['id_kategori'],
			'nama_linen_baru' => $getData['nama_linen_baru']];

	echo json_encode($data);
}