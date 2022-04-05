-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 05:51 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kresna`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `barcode` char(50) DEFAULT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `harga` char(100) DEFAULT NULL,
  `stok` char(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `barcode`, `nama`, `harga`, `stok`) VALUES
(16, '8994075230412', 'Momogi', '1000', '199'),
(17, '8994096219434', 'Lemon Tea', '5000', '396'),
(18, '8996001354124', 'Beng beng', '2000', '1994');

-- --------------------------------------------------------

--
-- Stand-in structure for view `barang_beli_list`
-- (See below for the actual view)
--
CREATE TABLE `barang_beli_list` (
`id_beli_barang` int(11)
,`id_barang` int(11)
,`id_pembelian` int(11)
,`banyak_beli` char(20)
,`harga_beli` char(100)
,`jumlah` double
,`barcode` char(50)
,`nama` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `beli_barang`
--

CREATE TABLE `beli_barang` (
  `id_beli_barang` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `banyak_beli` char(20) DEFAULT NULL,
  `harga_beli` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli_barang`
--

INSERT INTO `beli_barang` (`id_beli_barang`, `id_barang`, `id_pembelian`, `banyak_beli`, `harga_beli`) VALUES
(61, 17, 45, '200', '1500'),
(62, 17, 45, '200', '4000'),
(66, 16, 47, '200', '500'),
(67, 18, 47, '2000', '1000');

--
-- Triggers `beli_barang`
--
DELIMITER $$
CREATE TRIGGER `barang_beli_tambah` AFTER INSERT ON `beli_barang` FOR EACH ROW BEGIN
	update barang set stok=stok+new.`banyak_beli` where id_barang=new.`id_barang`;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beli_barang_batal` BEFORE DELETE ON `beli_barang` FOR EACH ROW BEGIN
	update barang set stok=stok-old.`banyak_beli` where id_barang=old.`id_barang`;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jual_barang`
--

CREATE TABLE `jual_barang` (
  `id_jual_barang` int(11) NOT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `banyak_jual` char(20) DEFAULT NULL,
  `harga_jual` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual_barang`
--

INSERT INTO `jual_barang` (`id_jual_barang`, `id_penjualan`, `id_barang`, `banyak_jual`, `harga_jual`) VALUES
(3, 35, 18, '1', '2000'),
(4, 35, 18, '1', '2000'),
(5, 35, 18, '1', '2000'),
(6, 35, 16, '1', '1000'),
(8, 37, 18, '1', '2000'),
(9, 37, 17, '1', '5000'),
(10, 37, 17, '1', '5000'),
(11, 37, 17, '1', '5000'),
(13, 37, 18, '1', '2000'),
(14, 37, 18, '1', '2000'),
(15, 37, 17, '1', '5000');

--
-- Triggers `jual_barang`
--
DELIMITER $$
CREATE TRIGGER `barang_jual_hapus` BEFORE DELETE ON `jual_barang` FOR EACH ROW BEGIN
	update barang set stok=stok+old.banyak_jual where id_barang=old.id_barang;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `barang_jual_tambah` AFTER INSERT ON `jual_barang` FOR EACH ROW BEGIN
	update barang set stok=stok-new.banyak_jual where id_barang=new.id_barang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `kode` char(14) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `kode`, `waktu`, `id_supplier`, `id_pengguna`) VALUES
(43, '20220317114950', '2022-03-17 11:49:50', 2, 10),
(44, '20220317115204', '2022-03-17 11:52:04', 1, 10),
(45, '20220317122544', '2022-03-17 12:25:44', 1, 10),
(46, '20220321095029', '2022-03-21 09:50:29', 1, 10),
(47, '20220321100842', '2022-03-21 10:08:42', 1, 10);

--
-- Triggers `pembelian`
--
DELIMITER $$
CREATE TRIGGER `beli_barang_hapus` BEFORE DELETE ON `pembelian` FOR EACH ROW BEGIN
	delete from beli_barang where id_pembelian=old.id_pembelian;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `pembelian_list`
-- (See below for the actual view)
--
CREATE TABLE `pembelian_list` (
`id_pembelian` int(11)
,`kode` char(14)
,`waktu` datetime
,`nama` varchar(200)
,`total` double
);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` char(100) NOT NULL,
  `password` char(100) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `status` enum('offline','online') DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `nama`, `level`, `status`) VALUES
(10, 'yun', '5f1d65f27e370c36dfd845f6dc78b869', 'yun', '2', 'online'),
(12, 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'tes', '3', 'online'),
(14, 'tzu', 'ac627ab1ccbdb62ec96e702f07f6425b', 'Chou Tzuyu', '1', 'online'),
(15, 'yuna', 'a06e99d8638b422af5b11805d9a9f33f', 'Shin Yuna', '1', 'online'),
(16, 'jihyo', '192dcec6293f01dd33aa8e2ae30b05f9', 'Park Jihyo', '2', 'online'),
(17, 'nay', '79d3f42ed60bb21b8cbf1b9da8dd82d7', 'Im Nayeon', '3', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode` char(14) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kode`, `waktu`, `id_pengguna`) VALUES
(25, '20220317114147', '2022-03-17 11:41:47', 12),
(26, '20220317115309', '2022-03-17 11:53:09', 12),
(27, '20220317115403', '2022-03-17 11:54:03', 12),
(28, '20220317115446', '2022-03-17 11:54:46', 12),
(29, '20220317122142', '2022-03-17 12:21:42', 12),
(30, '20220317122637', '2022-03-17 12:26:37', 12),
(31, '20220317123033', '2022-03-17 12:30:33', 12),
(32, '20220319084723', '2022-03-19 08:47:23', 12),
(33, '20220319122814', '2022-03-19 12:28:14', 12),
(34, '20220321095219', '2022-03-21 09:52:19', 12),
(35, '20220321100605', '2022-03-21 10:06:05', 12),
(36, '20220321100634', '2022-03-21 10:06:34', 12),
(37, '20220321102141', '2022-03-21 10:21:41', 12);

--
-- Triggers `penjualan`
--
DELIMITER $$
CREATE TRIGGER `penjualan_hapus` BEFORE DELETE ON `penjualan` FOR EACH ROW BEGIN
	delete from jual_barang where id_penjualan=old.id_penjualan;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `penjualan_list`
-- (See below for the actual view)
--
CREATE TABLE `penjualan_list` (
`id_penjualan` int(11)
,`kode` char(14)
,`waktu` datetime
,`id_pengguna` int(11)
,`nama` varchar(150)
,`total` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `struk_jual`
-- (See below for the actual view)
--
CREATE TABLE `struk_jual` (
`id_jual_barang` int(11)
,`id_penjualan` int(11)
,`id_barang` int(11)
,`banyak_jual` char(20)
,`harga_jual` char(50)
,`jumlah` double
,`barcode` char(50)
,`nama` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `telp` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `telp`) VALUES
(1, 'Toko', 'Jalan', '08237713567'),
(2, 'Toko', 'Jalan jalan', '08283918273'),
(3, 'JYP mart', 'Seoul', '08218387367812'),
(4, 'YG mart', 'Gangnam', '082543424365');

-- --------------------------------------------------------

--
-- Structure for view `barang_beli_list`
--
DROP TABLE IF EXISTS `barang_beli_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `barang_beli_list`  AS  (select `beli_barang`.`id_beli_barang` AS `id_beli_barang`,`beli_barang`.`id_barang` AS `id_barang`,`beli_barang`.`id_pembelian` AS `id_pembelian`,`beli_barang`.`banyak_beli` AS `banyak_beli`,`beli_barang`.`harga_beli` AS `harga_beli`,(`beli_barang`.`banyak_beli` * `beli_barang`.`harga_beli`) AS `jumlah`,`barang`.`barcode` AS `barcode`,`barang`.`nama` AS `nama` from (`beli_barang` join `barang`) where (`beli_barang`.`id_barang` = `barang`.`id_barang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `pembelian_list`
--
DROP TABLE IF EXISTS `pembelian_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pembelian_list`  AS  (select `pembelian`.`id_pembelian` AS `id_pembelian`,`pembelian`.`kode` AS `kode`,`pembelian`.`waktu` AS `waktu`,`supplier`.`nama` AS `nama`,sum((`beli_barang`.`banyak_beli` * `beli_barang`.`harga_beli`)) AS `total` from ((`supplier` join `pembelian`) join `beli_barang`) where ((`supplier`.`id_supplier` = `pembelian`.`id_supplier`) and (`pembelian`.`id_pembelian` = `beli_barang`.`id_pembelian`)) group by `pembelian`.`id_pembelian`) ;

-- --------------------------------------------------------

--
-- Structure for view `penjualan_list`
--
DROP TABLE IF EXISTS `penjualan_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `penjualan_list`  AS  (select `penjualan`.`id_penjualan` AS `id_penjualan`,`penjualan`.`kode` AS `kode`,`penjualan`.`waktu` AS `waktu`,`penjualan`.`id_pengguna` AS `id_pengguna`,`pengguna`.`nama` AS `nama`,sum((`jual_barang`.`banyak_jual` * `jual_barang`.`harga_jual`)) AS `total` from ((`penjualan` join `jual_barang`) join `pengguna`) where ((`penjualan`.`id_penjualan` = `jual_barang`.`id_penjualan`) and (`pengguna`.`id_pengguna` = `penjualan`.`id_pengguna`)) group by `penjualan`.`id_penjualan`) ;

-- --------------------------------------------------------

--
-- Structure for view `struk_jual`
--
DROP TABLE IF EXISTS `struk_jual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `struk_jual`  AS  (select `jual_barang`.`id_jual_barang` AS `id_jual_barang`,`jual_barang`.`id_penjualan` AS `id_penjualan`,`jual_barang`.`id_barang` AS `id_barang`,`jual_barang`.`banyak_jual` AS `banyak_jual`,`jual_barang`.`harga_jual` AS `harga_jual`,(`jual_barang`.`banyak_jual` * `jual_barang`.`harga_jual`) AS `jumlah`,`barang`.`barcode` AS `barcode`,`barang`.`nama` AS `nama` from (`barang` join `jual_barang`) where (`barang`.`id_barang` = `jual_barang`.`id_barang`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `beli_barang`
--
ALTER TABLE `beli_barang`
  ADD PRIMARY KEY (`id_beli_barang`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indexes for table `jual_barang`
--
ALTER TABLE `jual_barang`
  ADD PRIMARY KEY (`id_jual_barang`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `beli_barang`
--
ALTER TABLE `beli_barang`
  MODIFY `id_beli_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `jual_barang`
--
ALTER TABLE `jual_barang`
  MODIFY `id_jual_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli_barang`
--
ALTER TABLE `beli_barang`
  ADD CONSTRAINT `beli_barang_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `beli_barang_ibfk_3` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`);

--
-- Constraints for table `jual_barang`
--
ALTER TABLE `jual_barang`
  ADD CONSTRAINT `jual_barang_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `jual_barang_ibfk_3` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
