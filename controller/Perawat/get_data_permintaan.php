<?php 
require 'controller/config/connection.php';

$id_permintaan = $_POST['id_permintaan'];

$sqlData = mysqli_query($conn, "SELECT `id_permintaan_linen_baru`, `nama_linen_baru`, `id_user`, `id_ruang`, `id_kelas`, `jml_permintaan`,`id_kategori`, `keterangan` FROM `permintaan_linen_baru` WHERE `id_permintaan_linen_baru`= $id_permintaan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = [ 	'id' => $getData['id_permintaan_linen_baru'],
				'nama_linen' => $getData['nama_linen_baru'],
				'id_user' => $getData['id_user'],
				'id_ruang' => $getData['id_ruang'],
				'id_kelas' => $getData['id_kelas'],
				'jumlah' => $getData['jml_permintaan'],
				'id_kategori' => $getData['id_kategori'],
				'keterangan' => $getData['keterangan']];
	echo json_encode($data);
}
