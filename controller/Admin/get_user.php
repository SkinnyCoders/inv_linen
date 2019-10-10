<?php 
require 'controller/config/connection.php';

$id_user = $_POST['id_user'];

//ambil data user
$sql_user = mysqli_query($conn, "SELECT * FROM user WHERE id_user=$id_user");
$data_user = mysqli_fetch_assoc($sql_user);
$data = [
		'id_user' => $data_user['id_user'],
		'nama' => $data_user['nama_user'],
		'username' => $data_user['username'],
		'email' => $data_user['email'],
		'id_level' => $data_user['id_level'],
		'gender' => $data_user['jenis_kel']
		];
if (mysqli_num_rows($sql_user) > 0) {
	echo json_encode($data);
}

 ?>