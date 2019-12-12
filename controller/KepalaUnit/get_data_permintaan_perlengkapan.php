<?php 
require 'controller/config/connection.php';

$id_permintaan = $_POST['id_permintaan'];

$sqlData = mysqli_query($conn, "SELECT `id_permintaan_perlengkapan`,`nama_perlengkapan`,`tgl_permintaan`,user.nama_user, `jml_permintaan`,`keterangan`,`status` FROM `permintaan_perlengkapan` INNER JOIN user ON user.id_user=permintaan_perlengkapan.id_user WHERE permintaan_perlengkapan.id_permintaan_perlengkapan =   $id_permintaan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$tanggal = DateTime::createFromFormat('Y-m-d H:i:s', $getData['tgl_permintaan'])->format('d F Y');
	$data = [ 	'id' => $getData['id_permintaan_perlengkapan'],
				'nama_linen' => $getData['nama_perlengkapan'],
				'id_user' => $getData['nama_user'],
				'tanggal' => $tanggal,
				'jumlah' => $getData['jml_permintaan'],
				'status' => $getData['status'],
				'keterangan' => $getData['keterangan']];
	echo json_encode($data);
}
