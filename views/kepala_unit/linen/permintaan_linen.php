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
                        <h2>LINEN</h2>
                        <ol class="breadcrumb align-right">
                            <li><a href="javascript:void(0);">Dashboard</a></li>
                            <li><a href="javascript:void(0);">Kepala Unit</a></li>
                            <li><a href="javascript:void(0);">Linen</a></li>
                            <li class="active">Daftar Permintaan Linen Baru</li>
                        </ol>
                        <?php if (isset($_GET['message_success'])) { ?>
                            <!-- alert success -->
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               <?php echo $_GET['message_success']?>
                            </div>
                            <!-- end alert success -->
                        <?php } elseif (isset($_GET['message_failed'])) { ?>
                            <!-- alert failed -->
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $_GET['message_failed']?>
                            </div>
                            <!-- end alert failed -->
                        <?php } ?>
                    </div>
                    <!-- Basic Examples -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        DAFTAR PERMINTAAN LINEN
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" class="text-nowrap">No</th>
                                                    <th style="width: 22%;" class="text-nowrap">Nama Linen</th>
                                                    <th style="width: 15%;" class="text-nowrap">Kategori</th>
                                                    <th style="width: 20%;" class="text-nowrap">Ruang - Kelas</th>
                                                    <th style="width: 10%;" class="text-nowrap">Diajukan</th>
                                                    <th style="width: 10%;" class="text-nowrap">jumlah</th>
                                                    <th style="width: 10%;" class="text-nowrap">Status</th>
                                                    <th style="width: 15%;" class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                    $getLinen = mysqli_query($conn, "SELECT id_permintaan_linen_baru, nama_linen_baru, kategori.nama_kategori, ruang.nama_ruang, kelas.nama_kelas, user.nama_user, jml_permintaan, permintaan.status FROM `permintaan_linen_baru` AS permintaan INNER JOIN user ON user.id_user=permintaan.id_user INNER JOIN ruang ON ruang.id_ruang=permintaan.id_ruang INNER JOIN kelas ON kelas.id_kelas=permintaan.id_kelas INNER JOIN kategori ON kategori.id_kategori=permintaan.id_kategori WHERE permintaan.status != 'diterima'");
                                                    while ($data_linen = mysqli_fetch_assoc($getLinen)) {
                                                        if ($data_linen['status'] == 'tidak setuju') {
                                                            $style = "label-danger";
                                                            $status = "Ditolak";
                                                        }else if ($data_linen['status'] == 'belum') {
                                                            $style = 'label-warning';
                                                            $status = "Belum";
                                                        }else{
                                                            $style = 'label-success';
                                                            $status = "Setuju";
                                                        }
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td <?=$style?>><?= ucwords($data_linen['nama_linen_baru']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_kategori']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_ruang']) ?> - <?=ucwords($data_linen['nama_kelas'])?></td>
                                                        <td><?= ucwords($data_linen['nama_user']) ?></td>
                                                        <td><?= $data_linen['jml_permintaan']?></td>
                                                        <td><h4><span class="label <?=$style?>"><?=$status?></span></h4></label></td>
                                                        <td class="text-nowrap"><a href="javascript:void(0)" id="<?=$data_linen['id_permintaan_linen_baru']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-primary waves-effect m-r-20 edit_permintaan"> KONFIRMASI</a>
                                                        </td>
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

                    <!-- Modal update data -->
                    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">KONFIRMASI PERMINTAAN LINEN BARU</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-responsive table-striped">
                                                <tr>
                                                    <th class="text-nowrap">Nama Linen</th>
                                                    <th class="text-nowrap">Ruang - Kelas</th>
                                                    <th class="text-nowrap">Jumlah</th>
                                                    <th class="text-nowrap">Pengaju</th>
                                                    <th class="text-nowrap">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <td><span id="update_nama_linen"></span></td>
                                                    <td><span id="update_ruang"></span> - <span id="update_kelas"></span></td>
                                                    <td><span id="update_jumlah"></span></td>
                                                    <td><span id="update_oleh"></span></td>
                                                    <td><span id="update_keterangan"></span></td>
                                                </tr>
                                            </table>
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/kepala-unit/linen/permintaan/konfirmasi/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="hidden" name="id_permintaan" id="update_id">
                                                        <select class="form-control" id="status" name="konfirm" required>
                                                            <option value="setuju">Setuju</option>
                                                            <option value="tidak setuju">Tidak Setuju</option>

                                                        </select>
                                                        <label for="konfirm" class="form-label">* Konfirmasi</label>
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
                                    title: "Apakah benar akan menghapus data permintaan linen baru?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/perawat/permintaan/linen/hapus_permintaan/",
                                        data: {
                                            'id_permintaan': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>perawat/permintaan/linen/?message_success= Selamat, Permintaan Linen Baru Berhasil Dihapus!!!";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>perawat/permintaan/linen/?message_failed=Permintaan Linen Baru gagal Dihapus!!!";
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
                        url : "<?=$base_url?>kepala-unit/linen/permintaan/ambil_data_permintaan/",
                        data : {'id_permintaan' : id_minta},
                        dataType : "json",
                        success : function(data){
                           $('#update_nama_linen').text(data.nama_linen);
                           $('#update_ruang').text(data.id_ruang);
                           $('#update_kelas').text(data.id_kelas);
                           $('#update_jumlah').text(data.jumlah);
                           $('#update_keterangan').text(data.keterangan);
                           $('#update_id').val(data.id);
                           $('#update_oleh').text(data.id_user);
                           $('#status').val(data.status).trigger();
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