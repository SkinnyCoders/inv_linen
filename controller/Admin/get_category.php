<?php 
require 'controller/config/connection.php';

$id_kategori = $_POST['id_kategori'];

$sqlData = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori= $id_kategori");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = ['id_kategori' => $getData['id_kategori'], 'kategori'=> $getData['nama_kategori']];
	echo json_encode($data);
}