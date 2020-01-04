<?php

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (isset($_POST['auth'])) {
    $username = strtolower(filterString($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $rememberme = isset($_POST['rememberme'])?$_POST['rememberme']:'';
    date_default_timezone_set('Asia/Jakarta');

    //cek apakah ada username yg diinputkan
    $sql_data_user = mysqli_query($conn, "SELECT `id_user`, `nama_user`, `username`, `email`,`password`,`user`.`id_level`, `level`.`nama_level` FROM `user` JOIN `level` ON level.id_level=user.id_level WHERE `username` = '$username' OR `email` = '$username'");
    $cek_data_user = mysqli_num_rows($sql_data_user);

    if ($cek_data_user > 0) {
        $data_user = mysqli_fetch_assoc($sql_data_user);
        //cek password
        if (password_verify($password, $data_user['password'])) {
            session_start();
            $_SESSION['login']      = 'punten';
            $_SESSION['role']       = $data_user['id_level'];
            $_SESSION['username']   = $data_user['username'];
            $_SESSION['id_user']    = $data_user['id_user'];
            $_SESSION['jabatan']    = $data_user['nama_level'];
            $_SESSION['nama_user']  = $data_user['nama_user'];

            if (!empty($rememberme)) {
                setcookie('cookie_username', $data_user['username'], time()+(60*60*24*7), '/');
                setcookie('cookie_password', $data_user['password'], time()+(60*60*24*7), '/');
            }

            if ($data_user['id_level'] == '2') {
                header('location:' . $base_url . 'admin/dashboard/');
            }elseif ($data_user['id_level'] == '3') {
                header('location:' . $base_url . 'laundry/dashboard/');
            }elseif ($data_user['id_level'] == '4') {
                //sql get id ruang
                $sqlRuang = mysqli_query($conn, "SELECT id_ruang FROM perawat_ruang WHERE id_perawat =".$data_user['id_user']);
                $dataRuang = mysqli_fetch_assoc($sqlRuang);

                $_SESSION['id_ruang'] = $dataRuang['id_ruang'];
                header('location:' . $base_url . 'perawat/dashboard/');
            }elseif ($data_user['id_level'] == '1') {
                header('location:'.$base_url.'kepala-unit/dashboard/');
            }
        } else {
            header('location:' . $base_url . 'login/?message_failed=Upss password salah');
        }
    } else {
        header('location:' . $base_url . 'login/?message_failed=Upss Username atau Email salah');
    }
}
