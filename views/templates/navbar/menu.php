<div class="menu">
    <ul class="list">
        <li class="header">MENU</li>
        <?php
        if ($role == 1) { ?>
            <li>
                <a href="index.html">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">home</i>
                    <span>Linen</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Cards</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/cards/basic.html">Basic</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/colored.html">Colored</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/no-header.html">No Header</a>
                            </li>
                        </ul>
                    </li>
                </ul>
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