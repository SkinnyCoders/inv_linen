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
                            <li class="active">List Perlengkapan</li>
                        </ol>
                        <?php if (isset($_GET['message_success'])) { ?>
                            <!-- alert success -->
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $_GET['message_success']; ?>
                            </div>
                            <!-- end alert success -->
                        <?php } elseif (isset($_GET['message_failed'
                        ])) { ?>
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
                              
                                    <h2>
                                        DAFTAR PERLENGKAPAN
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%;" class="text-nowrap">No</th>
                                                    <th style="width: 30%;" class="text-nowrap">Nama Perlengkapan</th>
                                                    <th style="width: 30%;" class="text-nowrap">Jenis</th>
                                                     <th style="width: 30%;" class="text-nowrap">Manfaat</th>
                                                     <th style="width: 30%;" class="text-nowrap">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                    $getPerlengkapan = mysqli_query($conn, "SELECT * FROM `perlengkapan` WHERE 1 ORDER BY nama_perlengkapan ASC");
                                                    while ($data_perlengkapan = mysqli_fetch_assoc($getPerlengkapan)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= ucwords($data_perlengkapan['nama_perlengkapan']) ?></td>
                                                        <td><?= ucwords($data_perlengkapan['jenis']) ?></td>
                                                        <td><?= ucwords($data_perlengkapan['manfaat']) ?></td>
                                                        <td><?= $data_perlengkapan['jumlah'] ?></td>
                                                       <!--  <td class="text-nowrap"><a href="javascript:void(0)" id="<?=$data_perlengkapan['id_perlengkapan']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-info waves-effect m-r-20 edit"> EDIT</a>
                                                            <a href="javascript:void(0)" id="<?=$data_perlengkapan['id_perlengkapan']?>" class="btn btn-danger waves-effect delete_perlengkapan">HAPUS</a></td> -->
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
                              title: 'Data Perlengkapan' 
                            },{
                                extend: 'excel',
                                title: 'Data Perlengkapan'
                            },
                            {
                                extend: 'print',
                                title: 'Data Perlengkapan'
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
                            $('.delete_perlengkapan').click(function() {
                                var dataId = this.id;
                                swal({
                                    title: "Apakah benar akan menghapus data kategori?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/laundry/perlengkapan/delete_perlengkapan/",
                                        data: {
                                            'id_perlengkapan': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>laundry/perlengkapan/?message_success=Selamat, Data Perlengkapan Berhasil Dihapus!.";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>laundry/perlengkapan/?message_failed=Maaf, Data Perlengkapan Gagal Dihapus!.";
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

                $('.edit').on('click', function(){
                    var perlengkapan_id = this.id;
                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/laundry/perlengkapan/ambil_perlengkapan/",
                        data : {'id_perlengkapan' : perlengkapan_id},
                        dataType : "json",
                        success : function(data){
                            $('#id_perlengkapan').val(data.id_perlengkapan);
                            $('#nama_perlengkapan').val(data.perlengkapan);
                            $('#jenis-update').val(data.jenis);
                            $('#manfaat-update').val(data.manfaat);
                            $('#jumlah-update').val(data.jumlah);
                        
                        },
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
