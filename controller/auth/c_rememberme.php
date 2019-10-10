<?php 

require 'controller/config/connection.php';

if (isset($_COOKIE['cookie_username'])) {
	$username = $_COOKIE['cookie_username'];
    $sqlDataUser = mysqli_query($conn, "SELECT `id_user`, `nama_user`, `username`, `email`,`password`,`user`.`id_level`, `level`.`nama_level` FROM `user` JOIN `level` ON level.id_level=user.id_level WHERE `username` = '$username'");
    $getDataUser = mysqli_fetch_assoc($sqlDataUser);

    if ($_COOKIE['cookie_username'] == $getDataUser['username'] && $_COOKIE['cookie_password'] == $getDataUser['password']) {
        session_start();
        $_SESSION['login']      = 'punten';
        $_SESSION['role']       = $getDataUser['id_level'];
        $_SESSION['username']   = $getDataUser['username'];
        $_SESSION['id_user']    = $getDataUser['id_user'];
        $_SESSION['jabatan']    = $getDataUser['nama_level'];
        $_SESSION['nama_user']  = $getDataUser['nama_user'];

        if ($getDataUser['id_level'] == '2') {
            header('location:' . $base_url . 'admin/dashboard/');
        }elseif ($getDataUser['id_level'] == '3') {
            header('location:' . $base_url . 'laundry/');
        }
    }

}
 ?>