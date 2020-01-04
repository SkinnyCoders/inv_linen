<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 'punten') {
    if (isset($_SESSION['role']) && $_SESSION['role'] == '1') {

        include_once 'views/templates/head.php';
        require 'controller/config/connection.php';
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama_user'];
        ?>

<body class="theme-blue">
    <!-- side bar -->
    <?php
    include_once 'views/templates/navbar/top_bar.php';
    include_once 'views/templates/navbar/left_side_bar.php';
    ?>
    <!-- end side bar -->

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>KEPALA UNIT</h2>
                <ol class="breadcrumb align-right">
                    <li class="active">Dashboard</li>
                </ol>
                <?php if (isset($_GET['message_success'])) { ?>
                    <!-- alert success -->
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Selamat, Data Pengguna berhasil ditambahkan!
                    </div>
                    <!-- end alert success -->
                <?php } elseif (isset($_GET['message_failed'])) { ?>
                    <!-- alert failed -->
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Maaf, Data Pengguna gagal ditambahkan!, harap periksa lagi informasi yang diinputkan!.
                    </div>
                    <!-- end alert failed -->
                <?php } ?>
            </div>

            <?php 
            $sqlLinen = mysqli_query($conn, "SELECT id_linen FROM linen WHERE 1");
            $totalLinen = mysqli_num_rows($sqlLinen);

            $sqlUser = mysqli_query($conn, "SELECT `id_user` FROM `user` WHERE 1");
            $totalUser = mysqli_num_rows($sqlUser);

            $sqlPerlengkapan = mysqli_query($conn, "SELECT id_perlengkapan FROM perlengkapan WHERE 1");
            $totalPerlengkapan = mysqli_num_rows($sqlPerlengkapan);

            //cek permintaan belum dikonfirmasi
            $sqlCekPermintaanLinen = mysqli_query($conn, "SELECT COUNT(`id_permintaan_linen_baru`) AS minta FROM `permintaan_linen_baru` WHERE `status` = 'belum'");
            $dataMintaLinen = mysqli_fetch_assoc($sqlCekPermintaanLinen);
            $dataMintaLinen = $dataMintaLinen['minta'];

            $sqlCekPermintaanPerlengkapan = mysqli_query($conn, "SELECT COUNT(`id_permintaan_perlengkapan`) AS minta FROM `permintaan_perlengkapan` WHERE `status` = 'belum'");
            $dataMintaPerlengkapan = mysqli_fetch_assoc($sqlCekPermintaanPerlengkapan);
            $dataMintaPerlengkapan = $dataMintaPerlengkapan['minta'];

             ?>
             <div class="row clearfix">
                <div class="col-md-12">
                    <?php if ($dataMintaLinen > 0) {
                        echo '<div class="alert alert-danger">
                        <strong>Ada '.$dataMintaLinen.'</strong> Permintaan Linen yang belum dikonfirmasi! <a class="btn btn-sm btn-warning" href="'.$base_url.'kepala-unit/linen/permintaan/">Lihat Disini</a>
                    </div>';
                    }
                    if($dataMintaPerlengkapan > 0){
                        echo '<div class="alert alert-danger">
                        <strong>Ada '.$dataMintaPerlengkapan.'</strong> Permintaan Perlengkapan yang belum dikonfirmasi! <a class="btn btn-sm btn-warning" href="'.$base_url.'kepala-unit/perlengkapan/permintaan/">Lihat Disini</a>
                    </div>';
                    } ?>
                    
                </div>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">pan_tool</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH LINEN</div>
                            <div class="number"><?=$totalLinen?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">cached</i>
                        </div>
                        <div class="content">
                            <div class="text">PERLENGKAPAN</div>
                            <div class="number"><?=$totalPerlengkapan?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-gray hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">watch_later</i>
                        </div>
                        <div class="content">
                            <div class="text">PENGGUNA</div>
                            <div class="number"><?=$totalUser?></div>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="row">
                <!-- Donut Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Penggunaan Perlengkapan</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="bar_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Donut Chart -->
            </div>
        
        </div>
    </section>

    <?php include_once 'views/templates/footer.php' ?>

    <?php 
    $bulan = date('m')+1;


    for ($i=0; $i <=2 ; $i++) { 
        
        $bulan = $bulan -1;

        $sqlPerlengkapan = mysqli_query($conn, "SELECT perlengkapan.nama_perlengkapan, SUM(jml_penggunaan) AS jumlah FROM `penggunaan_perlengkapan` JOIN jumlah_proses_pencucian ON jumlah_proses_pencucian.id_jumlah_proses_pencucian=penggunaan_perlengkapan.id_jumlah_proses_pencucian INNER JOIN perlengkapan ON perlengkapan.id_perlengkapan=penggunaan_perlengkapan.id_perlengkapan WHERE MONTH(jumlah_proses_pencucian.tanggal_cuci) = $bulan GROUP BY perlengkapan.id_perlengkapan");

            $flag = mysqli_num_rows($sqlPerlengkapan);
            
            if (mysqli_num_rows($sqlPerlengkapan) > 0) {
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
            }else{
                $namaPerlengkapan[] = [];
            }
            
    } 

    for($k=0;$k<count($namaPerlengkapan); $k++){

        $dataset[] =
                [
                    'label' => $namaPerlengkapan[$k],
                    'data' => [40,50,30],
                    'backgroundColor' => 'rgba(233, 30, 99, 0.8)'
                ];
    }
    

        $dataFix = [
                'labels' => ['Januari', 'Februari', 'Maret'],
                'datasets' => $dataset
                
        ];

        $dataaa = json_encode($dataFix, true);

     ?>

    <script>
        $(function () {
            new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
        });

        function getChartJs(type) {
            var config = null;
            if(type === 'bar'){
                config = {
                    type: 'bar',
                    data: <?php echo $dataaa; ?>,
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            }else if(type === 'pie'){
                config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [225, 50, 100, 40],
                            backgroundColor: [
                                "rgb(233, 30, 99)",
                                "rgb(255, 193, 7)",
                                "rgb(0, 188, 212)",
                                "rgb(139, 195, 74)"
                            ],
                        }],
                        labels: [
                            "Pink",
                            "Amber",
                            "Cyan",
                            "Light Green"
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            }
            return config;

        }
    </script>

    <?php
    } else {
        header('location:' . $base_url . 'logout/?a=tidak sah');
    }
} else {
    header('location:' . $base_url . 'logout/?a=belum login');
}
?>