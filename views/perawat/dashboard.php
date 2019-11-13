<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 'punten') {
    if (isset($_SESSION['role']) && $_SESSION['role'] == '4') {

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
                <h2>PERAWAT</h2>
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
            //get permintaan linen
            $sqlPermintaan = mysqli_query($conn, "SELECT `id_permintaan_linen_baru` FROM `permintaan_linen_baru` WHERE 1");
            $totalPermintaan = mysqli_num_rows($sqlPermintaan);

            //get penerimaan linen
            $sqlPenerimaan = mysqli_query($conn, "SELECT `id_penerimaan_linen_baru` FROM `penerimaan_linen_baru` WHERE 1");
            $totalPenerimaan = mysqli_num_rows($sqlPenerimaan);

             ?>


            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">pan_tool</i>
                        </div>
                        <div class="content">
                            <div class="text">PERMINTAAN LINEN</div>
                            <div class="number"><?=$totalPermintaan?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">cached</i>
                        </div>
                        <div class="content">
                            <div class="text">PENERIMAAN LINEN</div>
                            <div class="number"><?=$totalPenerimaan?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-gray hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">watch_later</i>
                        </div>
                        <div class="content">
                            <div class="text">LINEN BERSIH</div>
                            <div class="number">20</div>
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