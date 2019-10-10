<?php

require 'controller/config/connection.php';

$id_linen = $_POST['id_linen'];

$sql_delete = mysqli_query($conn, "DELETE FROM `linen` WHERE id_linen = $id_linen");
if ($sql_delete) {
	http_response_code(200);
}else{
	http_response_code(404);
}