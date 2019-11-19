<?php 
require 'controller/config/connection.php';
include 'librarys/functionFilter.php';

$id_permintaan_linen = $_POST['id_permintaan_linen'];
$jumlah = filterString($_POST['jumlah_linen']);
$keterangan = trim(strtolower(filterString($_POST['keterangan'])));

	$insertLinenPengajuan = mysqli_query($conn, "INSERT INTO `penerimaan_linen_baru`(`id_permintaan_linen_baru`, `jml_diterima`,`keterangan`) VALUES ($id_permintaan_linen, $jumlah, '$keterangan')");

	//mengambil id terakhir dari table penerimaan linen 
	$lastId = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
	while ($d = mysqli_fetch_array($lastId)) {
		$id = $d[0];
	}

	if ($insertLinenPengajuan) {
		/*update ke table linen jika ada data yang cocok
		get date linen dari permintaan linen baru */
		$sqlLinen = mysqli_query($conn, "SELECT `nama_linen_baru`, `id_ruang`, `id_kelas`, `id_kategori` FROM `permintaan_linen_baru` WHERE `id_permintaan_linen_baru` = $id_permintaan_linen");
		if (mysqli_num_rows($sqlLinen) > 0) {
			$dataLinen   = mysqli_fetch_assoc($sqlLinen);
			$nama_linen  = $dataLinen['nama_linen_baru'];
			$id_ruang 	 = $dataLinen['id_ruang'];
			$id_kelas 	 = $dataLinen['id_kelas'];
			$id_kategori = $dataLinen['id_kategori'];
		}else{
			$nama_linen  = $_POST['nama_linen'];
			$id_ruang	 = $_POST['id_ruang'];
			$id_kelas 	 = $_POST['id_kelas'];
			$id_kategori = $_POST['id_kategori'];
		}

		//get jumlah linen actual
		$sqlTotalLinen = mysqli_query($conn, "SELECT jml_linen FROM linen WHERE `nama_linen` = '$nama_linen' AND `id_ruang` = $id_ruang AND `id_kelas` = $id_kelas AND `id_kategori` = $id_kategori");
		if (mysqli_num_rows($sqlTotalLinen) > 0) {
			$getTotalLinen = mysqli_fetch_assoc($sqlTotalLinen);
			//tambahkan jumlah linen aktual dengan jumalah penerimaan linen baru
			$jumlahTotal = $getTotalLinen['jml_linen'] + $jumlah;

			//proses update jumlah linen
			$updateLinen = mysqli_query($conn, "UPDATE `linen` SET `id_penerimaan_linen_baru`=$id, `jml_linen`=$jumlahTotal WHERE `nama_linen` = '$nama_linen' AND `id_ruang` = $id_ruang AND `id_kelas` = $id_kelas AND `id_kategori` = $id_kategori");
			if ($updateLinen) {
				//update permintaan
				$sqlUpdatePermintaan = mysqli_query($conn, "UPDATE permintaan_linen_baru SET status = 'diterima' WHERE id_permintaan_linen_baru = $id_permintaan_linen");
				if ($sqlUpdatePermintaan) {
					header('location:'.$base_url.'perawat/penerimaan/linen/?message_success');
				}else{
					header('location:'.$base_url.'perawat/penerimaan/linen/?message_failed');
				}
				
			}else{
				header('location:'.$base_url.'perawat/penerimaan/linen/?message_failed');
			}
		}else{
			//insert data baru jika tidak ada data yang sesuai dengan linen yang diterima
			$insertLinenBaru = mysqli_query($conn, "INSERT INTO `linen`(`nama_linen`, `id_ruang`, `id_kelas`, `id_penerimaan_linen_baru`, `id_kategori`, `jml_linen`) VALUES ('$nama_linen',$id_ruang,$id_kelas,$id,$id_kategori,$jumlah)");
			if ($insertLinenBaru) {
				//update permintaan
				$sqlUpdatePermintaan = mysqli_query($conn, "UPDATE permintaan_linen_baru SET status = 'diterima' WHERE id_permintaan_linen_baru = $id_permintaan_linen");
				if ($sqlUpdatePermintaan) {
					header('location:'.$base_url.'perawat/penerimaan/linen/?message_success');
				}else{
					header('location:'.$base_url.'perawat/penerimaan/linen/?message_failed');
				}
			}else{
				header('location:'.$base_url.'perawat/penerimaan/linen/?message_failed');
			}

		}
	
	}else{
		header('location:'.$base_url.'perawat/penerimaan/linen/?message_failed'.mysqli_error($conn));
	}
