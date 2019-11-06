<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$id_permintaan = $_POST['id_permintaan_perlengkapan'];
$jumlah = filterString($_POST['jumlah_perlengkapan']);
$penerima = $_POST['id_penerima'];

	$insertLinenPenerimaan = mysqli_query($conn, "INSERT INTO `penerimaan_perlengkapan`(`id_permintaan_perlengkapan`, `jml_diterima`,`id_penerima`,`status`) VALUES ($id_permintaan, $jumlah,$penerima,'diterima')");
	if ($insertLinenPenerimaan) {
		header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_success');
	}else{
		header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_failed'.mysqli_error($conn));
	}
