<?php

require 'controller/config/connection.php';

$id_perlengkapan = $_POST['id_perlengkapan'];

$delete_perlengkapan = $conn->prepare("DELETE FROM `perlengkapan` WHERE `id_perlengkapan` =?");
$delete_perlengkapan->bind_param('s', $id_perlengkapan);
if($delete_perlengkapan->execute()){
    $delete_perlengkapan->close();
    http_response_code(200);
}else{
    http_response_code(404);
}