<?php
include_once 'controller/auth/c_rememberme.php';

include_once 'views/templates/head.php';
include_once 'librarys/functionSalam.php';
date_default_timezone_set('Asia/Bangkok');
$jam = date("H:i:s");

 ?>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Sistem Informasi Monitoring Linen</b></a>
            <small>Silahkan login terlebih dahulu</small>
        </div>
        <div class="card">
            <div class="body">
                <form action="<?= $base_url ?>auth/login/" method="POST">
                    <div class="msg"><?= salam($jam) ?>,Silahkan Login!</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username atau Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" name="auth" type="submit">Sign In</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6 col-xs-offset-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include_once 'views/templates/footer.php';

    ?>