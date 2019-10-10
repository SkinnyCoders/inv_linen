<?php 
require 'controller/config/connection.php';

$id_kategori = $_POST['id_kategori'];
$nama_kategori = $_POST['kategori'];

$sqlEdit = mysqli_query($conn, "UPDATE `kategori` SET `nama_kategori`='$nama_kategori' WHERE `id_kategori`=$id_kategori");
if ($sqlEdit) {
	header('location :'.$base_url.'admin/linen/kategori/?message_success');
}else{
	header('location :'.$base_url.'admin/linen/kategori/?message_failed');
}