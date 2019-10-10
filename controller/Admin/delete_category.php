<?php 

require 'controller/config/connection.php';

$id_kategori = $_POST['id_kategori'];

if (!empty($id_kategori)) {
	$delete = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id_kategori");
	if ($delete) {
		http_response_code(200);
	}else{
		http_response_code(404);
	}
}

 ?>