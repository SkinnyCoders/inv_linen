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
                        <h2>PERLENGKAPAN</h2>
                        <ol class="breadcrumb align-right">
                            <li><a href="javascript:void(0);">Dashboard</a></li>
                            <li><a href="javascript:void(0);">Kepala Unit</a></li>
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
                                                    <th style="width: 20%;" class="text-nowrap">Tanggal</th>
                                                    <th style="width: 20%;" class="text-nowrap">Diterima Oleh</th>
                                                    <th style="width: 10%;" class="text-nowrap">jumlah</th>
                                                    <!-- <th style="width: 15%;" class="text-nowrap">Aksi</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                    $getLinen = mysqli_query($conn, "SELECT penerimaan_perlengkapan.id_penerimaan_perlengkapan AS id , permintaan_perlengkapan.nama_perlengkapan, `jml_diterima`, `tgl_penerimaan`, user.nama_user FROM `penerimaan_perlengkapan` INNER JOIN permintaan_perlengkapan ON permintaan_perlengkapan.id_permintaan_perlengkapan=penerimaan_perlengkapan.id_permintaan_perlengkapan INNER JOIN user ON user.id_user=penerimaan_perlengkapan.id_penerima WHERE penerimaan_perlengkapan.status = 'diterima'");
                                                    while ($data_linen = mysqli_fetch_assoc($getLinen)) {

                                                        $tgl = DateTime::createFromFormat('Y-m-d H:i:s', $data_linen['tgl_penerimaan'])->format('d F Y');
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= ucwords($data_linen['nama_perlengkapan']) ?></td>
                                                        <td><?= ucwords($tgl) ?></td>
                                                        <td><?= ucwords($data_linen['nama_user']) ?></td>
                                                        <td><?= $data_linen['jml_diterima']?></td>
                                                       <!--  <td class="text-nowrap"><a href="javascript:void(0)" onclick='getKelas("<?=$data_linen['id']?>")' id="<?=$data_linen['id']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-info waves-effect m-r-20 edit_perlengkapan"> EDIT</a>
                                                            <a href="javascript:void(0)" id="<?=$data_linen['id']?>" class="btn btn-danger waves-effect delete_penerimaan">HAPUS</a></td> -->
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

            <!-- Jquery DataTable Plugin Js -->
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/jquery.dataTables.js"></script>
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
            <script src="<?= $base_url ?>vendors/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

            <!-- Custom Js -->
            <script src="<?= $base_url ?>vendors/js/admin.js"></script>

            <!-- Demo Js -->
            <script src="<?= $base_url ?>vendors/js/demo.js"></script>

            <script>
                /* tabel */
                $(document).ready(function() {
                    $('#table_user_list').DataTable({
                        dom: 'Bfrtip',
                        responsive: true,
                        buttons: [{
                              extend: 'pdfHtml5',
                              title: 'Data Linen' 
                            },{
                                extend: 'excel',
                                title: 'Data Linen'
                            },
                            {
                                extend: 'print',
                                title: 'Data Linen'
                            }
                        ],
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

                $('.edit_perlengkapan').on('click', function(){
                    var id_perlengkapan = this.id;

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/laundry/penerimaan/perlengkapan/ambil_permintaan_edit/",
                        data : {'id_penerimaan' : id_perlengkapan},
                        dataType : "json",
                        success : function(data){
                            $('#id_perlengkapan').val(data.id);
                            $('#nama_perlengkapan').val(data.perlengkapan);
                            $('.jumlah').val(data.jumlah);
                            $('.diterima').val(data.penerima);
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