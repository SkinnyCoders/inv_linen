-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2019 at 04:47 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sicom_linen`
--

-- --------------------------------------------------------

--
-- Table structure for table `jumlah_proses_pencucian`
--

CREATE TABLE `jumlah_proses_pencucian` (
  `id_jumlah_proses_pencucian` int(11) NOT NULL,
  `id_proses_cuci` int(11) NOT NULL,
  `tanggal_cuci` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis_pencucian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jumlah_proses_pencucian`
--

INSERT INTO `jumlah_proses_pencucian` (`id_jumlah_proses_pencucian`, `id_proses_cuci`, `tanggal_cuci`, `jenis_pencucian`) VALUES
(3, 1, '2019-10-06 13:55:49', 'infeksius'),
(4, 1, '2019-10-08 19:50:09', 'infeksius'),
(5, 2, '2019-10-08 20:25:03', 'infeksius');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(4, 'Sarung'),
(6, 'selimut');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(5) NOT NULL,
  `nama_kelas` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'Kelas VIP'),
(2, 'vvip'),
(3, 'kelas normal'),
(4, 'kelas bersalin 1'),
(5, 'mawar'),
(9, 'kelas berat'),
(10, 'kelas 1');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(5) NOT NULL,
  `nama_level` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'kepala unit'),
(2, 'petugas IT'),
(3, 'unit laundry'),
(4, 'perawat');

-- --------------------------------------------------------

--
-- Table structure for table `linen`
--

CREATE TABLE `linen` (
  `id_linen` int(11) NOT NULL,
  `nama_linen` varchar(30) DEFAULT NULL,
  `id_ruang` int(5) DEFAULT NULL,
  `id_kelas` int(5) DEFAULT NULL,
  `id_penerimaan_linen_baru` int(11) DEFAULT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `jml_linen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `linen`
--

INSERT INTO `linen` (`id_linen`, `nama_linen`, `id_ruang`, `id_kelas`, `id_penerimaan_linen_baru`, `id_kategori`, `jml_linen`) VALUES
(1, 'linen 1', 3, 1, NULL, 4, 10),
(2, 'linen 2', 3, 2, NULL, 4, 10),
(3, 'linen 3', 3, 3, NULL, 4, 20);

-- --------------------------------------------------------

--
-- Table structure for table `linen_bersih`
--

CREATE TABLE `linen_bersih` (
  `id_linen_bersih` int(11) NOT NULL,
  `id_pencucian` int(11) DEFAULT NULL,
  `jml_linen_bersih` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('bersih') DEFAULT 'bersih'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `linen_bersih`
--

INSERT INTO `linen_bersih` (`id_linen_bersih`, `id_pencucian`, `jml_linen_bersih`, `tgl`, `status`) VALUES
(2, 4, 10, '2019-10-09 23:33:24', 'bersih');

-- --------------------------------------------------------

--
-- Table structure for table `linen_kotor`
--

CREATE TABLE `linen_kotor` (
  `id_linen_kotor` int(11) NOT NULL,
  `id_linen` int(11) DEFAULT NULL,
  `jml_linen_kotor` int(11) DEFAULT NULL,
  `id_user` int(5) DEFAULT NULL,
  `jenis_linen_kotor` enum('infeksius','non infeksius') DEFAULT NULL,
  `tgl_pengambilan` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('kotor','bersih') DEFAULT 'kotor',
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `linen_kotor`
--

INSERT INTO `linen_kotor` (`id_linen_kotor`, `id_linen`, `jml_linen_kotor`, `id_user`, `jenis_linen_kotor`, `tgl_pengambilan`, `status`, `keterangan`) VALUES
(6, 1, 10, 17, 'infeksius', '2019-10-06 13:55:04', 'kotor', NULL),
(7, 2, 10, 17, 'infeksius', '2019-10-06 13:55:04', 'kotor', NULL),
(8, 3, 10, 17, 'non infeksius', '2019-10-06 13:55:04', 'kotor', NULL),
(10, 3, 6, 17, 'infeksius', '2019-10-08 00:48:32', 'kotor', NULL),
(13, 1, 4, 17, 'infeksius', '2019-10-08 20:23:16', 'kotor', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `linen_reject`
--

CREATE TABLE `linen_reject` (
  `id_linen_reject` int(11) NOT NULL,
  `id_pencucian` int(11) DEFAULT NULL,
  `jml_linen_reject` int(11) DEFAULT NULL,
  `tgl_reject` datetime DEFAULT NULL,
  `status` enum('reject') DEFAULT 'reject',
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pencucian`
--

CREATE TABLE `pencucian` (
  `id_pencucian` int(11) NOT NULL,
  `id_proses_cuci` int(11) NOT NULL,
  `id_linen_kotor` int(11) DEFAULT NULL,
  `tgl_cuci` datetime DEFAULT CURRENT_TIMESTAMP,
  `jml_cuci` int(11) DEFAULT NULL,
  `status` enum('cuci','bersih') DEFAULT 'cuci'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pencucian`
--

INSERT INTO `pencucian` (`id_pencucian`, `id_proses_cuci`, `id_linen_kotor`, `tgl_cuci`, `jml_cuci`, `status`) VALUES
(3, 1, 6, '2019-10-06 13:55:48', 10, 'cuci'),
(4, 1, 10, '2019-10-08 19:50:08', 10, 'bersih'),
(6, 2, 13, '2019-10-08 20:25:03', 10, 'cuci');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_linen_baru`
--

CREATE TABLE `penerimaan_linen_baru` (
  `id_penerimaan_linen_baru` int(11) NOT NULL,
  `id_permintaan_linen_baru` int(11) DEFAULT NULL,
  `jml_diterima` int(11) DEFAULT NULL,
  `tgl_diterima` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('diterima') DEFAULT 'diterima',
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_perlengkapan`
--

CREATE TABLE `penerimaan_perlengkapan` (
  `id_penerimaan_perlengkapan` int(11) NOT NULL,
  `id_permintaan_perlengkapan` int(11) DEFAULT NULL,
  `jml_diterima` int(11) DEFAULT NULL,
  `tgl_penerimaan` datetime DEFAULT NULL,
  `status` enum('diterima','belum diterima') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan_perlengkapan`
--

CREATE TABLE `penggunaan_perlengkapan` (
  `id_jumlah_proses_pencucian` int(11) NOT NULL,
  `id_perlengkapan` int(11) DEFAULT NULL,
  `jml_penggunaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan_perlengkapan`
--

INSERT INTO `penggunaan_perlengkapan` (`id_jumlah_proses_pencucian`, `id_perlengkapan`, `jml_penggunaan`) VALUES
(3, 2, 100),
(4, 2, 100),
(5, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `perlengkapan`
--

CREATE TABLE `perlengkapan` (
  `id_perlengkapan` int(11) NOT NULL,
  `nama_perlengkapan` varchar(30) DEFAULT NULL,
  `jenis` varchar(30) DEFAULT NULL,
  `manfaat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perlengkapan`
--

INSERT INTO `perlengkapan` (`id_perlengkapan`, `nama_perlengkapan`, `jenis`, `manfaat`) VALUES
(1, 'Rinso', 'cair', 'Penghilang noda'),
(2, 'Molto', 'cair', 'pemutih');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_linen_baru`
--

CREATE TABLE `permintaan_linen_baru` (
  `id_permintaan_linen_baru` int(11) NOT NULL,
  `nama_linen_baru` varchar(25) DEFAULT NULL,
  `id_user` int(5) DEFAULT NULL,
  `id_ruang` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `tgl_permintaan` datetime DEFAULT CURRENT_TIMESTAMP,
  `jml_permintaan` int(11) DEFAULT NULL,
  `status` enum('setuju','tidak setuju','belum','diterima') DEFAULT 'belum',
  `id_kategori` int(5) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_linen_baru`
--

INSERT INTO `permintaan_linen_baru` (`id_permintaan_linen_baru`, `nama_linen_baru`, `id_user`, `id_ruang`, `id_kelas`, `tgl_permintaan`, `jml_permintaan`, `status`, `id_kategori`, `keterangan`) VALUES
(1, 'linen 1', 16, 3, 1, '2019-09-18 00:20:23', 6, 'tidak setuju', 4, 'untuk pengganti hilang'),
(2, 'test server', 16, 3, 3, '2019-10-05 10:47:21', 10, 'setuju', 6, 'untuk pengganti hilang');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_perlengkapan`
--

CREATE TABLE `permintaan_perlengkapan` (
  `id_permintaan_perlengkapan` int(11) NOT NULL,
  `nama_perlengkapan` varchar(30) DEFAULT NULL,
  `id_user` int(5) DEFAULT NULL,
  `tgl_permintaan` datetime DEFAULT NULL,
  `jml_permintaan` int(11) DEFAULT NULL,
  `status` enum('setuju','tidak setuju') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(5) NOT NULL,
  `nama_ruang` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`) VALUES
(1, 'rrrr'),
(2, 'rrrr'),
(3, 'Bersalin'),
(4, 'Gigi');

-- --------------------------------------------------------

--
-- Table structure for table `ruang_kelas`
--

CREATE TABLE `ruang_kelas` (
  `id_kelas` int(5) NOT NULL,
  `id_ruang` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang_kelas`
--

INSERT INTO `ruang_kelas` (`id_kelas`, `id_ruang`) VALUES
(1, 3),
(2, 3),
(3, 3),
(5, 4),
(9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `id_level` int(5) DEFAULT NULL,
  `jenis_kel` enum('L','P') DEFAULT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `email`, `password`, `id_level`, `jenis_kel`, `register_date`) VALUES
(14, 'Rizki', 'rizki', 'laughzsec@gmail.com', '$2y$10$sRWiBo6.r7014SRTBnURx.mfPOCY4F8vojEDgjzbVCvYJpNlAln9i', 2, 'L', '2019-09-11 19:39:50'),
(15, 'Siti Nurbaya', 'siti', 'siti@gmail.com', '$2y$10$AC5Gtn7aXQCOqvT/qxpH2uWRrAITxMCIpV56jVfwOIuEJZDRZ3oha', 4, 'P', '2019-09-12 12:57:39'),
(16, 'Dini', 'dini', 'dini@gmail.com', '$2y$10$TcCbJj4G.Kz3hPB8tBklBe1p4aJCSYeACZ7f.zyvUvNFshdFnEMbO', 4, 'P', '2019-09-17 23:27:20'),
(17, 'Gigi', 'gigi', 'gigi@gmail.com', '$2y$10$Pm3Xhe.mbEdSS2aQNaPcdeMPeU66BvXxOJ58N5NgHub.GBAM6I4ku', 3, 'P', '2019-10-02 21:10:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jumlah_proses_pencucian`
--
ALTER TABLE `jumlah_proses_pencucian`
  ADD PRIMARY KEY (`id_jumlah_proses_pencucian`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `linen`
--
ALTER TABLE `linen`
  ADD PRIMARY KEY (`id_linen`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_penerimaan_linen_baru` (`id_penerimaan_linen_baru`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `linen_bersih`
--
ALTER TABLE `linen_bersih`
  ADD PRIMARY KEY (`id_linen_bersih`),
  ADD KEY `id_pencucian` (`id_pencucian`);

--
-- Indexes for table `linen_kotor`
--
ALTER TABLE `linen_kotor`
  ADD PRIMARY KEY (`id_linen_kotor`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `linen_kotor_ibfk_2` (`id_linen`);

--
-- Indexes for table `linen_reject`
--
ALTER TABLE `linen_reject`
  ADD PRIMARY KEY (`id_linen_reject`),
  ADD KEY `id_pencucian` (`id_pencucian`);

--
-- Indexes for table `pencucian`
--
ALTER TABLE `pencucian`
  ADD PRIMARY KEY (`id_pencucian`),
  ADD KEY `id_linen_kotor` (`id_linen_kotor`);

--
-- Indexes for table `penerimaan_linen_baru`
--
ALTER TABLE `penerimaan_linen_baru`
  ADD PRIMARY KEY (`id_penerimaan_linen_baru`),
  ADD KEY `id_permintaan_linen_baru` (`id_permintaan_linen_baru`);

--
-- Indexes for table `penerimaan_perlengkapan`
--
ALTER TABLE `penerimaan_perlengkapan`
  ADD PRIMARY KEY (`id_penerimaan_perlengkapan`),
  ADD KEY `id_permintaan_perlengkapan` (`id_permintaan_perlengkapan`);

--
-- Indexes for table `penggunaan_perlengkapan`
--
ALTER TABLE `penggunaan_perlengkapan`
  ADD KEY `id_jumlah_proses_pencucian` (`id_jumlah_proses_pencucian`),
  ADD KEY `id_perlengkapan` (`id_perlengkapan`);

--
-- Indexes for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  ADD PRIMARY KEY (`id_perlengkapan`);

--
-- Indexes for table `permintaan_linen_baru`
--
ALTER TABLE `permintaan_linen_baru`
  ADD PRIMARY KEY (`id_permintaan_linen_baru`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `permintaan_perlengkapan`
--
ALTER TABLE `permintaan_perlengkapan`
  ADD PRIMARY KEY (`id_permintaan_perlengkapan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `ruang_kelas`
--
ALTER TABLE `ruang_kelas`
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_ruang` (`id_ruang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `user_ibfk_1` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jumlah_proses_pencucian`
--
ALTER TABLE `jumlah_proses_pencucian`
  MODIFY `id_jumlah_proses_pencucian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `linen`
--
ALTER TABLE `linen`
  MODIFY `id_linen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `linen_bersih`
--
ALTER TABLE `linen_bersih`
  MODIFY `id_linen_bersih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `linen_kotor`
--
ALTER TABLE `linen_kotor`
  MODIFY `id_linen_kotor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `linen_reject`
--
ALTER TABLE `linen_reject`
  MODIFY `id_linen_reject` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pencucian`
--
ALTER TABLE `pencucian`
  MODIFY `id_pencucian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penerimaan_linen_baru`
--
ALTER TABLE `penerimaan_linen_baru`
  MODIFY `id_penerimaan_linen_baru` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penerimaan_perlengkapan`
--
ALTER TABLE `penerimaan_perlengkapan`
  MODIFY `id_penerimaan_perlengkapan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  MODIFY `id_perlengkapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permintaan_linen_baru`
--
ALTER TABLE `permintaan_linen_baru`
  MODIFY `id_permintaan_linen_baru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permintaan_perlengkapan`
--
ALTER TABLE `permintaan_perlengkapan`
  MODIFY `id_permintaan_perlengkapan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `linen`
--
ALTER TABLE `linen`
  ADD CONSTRAINT `linen_ibfk_1` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linen_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linen_ibfk_4` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linen_ibfk_5` FOREIGN KEY (`id_penerimaan_linen_baru`) REFERENCES `penerimaan_linen_baru` (`id_penerimaan_linen_baru`);

--
-- Constraints for table `linen_bersih`
--
ALTER TABLE `linen_bersih`
  ADD CONSTRAINT `linen_bersih_ibfk_1` FOREIGN KEY (`id_pencucian`) REFERENCES `pencucian` (`id_pencucian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `linen_kotor`
--
ALTER TABLE `linen_kotor`
  ADD CONSTRAINT `linen_kotor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linen_kotor_ibfk_2` FOREIGN KEY (`id_linen`) REFERENCES `linen` (`id_linen`) ON DELETE CASCADE;

--
-- Constraints for table `linen_reject`
--
ALTER TABLE `linen_reject`
  ADD CONSTRAINT `linen_reject_ibfk_1` FOREIGN KEY (`id_pencucian`) REFERENCES `pencucian` (`id_pencucian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pencucian`
--
ALTER TABLE `pencucian`
  ADD CONSTRAINT `pencucian_ibfk_1` FOREIGN KEY (`id_linen_kotor`) REFERENCES `linen_kotor` (`id_linen_kotor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penerimaan_linen_baru`
--
ALTER TABLE `penerimaan_linen_baru`
  ADD CONSTRAINT `penerimaan_linen_baru_ibfk_1` FOREIGN KEY (`id_permintaan_linen_baru`) REFERENCES `permintaan_linen_baru` (`id_permintaan_linen_baru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penerimaan_perlengkapan`
--
ALTER TABLE `penerimaan_perlengkapan`
  ADD CONSTRAINT `penerimaan_perlengkapan_ibfk_1` FOREIGN KEY (`id_permintaan_perlengkapan`) REFERENCES `permintaan_perlengkapan` (`id_permintaan_perlengkapan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penggunaan_perlengkapan`
--
ALTER TABLE `penggunaan_perlengkapan`
  ADD CONSTRAINT `penggunaan_perlengkapan_ibfk_1` FOREIGN KEY (`id_jumlah_proses_pencucian`) REFERENCES `jumlah_proses_pencucian` (`id_jumlah_proses_pencucian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penggunaan_perlengkapan_ibfk_2` FOREIGN KEY (`id_perlengkapan`) REFERENCES `perlengkapan` (`id_perlengkapan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permintaan_linen_baru`
--
ALTER TABLE `permintaan_linen_baru`
  ADD CONSTRAINT `permintaan_linen_baru_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permintaan_linen_baru_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permintaan_linen_baru_ibfk_3` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`),
  ADD CONSTRAINT `permintaan_linen_baru_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `permintaan_perlengkapan`
--
ALTER TABLE `permintaan_perlengkapan`
  ADD CONSTRAINT `permintaan_perlengkapan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruang_kelas`
--
ALTER TABLE `ruang_kelas`
  ADD CONSTRAINT `ruang_kelas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ruang_kelas_ibfk_2` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
