<?php 

require 'controller/config/connection.php';

$id_permintaan = $_POST['id_permintaan'];

if (!empty($id_permintaan)) {
	$delete = mysqli_query($conn, "DELETE FROM `permintaan_linen_baru` WHERE `id_permintaan_linen_baru` = $id_permintaan");
	if ($delete) {
		http_response_code(200);
	}else{
		http_response_code(404);
	}
}

 ?>