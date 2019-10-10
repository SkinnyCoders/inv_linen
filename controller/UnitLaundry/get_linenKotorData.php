<?php 
require 'controller/config/connection.php';

$id_linen = $_POST['id_linen'];

//ambil data user
$sql_linen = mysqli_query($conn, "SELECT linen_kotor.id_linen_kotor AS id, linen.nama_linen, kategori.nama_kategori, ruang.nama_ruang, kelas.nama_kelas, linen_kotor.jml_linen_kotor, linen_kotor.jenis_linen_kotor FROM `linen_kotor` INNER JOIN linen ON linen.id_linen=linen_kotor.id_linen INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas WHERE linen_kotor.id_linen_kotor =$id_linen");
$data_linen = mysqli_fetch_assoc($sql_linen);

$ruang_kelas = ucwords($data_linen['nama_ruang']).' - '.ucwords($data_linen['nama_kelas']);

$data = [
		'id_linen' => $data_linen['id'],
		'nama_linen' => ucwords($data_linen['nama_linen']),
		'ruang_kelas' => $ruang_kelas,
		'jenis' => $data_linen['jenis_linen_kotor'],
		'jumlah' => $data_linen['jml_linen_kotor']
		];
if (mysqli_num_rows($sql_linen) > 0) {
	echo json_encode($data);
}

 ?>