<?php 

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (!empty($_POST['id_linen'])) {
	$id_linen       = $_POST['id_linen'];
    $nama_linen     = trim(strtolower(filterString($_POST['linen'])));
    $id_ruang       = $_POST['ruang'];
    $id_kelas       = $_POST['kelas'];
    $id_kategori    = $_POST['kategori'];
    $jumlah         = $_POST['jumlah_linen'];

    //untuk mengecek ada user yang sama tidak
    $sql_cek_linen  = mysqli_query($conn, "SELECT `id_linen`, `nama_linen` FROM `linen` WHERE nama_linen = '$nama_linen'");
    $data_linen     = mysqli_fetch_assoc($sql_cek_linen);
    $rows_cek_linen = mysqli_num_rows($sql_cek_linen);

    if ($nama_linen !== $data_linen['nama_linen'] && $rows_cek_linen > 0) {
        header('location:' . $base_url . 'admin/linen/list/?message_failed');
    } else {
        $update_linen = $conn->prepare("UPDATE `linen` SET `nama_linen`=?,`id_ruang`=?,`id_kelas`=?,`id_kategori`=?,`jml_linen`=? WHERE `id_linen` =?");
        $update_linen->bind_param('ssssss', $nama_linen, $id_ruang, $id_kelas, $id_kategori, $jumlah, $id_linen);
        if ($update_linen->execute()) {
            $update_linen->close();
            header('location:' . $base_url . 'admin/linen/list/?message_success');
        } else {
            header('location:' . $base_url . 'admin/linen/list/?message_failed');
        }
    }
}else{
	header('location:' . $base_url . 'admin/linen/list/?message_failed');
}

 ?>