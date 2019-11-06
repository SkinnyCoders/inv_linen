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
                            <li><a href="javascript:void(0);">User</a></li>
                            <li class="active">Tambah User</li>
                        </ol>
                        <?php if (isset($_GET['message_success'])) { ?>
                            <!-- alert success -->
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Selamat, Data Pengguna berhasil ditambahkan!
                            </div>
                            <!-- end alert success -->
                        <?php } elseif (isset($_GET['message_failed'])) { ?>
                            <!-- alert failed -->
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Maaf, Data Pengguna gagal ditambahkan!, harap periksa lagi informasi yang diinputkan!.
                            </div>
                            <!-- end alert failed -->
                        <?php } ?>
                    </div>
                    <!-- Basic Examples -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <a href="<?= $base_url ?>admin/user/tambah/" class="btn btn-primary waves-effect pull-right"> <i class="material-icons">person_add</i> Tambah Pengguna</a>
                                    <h2>
                                        DAFTAR PENGGUNA
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table id="table_user_list" class="table table-striped table-hover" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th class="row-nama text-nowrap">Name</th>
                                                    <th class="row-posisi text-nowrap">Posisi</th>
                                                    <th class="row-gender text-nowrap">Jenis Kelamin</th>
                                                    <th class="row-aksi text-nowrap">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $getUser = mysqli_query($conn, "SELECT user.id_user, user.nama_user, level.nama_level, user.jenis_kel FROM `user` INNER JOIN level ON level.id_level=user.id_level WHERE 1");
                                                    while ($data_user = mysqli_fetch_assoc($getUser)) {
                                                        if ($data_user['jenis_kel'] == 'L') {
                                                            $gender = 'Laki - Laki';
                                                        } else {
                                                            $gender = 'Perempuan';
                                                        }

                                                ?>
                                                    <tr>
                                                        <td><?= ucwords($data_user['nama_user']) ?></td>
                                                        <td><?= ucwords($data_user['nama_level']) ?></td>
                                                        <td><?= ucwords($gender) ?></td>
                                                        <td class="text-nowrap"><a href="javascript:void(0)" id="<?=$data_user['id_user']?>" data-toggle="modal" data-target="#modalEdit" class="btn btn-info waves-effect m-r-20 edit"> EDIT</a>
                                                            <a href="javascript:void(0)" id="<?= $data_user['id_user'] ?>" class="btn btn-danger waves-effect edit_user">HAPUS</a></td>
                                                    </tr>
                                                <?php
                                                    }
                                                    $getUser->close();
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
                    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">Edit Pengguna</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- Basic Validation -->
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form id="form_validation" action="<?php echo $base_url ?>controller/admin/user/sunting/" method="POST">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="hidden" name="id_user" id="id_user" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="nama_user" class="form-control" name="surename" placeholder="Nama" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" name="gender" id="male" value="L" class="with-gap">
                                                    <label for="male">Laki - Laki</label>

                                                    <input type="radio" name="gender" id="female" value="P" class="with-gap">
                                                    <label for="female" class="m-l-20">Perempuan</label>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control show-tick m-t-20" name="as_user" id="as_user">
                                                            <option value="1">Kepala Unit</option>
                                                            <option value="2" selected>Admin</option>
                                                            <option value="3">Petugas Laundry</option>
                                                            <option value="4">Perawat</option>
                                                        </select>
                                                        <label for="as_user" class="form-label">Tambahkan pengguna sebagai</label>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect">SAVE CHANGES</button>
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
                            $('.edit_user').click(function() {
                                var dataId = this.id;
                                swal({
                                    title: "Apakah benar akan menghapus data pengguna?",
                                    text: "Jika anda menekan Ya, Maka data akan terhapus secara permanen oleh sistem.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#ef5350",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                }, function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= $base_url ?>controller/admin/user/delete/",
                                        data: {
                                            'id_user': dataId
                                        },
                                        success: function(respone) {
                                            window.location.href = "<?= $base_url ?>admin/user/list/?message_success=Data Pengguna Berhasil Dihapus!.";
                                        },
                                        error: function(request, error) {
                                            window.location.href = "<?= $base_url ?>admin/user/list/?message_failed=Data Pengguna Gagal Dihapus!.";
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
                    var user_id = this.id;
                    $.ajax({
                        type : "POST",
                        url : "<?=$base_url?>controller/admin/user/ambil/",
                        data : {'id_user' : user_id},
                        dataType : "json",
                        success : function(data){
                            $('#id_user').val(data.id_user);
                            $('#nama_user').val(data.nama);
                            $('#username').val(data.username);
                            $('#email').val(data.email);
                            $('#as_user').val(data.id_level).trigger();
                            $("input[name='gender'][value='"+data.gender+"']").prop('checked');
                            
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