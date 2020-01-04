<?php

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (isset($_POST['add_user'])) {
    $full_name  = filterString($_POST['surename']);
    $user_name  = trim(strtolower(filterString($_POST['username'])));
    $email      = filterString($_POST['email']);
    $password   = mysqli_real_escape_string($conn, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($conn, $_POST['password2']);
    $gender     = $_POST['gender'];
    $as_user    = $_POST['as_user'];

    //untuk mengecek ada user yang sama tidak
    $sql_cek_user = mysqli_query($conn, "SELECT id_user FROM `user` WHERE email = '$email' OR username = '$user_name'");
    $rows_cek_user = mysqli_num_rows($sql_cek_user);

    if ($rows_cek_user > 0) {
        header('location:' . $base_url . 'admin/user/tambah/?message_failed=Maaf, Data Pengguna Gagal Ditambahkan!. Harap periksa lagi informasi yang diinputkan!');
    } else {
        if ($password !== $password_confirm) {
            header('location:' . $base_url . 'admin/user/tambah/?message_failed=Maaf, Data Pengguna Gagal Ditambahkan!. Harap periksa lagi informasi yang diinputkan!');
        } else {
            //encrypt password
            $encypt_password = password_hash($password, PASSWORD_DEFAULT);
            //insert data ke table user
            $insert_new_user = $conn->prepare("INSERT INTO `user`(`nama_user`, `username`, `email`, `password`, `id_level`, `jenis_kel`) VALUES (?,?,?,?,?,?)");
            $insert_new_user->bind_param('ssssss', $full_name, $user_name, $email, $encypt_password, $as_user, $gender);
            if ($insert_new_user->execute()) {
                $id_user = $insert_new_user->insert_id;
                $insert_new_user->close();

                if (isset($_POST['ruang']) && !empty($_POST['ruang'])) {
                    $id_ruang = $_POST['ruang'];
                    
                    $sqlInsertRuang = mysqli_query($conn, "INSERT INTO `perawat_ruang`(`id_perawat`, `id_ruang`) VALUES ($id_user, $id_ruang)");
                    if ($sqlInsertRuang) {
                        header('location:' . $base_url . 'admin/user/list/?message_success=Selamat, Data Pengguna Berhasil Ditambahkan!.');
                    }else{
                        header('location:' . $base_url . 'admin/user/list/?message_failed=Maaf, Data Pengguna gagal Ditambahkan!.');
                    }
                }
                header('location:' . $base_url . 'admin/user/list/?message_success=Selamat, Data Pengguna Berhasil Ditambahkan!.');
            } else {
                header('location:' . $base_url . 'admin/user/tambah/?message_failed=Maaf, Data Pengguna Gagal Ditambahkan!. Harap periksa lagi informasi yang diinputkan!.');
            }
        }
    }
}
