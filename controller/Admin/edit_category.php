<?php 

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (!empty($_POST['id_kategori'])) {
	$id_kategori 	= $_POST['id_kategori'];
    $nama_kategori      = trim(filterString($_POST['kategori']));

    //untuk mengecek ada kategori yang sama tidak
    $sql_cek_kategori  = mysqli_query($conn, "SELECT `id_kategori`, `nama_kategori` FROM `kategori` WHERE nama_kategori = '$nama_kategori'");
    $data_kategori     = mysqli_fetch_assoc($sql_cek_kategori);
    $rows_cek_kategori = mysqli_num_rows($sql_cek_kategori);

    if ($nama_kategori !== $data_kategori['nama_kategori'] && $rows_cek_kategori > 0) {
        header('location:' . $base_url . 'admin/kategori/?message_failed');
    } else {
        $insert_new_kategori = $conn->prepare("UPDATE `kategori` SET `nama_kategori`=? WHERE id_kategori=?");
        $insert_new_kategori->bind_param('ss', $nama_kategori, $id_kategori);
        if ($insert_new_kategori->execute()) {
            $insert_new_kategori->close();
            header('location:' . $base_url . 'admin/linen/kategori/?message_success=Data Kategori Berhasil Diedit!.');
        } else {
            header('location:' . $base_url . 'admin/linen/kategori/?message_failed=Data Kategori Gagal Diedit!.');
        }
    }
}else{
	header('location:' . $base_url . 'admin/linen/kategori/?message_failed');
}

 ?>
