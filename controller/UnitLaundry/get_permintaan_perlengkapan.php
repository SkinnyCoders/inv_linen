<?php 
require 'controller/config/connection.php';

$id_permintaan = $_POST['id_permintaan'];

$sqlData = mysqli_query($conn, "SELECT `id_permintaan_perlengkapan`,`nama_perlengkapan`, user.nama_user , `tgl_permintaan`, `jml_permintaan`, `status`, `keterangan` FROM `permintaan_perlengkapan` INNER JOIN user ON user.id_user=permintaan_perlengkapan.id_user WHERE `id_permintaan_perlengkapan` =  $id_permintaan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = [ 	'id' => $getData['id_permintaan_perlengkapan'],
				'pengaju' => $getData['nama_user'],
				'jumlah' => $getData['jml_permintaan']];
	echo json_encode($data);
}
