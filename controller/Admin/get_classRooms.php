<?php 
require 'controller/config/connection.php';

$id_ruang = $_POST['id_ruang'];

$sqlData = mysqli_query($conn, "SELECT kelas.id_kelas, kelas.nama_kelas FROM `ruang_kelas` JOIN `kelas` ON kelas.id_kelas=ruang_kelas.id_kelas WHERE id_ruang = $id_ruang");
$cekData = mysqli_num_rows($sqlData);

if ($cekData > 0) {
	while ($getData = mysqli_fetch_assoc($sqlData)) {
		$data[] = ['id_kelas' => $getData['id_kelas'], 'kelas'=> $getData['nama_kelas']];
	}
	echo json_encode($data);
}else{
	$data = ['id_kelas' => 'Kosong', 'kelas'=> 'Kosong'];
	echo json_encode($data);
}