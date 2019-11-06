<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 'punten') {
    if (isset($_SESSION['role']) && $_SESSION['role'] == '2') {

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
                <h2>DASHBOARD ADMIN</h2>
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
            $sqlLinen = mysqli_query($conn, "SELECT id_linen FROM linen  WHERE 1 ");
            $totalLinen = mysqli_num_rows($sqlLinen);

            //linen dicuci
            $sqlUsers = mysqli_query($conn, "SELECT `id_user` FROM `user` WHERE 1");
            $totalUsers = mysqli_num_rows($sqlUsers);

            $sqlRuang = mysqli_query($conn, "SELECT `id_ruang` FROM `ruang` WHERE 1");
            $totalRuang = mysqli_num_rows($sqlRuang);

            $sqlKelas = mysqli_query($conn, "SELECT `id_kelas` FROM kelas WHERE 1");
            $totalKelas = mysqli_num_rows($sqlKelas);

            $sqlPerlengkapan = mysqli_query($conn, "SELECT id_perlengkapan FROM perlengkapan WHERE 1");
            $totalPerlengkapan = mysqli_num_rows($sqlPerlengkapan);
             ?>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">menu</i>
                        </div>
                        <div class="content">
                            <div class="text">DATA LINEN</div>
                            <div class="number"><?=$totalLinen?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">PENGGUNA</div>
                            <div class="number"><?=$totalUsers?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-gray hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">location_city</i>
                        </div>
                        <div class="content">
                            <div class="text">RUANG & KELAS</div>
                            <div class="number"><?=$totalRuang.' & '.$totalKelas?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">beenhere</i>
                        </div>
                        <div class="content">
                            <div class="text">PERLENGKAPAN</div>
                            <div class="number"><?=$totalPerlengkapan?></div>
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