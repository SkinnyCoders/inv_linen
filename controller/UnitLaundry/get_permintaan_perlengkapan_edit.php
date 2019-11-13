<?php 
require 'controller/config/connection.php';

$id_penerimaan = $_POST['id_penerimaan'];

$sqlData = mysqli_query($conn, "SELECT penerimaan_perlengkapan.id_penerimaan_perlengkapan AS id, permintaan_perlengkapan.nama_perlengkapan, user.nama_user, penerimaan_perlengkapan.jml_diterima FROM `penerimaan_perlengkapan` INNER JOIN permintaan_perlengkapan ON permintaan_perlengkapan.id_permintaan_perlengkapan=penerimaan_perlengkapan.id_permintaan_perlengkapan INNER JOIN user ON user.id_user=penerimaan_perlengkapan.id_penerima WHERE `id_penerimaan_perlengkapan` =  $id_penerimaan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = [ 	'id' => $getData['id'],
				'perlengkapan' => ucwords($getData['nama_perlengkapan']),
				'penerima' => $getData['nama_user'],
				'jumlah' => $getData['jml_diterima']];
	echo json_encode($data);
}
