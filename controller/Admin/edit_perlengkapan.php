<?php 

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (!empty($_POST['id_perlengkapan'])) {
	$id_perlengkapan       = $_POST['id_perlengkapan'];
    $nama_perlengkapan     = trim(strtolower(filterString($_POST['nama_perlengkapan'])));
    $jenis      = $_POST['jenis'];
    $manfaat      = $_POST['manfaat'];

    //untuk mengecek ada perlengkapan yg sama atau tidak
    $sql_cek_perlengkapan  = mysqli_query($conn, "SELECT `nama_perlengkapan` FROM `perlengkapan` WHERE nama_perlengkapan = '$nama_perlengkapan'");
    $data_perlengkapan     = mysqli_fetch_assoc($sql_cek_perlengkapan);
    $rows_cek_perlengkapan = mysqli_num_rows($sql_cek_perlengkapan);

    if ($nama_perlengkapan !== $data_perlengkapan['nama_perlengkapan'] && $rows_cek_perlengkapan > 0) {
        header('location:' . $base_url . 'admin/perlengkapan/?message_failed');
    } else {
        $update_perlengkapan = $conn->prepare("UPDATE `perlengkapan` SET `nama_perlengkapan`=?, `jenis`=?, `manfaat`=? WHERE `id_perlengkapan` =?");
        $update_perlengkapan->bind_param('ssss', $nama_perlengkapan, $jenis, $manfaat, $id_perlengkapan);
        if ($update_perlengkapan->execute()) {
            $update_perlengkapan->close();
            header('location:' . $base_url . 'admin/perlengkapan/?message_success=Data Berhasil Diedit');
        } else {
            header('location:' . $base_url . 'admin/perlengkapan/?message_failed');
        }
    }
}else{
	header('location:' . $base_url . 'admin/perlengkapan/?message_failed');
}

 ?>