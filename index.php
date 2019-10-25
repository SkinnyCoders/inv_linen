<?php
//this file as router files
$uri = explode('?', $_SERVER['REQUEST_URI'], 2);

$base_url = 'http://localhost/dev/';

switch ($uri[0]) {
	case '/dev/':
		require __DIR__ . '/views/auth/v_login.php';
		break;

	/* Admin */

	case '/dev/admin/dashboard/':
		require __DIR__ . '/views/admin/v_dashboard.php';
		break;

	case '/dev/admin/user/tambah/':
		require __DIR__ . '/views/admin/user/v_addUser.php';
		break;

	case '/dev/controller/admin/user/add_new/':
		require __DIR__ . '/controller/Admin/add_user.php';
		break;

	case '/dev/controller/admin/user/ambil/':
		require __DIR__ . '/controller/Admin/get_user.php';
		break;

	case '/dev/admin/user/list/':
		require __DIR__ . '/views/admin/user/v_listUser.php';
		break;

	case '/dev/controller/admin/user/delete/':
		require __DIR__ . '/controller/Admin/delete_user.php';
		break;

	case '/dev/controller/admin/user/sunting/':
		require __DIR__ . '/controller/Admin/edit_user.php';
		break;

	case '/dev/admin/linen/kategori/':
		require __DIR__ . '/views/admin/linen/list_kategori.php';
		break;

	case '/dev/controller/admin/linen/tambah_kategori/':
		require __DIR__ .'/controller/Admin/add_category.php';
		break;

	case '/dev/controller/admin/linen/delete_kategori/':
		require __DIR__ .'/controller/Admin/delete_category.php';
		break;

	case '/dev/controller/admin/linen/ambil_kategori/':
		require __DIR__ . '/controller/Admin/get_category.php';
		break;

	case '/dev/controller/admin/linen/edit_kategori/':
		require __DIR__ . '/controller/Admin/edit_category.php';
		break;

	case '/dev/admin/linen/list/':
		require __DIR__ . '/views/admin/linen/list_linen.php';
		break;

	case '/dev/admin/ruang_kelas/':
		require __DIR__ . '/views/admin/ruang_kelas/v_ruang_kelas.php';
		break;

	case '/dev/controller/admin/ruang-kelas/tambah_kelas/':
		require __DIR__ . '/controller/Admin/add_class.php';
		break;

	case '/dev/controller/admin/ruang-kelas/get_kelas/':
		require __DIR__ . '/controller/Admin/get_class.php';
		break;

	case '/dev/controller/admin/ruang-kelas/update_kelas/':
		require __DIR__ . '/controller/Admin/edit_class.php';
		break;

	case '/dev/controller/admin/ruang-kelas/delete_kelas/':
		require __DIR__ . '/controller/Admin/delete_class.php';
		break;

	case '/dev/controller/admin/ruang-kelas/delete_ruang/':
		require __DIR__ . '/controller/Admin/delete_room.php';
		break;

	case '/dev/controller/admin/ruang-kelas/tambah_ruang/':
		require __DIR__ . '/controller/Admin/add_rooms.php';
		break;

	case '/dev/controller/admin/ruang-kelas/update_ruang/':
		require __DIR__ . '/controller/Admin/edit_room.php';
		break;

	case '/dev/controller/admin/linen/ambil_kelas/':
		require __DIR__ . '/controller/Admin/get_classRooms.php';
		break;

	case '/dev/controller/admin/linen/tambah_linen/':
		require __DIR__ . '/controller/Admin/add_linen.php';
		break;

	case '/dev/controller/admin/linen/delete_linen/':
		require __DIR__ . '/controller/Admin/delete_linen.php';
		break;

	case '/dev/controller/admin/linen/ambil_linen/':
		require __DIR__ . '/controller/Admin/get_linen.php';
		break;

	case '/dev/controller/admin/linen/update_linen/':
		require __DIR__ . '/controller/Admin/edit_linen.php';
		break;

	case '/dev/admin/perlengkapan/':
		require __DIR__ . '/views/admin/perlengkapan/list_perlengkapan.php';
		break;

	case '/dev/controller/admin/perlengkapan/tambah_perlengkapan/':
		require __DIR__ . '/controller/Admin/add_perlengkapan.php';
		break;

	case '/dev/controller/admin/perlengkapan/ambil_perlengkapan/':
		require __DIR__.'/controller/Admin/get_perlengkapan.php';
		break;

	case '/dev/controller/admin/perlengkapan/edit_perlengkapan/':
		require __DIR__ . '/controller/Admin/edit_perlengkapan.php';
		break;

	case '/dev/controller/admin/perlengkapan/delete_perlengkapan/':
		require __DIR__ . '/controller/Admin/delete_perlengkapan.php';
		break;

	/* end admin */

	/* Perawat */

	case '/dev/perawat/dashboard/':
		require __DIR__ . '/views/perawat/dashboard.php';
		break;

	case '/dev/perawat/permintaan/linen/':
		require __DIR__ . '/views/perawat/permintaan/permintaan_linen.php';
		break;

	case '/dev/perawat/permintaan/perlengkapan/':
		require __DIR__ . '/views/perawat/permintaan/permintaan_perlengkapan.php';
		break;

	case '/dev/controller/perawat/permintaan/linen/tambah/':
		require __DIR__ . '/controller/Perawat/add_permintaan_linen.php';
		break;

	case '/dev/perawat/penerimaan/linen/':
		require __DIR__ . '/views/perawat/penerimaan/penerimaan_linen.php';
		break;

	case '/dev/controller/perawat/permintaan/linen/ambil_permintaan/':
		require __DIR__ . '/controller/Perawat/get_permintaan_linen.php';
		break;

	case '/dev/controller/perawat/penerimaan/linen/tambah/':
		require __DIR__ . '/controller/Perawat/add_penerimaan_linen.php';
		break;

	case '/dev/controller/perawat/permintaan/linen/ambil_data_permintaan/':
		require __DIR__ . '/controller/Perawat/get_data_permintaan.php';
		break;

	case '/dev/controller/perawat/permintaan/linen/ubah/':
		require __DIR__ . '/controller/Perawat/update_permintaan.php';
		break;

	case '/dev/controller/perawat/permintaan/linen/hapus_permintaan/':
		require __DIR__ . '/controller/Perawat/delete_permintaan.php';
		break;

	case '/dev/controller/perawat/permintaan/linen/hapus_penerimaan/':
		require __DIR__ .'/controller/Perawat/delete_penerimaan.php';
		break;

	/* end Perawat */

	/* Laundry */
	case '/dev/laundry/dashboard/':
		require __DIR__ . '/views/petugasLaundry/dashboard.php';
		break;

	case '/dev/laundry/linen-kotor/':
		require __DIR__ . '/views/petugasLaundry/linen_kotor/pengambilan.php';
		break;

	case '/dev/controller/laundry/linen-kotor/ambil_linen/':
		require __DIR__ . '/controller/UnitLaundry/get_linenkotor.php';
		break;

	case '/dev/controller/laundry/linen-kotor/tambah_linen_kotor/':
		require __DIR__ . '/controller/UnitLaundry/add_linen_dirty.php';
		break;

	case '/dev/controller/laundry/linen-kotor/hapus/':
		require __DIR__ . '/controller/UnitLaundry/delete_linen_dirty.php';
		break;

	case '/dev/controller/laundry/linen-kotor/ambil_linen-kotor/':
		require __DIR__ .'/controller/UnitLaundry/get_linenKotorData.php';
		break;

	case '/dev/laundry/pencucian/':
		require __DIR__ . '/views/petugasLaundry/pencucian_linen/pencucian.php';
		break;

	case '/dev/controller/laundry/linen-kotor/update/':
		require __DIR__ . '/controller/UnitLaundry/edit_linen_dirty.php';
		break;

	case '/dev/controller/laundry/pencucian/ambil_linen_kotor/':
		require __DIR__ . '/controller/UnitLaundry/get_pencucian_linenkotor.php';
		break;

	case '/dev/controller/laundry/pencucian/proses/':
		require __DIR__ . '/controller/UnitLaundry/process_wash.php';
		break;

	case '/dev/laundry/linen-bersih/':
		require __DIR__ . '/views/petugasLaundry/linen_bersih/linen_bersih.php';
		break;

	case '/dev/controller/laundry/linen-bersih/ambil_linen/':
		require __DIR__ . '/controller/UnitLaundry/get_linen_bersih.php';
		break;

	case '/dev/controller/laundry/linen-bersih/tambah_linen_bersih/':
		require __DIR__ . '/controller/UnitLaundry/add_linen_clean.php';
		break;

	case '/dev/controller/laundry/linen-bersih/ambil_linen-reject/':
		require __DIR__ .'/controller/UnitLaundry/get_linen_reject.php';
		break;

	case '/dev/controller/laundry/linen-bersih/reject/':
		require __DIR__ . '/controller/UnitLaundry/proses_reject.php';
		break;

	case '/dev/laundry/permintaan/perlengkapan/':
		require __DIR__ . '/views/petugasLaundry/perlengkapan/permintaan_perlengkapan.php';
		break;

	case '/dev/laundry/penerimaan/perlengkapan/':
		require __DIR__ . '/views/petugasLaundry/perlengkapan/penerimaan_perlengkapan.php';
		break;

	/* end laundry */

		/* login page */
	case '/dev/login/':
		require __DIR__ . '/views/auth/v_login.php';
		break;

	case '/dev/logout/':
		require __DIR__ . '/controller/auth/c_logout.php';
		break;

	case '/dev/auth/login/':
		require __DIR__ . '/controller/auth/c_login.php';
		break;

	case '/dev/coba/':
		require __DIR__ . '/controller/auth/c_login.php';
		break;
		/* end login page */
	default:
		require 'views/404.php';
		break;
}
