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
                        <h2>PERLENGKAPAN</h2>
                        <ol class="breadcrumb align-right">
                            <li><a href="javascript:void(0);">Dashboard</a></li>
                            <li><a href="javascript:void(0);">Perlengkapan</a></li>
                            <li class="active">Penerimaan Perlengkapan</li>
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
                                        DAFTAR PENERIMAAN PERLENGKAPAN
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" class="text-nowrap">No</th>
                                                    <th style="width: 27%;" class="text-nowrap">Nama Perlengkapan</th>
                                                    <th style="width: 15%;" class="text-nowrap">Tanggal</th>
                                                    <th style="width: 25%;" class="text-nowrap">Diterima Oleh</th>
                                                    <th style="width: 10%;" class="text-nowrap">jumlah</th>
                                                    <th style="width: 15%;" class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                    $getLinen = mysqli_query($conn, "SELECT penerimaan_perlengkapan.id_penerimaan_perlengkapan AS id , permintaan_perlengkapan.nama_perlengkapan, `jml_diterima`, `tgl_penerimaan`, user.nama_user FROM `penerimaan_perlengkapan` INNER JOIN permintaan_perlengkapan ON permintaan_perlengkapan.id_permintaan_perlengkapan=penerimaan_perlengkapan.id_permintaan_perlengkapan INNER JOIN user ON user.id_user=penerimaan_perlengkapan.id_penerima WHERE penerimaan_perlengkapan.status = 'diterima'");
                                                    while ($data_linen = mysqli_fetch_assoc($getLinen)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= ucwords($data_linen['nama_perlengkapan']) ?></td>
                                                        <td><?= ucwords($data_linen['tgl_penerimaan']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_user']) ?></td>
                                                        <td><?= $data_linen['jml_diterima']?></td>
                                                        <td class="text-nowrap"><a href="javascript:void(0)" onclick='getKelas("<?=$data_linen['id']?>")' id="<?=$data_linen['id']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-info waves-effect m-r-20 edit_linen"> EDIT</a>
                                                            <a href="javascript:void(0)" id="<?=$data_linen['id']?>" class="btn btn-danger waves-effect delete_penerimaan">HAPUS</a></td>
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

                    <!-- Default Size -->
                    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">PENERIMAAN PERLENGKAPAN BARU</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/laundry/penerimaan/perlengkapan/tambah/" method="POST">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="id_permintaan_perlengkapan" id="permintaan" required>
                                                            <option></option>
                                                            <?php 
                                                            $sqlLinen = mysqli_query($conn, "SELECT `id_permintaan_perlengkapan`, `nama_perlengkapan`,`jml_permintaan` FROM `permintaan_perlengkapan` WHERE `status` = 'setuju' AND NOT EXISTS (SELECT id_permintaan_perlengkapan FROM penerimaan_perlengkapan WHERE penerimaan_perlengkapan.id_permintaan_perlengkapan=id_permintaan_perlengkapan)");
                                                            while ($dataPerlengkapan = mysqli_fetch_assoc($sqlLinen)) {
                                                             ?>
                                                            <option value="<?=$dataPerlengkapan['id_permintaan_perlengkapan']?>"><?=$dataPerlengkapan['nama_perlengkapan']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="permintaan" class="form-label">* Permintaan Linen</label>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="display: none;" id="diajukan">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="permintaan_oleh" name="diajukan" placeholder="* Diajukan Oleh" required disabled>
                                                        <input type="hidden" name="id_penerima" id="oleh" value="<?=$_SESSION['id_user']?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="permintaan_jumlah" class="form-control" name="jumlah_perlengkapan1" placeholder="Jumlah Permintaan" required disabled>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="number" min="1" class="form-control" name="jumlah_perlengkapan" placeholder="* Jumlah Diterima" required>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="keterangan" placeholder="* Keterangan">
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

                    <!-- Default Size -->
                    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">UBAH DATA LINEN</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/admin/linen/update_linen/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="hidden" name="id_linen" id="id_linen" value="" required>
                                                        <input type="text" class="form-control" id="nama_linen" name="linen" placeholder="Nama Linen" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20 id_kategori" name="kategori" id="kategori" required>
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM kategori WHERE 1 ORDER BY id_kategori ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['id_kategori']?>"><?=$dataKelas['nama_kategori']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="kategori" class="form-label">Pilih Kategori</label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20 id_ruang1" name="ruang" id="ruang_linen_update" required>
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM ruang WHERE 1 ORDER BY id_ruang ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['id_ruang']?>"><?=$dataKelas['nama_ruang']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="ruang_linen_update" class="form-label">Pilih Ruang</label>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="kelas_linen">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20 id_kelas" name="kelas" id="kelas_ruang_select_update" required>
                                                            <option ></option>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" min="5" class="form-control jumlah" name="jumlah_linen" placeholder="Jumlah Linen" required>
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
                //memunculkan pilihan kelas
                $('#permintaan').on('change', function(){
                    $('#ruang_kelas').show();
                    $('#diajukan').show();

                    var id_permintaan = $('#permintaan').val();

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/laundry/penerimaan/perlengkapan/ambil_permintaan/",
                        data : {'id_permintaan' : id_permintaan},
                        dataType : "json",
                        success : function(data){
                            $("#permintaan_oleh").val(data.pengaju);
                            $('#permintaan_jumlah').val(data.jumlah);
                        }
                    })
                });
            </script>

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
                            $('.delete_penerimaan').click(function() {
                                var dataId = this.id;
                                console.log(dataId);
                                swal({
                                    title: "Apakah benar akan menghapus data penerimaan linen?",
                                    text: "Jika anda menekan Ya, Maka data linen dan data penerimaan linen akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/laundry/penerimaan/perlengkapan/hapus_penerimaan/?id="+dataId,
                                        data: {
                                            'id_penerimaan': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>laundry/penerimaan/perlengkapan/?message_success";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>laundry/penerimaan/perlengkapan/?message_failed";
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

                $('.edit_linen').on('click', function(){
                    var id_linen = this.id;

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/admin/linen/ambil_linen/",
                        data : {'id_linen' : id_linen},
                        dataType : "json",
                        success : function(data){
                            $('#id_linen').val(data.id_linen);
                            $('#nama_linen').val(data.nama_linen);
                            $('.jumlah').val(data.jumlah);
                            $('.id_ruang1').val(data.id_ruang);
                            $('.id_kelas').val(data.id_kelas);
                            $('.id_kategori').val(data.id_kategori).trigger();
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