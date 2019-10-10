<?php

require 'controller/config/connection.php';

$id_linen_kotor = $_POST['id_linen_kotor'];

$sql_delete = mysqli_query($conn, "DELETE FROM `linen_kotor` WHERE id_linen_kotor = $id_linen_kotor");
if ($sql_delete) {
	http_response_code(200);
}else{
	http_response_code(404);
}