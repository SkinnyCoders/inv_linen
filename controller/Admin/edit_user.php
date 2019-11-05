<?php 

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (!empty($_POST['gender'])) {
	$id_user 	= $_POST['id_user'];
	$full_name  = filterString($_POST['surename']);
    $user_name  = trim(strtolower(filterString($_POST['username'])));
    $email      = filterString($_POST['email']);
    $gender     = $_POST['gender'];
    $as_user    = $_POST['as_user'];

    //untuk mengecek ada user yang sama tidak
    $sql_cek_user = mysqli_query($conn, "SELECT `id_user`, `username` FROM `user` WHERE username = '$user_name'");
    $data_user = mysqli_fetch_assoc($sql_cek_user);
    $rows_cek_user = mysqli_num_rows($sql_cek_user);

    if ($user_name !== $data_user['username'] && $rows_cek_user > 0) {
        header('location:' . $base_url . 'admin/user/list/?message_failed');
    } else {
        $insert_new_user = $conn->prepare("UPDATE `user` SET `nama_user`=?,`username`=?,`email`=?,`id_level`=?,`jenis_kel`=? WHERE id_user=?");
        $insert_new_user->bind_param('ssssss', $full_name, $user_name, $email, $as_user, $gender, $id_user);
        if ($insert_new_user->execute()) {
            $insert_new_user->close();
            header('location:' . $base_url . 'admin/user/list/?message_success=Data Pengguna Berhasi Diedit!.');
        } else {
            header('location:' . $base_url . 'admin/user/list/?message_failed=Data Pengguna Gagal Diedit!.');
        }
    }
}else{
	header('location:' . $base_url . 'admin/user/list/?message_failed');
}

 ?>