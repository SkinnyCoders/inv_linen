<?php 
require 'controller/config/connection.php';

$id_permintaan = $_GET['id'];

if (isset($id_permintaan)) {
	$sqlData = mysqli_query($conn, "SELECT `id_permintaan_perlengkapan`, `nama_perlengkapan`, `id_user`, `jml_permintaan`, `status`, `keterangan` FROM `permintaan_perlengkapan` WHERE `id_permintaan_perlengkapan` = $id_permintaan");
	$getData = mysqli_fetch_assoc($sqlData);
	if ($getData) {
		$data = [
			'id' => $getData['id_permintaan_perlengkapan'],
			'perlengkapan' => $getData['nama_perlengkapan'],
			'jumlah' => $getData['jml_permintaan'],
			'status' => $getData['status'],
			'pengaju' => $getData['id_user'],
			'keterangan' => $getData['keterangan']
		];

		echo json_encode($data);
	}
}