<?php

require 'controller/config/connection.php';

$id_kelas = $_POST['id_kelas'];

$delete_user = $conn->prepare("DELETE FROM `kelas` WHERE `id_kelas` =?");
$delete_user->bind_param('s', $id_kelas);
if($delete_user->execute()){
    $delete_user->close();
    http_response_code(200);
}else{
    http_response_code(404);
}