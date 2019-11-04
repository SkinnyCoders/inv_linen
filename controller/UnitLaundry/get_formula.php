<?php 
require 'controller/config/connection.php';

$jenis = $_POST['id_ruang'];

$getFormula = mysqli_query($conn, "SELECT `id_formula`, `nama_formula` FROM `formula_perlengkapan` WHERE `jenis_formula` = '$jenis'");

if (mysqli_num_rows($getFormula) > 0) {
	while ($formula = mysqli_fetch_assoc($getFormula)) {
		$data[] = ['id_formula' => $formula['id_formula'], 'nama_formula' => $formula['nama_formula']];
	}

	echo json_encode($data);
}else{
	$data = [];
	echo json_encode($data);
}

 ?>