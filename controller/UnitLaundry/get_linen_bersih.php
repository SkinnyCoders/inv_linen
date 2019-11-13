<?php 
require 'controller/config/connection.php';

$id_ruang = $_POST['id_ruang'];
$tanggal_sekarang = date('Y-m-d');
$sqlData = mysqli_query($conn, "SELECT pencucian.id_pencucian, pencucian.id_proses_cuci, linen.nama_linen, kategori.nama_kategori, kelas.nama_kelas, jenis_linen_kotor.jumlah, jenis_linen_kotor.jenis, pencucian.id_proses_cuci FROM pencucian INNER JOIN linen_kotor ON linen_kotor.id_linen_kotor=pencucian.id_linen_kotor INNER JOIN linen ON linen.id_linen=linen_kotor.id_linen INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN jenis_linen_kotor ON jenis_linen_kotor.id_jenis_linen_kotor=pencucian.id_jenis_linen_kotor WHERE linen.id_ruang = $id_ruang AND pencucian.status='cuci' AND DATE(pencucian.tgl_cuci) = '$tanggal_sekarang'");
$cekData = mysqli_num_rows($sqlData);

if ($cekData > 0) {
	while ($getData = mysqli_fetch_assoc($sqlData)) {
		$data[] = ['id_cuci' => $getData['id_pencucian'], 'linen'=> $getData['nama_linen'], 'kategori' => $getData['nama_kategori'], 'kelas' => $getData['nama_kelas'], 'jml_linen' => $getData['jumlah'], 'jenis_linen' => $getData['jenis'], 'proses_cuci' => $getData['id_proses_cuci']];
	}
	echo json_encode($data);
}else{
	$data = [];
	echo json_encode($data);
}