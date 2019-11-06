<?php 

require 'controller/config/connection.php';

$id_penerimaan = $_GET['id'];

if (!empty($id_permintaan)) {
	$delete = mysqli_query($conn, "DELETE FROM `penerimaan_perlengkapan` WHERE `id_penerimaan_perlengkapan` = $id_penerimaan");
	if ($delete) {
		http_response_code(200);
	}else{
		http_response_code(404);
	}
}

 ?>