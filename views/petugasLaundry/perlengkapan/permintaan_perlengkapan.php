<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 'punten') {
    if (isset($_SESSION['role']) && $_SESSION['role'] == '3') {

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
                        <h2>PERMINTAAN PERLENGKAPAN</h2>
                        <ol class="breadcrumb align-right">
                            <li><a href="javascript:void(0);">Dashboard</a></li>
                            <li><a href="javascript:void(0);">Perlengkapan</a></li>
                            <li class="active">Permintaan Perlangkapan</li>
                        </ol>
                        <?php if (isset($_GET['message_success'])) { ?>
                            <!-- alert success -->
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Selamat, Data linen berhasil ditambahkan!
                            </div>
                            <!-- end alert success -->
                        <?php } elseif (isset($_GET['message_failed'])) { ?>
                            <!-- alert failed -->
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Maaf, Data linen gagal ditambahkan!, harap periksa lagi informasi yang diinputkan!.
                            </div>
                            <!-- end alert failed -->
                        <?php } ?>
                    </div>
                    <!-- Basic Examples -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <a href="javascript:void(0)" class="btn btn-primary waves-effect pull-right" data-toggle="modal" data-target="#modalAdd">Tambah Data</a>
                                    <h2>
                                        DAFTAR PERMINTAAN PERLENGKAPAN
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" class="text-nowrap">No</th>
                                                    <th style="width: 22%;" class="text-nowrap">Nama Perlengkapan</th>
                                                    <th style="width: 20%;" class="text-nowrap">Tanggal</th>
                                                    <th style="width: 10%;" class="text-nowrap">Diajukan Oleh</th>
                                                    <th style="width: 10%;" class="text-nowrap">jumlah</th>
                                                    <th style="width: 15%;" class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                    $getLinen = mysqli_query($conn, "SELECT * FROM `permintaan_perlengkapan` INNER JOIN user ON user.id_user=permintaan_perlengkapan.id_user WHERE 1");
                                                    while ($data_linen = mysqli_fetch_assoc($getLinen)) {
                                                        if ($data_linen['status'] == 'tidak setuju') {
                                                            $style = "style='color:red;'";
                                                        }else{
                                                            $style = '';
                                                        }
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td <?=$style?>><?= ucwords($data_linen['nama_perlengkapan']) ?></td>
                                                        <td><?= ucwords($data_linen['tgl_permintaan']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_user']) ?></td>
                                                        <td><?= $data_linen['jml_permintaan']?></td>
                                                        <td class="text-nowrap"><a href="javascript:void(0)" onclick='getKelas("<?=$data_linen['id_permintaan_perlengkapan']?>")' id="<?=$data_linen['id_permintaan_perlengkapan']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-info waves-effect m-r-20 edit_permintaan"> EDIT</a>
                                                            <a href="javascript:void(0)" id="<?=$data_linen['id_permintaan_perlengkapan']?>" class="btn btn-danger waves-effect delete_permintaan">HAPUS</a></td>
                                                    </tr>
                                                <?php
                                                    }
                                                    
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Basic Examples -->

                    <!-- Modal add data -->
                    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">PERMINTAAN PERLENGKAPAN BARU</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/laundry/permintaan/perlengkapan/tambah/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="perlengkapan_baru" placeholder="* Nama Perlengkapan" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="kategori" id="kategori" required>
                                                            <option value=cair>Cair</option>
                                                            <option value="bubuk">Bubuk</option>
                                                        </select>
                                                        <label for="kategori" class="form-label">* Pilih Jenis</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" min="1" class="form-control" name="jumlah_perlengkapan" placeholder="* Jumlah Perlengkapan" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="diajukan" id="kategori" required>
                                                            <?php 
                                                            $sqlLaundry = mysqli_query($conn, "SELECT `id_user`,`nama_user` FROM `user` WHERE `id_level`=3");
                                                            while ($dataLaundry = mysqli_fetch_assoc($sqlLaundry)) {
                                                             ?>

                                                            <option value="<?=$dataLaundry['id_user']?>" <?php if($dataLaundry['id_user'] == $_SESSION['id_user']){ echo 'selected';}?>><?=$dataLaundry['nama_user']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="kategori" class="form-label">* Diajukan Oleh</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="keterangan" placeholder="* Keterangan Pengajuan" required>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                                <button type="submit" name="simpan" class="btn btn-primary waves-effect">SIMPAN</button>
                                            </form>
                                    <button type="button" class="btn btn-link waves-effect waves-red" data-dismiss="modal" style="color:red">TUTUP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->

                    <!-- Modal Edit data -->
                    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">EDIT PERMINTAAN PERLENGKAPAN BARU</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/laundry/permintaan/perlengkapan/tambah/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="perlengkapan_baru" placeholder="* Nama Perlengkapan" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="kategori" id="kategori" required>
                                                            <option value=cair>Cair</option>
                                                            <option value="bubuk">Bubuk</option>
                                                        </select>
                                                        <label for="kategori" class="form-label">* Pilih Jenis</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" min="1" class="form-control" name="jumlah_perlengkapan" placeholder="* Jumlah Perlengkapan" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="diajukan" id="kategori" required>
                                                            <?php 
                                                            $sqlLaundry = mysqli_query($conn, "SELECT `id_user`,`nama_user` FROM `user` WHERE `id_level`=3");
                                                            while ($dataLaundry = mysqli_fetch_assoc($sqlLaundry)) {
                                                             ?>

                                                            <option value="<?=$dataLaundry['id_user']?>" <?php if($dataLaundry['id_user'] == $_SESSION['id_user']){ echo 'selected';}?>><?=$dataLaundry['nama_user']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="kategori" class="form-label">* Diajukan Oleh</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="keterangan" placeholder="* Keterangan Pengajuan" required>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                                <button type="submit" name="simpan" class="btn btn-primary waves-effect">SIMPAN</button>
                                            </form>
                                    <button type="button" class="btn btn-link waves-effect waves-red" data-dismiss="modal" style="color:red">TUTUP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                </div>
            </section>

            <!-- Jquery Core Js -->
            <script src="<?= $base_url ?>vendors/plugins/jquery/jquery.min.js"></script>

            <!-- Bootstrap Core Js -->
            <script src="<?= $base_url ?>vendors/plugins/bootstrap/js/bootstrap.js"></script>

            <!-- Select Plugin Js -->
            <script src="<?= $base_url ?>vendors/plugins/bootstrap-select/js/bootstrap-select.js"></script>

            <!-- Jquery Validation Plugin Css -->
            <script src="<?= $base_url ?>vendors/plugins/jquery-validation/jquery.validate.js"></script>

            <!-- JQuery Steps Plugin Js -->
            <script src="<?= $base_url ?>vendors/plugins/jquery-steps/jquery.steps.js"></script>

            <!-- Sweet Alert Plugin Js -->
            <script src="<?= $base_url ?>vendors/plugins/sweetalert/sweetalert.min.js"></script>

            <!-- Slimscroll Plugin Js -->
            <script src="<?= $base_url ?>vendors/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

            <!-- Waves Effect Plugin Js -->
            <script src="<?= $base_url ?>vendors/plugins/node-waves/waves.js"></script>
            <!-- Jquery DataTable Plugin Js -->
            <script src="<?= $base_url ?>vendors/DataTables/datatables.min.js"></script>

            <!-- Custom Js -->
            <script src="<?= $base_url ?>vendors/js/admin.js"></script>

            <!-- Demo Js -->
            <script src="<?= $base_url ?>vendors/js/demo.js"></script>


            <script>
                /* tabel */
                $(document).ready(function() {
                    $('#table_user_list').DataTable({
                        'order': [
                            [0, 'asc']
                        ],
                        'columnDefs': [{
                            'targets': 'no-sort',
                            'orderable': false
                        }],
                        'searching': true,
                        'info': false,
                        'paging': true
                    });
                });

                /* hapus */
                ! function($) {
                    "use strict";
                    var SweetAlert = function() {};
                    SweetAlert.prototype.init = function() {
                            $('.delete_permintaan').click(function() {
                                var dataId = this.id;
                                swal({
                                    title: "Apakah benar akan menghapus data permintaan perlengkapan baru?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/laundry/permintaan/linen/hapus_permintaan/",
                                        data: {
                                            'id_permintaan': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>laundry/permintaan/perlengkapan/?message_success";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>laundry/permintaan/perlengkapan/?message_failed";
                                        },
                                    })
                                });
                            });
                        },
                        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
                }(window.jQuery),
                function($) {
                    "use strict";
                    $.SweetAlert.init()
                }(window.jQuery);

                $('.edit_permintaan').on('click', function(){
                    var id_minta = this.id;

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/perawat/permintaan/linen/ambil_data_permintaan/",
                        data : {'id_permintaan' : id_minta},
                        dataType : "json",
                        success : function(data){
                           $('#update_nama_linen').val(data.nama_linen);
                           $('.update_ruang').val(data.id_ruang);
                           $('#update_kategori').val(data.id_kategori);
                           $('#update_jumlah').val(data.jumlah);
                           $('#update_keterangan').val(data.keterangan);
                           $('#update_id').val(data.id);
                        },
                    })
                });

                
            </script>

        </body>

        </html>

<?php
    } else {
        header('location:' . $base_url . 'logout/?a=tidak sah');
    }
} else {
    header('location:' . $base_url . 'logout/?a=belum login');
}
?>