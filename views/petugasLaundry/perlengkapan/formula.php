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
                        <h2>FORMULA PERLENGKAPAN</h2>
                        <ol class="breadcrumb align-right">
                            <li><a href="javascript:void(0);">Dashboard</a></li>
                            <li><a href="javascript:void(0);">Perlengkapan</a></li>
                            <li class="active">Daftar Formula Perlengkapan</li>
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
                                        DAFTAR FORMULA PERLENGKAPAN
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" class="text-nowrap">No</th>
                                                    <th style="width: 22%;" class="text-nowrap">Nama Formula</th>
                                                    <th style="width: 15%;" class="text-nowrap">Jenis Formula</th>
                                                    <th style="width: 20%;" class="text-nowrap">Takaran</th>
                                                    <th style="width: 15%;" class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                $sqlFormula = mysqli_query($conn, "SELECT formula_perlengkapan.nama_formula, formula_perlengkapan.jenis_formula, formula_perlengkapan.id_formula, SUM(takaran_formula.jumlah) AS jumlah FROM `formula_perlengkapan` INNER JOIN takaran_formula ON takaran_formula.id_formula=formula_perlengkapan.id_formula WHERE 1 GROUP BY formula_perlengkapan.id_formula");
                                                if (mysqli_num_rows($sqlFormula) > 0) {
                                                    while ($dataFormula = mysqli_fetch_assoc($sqlFormula)) { 
                                                        ?>
                                                     <tr>
                                                        <td><?=$no++?></td>
                                                        <td><?=ucwords($dataFormula['nama_formula'])?></td>
                                                        <td><?=ucwords($dataFormula['jenis_formula'])?></td>

                                                        <td>
                                                            <?=$dataFormula['jumlah'].' ML'?>
                                                        </td>
                                                        
                                                        <td class="text-nowrap"><!-- <a href="javascript:void(0)" id="<?=$dataFormula['id_formula']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-info waves-effect m-r-20 edit_permintaan"> EDIT</a> -->
                                                            <a href="javascript:void(0)" id="<?=$dataFormula['id_formula']?>" class="btn btn-danger waves-effect delete_formula">HAPUS</a></td>
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

                    <!-- Modal add data -->
                    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">FORMULA BARU</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/laundry/formula/add/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="nama_formula" placeholder="* Nama Formula" required>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="keterangan" placeholder="* Keterangan Pengajuan" required>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="jenis" id="jenis" required>
                                                        <option value="">Pilih Jenis</option>
                                                        <option value="infeksius">Infeksius</option>
                                                        <option value="non infeksius">Non Infeksius</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row" id="newlink">
                                                    <div class="col-md-8">
                                                        <div class="form-group form-float" id="perlengkapan">
                                                            <div class="form-line">
                                                                <select class="form-control show-tick m-t-20" name="perlengkapan[]" id="ruang_linen" required>
                                                                    <option>Pilih Perlengkapan</option>
                                                                    <?php 
                                                                    $getPerlengkapan = mysqli_query($conn, "SELECT `id_perlengkapan`, `nama_perlengkapan` FROM `perlengkapan` WHERE 1 ORDER BY `nama_perlengkapan` ASC");
                                                                    while ($data = mysqli_fetch_assoc($getPerlengkapan)) {
                                                                    
                                                                     ?>
                                                                    <option value="<?=$data['id_perlengkapan']?>"><?=ucwords($data['nama_perlengkapan'])?></option>
                                                                <?php } ?>
                                                                   
                                                                </select>
                                                                <label for="ruang_linen" class="form-label">Pilih Perlengkapan</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                         <div class="form-group form-float" id="jml_perlengkapan">
                                                            <div class="form-line">
                                                                <label>Jumlah Perlengkapan</label>
                                                                <input type="text" class="form-control" name="jumlah_perlengkapan[]" placeholder="Jumlah (ML)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="javascript:new_link()">Tambah</a>
                                                <div id="newlinktpl" style="display:none">
                                                   <div class="col-md-8">
                                                        <div class="form-group form-float" id="perlengkapan">
                                                            <div class="form-line">
                                                                <select class="form-control show-tick m-t-20" name="perlengkapan[]" id="ruang_linen" required>
                                                                    <option value="0">Pilih Perlengkapan</option>
                                                                    <?php 
                                                                    $getPerlengkapan = mysqli_query($conn, "SELECT `id_perlengkapan`, `nama_perlengkapan` FROM `perlengkapan` WHERE 1 ORDER BY `nama_perlengkapan` ASC");
                                                                    while ($data = mysqli_fetch_assoc($getPerlengkapan)) {
                                                                    
                                                                     ?>
                                                                    <option value="<?=$data['id_perlengkapan']?>"><?=ucwords($data['nama_perlengkapan'])?></option>
                                                                <?php } ?>
                                                                   
                                                                </select>
                                                                <label for="ruang_linen" class="form-label">Pilih Perlengkapan</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                         <div class="form-group form-float" id="jml_perlengkapan">
                                                            <div class="form-line">
                                                                <label>Jumlah Perlengkapan</label>
                                                                <input type="text" class="form-control" name="jumlah_perlengkapan[]" placeholder="Jumlah (ML)">
                                                            </div>
                                                        </div>
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
                //memunculkan pilihan kelas
                $('.update_ruang').on('change', function(){
                    $('#kelas_linen_update').show();

                    var id_ruang = $('.update_ruang').val();

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
                            $('.delete_formula').click(function() {
                                var dataId = this.id;
                                swal({
                                    title: "Apakah benar akan menghapus data formula perlengkapan?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/laundry/formula/hapus/",
                                        data: {
                                            'id_formula': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>laundry/formula/?message_success";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>laundry/formula/?message_failed";
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
            <script>
            /*
            This script is identical to the above JavaScript function.
            */
            var ct = 1;
            function new_link()
            {
                ct++;
                var div1 = document.createElement('div');
                div1.id = ct;
                // link to delete extended form elements
                var delLink = '<a class="btn btn-small btn-danger float-right" href="javascript:delIt('+ ct +')">Del</a>';
                div1.innerHTML = document.getElementById('newlinktpl').innerHTML;
                document.getElementById('newlink').appendChild(div1);
            }
            // function to delete the newly added set of elements
            function delIt(eleId)
            {
                d = document;
                var ele = d.getElementById(eleId);
                var parentEle = d.getElementById('newlink');
                parentEle.removeChild(ele);
            }
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