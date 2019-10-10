<?php 
require 'controller/config/connection.php';

$id_ruang = $_POST['id_ruang'];
$tanggal_sekarang = date('Y-m-d');
$sqlData = mysqli_query($conn, "SELECT linen.id_linen, linen.nama_linen, kategori.nama_kategori, kelas.nama_kelas FROM `ruang_kelas` INNER JOIN linen ON linen.id_kelas=ruang_kelas.id_kelas INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas WHERE ruang_kelas.id_ruang = $id_ruang AND NOT EXISTS (SELECT * FROM linen_kotor WHERE linen_kotor.id_linen=linen.id_linen AND DATE(linen_kotor.tgl_pengambilan) = '$tanggal_sekarang' AND linen_kotor.status = 'kotor')");
$cekData = mysqli_num_rows($sqlData);

if ($cekData > 0) {
	while ($getData = mysqli_fetch_assoc($sqlData)) {
		$data[] = ['id_linen' => $getData['id_linen'], 'linen'=> $getData['nama_linen'], 'kategori' => $getData['nama_kategori'], 'kelas' => $getData['nama_kelas']];
	}
	echo json_encode($data);
}else{
	$data = [];
	echo json_encode($data);
}