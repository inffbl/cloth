-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2019 at 01:55 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_detail_pinjam` int(25) NOT NULL,
  `id_inventaris` int(25) NOT NULL,
  `kode_inventaris` varchar(25) NOT NULL,
  `jumlah` int(25) NOT NULL,
  `id_peminjaman` int(25) NOT NULL,
  `status_peminjaman` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id_detail_pinjam`, `id_inventaris`, `kode_inventaris`, `jumlah`, `id_peminjaman`, `status_peminjaman`) VALUES
(20, 7, 'BR003', 7, 35, 'Sudah'),
(21, 7, 'BR003', 2, 36, 'Sudah'),
(22, 7, 'BR003', 2, 37, 'Sudah'),
(23, 6, 'BR002', 4, 38, 'Sudah'),
(24, 7, 'BR003', 4, 39, 'Sudah'),
(25, 7, 'BR003', 5, 42, 'Sudah'),
(26, 6, 'BR002', 3, 43, 'Sudah'),
(27, 7, 'BR003', 10, 44, 'Sudah'),
(28, 6, 'BR002', 2, 45, 'Sudah'),
(29, 7, 'BR003', 4, 46, 'Belum');

--
-- Triggers `detail_pinjam`
--
DELIMITER $$
CREATE TRIGGER `peminjaman` AFTER INSERT ON `detail_pinjam` FOR EACH ROW BEGIN
UPDATE inventaris SET jumlah = jumlah - NEW.jumlah
     WHERE kode_inventaris = NEW.kode_inventaris;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengembalian` AFTER UPDATE ON `detail_pinjam` FOR EACH ROW BEGIN
UPDATE inventaris SET jumlah = jumlah + OLD.jumlah
     WHERE kode_inventaris = OLD.kode_inventaris;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` int(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kondisi` varchar(500) NOT NULL DEFAULT 'Baik',
  `keterangan` varchar(500) NOT NULL DEFAULT 'Tidak Ada',
  `jumlah` int(25) NOT NULL,
  `id_jenis` int(25) NOT NULL,
  `tanggal_register` date NOT NULL,
  `id_ruang` int(25) NOT NULL,
  `kode_inventaris` varchar(25) NOT NULL,
  `id_petugas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `nama`, `kondisi`, `keterangan`, `jumlah`, `id_jenis`, `tanggal_register`, `id_ruang`, `kode_inventaris`, `id_petugas`) VALUES
(5, 'Speaker', 'Baik', 'Tidak Ada', 5, 1, '2019-04-29', 2, 'BR001', 'PET001'),
(6, 'Mic', 'Baik', 'Tidak Ada', 9, 1, '2019-04-29', 1, 'BR002', 'PET001'),
(7, 'asa', 'Baik', 'Tidak Ada', 13, 1, '2019-04-30', 3, 'BR003', 'PET001');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(25) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `kode_jenis` varchar(25) NOT NULL,
  `keterangan` varchar(500) NOT NULL DEFAULT 'Tidak Ada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `kode_jenis`, `keterangan`) VALUES
(1, 'Elektronik', 'J001', 'Tidak Ada'),
(3, 'Furnitur', 'J002', 'Tidak Ada'),
(5, 'Kebersihan', 'J003', 'Tidak Ada');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` varchar(25) NOT NULL,
  `nama_level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
('lev001', 'admin'),
('lev002', 'operator');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id_maintenance` varchar(25) NOT NULL,
  `id_inventaris` int(25) NOT NULL,
  `kode_inventaris` varchar(25) NOT NULL,
  `jumlah` int(25) NOT NULL,
  `kondisi` varchar(255) NOT NULL DEFAULT 'Rusak',
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(25) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nip`, `alamat`, `username`, `password`, `level`) VALUES
('PEG001', 'Hashfi Ihkamuddin', '11605508', 'Bogor', 'hshfhkmddn', 'aGFzaGZpMDA3', 'pegawai'),
('PEG002', 'Ikhsan Maulana', '11605598', 'Bogor', 'ikhsan', 'ikhsan', 'pegawai'),
('PEG003', 'dani', '11605507', 'Cibedug', 'dani', 'dani', 'pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(25) NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status_peminjaman` varchar(255) DEFAULT NULL,
  `id_pegawai` varchar(25) NOT NULL,
  `id_petugas` varchar(25) NOT NULL,
  `keterang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `kode_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `status_peminjaman`, `id_pegawai`, `id_petugas`, `keterang`) VALUES
(35, 'PN001', '2019-04-30', '2019-04-30', 'Sudah', 'PEG001', 'PET001', ''),
(36, 'PN002', '2019-04-30', '0000-00-00', 'sudah', 'PEG001', 'PET001', '2 rusak'),
(37, 'PN003', '2019-04-30', '2019-04-30', 'Sudah', 'PEG001', 'PET001', ''),
(38, 'PN004', '2019-04-30', '2019-04-30', 'Sudah', 'PEG001', 'PET001', ''),
(39, 'PN005', '2019-04-30', '2019-04-30', 'Sudah', 'PEG001', 'PET001', ''),
(42, 'PN006', '2019-04-30', '2019-04-30', 'Sudah', 'PEG001', 'PET001', ''),
(43, 'PN007', '2019-04-30', '2019-04-30', 'Sudah', 'PEG001', 'PET001', ''),
(44, 'PN008', '2019-04-30', '0000-00-00', 'Belum', 'PEG001', 'PET001', '2 rusak\r\n'),
(45, 'PN009', '2019-04-30', '2019-04-30', 'Sudah', 'PEG001', 'PET001', '3 rusak'),
(46, 'PN010', '2019-04-30', '0000-00-00', 'Belum', 'PEG001', 'PET001', '');

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `balikin` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
UPDATE detail_pinjam SET status_peminjaman = 'Sudah'
     WHERE id_peminjaman = OLD.id_peminjaman;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` varchar(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `id_level` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `id_level`, `level`) VALUES
('PET001', 'admin', 'YWRtaW4=', 'Admin', '1', 'admin'),
('PET002', 'operator', 'b3BlcmF0b3I=', 'Operator', '2', 'operator');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(25) NOT NULL,
  `nama_ruang` varchar(255) NOT NULL,
  `kode_ruang` varchar(25) NOT NULL,
  `keterangan` varchar(500) NOT NULL DEFAULT 'Tidak Ada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `kode_ruang`, `keterangan`) VALUES
(1, 'Gudang Pajajaran', 'R001', 'Tidak Ada'),
(2, 'Gudang Siliwangi', 'R002', 'Tidak Ada'),
(3, 'Gudang Mewah', 'R003', 'Tidak Ada');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_barang`
-- (See below for the actual view)
--
CREATE TABLE `view_barang` (
`kode_inventaris` varchar(25)
,`nama` varchar(255)
,`nama_jenis` varchar(255)
,`nama_ruang` varchar(255)
,`jumlah` int(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_detailbarang`
-- (See below for the actual view)
--
CREATE TABLE `view_detailbarang` (
`kode_inventaris` varchar(25)
,`nama` varchar(255)
,`kondisi` varchar(500)
,`keterangan` varchar(500)
,`jumlah` int(25)
,`nama_jenis` varchar(255)
,`nama_ruang` varchar(255)
,`tanggal_register` date
,`nama_petugas` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_detaillaporan`
-- (See below for the actual view)
--
CREATE TABLE `view_detaillaporan` (
`kode_peminjaman` varchar(255)
,`nama_pegawai` varchar(255)
,`tanggal_pinjam` date
,`tanggal_kembali` date
,`status_peminjaman` varchar(255)
,`kode_inventaris` varchar(25)
,`nama` varchar(255)
,`kondisi` varchar(500)
,`nama_jenis` varchar(255)
,`nama_ruang` varchar(255)
,`jumlah` int(25)
,`keterang` varchar(255)
,`id_petugas` varchar(25)
);

-- --------------------------------------------------------

--
-- Structure for view `view_barang`
--
DROP TABLE IF EXISTS `view_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_barang`  AS  select `m1`.`kode_inventaris` AS `kode_inventaris`,`m1`.`nama` AS `nama`,`m2`.`nama_jenis` AS `nama_jenis`,`m3`.`nama_ruang` AS `nama_ruang`,`m1`.`jumlah` AS `jumlah` from ((`inventaris` `m1` join `jenis` `m2` on((`m1`.`id_jenis` = `m2`.`id_jenis`))) join `ruang` `m3` on((`m1`.`id_ruang` = `m3`.`id_ruang`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_detailbarang`
--
DROP TABLE IF EXISTS `view_detailbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detailbarang`  AS  select `m1`.`kode_inventaris` AS `kode_inventaris`,`m1`.`nama` AS `nama`,`m1`.`kondisi` AS `kondisi`,`m1`.`keterangan` AS `keterangan`,`m1`.`jumlah` AS `jumlah`,`m2`.`nama_jenis` AS `nama_jenis`,`m3`.`nama_ruang` AS `nama_ruang`,`m1`.`tanggal_register` AS `tanggal_register`,`m4`.`nama_petugas` AS `nama_petugas` from (((`inventaris` `m1` join `jenis` `m2` on((`m1`.`id_jenis` = `m2`.`id_jenis`))) join `ruang` `m3` on((`m1`.`id_ruang` = `m3`.`id_ruang`))) join `petugas` `m4` on((`m1`.`id_petugas` = `m4`.`id_petugas`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_detaillaporan`
--
DROP TABLE IF EXISTS `view_detaillaporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detaillaporan`  AS  select `m1`.`kode_peminjaman` AS `kode_peminjaman`,`m6`.`nama_pegawai` AS `nama_pegawai`,`m1`.`tanggal_pinjam` AS `tanggal_pinjam`,`m1`.`tanggal_kembali` AS `tanggal_kembali`,`m1`.`status_peminjaman` AS `status_peminjaman`,`m2`.`kode_inventaris` AS `kode_inventaris`,`m3`.`nama` AS `nama`,`m3`.`kondisi` AS `kondisi`,`m4`.`nama_jenis` AS `nama_jenis`,`m5`.`nama_ruang` AS `nama_ruang`,`m2`.`jumlah` AS `jumlah`,`m1`.`keterang` AS `keterang`,`m1`.`id_petugas` AS `id_petugas` from (((((`peminjaman` `m1` join `detail_pinjam` `m2` on((`m1`.`id_peminjaman` = `m2`.`id_peminjaman`))) join `inventaris` `m3` on((`m2`.`id_inventaris` = `m3`.`id_inventaris`))) join `jenis` `m4` on((`m3`.`id_jenis` = `m4`.`id_jenis`))) join `ruang` `m5` on((`m3`.`id_ruang` = `m5`.`id_ruang`))) join `pegawai` `m6` on((`m1`.`id_pegawai` = `m6`.`id_pegawai`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id_detail_pinjam`),
  ADD KEY `id_inventaris` (`id_inventaris`,`id_peminjaman`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `kode_inventaris` (`kode_inventaris`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`),
  ADD KEY `id_jenis` (`id_jenis`,`id_ruang`,`id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_ruang` (`id_ruang`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id_maintenance`),
  ADD KEY `id_inventaris` (`id_inventaris`),
  ADD KEY `kode_inventaris` (`kode_inventaris`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_pegawai` (`id_pegawai`,`id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id_detail_pinjam` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_inventaris` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD CONSTRAINT `detail_pinjam_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`);

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `inventaris_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`),
  ADD CONSTRAINT `inventaris_ibfk_3` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
