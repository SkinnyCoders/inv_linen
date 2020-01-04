<div class="menu">
    <ul class="list">
        <li class="header">MENU</li>
        <?php
        if ($role == 1) { ?>
            <li>
                <a href="<?=$base_url?>kepala-unit/dashboard/">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">group</i>
                    <span>Data Linen</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/linen/daftar-linen/">Daftar Linen</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/linen/linen-hilang/">Linen Hilang & Rusak</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/linen/permintaan/">Permintaan Linen</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/linen/penerimaan/">Penerimaan Linen</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/linen/ketepatan/">Ketepatan Linen</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">group</i>
                    <span>Proses Pencucian</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/cuci/linen-kotor/">Pengambilan Linen Kotor</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/cuci/dicuci/">Sedang dicuci</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/cuci/linen-bersih">Linen Bersih</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/cuci/pengguna-perlengkapan/">Penggunaan Perlengkapan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">group</i>
                    <span>Data Perlengkapan</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/perlengkapan/list/">Daftar Perlengkapan</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/perlengkapan/permintaan/">Permintaan Perlengkapan</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>kepala-unit/perlengkapan/penerimaan/">Penerimaan Perlengkapan</a>
                    </li>
                </ul>
            </li>
            
            
            <li>
                <a href="<?php echo $base_url ?>kepala-unit/pengguna/list/">
                    <i class="material-icons">group</i>
                    <span>Data Pengguna</span>
                </a>
            </li>
        <?php
        //menu admin IT
        } elseif ($role == 2) { ?>
            <li>
                <a href="<?=$base_url?>admin/dashboard/">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">menu</i>
                    <span>Data Linen</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo $base_url ?>admin/linen/list/">Daftar Linen</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>admin/linen/kategori/">Kategori Linen</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo $base_url ?>admin/user/list/">
                    <i class="material-icons">group</i>
                    <span>Pengguna</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $base_url ?>admin/ruang_kelas/">
                    <i class="material-icons">location_city</i>
                    <span>Ruang & Kelas</span>
                </a>
            </li>
            
             <?php
            // menu petugas laundry
        }elseif ($role == 3) { ?>
            <li>
                <a href="<?=$base_url?>laundry/dashboard/">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">beenhere</i>
                    <span>Data Perlengkapan</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo $base_url ?>laundry/perlengkapan/">Data Perlengkapan</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>laundry/permintaan/perlengkapan/">Permintaan Perlengkapan</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>laundry/penerimaan/perlengkapan/">Penerimaan Perlengkapan</a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url ?>laundry/formula/">Formula Perlengkapan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?=$base_url?>laundry/linen-kotor/">
                    <i class="material-icons">home</i>
                    <span>Data Linen Kotor</span>
                </a>
            </li>
             <li>
                <a href="<?=$base_url?>laundry/pencucian/">
                    <i class="material-icons">home</i>
                    <span>Data Pencucian Linen</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $base_url ?>laundry/linen-bersih/">
                    <i class="material-icons">home</i>
                    <span>Data Linen Bersih</span>
                </a>
            </li>
            
        
        <?php

        }elseif ($role == 4) { ?>
            <li>
                <a href="<?=$base_url?>perawat/dashboard/">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $base_url ?>perawat/linen/daftar-linen/">
                    <i class="material-icons">menu</i>
                    <span>Data Linen<span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">menu</i>
                    <span>Data Permintaan</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo $base_url ?>perawat/permintaan/linen/">Permintaan Linen Baru</a>
                    </li>
                </ul>
            </li>
             <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">menu</i>
                    <span>Data Penerimaan</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo $base_url ?>perawat/penerimaan/linen/">Penerimaan Linen Baru</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo $base_url ?>perawat/linen/hilang-rusak/">
                    <i class="material-icons">menu</i>
                    <span>Data Linen Hilang & Rusak<span>
                </a>
            </li>

        <?php
        }

        ?>


    </ul>
</div>