<?php 

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (!empty($_POST['id_ruang'])) {
	$id_ruang 	= $_POST['id_ruang'];
    $ruang     = trim(filterString($_POST['ruang']));

    //untuk mengecek ada user yang sama tidak
    $sql_cek_ruang  = mysqli_query($conn, "SELECT `id_ruang`, `nama_ruang` FROM `ruang` WHERE nama_ruang = '$ruang'");
    $data_ruang    = mysqli_fetch_assoc($sql_cek_ruang);
    $rows_cek_ruang = mysqli_num_rows($sql_cek_ruang);

    if ($ruang !== $data_ruang['nama_ruang'] && $rows_cek_ruang > 0) {
        header('location:' . $base_url . 'admin/ruang_kelas/?message_failed');
    } else {
        $insert_new_ruang = $conn->prepare("UPDATE `ruang` SET `nama_ruang`=? WHERE id_ruang=?");
        $insert_new_ruang->bind_param('ss', $ruang, $id_ruang);
        if ($insert_new_ruang->execute()) {
            $insert_new_ruang->close();
            header('location:' . $base_url . 'admin/ruang_kelas/?message_success=Data Ruang Berhasil Diedit!.');
        } else {
            header('location:' . $base_url . 'admin/ruang_kelas/?message_failed=Data Ruang Gagal Diedit!.');
        }
    }
}else{
	header('location:' . $base_url . 'admin/ruang_kelas/?message_failed');
}

 ?>