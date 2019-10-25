<?php 

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (!empty($_POST['id_kelas'])) {
	$id_kelas 	= $_POST['id_kelas'];
    $kelas      = trim(filterString($_POST['kelas']));

    //untuk mengecek ada user yang sama tidak
    $sql_cek_kelas  = mysqli_query($conn, "SELECT `id_kelas`, `nama_kelas` FROM `kelas` WHERE nama_kelas = '$kelas'");
    $data_kelas     = mysqli_fetch_assoc($sql_cek_user);
    $rows_cek_kelas = mysqli_num_rows($sql_cek_user);

    if ($kelas !== $data_kelas['nama_kelas'] && $rows_cek_kelas > 0) {
        header('location:' . $base_url . 'admin/ruang_kelas/?message_failed');
    } else {
        $insert_new_kelas = $conn->prepare("UPDATE `kelas` SET `nama_kelas`=? WHERE id_kelas=?");
        $insert_new_kelas->bind_param('ss', $kelas, $id_kelas);
        if ($insert_new_kelas->execute()) {
            $insert_new_kelas->close();
            header('location:' . $base_url . 'admin/ruang_kelas/?message_success=Data Kelas Berhasil Diedit!.');
        } else {
            header('location:' . $base_url . 'admin/ruang_kelas/?message_failed=Data Kelas Gagal Diedit!.');
        }
    }
}else{
	header('location:' . $base_url . 'admin/ruang_kelas/?message_failed');
}

 ?>