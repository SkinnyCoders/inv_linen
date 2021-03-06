<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 'punten') {
    if (isset($_SESSION['role']) && $_SESSION['role'] == '4') {

        include_once 'views/templates/head.php';
        require 'controller/config/connection.php';
        $role = $_SESSION['role'];
        $nama = $_SESSION['nama_user'];

        $id_ruang = $_SESSION['id_ruang'];

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
                            <li><a href="javascript:void(0);">Linen</a></li>
                            <li class="active">Daftar Linen</li>
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
                                <?php echo $_GET['message_failed'] ?>
                            </div>
                            <!-- end alert failed -->
                        <?php } ?>
                    </div>
                    <!-- Basic Examples -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <a href="javascript:void(0)" class="btn btn-primary waves-effect pull-right" data-toggle="modal" data-target="#modalAdd">Cari Linen</a>
                                    <h2>
                                        DAFTAR LINEN
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;" class="text-nowrap">No</th>
                                                    <th style="width: 30%;" class="text-nowrap">Nama Linen</th>
                                                    <th style="width: 20%;" class="text-nowrap">Kategori</th>
                                                    <th style="width: 30%;" class="text-nowrap">Ruang - Kelas</th>
                                                    <th style="width: 10%;" class="text-nowrap">jumlah</th>
                                                    <th class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                if (isset($_GET['ruang']) && !empty($_GET['ruang'])) {
                                                    $ruang = $_GET['ruang'];
                                                    $where = "AND ruang.nama_ruang = '$ruang' ORDER BY nama_linen ASC";
                                                }else{
                                                    $where = "AND 1 ORDER BY nama_linen ASC";
                                                }
                                                    $getLinen = mysqli_query($conn, "SELECT id_linen, nama_linen, linen.id_ruang, kelas.nama_kelas, ruang.nama_ruang, kategori.nama_kategori, linen.jml_linen FROM `linen` JOIN kelas ON kelas.id_kelas=linen.id_kelas JOIN ruang ON ruang.id_ruang=linen.id_ruang JOIN kategori ON kategori.id_kategori=linen.id_kategori WHERE linen.id_ruang = $id_ruang ".$where);
                                                    if (mysqli_num_rows($getLinen) > 0) {
                                                    
                                                    while ($data_linen = mysqli_fetch_assoc($getLinen)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= ucwords($data_linen['nama_linen']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_kategori']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_ruang']) ?> - <?=ucwords($data_linen['nama_kelas'])?></td>
                                                        <td><?= $data_linen['jml_linen']?></td>
                                                        <td><a href="javascript:void(0)" id="<?=$data_linen['id_linen']?>" data-toggle="modal" data-target="#modalAdd1" class="btn btn-primary edit_linen">Minta</a></td>
                                                    </tr>
                                                <?php
                                                    }
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
                                    <h4 class="modal-title" id="defaultModalLabel">CARI DATA LINEN</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="" method="get">
                                                
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="ruang" id="ruang_linen" required>
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM ruang WHERE 1 ORDER BY id_ruang ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['nama_ruang']?>"><?=$dataKelas['nama_ruang']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="ruang_linen" class="form-label">Pilih Ruang</label>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary waves-effect">CARI</button>
                                            </form>
                                    <button type="button" class="btn btn-link waves-effect waves-red" data-dismiss="modal" style="color:red">TUTUP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->

                    <!-- Modal add data -->
                    <div class="modal fade" id="modalAdd1" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">PERMINTAAN LINEN BARU</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/perawat/permintaan/linen/tambah2/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="linen_baru" id="nama_linen" placeholder="* Nama Linen Baru" required readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="kategori" id="kategori" required readonly>
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM kategori WHERE 1 ORDER BY id_kategori ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['id_kategori']?>"><?=$dataKelas['nama_kategori']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="kategori" class="form-label">* Pilih Kategori</label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20 ruang_op" name="ruang" id="ruang_linen" required>
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM ruang WHERE 1 ORDER BY id_ruang ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['id_ruang']?>"><?=$dataKelas['nama_ruang']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="ruang_linen" class="form-label">* Linen Untuk Ruang</label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20 kelas_ruang_select" name="kelas" id="kelas_linen2" required >
                                                          <?php 

                                                          $sqlKelasOP = mysqli_query($conn, "SELECT kelas.id_kelas, kelas.nama_kelas FROM `ruang_kelas` INNER JOIN kelas ON kelas.id_kelas=ruang_kelas.id_kelas WHERE `id_ruang` =".$_SESSION['id_ruang']);
                                                          while ($dataKelasOP = mysqli_fetch_assoc($sqlKelasOP)) : ?>
                                                              <option value="<?=$dataKelasOP['id_kelas']?>"><?=ucwords($dataKelasOP['nama_kelas'])?></option>
                                                          <?php
                                                      endwhile;
                                                           ?>
                                                        </select>
                                                        <label for="kelas_ruang_select" class="form-label">* Linen Untuk Kelas</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" min="1" class="form-control" name="jumlah_linen" placeholder="* Jumlah Linen" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="diajukan" id="kategori" required>
                                                            <?php 
                                                            $sqlPerawat = mysqli_query($conn, "SELECT `id_user`,`nama_user` FROM `user` WHERE `id_level`=4");
                                                            while ($dataPerawat = mysqli_fetch_assoc($sqlPerawat)) {
                                                             ?>

                                                            <option value="<?=$dataPerawat['id_user']?>" <?php if($dataPerawat['id_user'] == $_SESSION['id_user']){ echo 'selected="true"';}?>><?=$dataPerawat['nama_user']?></option>
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
                //memunculkan pilihan kelas
                $('#ruang_linen').on('change', function(){
                    $('#kelas_linen').show();

                    var id_ruang = $('#ruang_linen').val();

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/admin/linen/ambil_kelas/",
                        data : {'id_ruang' : id_ruang},
                        async : false,
                        dataType : "json",
                        success : function(data){
                            var html = '';
                            var i;

                            for(i=0; i<data.length; i++){
                            html += '<option value="'+data[i].id_kelas+'">'+data[i].kelas+'</option>';
                            }
                            console.log(html);
                            $("#kelas_ruang_select").html(html);
                        }
                    })
                });
            </script>

            <script>
                function getKelas(id_ruang){
                    console.log(id_ruang);
                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/admin/linen/ambil_kelas/",
                        data : {'id_ruang' : id_ruang},
                        async : false,
                        dataType : "json",
                        success : function(data){
                            var html = '';
                            var i;

                            for(i=0; i<data.length; i++){
                            html += '<option value="'+data[i].id_kelas+'">'+data[i].kelas+'</option>';
                            }
                            console.log(html);
                            $("#kelas_ruang_select_update").html(html);
                        }
                    })
                };

                //memunculkan pilihan kelas
                $('#ruang_linen_update').on('change', function(){

                    var id_ruang = $('#ruang_linen_update').val();

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/admin/linen/ambil_kelas/",
                        data : {'id_ruang' : id_ruang},
                        async : false,
                        dataType : "json",
                        success : function(data){
                            var html = '';
                            var i;

                            for(i=0; i<data.length; i++){
                            html += '<option value="'+data[i].id_kelas+'">'+data[i].kelas+'</option>';
                            }
                            $("#kelas_ruang_select_update").html(html);
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
                            $('.delete_linen').click(function() {
                                var dataId = this.id;
                                swal({
                                    title: "Apakah benar akan menghapus data Linen?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/admin/linen/delete_linen/",
                                        data: {
                                            'id_linen': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>admin/linen/list/?message_success=Linen Berhasil Dihapus!!!";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>admin/linen/list/?message_failed=Linen Gagal Dihapus!!!";
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
                        url : "<?=$base_url?>controller/perawat/permintaan/ambil_data/",
                        data : {'id_linen' : id_linen},
                        dataType : "json",
                        success : function(data){
                            $('#id_linen').val(data.id_linen);
                            $('#nama_linen').val(data.linen);
                            $('#kelas_linen2').val(data.kelas);
                            $('.ruang_op').val(data.ruang);
                            $('#kategori').val(data.kategori).trigger();
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