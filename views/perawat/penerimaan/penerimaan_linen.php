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
                                <?php echo $_GET['message_success']; ?>
                            </div>
                            <!-- end alert success -->
                        <?php } elseif (isset($_GET['message_failed'])) { ?>
                            <!-- alert failed -->
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $_GET['message_failed']; ?>
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
                                        DAFTAR PERMINTAAN LINEN
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" class="text-nowrap">No</th>
                                                    <th style="width: 27%;" class="text-nowrap">Nama Linen</th>
                                                    <th style="width: 15%;" class="text-nowrap">Kategori</th>
                                                    <th style="width: 25%;" class="text-nowrap">Ruang - Kelas</th>
                                                    <th style="width: 10%;" class="text-nowrap">jumlah</th>
                                                    <th style="width: 10%;" class="text-nowrap">Sisa</th>
                                                    <th style="width: 15%;" class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                    $getLinen = mysqli_query($conn, "SELECT id_penerimaan_linen_baru AS id, nama_linen_baru, nama_ruang, nama_kelas, nama_kategori, jml_diterima, permintaan_linen_baru.jml_permintaan FROM penerimaan_linen_baru JOIN permintaan_linen_baru ON permintaan_linen_baru.id_permintaan_linen_baru=penerimaan_linen_baru.id_permintaan_linen_baru JOIN ruang ON ruang.id_ruang=permintaan_linen_baru.id_ruang JOIN kelas ON kelas.id_kelas=permintaan_linen_baru.id_kelas JOIN kategori ON kategori.id_kategori=permintaan_linen_baru.id_kategori WHERE penerimaan_linen_baru.`status` = 'diterima'");
                                                    while ($data_linen = mysqli_fetch_assoc($getLinen)) {
                                                        if ($data_linen['jml_diterima'] > $data_linen['jml_permintaan']) {
                                                            $sisa = $data_linen['jml_diterima'] - $data_linen['jml_permintaan'];
                                                            $id = $data_linen['id'];
                                                            $btn = '<a href="javascript:void(0)" id="'.$id.'" class="btn btn-warning waves-effect m-r-20 batal_sisa"> LEBIH '.$sisa.'</a>';
                                                        }else{
                                                            $btn = "-";
                                                        }
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= ucwords($data_linen['nama_linen_baru']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_kategori']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_ruang']) ?> - <?=ucwords($data_linen['nama_kelas'])?></td>
                                                        <td><?= $data_linen['jml_diterima']?></td>
                                                        <td><?=$btn?></td>
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
                                    <h4 class="modal-title" id="defaultModalLabel">PENERIMAAN LINEN BARU</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/perawat/penerimaan/linen/tambah/" method="POST">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="id_permintaan_linen" id="permintaan" required>
                                                            <option></option>
                                                            <?php 
                                                            $sqlLinen = mysqli_query($conn, "SELECT `id_permintaan_linen_baru`,`nama_linen_baru`,`nama_kategori` FROM `permintaan_linen_baru` INNER JOIN kategori ON kategori.id_kategori=permintaan_linen_baru.id_kategori WHERE permintaan_linen_baru.`status` = 'setuju' AND NOT EXISTS (SELECT * FROM penerimaan_linen_baru WHERE id_permintaan_linen_baru = permintaan_linen_baru.id_permintaan_linen_baru)");
                                                            while ($dataLinen = mysqli_fetch_assoc($sqlLinen)) {
                                                             ?>
                                                            <option value="<?=$dataLinen['id_permintaan_linen_baru']?>"><?=$dataLinen['nama_linen_baru']?> - <?=$dataLinen['nama_kategori']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="permintaan" class="form-label">* Permintaan Linen</label>
                                                    </div>
                                                </div>
                                                <div class="row" style="display: none;" id="ruang_kelas">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="permintaan_ruang" class="form-control" name="penerimaan_ruang" placeholder="* Ruang" required disabled>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="permintaan_kelas" class="form-control" name="penerimaan_kelas" placeholder="* Kelas" required disabled>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="form-group" style="display: none;" id="diajukan">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="permintaan_oleh" name="diajukan" placeholder="* Diajukan Oleh" required disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="permintaan_jumlah" class="form-control" name="jumlah_linen" placeholder="Jumlah Permintaan" required disabled>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="number" min="1" class="form-control" name="jumlah_linen" placeholder="* Jumlah Linen Diterima" required>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="keterangan" placeholder="* Keterangan">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="id_ruang" id="permintaan_id_ruang" value="" required>
                                                    <input type="hidden" name="id_kelas" id="permintaan_id_kelas" value="" required>
                                                    <input type="hidden" name="id_kategori" id="permintaan_id_kategori" value="" required>
                                                    <input type="hidden" name="nama_linen" id="permintaan_nama_linen" value="" required>
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
                                    <h4 class="modal-title" id="defaultModalLabel">UBAH DATA PENERIMAAN LINEN</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/perawat/penerimaan/linen/ubah/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="hidden" name="id_penerimaan_linen" id="id_penerimaan_linen" value="" required>
                                                        <input type="text" class="form-control" id="nama_linen" name="linen" placeholder="Nama Linen" required disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="permintaan_ruang" class="form-control nama_ruang" name="penerimaan_ruang" placeholder="* Ruang" required disabled>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="permintaan_kelas" class="form-control nama_kelas" name="penerimaan_kelas" placeholder="* Kelas" required disabled>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control oleh" id="permintaan_oleh" name="diajukan" placeholder="* Diajukan Oleh" required disabled>
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
                        url : "<?=$base_url?>controller/perawat/permintaan/linen/ambil_permintaan/",
                        data : {'id_permintaan' : id_permintaan},
                        dataType : "json",
                        success : function(data){
                            $("#permintaan_ruang").val(data.ruang);
                            $("#permintaan_kelas").val(data.kelas);
                            $("#permintaan_oleh").val(data.oleh);
                            $('#permintaan_jumlah').val(data.jumlah);
                            $('#permintaan_id_ruang').val(data.id_ruang);
                            $('#permintaan_id_kelas').val(data.id_kelas);
                            $('#permintaan_id_kategori').val(data.id_kategori);
                            $('#permintaan_nama_linen').val(data.nama_linen_baru);
                        }
                    })
                });
            </script>

            <script>

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
                                        url: "<?= $base_url ?>controller/perawat/permintaan/linen/hapus_penerimaan/",
                                        data: {
                                            'id_penerimaan': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>perawat/penerimaan/linen/?message_success=Selamat, Data Penerimaan Linen Baru Berhasil Dihapus!!!";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>perawat/penerimaan/linen/?message_failed=Maaf, Data Penerimaan Linen Baru Berhasil Dihapus!!!";
                                        },
                                    })
                                });
                            });

                             $('.batal_sisa').click(function() {
                                var dataIdSisa = this.id;

                                swal({
                                    title: "Data linen yang diterima melebihi dari jumlah yang diminta!",
                                    text: "Jika anda menekan Ya, Maka data linen dan data penerimaan linen akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/perawat/permintaan/linen/cancel_sisa/?id="+dataIdSisa,
                                        data: {
                                            'id_penerimaan': dataIdSisa
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>perawat/penerimaan/linen/?message_success=Selamat, Data Penerimaan Linen Baru Berhasil Dihapus!!!";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>perawat/penerimaan/linen/?message_failed=Maaf, Data Penerimaan Linen Baru Berhasil Dihapus!!!";
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
                    var id = this.id;

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/perawat/penerimaan/linen/ambil_penerimaan/",
                        data : {'id_penerimaan' : id},
                        dataType : "json",
                        success : function(data){
                            $('#id_penerimaan_linen').val(data.id_penerimaan);
                            $('#nama_linen').val(data.nama_linen);
                            $('.jumlah').val(data.jumlah);
                            $('.nama_ruang').val(data.ruang);
                            $('.nama_kelas').val(data.kelas);
                            $('.oleh').val(data.oleh);
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