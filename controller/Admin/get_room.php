<?php 
require 'controller/config/connection.php';

$id_ruang = $_POST['id_ruang'];

$sqlData = mysqli_query($conn, "SELECT * FROM ruang WHERE id_ruang= $id_ruang");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = ['id_ruang' => $getData['id_ruang'], 'ruang'=> $getData['nama_ruang']];
	echo json_encode($data);
}