<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$id_permintaan = $_POST['id_permintaan_perlengkapan'];
$jumlah = filterString($_POST['jumlah_perlengkapan']);
$penerima = $_POST['id_penerima'];

//get nama perlengkapan
$sqlPermintaan = mysqli_query($conn, "SELECT `nama_perlengkapan`,`jml_permintaan` FROM `permintaan_perlengkapan` WHERE `id_permintaan_perlengkapan` = $id_permintaan");
$perlengkapan = mysqli_fetch_assoc($sqlPermintaan);
$nama_perlengkapan = $perlengkapan['nama_perlengkapan'];
$jumlah_permintaan = $perlengkapan['jml_permintaan'];

if ($jumlah > $jumlah_permintaan) {
	header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_failed=jumlah tidak boleh melebihi yang diajukan';
}else{

	$insertLinenPenerimaan = mysqli_query($conn, "INSERT INTO `penerimaan_perlengkapan`(`id_permintaan_perlengkapan`, `jml_diterima`,`id_penerima`,`status`) VALUES ($id_permintaan, $jumlah,$penerima,'diterima')");
	//mengambil id terakhir dari table penerimaan linen 
	$lastId = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
	while ($d = mysqli_fetch_array($lastId)) {
		$id = $d[0];
	}
	if ($insertLinenPenerimaan) {
		$cekPerlengkapan = mysqli_query($conn, "SELECT `nama_perlengkapan`,`jumlah` FROM `perlengkapan` WHERE `nama_perlengkapan` = '$nama_perlengkapan'");
		if (mysqli_num_rows($cekPerlengkapan) > 0) {
			//update jumlah stok
			$jumlahStok = mysqli_fetch_assoc($cekPerlengkapan);
			$jumlahStok = $jumlahStok['jumlah'];
			$jumlahAkhir = $jumlahStok+$jumlah;

			$sqlUpdateStok = mysqli_query($conn, "UPDATE `perlengkapan` SET `jumlah`=$jumlahAkhir WHERE `nama_perlengkapan` = '$nama_perlengkapan'");

			if ($sqlUpdateStok) {
				header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_success');
			}else{
				header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_failed'.mysqli_error($conn));
			}
		}else{
			$insertPerlengkapan = mysqli_query($conn, "INSERT INTO `perlengkapan`(`nama_perlengkapan`, `jenis`, `jumlah`, `id_penerima`) VALUES ('$nama_perlengkapan', 'cair', $jumlah, $id)");

			if ($insertPerlengkapan) {
				header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_success');
			}else{
				header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_failed'.mysqli_error($conn));
			}
		}
	}else{
		header('location:'.$base_url.'laundry/penerimaan/perlengkapan/?message_failed'.mysqli_error($conn));
	}
}
