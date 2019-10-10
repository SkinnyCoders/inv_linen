<?php

require 'controller/config/connection.php';

$id_user = $_POST['id_user'];

$delete_user = $conn->prepare("DELETE FROM `user` WHERE `id_user` =?");
$delete_user->bind_param('s', $id_user);
if($delete_user->execute()){
    $delete_user->close();
    http_response_code(200);
}else{
    http_response_code(404);
}