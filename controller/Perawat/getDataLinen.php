<?php 
require 'controller/config/connection.php';

$id_permintaan = $_POST['id_linen'];

$sqlData = mysqli_query($conn, "SELECT `nama_linen`, ruang.id_ruang, kelas.id_kelas, kategori.id_kategori FROM `linen` INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori WHERE `id_linen` =  $id_permintaan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = ['linen' => $getData['nama_linen'],
			'ruang' => $getData['id_ruang'], 
			'kelas'=> $getData['id_kelas'], 
			'kategori' => $getData['id_kategori']];

	echo json_encode($data);
}