<?php 
require 'controller/config/connection.php';

$id_penerimaan = $_POST['id_penerimaan'];

$sqlData = mysqli_query($conn, "SELECT penerimaan_linen_baru.id_penerimaan_linen_baru, nama_linen_baru, kelas.nama_kelas, ruang.nama_ruang, user.nama_user, penerimaan_linen_baru.jml_diterima FROM `penerimaan_linen_baru` INNER JOIN permintaan_linen_baru ON permintaan_linen_baru.id_permintaan_linen_baru=penerimaan_linen_baru.id_permintaan_linen_baru INNER JOIN kelas ON kelas.id_kelas=permintaan_linen_baru.id_kelas INNER JOIN ruang ON ruang.id_ruang=permintaan_linen_baru.id_ruang INNER JOIN user ON user.id_user=permintaan_linen_baru.id_user WHERE `id_penerimaan_linen_baru` = $id_penerimaan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = ['nama_linen' => $getData['nama_linen_baru'],
			'ruang' => $getData['nama_ruang'], 
			'kelas'=> $getData['nama_kelas'], 
			'oleh'=> $getData['nama_user'],
			'id_penerimaan' => $getData['id_penerimaan_linen_baru'],
			'jumlah' => $getData['jml_diterima']
			];

	echo json_encode($data);
}