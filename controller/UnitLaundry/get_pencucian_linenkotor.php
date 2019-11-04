<?php 
date_default_timezone_set('Asia/Jakarta');
require 'controller/config/connection.php';

$jenis = $_POST['id_ruang'];
$tanggal = date('Y-m-d');

$sqlData = mysqli_query($conn, "SELECT kotor.id_linen_kotor AS id_kotor, linen.nama_linen, kategori.nama_kategori, ruang.nama_ruang, kelas.nama_kelas, jenis.jumlah FROM `linen_kotor` as kotor INNER JOIN jenis_linen_kotor AS jenis ON jenis.id_linen_kotor=kotor.id_linen_kotor INNER JOIN linen ON linen.id_linen=kotor.id_linen INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang INNER JOIN kelas on kelas.id_kelas=linen.id_kelas WHERE jenis.jenis ='$jenis' AND DATE(tgl_pengambilan) = '$tanggal' AND kotor.status='kotor'  AND NOT EXISTS (SELECT * FROM pencucian WHERE pencucian.id_linen_kotor=kotor.id_linen_kotor)");


$cekData = mysqli_num_rows($sqlData);

if ($cekData > 0) {
	while ($getData = mysqli_fetch_assoc($sqlData)) {
		$data[] = ['id_linen_kotor' => $getData['id_kotor'], 'linen'=> $getData['nama_linen'], 'kategori' => $getData['nama_kategori'], 'ruang' => $getData['nama_ruang'], 'kelas' => $getData['nama_kelas'], 'jumlah' => $getData['jumlah']];
	}
	 echo json_encode($data);
}else{
	$data = [];
	echo json_encode($data);
}