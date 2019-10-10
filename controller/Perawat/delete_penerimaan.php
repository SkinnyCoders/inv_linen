<?php 

require 'controller/config/connection.php';

$id_penerimaan = $_POST['id_penerimaan'];

if (!empty($id_penerimaan)) {
	$deleteLinen = mysqli_query($conn, "DELETE FROM linen WHERE id_penerimaan_linen_baru = $id_penerimaan");

	if ($deleteLinen) {
		$delete = mysqli_query($conn, "DELETE FROM `penerimaan_linen_baru` WHERE `id_penerimaan_linen_baru` = $id_penerimaan");
		if ($delete) {
			http_response_code(200);
		}else{
			http_response_code(404);
		}
	}
}

 ?>