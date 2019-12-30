<?php 
require 'controller/config/connection.php';

$bulan = date('m')+1;

if (isset($_POST['type']) && $_POST['type'] == 'bar') {
	for ($i=0; $i <=2 ; $i++) { 
		
		$bulan = $bulan -1;

		$sqlPerlengkapan = mysqli_query($conn, "SELECT perlengkapan.nama_perlengkapan, SUM(jml_penggunaan) AS jumlah FROM `penggunaan_perlengkapan` JOIN jumlah_proses_pencucian ON jumlah_proses_pencucian.id_jumlah_proses_pencucian=penggunaan_perlengkapan.id_jumlah_proses_pencucian INNER JOIN perlengkapan ON perlengkapan.id_perlengkapan=penggunaan_perlengkapan.id_perlengkapan WHERE MONTH(jumlah_proses_pencucian.tanggal_cuci) = $bulan GROUP BY perlengkapan.id_perlengkapan");

			$flag = mysqli_num_rows($sqlPerlengkapan);
			

			while ($dataAda = mysqli_fetch_assoc($sqlPerlengkapan)) {
				$namaPerlengkapan[] = $dataAda['nama_perlengkapan'];
				$jumlah[] = $dataAda['jumlah'];

			}
		
			if ($flag > 0) {
				for ($j=0; $j < count($jumlah) ; $j++) { 
					$total[] = $jumlah[$j];
				}
				
			}else{
				for ($j=0; $j < count($jumlah) ; $j++) { 
					$total[] = 0;
				}
			}
	} 

	for($k=0;$k<count($namaPerlengkapan); $k++){

		$dataset[] =
				[
					'label' => $namaPerlengkapan[$k],
					'data' => [10,20,30],
					'backgroundColor' => 'rgba(233, 30, 99, 0.8)'
				];
	}
	

		$dataFix = [
				'labels' => ['Januari', 'Februari', 'Maret'],
				'datasets' => $dataset
				
		];

		echo json_encode($dataFix);

}

// 	{
//                         labels: ["Januari","Februari", "Maret"],
//                         datasets: [{
//                             label: "data 1",
//                             data: [100, 30,70],
//                             backgroundColor: 'rgba(233, 30, 99, 0.8)'
//                         }, {
//                             label: "data 2",
//                             data: [28, 40, 50],
//                             backgroundColor: 'rgb(139, 195, 74)'
//                         },{
//                             label: "data 3",
//                             data: [90,60,70],
//                             backgroundColor: 'rgba(0, 188, 212, 0.8)'
//                         },{
//                             label: "data 4",
//                             data: [50,70,30],
//                             backgroundColor: 'rgb(255, 193, 7)'
//                         }
//                             ]
//                     }
// }
 ?>