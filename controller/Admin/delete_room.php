<?php

require 'controller/config/connection.php';

if (@$_POST) {
	$id_ruang = $_POST['id'];

	$delete_user = $conn->prepare("DELETE FROM `ruang` WHERE `id_ruang` =?");
	$delete_user->bind_param('s', $id_ruang);
	if($delete_user->execute()){
	    $delete_user->close();
	    http_response_code(200);
	}else{
	    http_response_code(404);
	}
}