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
                            <li><a href="javascript:void(0);">Perawat</a></li>
                            <li class="active">Daftar Linen Hilang & Rusak</li>
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
                                        DAFTAR LINEN HILANG & RUSAK
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
                                                    <th style="width: 10%;" class="text-nowrap">jumlah</th>
                                                    <th style="width: 10%;" class="text-nowrap">Status</th>
                                                    <th style="width: 15%;" class="text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                    $getLinen = mysqli_query($conn, "SELECT linen_hilang.id_linen_hilang AS id,linen.nama_linen, kategori.nama_kategori, ruang.nama_ruang, kelas.nama_kelas, linen_hilang.jumlah, linen_hilang.status FROM `linen_hilang` INNER JOIN linen ON linen.id_linen=linen_hilang.id_linen INNER JOIN kategori ON kategori.id_kategori=linen.id_kategori INNER JOIN ruang ON ruang.id_ruang=linen.id_ruang INNER JOIN kelas ON kelas.id_kelas=linen.id_kelas WHERE ruang.id_ruang =".$_SESSION['id_ruang']);
                                                    while ($data_linen = mysqli_fetch_assoc($getLinen)) {
                                                        if ($data_linen['status'] == 'hilang') {
                                                            $style = "label-danger";
                                                            $status = "Hilang";
                                                        }else{
                                                            $style = 'label-warning';
                                                            $status = "Rusak";
                                                        }
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td <?=$style?>><?= ucwords($data_linen['nama_linen']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_kategori']) ?></td>
                                                        <td><?= ucwords($data_linen['nama_ruang']) ?> - <?=ucwords($data_linen['nama_kelas'])?></td>
                                                        
                                                        <td><?= $data_linen['jumlah']?></td>
                                                        <td><h4><span class="label <?=$style?>"><?=$status?></span></h4></label></td>
                                                        <td class="text-nowrap"><a href="javascript:void(0)"  id="<?=$data_linen['id']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-info waves-effect m-r-20 edit_permintaan"> EDIT</a>
                                                            <a href="javascript:void(0)" id="<?=$data_linen['id']?>" class="btn btn-danger waves-effect delete_permintaan">HAPUS</a></td>
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

                    <!-- Modal add data -->
                    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">LINEN HILANG & RUSAK</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/perawat/linen-hilang/tambah/" method="POST">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="ruang" id="ruang_linen" required>
                                                            <?php 
                                                            $sqlKelas = mysqli_query($conn, "SELECT * FROM ruang WHERE 1 ORDER BY id_ruang ASC");
                                                            while ($dataKelas = mysqli_fetch_assoc($sqlKelas)) {
                                                             ?>
                                                            <option value="<?=$dataKelas['id_ruang']?>"><?=$dataKelas['nama_ruang']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="ruang_linen" class="form-label">* Pilih Ruang</label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive" style="display: none" id="linen_rusak">
                                                    <table id="table_user_list" class="table table-hover" style="width: 100%">
                                                        <thead style="background-color: #eee;">
                                                            <tr>
                                                                <th style="width: 5%;" class="text-nowrap">Pilih</th>
                                                                <th style="width: 30%;" class="text-nowrap">Nama Linen - Kategori</th>
                                                                <th style="width: 15%;" class="text-nowrap">Kelas</th>
                                                                <th style="width: 10%;" class="text-nowrap">Stok</th>
                                                                <th style="width: 15%;" class="text-nowrap">Jumlah</th>
                                                                <th style="width: 17%;">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table_linen">
                                                            
                                                        </tbody>
                                                    </table>
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

                    <!-- Modal update data -->
                    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">EDIT LINEN HILANG & RUSAK</h4>
                                    <small class="text-muted"><span class="nama_linen"></span> di <span class="update_ruang"></span>  <span class="update_kelas"></span></small>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/perawat/linen-hilang/ubah/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <!-- <input type="text" class="form-control" name="linen_baru" id="update_nama_linen" placeholder="* Nama Linen Baru" required> -->
                                                        <input type="hidden" name="id_linen" class="id_linen_hilang" id="update_id" value="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    
                                                    <div class="form-line">
                                                        <label for="update_jumlah" class="form-label text-muted">* Jumlah</label>
                                                        <input type="number" min="1" class="form-control" name="jumlah_linen" id="update_jumlah" placeholder="* Jumlah Linen" required>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="status" id="update_status" required>
                                                            <option value="hilang">Hilang</option>
                                                            <option value="rusak">Rusak</option>
                                                        </select>
                                                        <label for="kategori" class="form-label">* Status</label>
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
                    $('#linen_rusak').show();

                    var id_ruang = $('#ruang_linen').val();

                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/laundry/linen-kotor/ambil_linen/",
                        data : {'id_ruang' : id_ruang},
                        async : false,
                        dataType : "json",
                        success : function(data){
                            var html = '';
                            var i;
                            var no = 1;

                            for(i=0; i<data.length; i++){
                            html += '<tr><td> <input type="checkbox" name="ambil[]" id="ambil'+i+'" value="'+i+'" class="filled-in chk-col-pink"> <label for="ambil'+i+'"></label><input type="hidden" name="id_linen'+i+'" value="'+data[i].id_linen+'"></td><td>'+data[i].linen+' - '+data[i].kategori+'</td><td>'+data[i].kelas+'</td><td>'+data[i].jumlah+'</td><td><input type="number" class="form-control" name="jumlah'+i+'"></td><td><select name="status_hilang'+i+'" class="form-control"><option value="rusak">Rusak</option><option value="hilang">Hilang</option></select></td></tr>';
                            }
                            console.log(html);
                            $(".table_linen").html(html);
                        }
                    })
                });
            </script>

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
                                    title: "Apakah benar akan menghapus data linen hilang & rusak?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/perawat/linen-hilang/hapus/",
                                        data: {
                                            'id_linen': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>perawat/linen/hilang-rusak/?message_success=Selamat, Data Linen Hilang/Rusak Berhasil Dihapus!!!";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>perawat/linen/hilang-rusak/?message_failed=Maaf, Data Linen Hilang/Rusak Gagal Dihapus!!!";
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
                        url : "<?=$base_url?>controller/perawat/linen-hilang/ambil_linen_hilang/",
                        data : {'id_linen_hilang' : id_minta},
                        dataType : "json",
                        success : function(data){
                            $('.id_linen_hilang').val(data.id);
                           $('.nama_linen').text(data.nama_linen);
                           $('.update_ruang').text(data.ruang);
                           $('.update_kelas').text(data.kelas);
                           $('#update_kategori').text(data.kategori);
                           $('#update_jumlah').val(data.jumlah);
                           $('#update_status').val(data.status).trigger();
                           
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