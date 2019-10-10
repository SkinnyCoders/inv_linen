<?php
session_start();
session_unset();
session_destroy();

if (isset($_GET['a'])) {
	if ($_GET['a'] == 'tidak sah') {
    	header('location:' . $base_url . 'login/?message_failed=Upss anda tidak memiliki hak akses');
	} elseif ($_GET['a'] == 'belum login') {
	    header('location:' . $base_url . 'login/?message_failed=Upss anda harus login terlebih dahulu');
	}
}else{
	header('location:'. $base_url . 'login/');
}
