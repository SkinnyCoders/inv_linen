<?php 
require 'controller/config/connection.php';

$id_permintaan = $_POST['id_permintaan'];

$sqlData = mysqli_query($conn, "SELECT `id_permintaan_linen_baru`, `nama_linen_baru`, user.nama_user, ruang.nama_ruang, kelas.nama_kelas, `jml_permintaan`,`keterangan`, `status` FROM `permintaan_linen_baru` INNER JOIN user ON user.id_user=permintaan_linen_baru.id_user INNER JOIN ruang ON ruang.id_ruang=permintaan_linen_baru.id_ruang INNER JOIN kelas ON kelas.id_kelas=permintaan_linen_baru.id_kelas WHERE `id_permintaan_linen_baru`= $id_permintaan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = [ 	'id' => $getData['id_permintaan_linen_baru'],
				'nama_linen' => $getData['nama_linen_baru'],
				'id_user' => $getData['nama_user'],
				'id_ruang' => $getData['nama_ruang'],
				'id_kelas' => $getData['nama_kelas'],
				'jumlah' => $getData['jml_permintaan'],
				'status' => $getData['status'],
				'keterangan' => $getData['keterangan']];
	echo json_encode($data);
}
