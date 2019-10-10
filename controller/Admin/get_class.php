<?php 
require 'controller/config/connection.php';

$id_kelas = $_POST['id_kelas'];

$sqlData = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas= $id_kelas");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = ['id_kelas' => $getData['id_kelas'], 'kelas'=> $getData['nama_kelas']];
	echo json_encode($data);
}