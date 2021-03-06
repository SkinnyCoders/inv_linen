<?php 
require 'controller/config/connection.php';

$id_ruang = $_POST['id_ruang'];
$tanggal_sekarang = date('Y-m-d');
$sqlData = mysqli_query($conn, "SELECT linen.id_linen, linen.jml_linen, linen.nama_linen, kategori.nama_kategori, kelas.nama_kelas FROM linen INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori WHERE linen.id_ruang = $id_ruang AND NOT EXISTS (SELECT * FROM linen_kotor WHERE linen_kotor.id_linen=linen.id_linen AND DATE(linen_kotor.tgl_pengambilan) = '$tanggal_sekarang' AND linen_kotor.status = 'kotor')");
$cekData = mysqli_num_rows($sqlData);

if ($cekData > 0) {
	while ($getData = mysqli_fetch_assoc($sqlData)) {
		$data[] = ['id_linen' => $getData['id_linen'], 
					'linen'=> $getData['nama_linen'], 
					'kategori' => $getData['nama_kategori'], 
					'kelas' => $getData['nama_kelas'],
					'jumlah' => $getData['jml_linen']];
	}
	echo json_encode($data);
}else{
	$data = [];
	echo json_encode($data);
}