<?php 
require 'controller/config/connection.php';

$jenis = $_POST['id_ruang'];

$getFormula = mysqli_query($conn, "SELECT formula_perlengkapan.`id_formula`, `nama_formula` FROM `formula_perlengkapan` INNER JOIN takaran_formula ON takaran_formula.id_formula=formula_perlengkapan.id_formula WHERE `jenis_formula` = '$jenis' GROUP BY formula_perlengkapan.id_formula");

if (mysqli_num_rows($getFormula) > 0) {
	while ($formula = mysqli_fetch_assoc($getFormula)) {
		//get komposisi
		$id_formulaa = $formula['id_formula'];
        
        $sqlKomposisi = mysqli_query($conn, "SELECT GROUP_CONCAT(perlengkapan.nama_perlengkapan) AS perlengkapan, GROUP_CONCAT(takaran_formula.jumlah) AS jumlah FROM `takaran_formula` INNER JOIN perlengkapan ON perlengkapan.id_perlengkapan=takaran_formula.id_perlengkapan WHERE id_formula = $id_formulaa");
        $komposisi = [];
    	$total = mysqli_num_rows($sqlKomposisi);
    	while ($data_komposisi = mysqli_fetch_assoc($sqlKomposisi)) {
    		$komposisi[] = $data_komposisi;
    	};	
    	
		$data[] = ['id_formula' => $formula['id_formula'], 'nama_formula' => $formula['nama_formula'], 'komposisi' => $komposisi];
	}

	echo json_encode($data);
}else{
	$data = [];
	echo json_encode($data);
}

 ?>