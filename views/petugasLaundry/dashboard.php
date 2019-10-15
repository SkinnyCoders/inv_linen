<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 'punten') {
    if (isset($_SESSION['role']) && $_SESSION['role'] == '3') {
        date_default_timezone_set('Asia/Jakarta');
        include_once 'views/templates/head.php';
        require 'controller/config/connection.php';
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama_user'];
        $tanggal = date('Y-m-d');
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
                <h2>UNIT LAUNDRY</h2>
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
            <!-- Basic Validation -->
            <?php 
            //ambil data linen
            //linen kotor
            $sqlLinenKotor = mysqli_query($conn, "SELECT id_linen_kotor FROM linen_kotor  WHERE `status` = 'kotor' AND DATE(tgl_pengambilan) = '$tanggal'");
            $totalKotor = mysqli_num_rows($sqlLinenKotor);

            //linen dicuci
            $sqlCuci = mysqli_query($conn, "SELECT `id_pencucian` FROM `pencucian` WHERE DATE(`tgl_cuci`) = '$tanggal' AND `status` = 'cuci'");
            $totalCuci = mysqli_num_rows($sqlCuci);

            $sqlProses = mysqli_query($conn, "SELECT `id_jumlah_proses_pencucian` FROM `jumlah_proses_pencucian` WHERE DATE(`tanggal_cuci`) = '$tanggal' GROUP BY `id_proses_cuci`");
            $totalProses = mysqli_num_rows($sqlProses);

            $sqlBersih = mysqli_query($conn, "SELECT `id_linen_bersih` FROM linen_bersih WHERE DATE(`tgl`) = '$tanggal' AND `status` = 'bersih'");
            $totalBersih = mysqli_num_rows($sqlBersih);
             ?>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">pan_tool</i>
                        </div>
                        <div class="content">
                            <div class="text">LINEN KOTOR</div>
                            <div class="number"><?=$totalKotor?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">cached</i>
                        </div>
                        <div class="content">
                            <div class="text">LINEN DICUCI</div>
                            <div class="number"><?=$totalCuci?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-gray hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">watch_later</i>
                        </div>
                        <div class="content">
                            <div class="text">PROSES CUCI</div>
                            <div class="number"><?=$totalProses?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">turned_in</i>
                        </div>
                        <div class="content">
                            <div class="text">LINEN BERSIH</div>
                            <div class="number"><?=$totalBersih?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>

    <?php include_once 'views/templates/footer.php' ?>

    <?php
    } else {
        header('location:' . $base_url . 'logout/?a=tidak sah');
    }
} else {
    header('location:' . $base_url . 'logout/?a=belum login');
}
?>