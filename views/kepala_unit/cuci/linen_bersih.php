<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

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
                        <h2>LINEN BERSIH</h2>
                        <ol class="breadcrumb align-right">
                            <li><a href="javascript:void(0);">Dashboard</a></li>
                            <li><a href="javascript:void(0);">Linen Bersih</a></li>
                            <li class="active">Daftar Linen Bersih</li>
                        </ol>
                        <?php if (isset($_GET['message_success'])) { ?>
                            <!-- alert success -->
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Selamat, Data linen bersih berhasil ditambahkan!
                            </div>
                            <!-- end alert success -->
                        <?php } elseif (isset($_GET['message_failed'])) { ?>
                            <!-- alert failed -->
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Maaf, Data linen bersih gagal ditambahkan!, harap periksa lagi informasi yang diinputkan!.
                            </div>
                            <!-- end alert failed -->
                        <?php } ?>
                    </div>
                    <!-- Basic Examples -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <a href="javascript:void(0)" class="btn btn-primary waves-effect pull-right" data-toggle="modal" data-target="#modalAdd">Cari Linen Bersih</a>
                                    <h2>
                                       <?php 
                                        if (isset($_GET['tanggal'])) {
                                            $tanggalKet = Datetime::createFromFormat('Y-m-d', $_GET['tanggal'])->format('d F Y');
                                        }else{
                                            $tanggalKet = date('d F Y');
                                        }

                                         ?>


                                        DAFTAR LINEN BERSIH - <?=$tanggalKet?>
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;" class="text-nowrap">No</th>
                                                    <th style="width: 25%;" class="text-nowrap">Nama Linen - Kategori</th>
                                                    <th style="width: 20%;" class="text-nowrap">Ruang - Kelas</th>
                                                    <th style="width: 13%;" class="text-nowrap">jumlah Cuci</th>
                                                    <th style="width: 15%;">Jenis Cuci</th>
                                                    <th style="width: 15">Proses</th>
                                                    <!-- <th style="width: 3%;" class="text-nowrap">Aksi</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                if (isset($_GET['tanggal']) && !empty($_GET['tanggal'])) {
                                                    $tanggal = $_GET['tanggal'];
                                                }else{
                                                    $tanggal = date('Y-m-d'); 
                                                }
                                                    $getLinenKotor = mysqli_query($conn, "SELECT bersih.id_linen_bersih AS id, linen.nama_linen, kategori.nama_kategori, kelas.nama_kelas, ruang.nama_ruang, bersih.jumlah, jenis_linen_kotor.jenis, pencucian.id_proses_cuci FROM linen_bersih AS bersih INNER JOIN pencucian ON pencucian.id_pencucian=bersih.id_pencucian INNER JOIN linen_kotor AS kotor ON kotor.id_linen_kotor=pencucian.id_linen_kotor INNER JOIN linen ON linen.id_linen=kotor.id_linen INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN jenis_linen_kotor ON jenis_linen_kotor.id_jenis_linen_kotor=pencucian.id_jenis_linen_kotor WHERE DATE(bersih.tgl) = '$tanggal' AND bersih.status = 'bersih' ORDER BY linen.nama_linen ASC");
                                                    while ($data_linen = mysqli_fetch_assoc($getLinenKotor)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= ucwords($data_linen['nama_linen']) . ' - ' . ucwords($data_linen['nama_kategori']); ?></td>
                                                        <td><?= ucwords($data_linen['nama_ruang']) ?> - <?=ucwords($data_linen['nama_kelas'])?></td>
                                                        <td><?=$data_linen['jumlah']?></td>
                                                        <td><?= $data_linen['jenis']?></td>
                                                        <td>#PROSES-<?=$data_linen['id_proses_cuci']?></td>
                                                        <!-- <td class="text-nowrap">
                                                            <a href="javascript:void(0)" id="<?=$data_linen['id']?>" class="btn btn-danger waves-effect delete_linen"><i class="material-icons">clear</i></a></td> -->
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
                                    <h4 class="modal-title" id="defaultModalLabel">CARI LINEN KOTOR</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="" method="GET">
                                               
                                                <div class="form-group">
                                                    <label>Tanggal</label>
                                                    <div class="form-line">
                                            <input type="date" name="tanggal" class="datepicker form-control" placeholder="Pilih tanggal">
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
                //memunculkan pilihan kelas
                $('#ruang_linen').on('change', function(){
                    $('#linen_bersih').show();

                    var id_ruang = $('#ruang_linen').val();

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/laundry/linen-bersih/ambil_linen/",
                        data : {'id_ruang' : id_ruang},
                        async : false,
                        dataType : "json",
                        success : function(data){
                            var html = '';
                            var i;

                            for(i=0; i<data.length; i++){
                            html += '<tr><td> <input type="checkbox" name="ambil[]" id="ambil'+i+'" value="'+i+'" class="filled-in chk-col-pink"> <label for="ambil'+i+'"></label><input type="hidden" name="id_cuci'+i+'" value="'+data[i].id_cuci+'"></td><td>'+data[i].linen+' - '+data[i].kategori+'</td><td>'+data[i].kelas+'</td><td>'+data[i].jml_linen+' <input type="hidden" name="jumlah'+i+'" value="'+data[i].jml_linen+'"></td><td>Infeksius</td><td>#PROSES-'+data[i].proses_cuci+'</td><td class="text-nowrap"><a href="javascript:void(0)" onclick="reject('+data[i].id_cuci+')" id="'+data[i].id_cuci+'" class="btn btn-danger btn-sm waves-effect data_reject" data-toggle="modal" data-target="#modalReject"><i class="material-icons">clear</i></a></td></tr>';
                            }
                            $(".table_bersih").html(html);
                        }
                    })
                });
            </script>
            <script>
                function reject(data){
                    var id_linen = data;

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/laundry/linen-bersih/ambil_linen-reject/",
                        data : {'id_linen' : id_linen},
                        dataType : "json",
                        success : function(data){
                            $('#id_cuci_reject').val(data.id_cuci);
                            $('#nama_linen_reject').text(data.nama_linen);
                            $('#kelas_reject').text(data.ruang_kelas);
                        },
                    });
                }
            </script>

            <script>
                /* tabel */
                $(document).ready(function() {
                    $('#table_user_list').DataTable({
                        dom: 'Bfrtip',
                        responsive: true,
                        buttons: [{
                              extend: 'pdfHtml5',
                              title: 'Data Linen Bersih tanggal <?=$tanggalKet?>' 
                            },{
                                extend: 'excel',
                                title: 'Data Linen Bersih tanggal <?=$tanggalKet?>'
                            },
                            {
                                extend: 'print',
                                title: 'Data Linen Bersih tanggal <?=$tanggalKet?>'
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
                            $('.delete_linen').click(function() {
                                var dataId = this.id;
                                swal({
                                    title: "Apakah benar akan menghapus data Linen Bersih?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/laundry/linen-kotor/hapus/",
                                        data: {
                                            'id_linen_kotor': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>laundry/linen-kotor/?message_success";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>laundry/linen-kotor/?message_failed";
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