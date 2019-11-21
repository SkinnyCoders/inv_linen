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
                            <li><a href="javascript:void(0);">Ruang & Kelas</a></li>
                            <li class="active">Tambah Ruang & Kelas</li>
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
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        DAFTAR KELAS
                                    </h2>
                                </div>
                                <div class="body">
                                    <form id="form_validation" action="<?=$base_url?>controller/admin/ruang-kelas/tambah_kelas/" method="POST">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="username" class="form-control" name="kelas_name" placeholder="Nama Kelas" required>
                                            </div>
                                        </div>
                                        <div class="align-right">
                                            <button type="submit" name="simpan" class="btn btn-sm btn-primary waves-effect align-right">SIMPAN</button>
                                        </div>
                                        
                                    </form>
                                    <hr>
                                    <p class="text-muted"><span style="color: red">* </span>Dibawah ini adalah <span style="color: red">daftar kelas</span> yang sudah diinputkan</p>

                                        <?php 
                                        $sqlKelas = mysqli_query($conn, "SELECT * FROM kelas WHERE 1 ORDER BY id_kelas ASC");
                                        while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) { ?>
                                            
                                            <a class="label bg-teal update-kelas m-t-40" id="<?=$dataKelas['id_kelas']?>" data-toggle="modal" data-target="#modalEditKelas" href="javascript:void(0)"><span data-toggle="tooltip" data-placement="top" title="klik untuk update"><?php echo $dataKelas['nama_kelas']?></span></a>
                                       
                                        <?php }
                                         ?>
                                      
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        DAFTAR RUANG
                                    </h2>
                                </div>
                                <div class="body">
                                    <form id="form_validation" action="<?=$base_url?>controller/admin/ruang-kelas/tambah_ruang_single/" method="POST">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="username" class="form-control" name="ruang_name" placeholder="Nama Ruang" required>
                                            </div>
                                        </div>
                                        <div class="align-right">
                                            <button type="submit" name="simpan" class="btn btn-sm btn-primary waves-effect align-right">SIMPAN</button>
                                        </div>
                                        
                                    </form>
                                    <hr>
                                    <p class="text-muted"><span style="color: red">* </span>Dibawah ini adalah <span style="color: red">daftar ruang</span> yang sudah diinputkan</p>

                                        <?php 
                                        $sqlRuang = mysqli_query($conn, "SELECT * FROM ruang WHERE 1 ORDER BY id_ruang ASC");
                                        while ($dataRuang = mysqli_fetch_assoc($sqlRuang)) { ?>
                                            
                                            <a class="label bg-teal update-ruang m-t-40" id="<?=$dataRuang['id_ruang']?>" data-toggle="modal" data-target="#modalEditRuang" href="javascript:void(0)"><span data-toggle="tooltip" data-placement="top" title="klik untuk update"><?php echo $dataRuang['nama_ruang']?></span></a>
                                       
                                        <?php }
                                         ?>
                                      
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6">
                            <div class="card">
                                <div class="header">
                                    <a href="javascript:void(0)" class="btn btn-primary waves-effect pull-right" data-toggle="modal" data-target="#modalRuang">Tambah Konfigurasi Ruang & Kelas</a>
                                    <h2>
                                        DAFTAR RUANG KELAS
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%;" class="text-nowrap">No</th>
                                                    <th style="width: 50%;" class="text-nowrap">Nama Ruang</th>
                                                    <th style="width: 30">Nama Kelas</th>
                                                    <th style="width: 10%;" class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                    $getKategori = mysqli_query($conn, "SELECT * FROM `ruang` WHERE 1 ORDER BY nama_ruang ASC");
                                                    while ($data_kategori = mysqli_fetch_assoc($getKategori)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= ucwords($data_kategori['nama_ruang']) ?></td>
                                                        <td>
                                                            <?php 
                                                            $id_ruang = $data_kategori['id_ruang'];
                                                            $sqlKelas = mysqli_query($conn, "SELECT kelas.nama_kelas FROM `ruang_kelas` INNER JOIN kelas ON kelas.id_kelas=ruang_kelas.id_kelas WHERE `id_ruang` = $id_ruang");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                                echo '<span class="label label-success m-l-10">'.$dataKelas["nama_kelas"].'</span>';
                                                            }
                                                             ?>
                                                        </td>
                                                        <td class="text-nowrap"><a href="javascript:void(0)" id="<?=$data_kategori['id_ruang']?>" data-toggle="modal" data-target="#modalRuangEdit" class="btn btn-info waves-effect m-r-20 update-ruang-kelas"> EDIT</a>
                                                            <a href="javascript:void(0)" id="<?=$data_kategori['id_ruang']?>" class="btn btn-danger waves-effect delete_ruang">HAPUS</a></td>
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
                    <!-- modal edit kelas -->
                    <div class="modal fade" id="modalEditKelas" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="defaultModalLabel">Edit Kelas</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?=$base_url?>controller/admin/ruang-kelas/update_kelas/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="nama_kelas_update" class="form-control" value="" name="kelas" placeholder="Nama Kelas" required>
                                                        <input type="hidden" id="id_kelas_update" name="id_kelas" value="" required>
                                                    </div>
                                                </div>
                                                <div class="align-right">
                                                    <button type="submit" class="btn btn-sm btn-primary waves-effect align-right">SIMPAN</button>
                                                    <a class="btn btn-sm btn-danger waves-effect align-right hapus_kelas" id="" href="javascript:void(0)">HAPUS</a>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal edit ruang single -->
                    <div class="modal fade" id="modalEditRuang" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="defaultModalLabel">Edit Ruang</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?=$base_url?>controller/admin/ruang-kelas/update_ruang/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="nama_ruang_update" class="form-control" value="" name="ruang" placeholder="Nama Ruang" required>
                                                        <input type="hidden" id="id_ruang_update" name="id_ruang" value="" required>
                                                    </div>
                                                </div>
                                                <div class="align-right">
                                                    <button type="submit" class="btn btn-sm btn-primary waves-effect align-right">SIMPAN</button>
                                                    <a class="btn btn-sm btn-danger waves-effect align-right hapus_kelas" id="" href="javascript:void(0)">HAPUS</a>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Default Size -->
                    <div class="modal fade" id="modalRuang" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="defaultModalLabel">Konfigurasi Ruang</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/admin/ruang-kelas/tambah_ruang/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="ruang" id="as_user">
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM ruang WHERE 1 ORDER BY id_ruang ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['id_ruang']?>"><?=$dataKelas['nama_ruang']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="as_user" class="form-label">Pilih Ruang</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="ruang_kelas[]" id="as_user" multiple>
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM kelas WHERE 1 ORDER BY id_kelas ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['id_kelas']?>"><?=$dataKelas['nama_kelas']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="as_user" class="form-label">Pilih Kelas</label>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect">SIMPAN</button>
                                    </form>
                                    <button type="button" class="btn btn-link waves-effect waves-red" data-dismiss="modal" style="color:red">CLOSE</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Ruang -->
                    <div class="modal fade" id="modalRuangEdit" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="defaultModalLabel">Edit Konfigurasi Ruang <span id="nama_ruang_update2"></span></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/admin/ruang-kelas/update-ruang-kelas/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="hidden" name="id_ruang" id="id_ruang_update_input" value="">
                                                        
                                                        <select class="form-control m-t-20" name="ruang_kelas[]" id="ruang_kelas_update" multiple>
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM kelas WHERE 1 ORDER BY id_kelas ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['id_kelas']?>"><?=$dataKelas['nama_kelas']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="ruang_kelas_update" class="form-label">Pilih Kelas</label>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect">SIMPAN</button>
                                    </form>
                                    <button type="button" class="btn btn-link waves-effect waves-red" data-dismiss="modal" style="color:red">CLOSE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Jquery Core Js -->
            <script src="<?= $base_url ?>vendors/plugins/jquery/jquery.min.js"></script>

            <!-- Bootstrap Core Js -->
            <script src="<?= $base_url ?>vendors/plugins/bootstrap/js/bootstrap.js"></script>
            
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
            <!-- Multi Select Plugin Js -->
            <script src="<?= $base_url ?>vendors/plugins/multi-select/js/jquery.multi-select.js"></script>  
            <!-- Select Plugin Js -->
            <script src="<?= $base_url ?>vendors/plugins/bootstrap-select/js/bootstrap-select.js"></script>

            <!-- Custom Js -->
            <script src="<?= $base_url ?>vendors/js/admin.js"></script>
            <script src="<?= $base_url ?>vendors/js/pages/forms/advanced-form-elements.js"></script>


            <!-- Demo Js -->
            <script src="<?= $base_url ?>vendors/js/demo.js"></script>


            <script>
                /* tabel */
                $(document).ready(function() {
                    $('#table_user').DataTable({
                        'order': [
                            [0, 'asc']
                        ],
                        'columnDefs': [{
                            'targets': 'no-sort',
                            'orderable': false
                        }],
                        'searching': false,
                        'info': false,
                        'paging': true
                    });
                });

                /* hapus */
                ! function($) {
                    "use strict";
                    var SweetAlert = function() {};
                    SweetAlert.prototype.init = function() {
                            $('.hapus_kelas').click(function() {
                                var dataId = this.id;
                                swal({
                                    title: "Apakah benar akan menghapus data kelas?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/admin/ruang-kelas/delete_kelas/",
                                        data: {
                                            'id_kelas': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>admin/ruang_kelas/?message_success=Selamat, Data Kelas Berhasil Dihapus!.";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>admin/ruang_kelas/?message_failed=Maaf, Data Kelas Gagal Dihapus!.";
                                        },
                                    })
                                });
                            });
                            $('.delete_ruang').click(function() {
                                var dataId = this.id;
                                swal({
                                    title: "Apakah benar akan menghapus data ruang?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        method: "POST",
                                        url: "<?= $base_url ?>controller/admin/ruang-kelas/delete_ruang/?id="+dataId,
                                        data: {
                                            'id_ruang': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>admin/ruang_kelas/?message_success=Selamat, Data Ruang Berhasil Ditambahkan!.";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>admin/ruang_kelas/?message_failed=Maaf Data Ruang Gagal Dihapus!.";
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

                $('.update-kelas').on('click', function(){
                    var user_id = this.id;
                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/admin/ruang-kelas/get_kelas/",
                        data : {'id_kelas' : user_id},
                        dataType : "json",
                        success : function(data){
                            $('#id_kelas_update').val(data.id_kelas);
                            $('#nama_kelas_update').val(data.kelas);
                            $('.hapus_kelas').attr('id', data.id_kelas);
                        },
                    })
                })

                 $('.update-ruang').on('click', function(){
                    var user_id = this.id;
                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/admin/ruang-kelas/get_ruang/",
                        data : {'id_ruang' : user_id},
                        dataType : "json",
                        success : function(data){
                            $('#id_ruang_update').val(data.id_ruang);
                            $('#nama_ruang_update').val(data.ruang);
                            $('.hapus_ruang').attr('id', data.id_ruang);
                        },
                    })
                })

                $('.update-ruang-kelas').on('click', function(){
                    var id_ruang = this.id;
                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/admin/ruang-kelas/get_ruang_kelas/",
                        data : {'id_ruang' : id_ruang},
                        dataType : "json",
                        success : function(data){
                            $('#ruang_kelas_update').val(data.id_kelas).trigger("change");
                            $('#nama_ruang_update2').text(data.nama_ruang);
                            $('#id_ruang_update_input').val(data.id_ruang);
                        }
                    })
                })
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