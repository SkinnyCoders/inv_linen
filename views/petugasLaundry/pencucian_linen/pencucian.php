<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

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
                        <h2>PENCUCIAN LINEN KOTOR</h2>
                        <ol class="breadcrumb align-right">
                            <li><a href="javascript:void(0);">Dashboard</a></li>
                            <li><a href="javascript:void(0);">Pencucian Linen</a></li>
                            <li class="active">Daftar Pencucian Linen</li>
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
                                    <a href="javascript:void(0)" class="btn btn-primary waves-effect pull-right" data-toggle="modal" data-target="#modalAdd">Tambah Proses Cuci</a>
                                    <h2>
                                        DAFTAR LINEN DICUCI - <?=date('d F Y')?>
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;" class="text-nowrap">No</th>
                                                    <th style="width: 10%;" class="text-nowrap">Id Proses</th>
                                                    <th style="width: 25%;" class="text-nowrap">Nama Linen - Kategori</th>
                                                    <th style="width: 20%;" class="text-nowrap">Ruang - Kelas</th>
                                                    <th style="width: 10%;" class="text-nowrap">Jumlah</th>
                                                    <th style="width: 20%;">Jenis Cuci</th>
                                                    <th style="width: 10%;" class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $tanggal = date('Y-m-d');
                                                    $getLinenKotor = mysqli_query($conn, "SELECT pencucian.id_pencucian AS id, pencucian.id_proses_cuci, linen.nama_linen, kategori.nama_kategori, ruang.nama_ruang, kelas.nama_kelas, jenis.jumlah, jenis.jenis FROM `pencucian` INNER JOIN linen_kotor AS kotor ON kotor.id_linen_kotor=pencucian.id_linen_kotor INNER JOIN jenis_linen_kotor AS jenis ON jenis.id_jenis_linen_kotor=pencucian.id_jenis_linen_kotor INNER JOIN linen ON linen.id_linen=kotor.id_linen INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas WHERE DATE(`tgl_cuci`) = '$tanggal' AND pencucian.`status` = 'cuci' ORDER BY linen.nama_linen ASC");
                                                    while ($data_linen = mysqli_fetch_assoc($getLinenKotor)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td>#PROSES - <?=$data_linen['id_proses_cuci']?></td>
                                                        <td><?= ucwords($data_linen['nama_linen']) . ' - ' . ucwords($data_linen['nama_kategori']); ?></td>
                                                        
                                                        <td><?= ucwords($data_linen['nama_ruang']) ?> - <?=ucwords($data_linen['nama_kelas'])?></td>
                                                        <td><?=$data_linen['jumlah']?></td>
                                                        <td><?= $data_linen['jenis']?></td>
                                                        <td class="text-nowrap">
                                                            <a href="javascript:void(0)" id="<?=$data_linen['id']?>" class="btn btn-danger waves-effect delete_linen">HAPUS</a></td>
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
                                    <?php 
                                    $tanggal_sekarang = date('Y-m-d');
                                    //select id sebelumnya
                                    $getId = mysqli_query($conn, "SELECT id_proses_cuci FROM pencucian WHERE DATE(tgl_cuci) = '$tanggal_sekarang' ORDER BY id_pencucian DESC limit 1");
                                    if (mysqli_num_rows($getId) > 0) {
                                        $result = mysqli_fetch_assoc($getId);
                                        $id_proses = $result['id_proses_cuci'] + 1;
                                    }else{
                                        $id_proses = '1';
                                    }
                                     ?>
                                    <h4 class="modal-title" id="defaultModalLabel">PROSES CUCI LINEN KOTOR #PROSES - <?=$id_proses?></h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/laundry/pencucian/proses/" method="POST">
                                                <div class="form-group">
                                                    <input type="hidden" name="id_proses" value="<?=$id_proses?>">
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="id_petugas" id="petugas" required>
                                                            <?php 
                                                            $sqlPetugas = mysqli_query($conn, "SELECT `id_user`,`nama_user` FROM `user` WHERE `id_level` = 3 ORDER BY nama_user ASC");
                                                            while ($dataPetugas = mysqli_fetch_assoc($sqlPetugas)) {
                                                             ?>
                                                            <option value="<?=$dataPetugas['id_user']?>"><?=$dataPetugas['nama_user']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="petugas" class="form-label">Pilih Petugas</label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="jenis" id="ruang_linen" required>
                                                            <option>Pilih Jenis</option>
                                                            <option value="infeksius">Infeksius</option>
                                                            <option value="non infeksius">Non Infeksius</option>
                                                        </select>
                                                        <label for="ruang_linen" class="form-label">Pilih Jenis</label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive" style="display: none" id="linen_kotor">
                                                <table id="table_user_list" class="table table-hover" style="width: 100%">
                                                    <thead style="background-color: #eee;">
                                                        <tr>
                                                            <th style="width: 5%;" class="text-nowrap">Cuci</th>
                                                            <th style="width: 30%;" class="text-nowrap">Nama Linen - Kategori</th>
                                                            <th style="width: 30%;" class="text-nowrap">Ruang - Kelas</th>
                                                            <th style="width: 10%;" class="text-nowrap">jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table_kotor">
                                                        
                                                    </tbody>
                                                </table>
                                                </div>
                                                <div class="form-group form-float" id="perlengkapan" style="display: none">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="formula" id="formula_perlengkapan" required>
                                                            <option>Pilih Formula</option>
                                                            
                                                        </select>
                                                        <label for="ruang_linen" class="form-label">Pilih Formula</label>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                                <button type="submit" name="simpan" class="btn btn-primary waves-effect">PROSES</button>
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
                $('#ruang_linen').on('change', function(){
                    $('#linen_kotor').show();
                    $('#perlengkapan').show();

                    var id_ruang = $('#ruang_linen').val();

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/laundry/pencucian/ambil_linen_kotor/",
                        data : {'id_ruang' : id_ruang},
                        async : false,
                        dataType : "json",
                        success : function(data){
                            var html = '';
                            var i;
                            var no = 1;

                            for(i=0; i<data.length; i++){

                            html += '<tr><td> <input type="checkbox" name="ambil[]" id="ambil'+i+'" value="'+i+'" class="filled-in chk-col-pink"> <label for="ambil'+i+'"></label><input type="hidden" name="id_linen'+i+'" value="'+data[i].id_linen_kotor+'"> <input type="hidden" name="id_jenis_linen'+i+'" value="'+data[i].id_jenis_linen_kotor+'"></td><td>'+data[i].linen+' - '+data[i].kategori+'</td><td>'+data[i].ruang+' - '+data[i].kelas+'</td><td>'+data[i].jumlah+'</td></tr>';
                            }
                            console.log(html);
                            $(".table_kotor").html(html);
                        }
                    });

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/laundry/pencucian/ambil_formula/",
                        data : {'id_ruang' : id_ruang},
                        async : false,
                        dataType : "json",
                        success : function(data){
                            var html = '';
                            var i;

                            //for(i=0; i<data.length; i++){
                                // for(j=0; j<data[i].komposisi.length; j++){
                                //     $html2 += '<span>'+data[i].komposisi[j].jumlah+'</span>';
                                // }
                           // }

                            for(i=0; i<data.length; i++){
                                html += '<option value="'+data[i].id_formula+'">'+data[i].nama_formula;
                                for(j=0; j<data[i].komposisi.length; j++){
                                    html += ' ( '+data[i].komposisi[j].perlengkapan+' - '+data[i].komposisi[j].jumlah+' ML )</option>';
                                }
                            }
                            $("#formula_perlengkapan").html(html);
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
                                            window.location.href = "<?= $base_url ?>admin/linen/list/?message_success=Selamat, proses pencucian berhasil dihapus!!!";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>admin/linen/list/?message_failed=Maaf, proses pencucian gagal dihapus!!!";
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