<?php

require 'controller/config/connection.php';

$id_formula = $_POST['id_formula'];

$sql_delete = mysqli_query($conn, "DELETE FROM `formula_perlengkapan` WHERE id_formula = $id_formula");
if ($sql_delete) {
	http_response_code(200);
}else{
	http_response_code(404);
}