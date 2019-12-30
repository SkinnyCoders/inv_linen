<?php 

require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

if (!empty($_POST['id_linen'])) {
	$id_linen       = $_POST['id_linen'];
    $jumlah         = $_POST['jumlah_linen'];
    $jenis_linen    = $_POST['jenis_update'];

    //sql update linen kotor
    $sqlUpdate = mysqli_query($conn, "UPDATE `linen_kotor` SET `jml_linen_kotor`=$jumlah,`jenis_linen_kotor`='$jenis_linen' WHERE `id_linen_kotor` = $id_linen");
    if ($sqlUpdate) {
        header('location:'.$base_url.'laundry/linen-kotor/?message_success=Selamat, data linen kotor berhasil diedit!!!');
    }else{
        header('location:'.$base_url.'laundry/linen-kotor/?message_failed=Maaf, data linen kotor gagal diedit!!!');
    }
}

 ?>