<?php 
require 'controller/config/connection.php';

$id_perlengkapan = $_POST['id_perlengkapan'];

$sqlData = mysqli_query($conn, "SELECT * FROM perlengkapan WHERE id_perlengkapan= $id_perlengkapan");
$getData = mysqli_fetch_assoc($sqlData);
if ($getData) {
	$data = ['id_perlengkapan' => $getData['id_perlengkapan'], 'perlengkapan'=> $getData['nama_perlengkapan'], 'jenis' => $getData['jenis'], 'manfaat'=>$getData['manfaat'], 'jumlah' => $getData['jumlah']];
	echo json_encode($data);
}