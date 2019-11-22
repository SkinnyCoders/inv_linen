<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$nama_perlengkapan = $_POST['perlengkapan_baru'];
array_pop($nama_perlengkapan);
$diajukan = filterString($_POST['diajukan']);

$no = 0;

foreach ($nama_perlengkapan as $perlengkapan) {
	$jumlah = $_POST['jumlah'][$no];
	$keterangan = $_POST['keterangan'][$no];
	
	//query insert perlengkapan
	$insertLinenPengajuan = mysqli_query($conn, "INSERT INTO `permintaan_perlengkapan`(`nama_perlengkapan`, `id_user`,`jml_permintaan`,`keterangan`) VALUES ('$perlengkapan','$diajukan', '$jumlah', '$keterangan')");
	
	$no++;
}

if ($insertLinenPengajuan) {
	header('location:'.$base_url.'laundry/permintaan/perlengkapan/?message_success');
}else{
	header('location:'.$base_url.'laundry/permintaan/perlengkapan/?message_failed'.mysqli_error($conn));
}
	
