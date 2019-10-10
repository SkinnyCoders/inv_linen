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
                <h2>PENGGUNA</h2>
                <ol class="breadcrumb align-right">
                    <li><a href="javascript:void(0);">Dashboard</a></li>
                    <li><a href="<?= $base_url ?>admin/user/list/">User</a></li>
                    <li class="active">Tambah User</li>
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>TAMBAH PENGGUNA BARU</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" action="<?php echo $base_url ?>controller/admin/user/add_new/" method="POST">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="surename" required>
                                        <label class="form-label">Name Lengkap</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="username" required>
                                        <label class="form-label">Username</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="gender" id="male" value="L" class="with-gap">
                                    <label for="male">Laki - Laki</label>

                                    <input type="radio" name="gender" id="female" value="P" class="with-gap">
                                    <label for="female" class="m-l-20">Perempuan</label>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" min="6" class="form-control" name="password" required>
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" min="6" class="form-control" name="password2" required>
                                        <label class="form-label">Ulangi Password</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control show-tick m-t-20" name="as_user" id="as_user">
                                            <option value="1">Kepala Unit</option>
                                            <option value="2" selected>Admin</option>
                                            <option value="3">Petugas Laundry</option>
                                            <option value="4">Perawat</option>
                                        </select>
                                        <label for="as_user" class="form-label">Tambahkan pengguna sebagai</label>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="agree">
                                    <label for="checkbox">Data diatas benar dan dapat dipertanggung jawabkan</label>
                                </div> -->
                                <button class="btn btn-primary waves-effect" name="add_user" type="submit">SIMPAN</button>
                            </form>
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