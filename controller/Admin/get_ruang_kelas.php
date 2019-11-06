<?php 
require 'controller/config/connection.php';

$id_ruang1 = $_POST['id_ruang'];

$dataRuang = $conn->prepare("SELECT GROUP_CONCAT(id_kelas), ruang.nama_ruang, ruang_kelas.id_ruang FROM `ruang_kelas` INNER JOIN ruang ON ruang.id_ruang=ruang_kelas.id_ruang WHERE ruang_kelas.`id_ruang` = ?");
$dataRuang->bind_param('s', $id_ruang1);
if ($dataRuang->execute()) {
	$dataRuang->bind_result($id_kelas, $nama_ruang, $id_ruang);
	$dataRuang->fetch();

	$id_kelas = explode(',', $id_kelas);

	$data = ['nama_ruang' => $nama_ruang, 'id_kelas'=> $id_kelas, 'id_ruang' => $id_ruang];

	echo json_encode($data);
}else{
	echo "gagal";
}