-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 07:45 AM
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
-- Database: `db_penjualan`
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
(5, '123', 'Surabi', '3000', '0'),
(10, 'xyz', 'Tes', '1000', '130'),
(11, 'xcv', 'Fuding', '3000', '200');

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
(31, 11, 26, '200', '2000'),
(32, 10, 27, '90', '1000'),
(33, 10, 28, '10', '1000'),
(34, 10, 29, '10', '1000'),
(35, 10, 29, '20', '1000');

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
(20, '20220308070347', '2022-03-08 07:03:47', 1, 10),
(21, '20220308080316', '2022-03-08 08:03:16', 1, 10),
(22, '20220308080345', '2022-03-08 08:03:45', 1, 10),
(23, '20220308080348', '2022-03-08 08:03:48', 1, 10),
(24, '20220308080350', '2022-03-08 08:03:50', 1, 10),
(25, '20220308080350', '2022-03-08 08:03:50', 1, 10),
(26, '20220308080356', '2022-03-08 08:03:56', 1, 10),
(27, '20220308090353', '2022-03-08 09:03:53', 1, 10),
(28, '20220308090358', '2022-03-08 09:03:58', 1, 10),
(29, '20220308100300', '2022-03-08 10:03:00', 1, 10),
(30, '20220308100349', '2022-03-08 10:03:49', 1, 10),
(31, '20220308100352', '2022-03-08 10:03:52', 1, 10),
(32, '20220308110312', '2022-03-08 11:03:12', 1, 10);

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
  `level` enum('1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `nama`, `level`) VALUES
(9, 'tzu', 'ac627ab1ccbdb62ec96e702f07f6425b', 'Tzuyu', '1'),
(10, 'yun', '70b8fe090143d5778c8a26ae17e21df5', 'yun', '2'),
(12, 'tes', '47d40767c7e9df50249ebfd9c7cfff77', 'tes', '3');

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
(1, 'Toko', 'Jalan', '08237713567');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `penjualan_list`  AS  (select `penjualan`.`id_penjualan` AS `id_penjualan`,`penjualan`.`waktu` AS `waktu`,`penjualan`.`id_pengguna` AS `id_pengguna`,`pengguna`.`nama` AS `nama`,sum((`jual_barang`.`banyak_jual` * `jual_barang`.`harga_jual`)) AS `total` from ((`penjualan` join `jual_barang`) join `pengguna`) where ((`penjualan`.`id_penjualan` = `jual_barang`.`id_penjualan`) and (`pengguna`.`id_pengguna` = `penjualan`.`id_pengguna`)) group by `penjualan`.`id_penjualan`) ;

-- --------------------------------------------------------

--
-- Structure for view `struk_jual`
--
DROP TABLE IF EXISTS `struk_jual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `struk_jual`  AS  (select `jual_barang`.`id_jual_barang` AS `id_jual_barang`,`jual_barang`.`id_barang` AS `id_barang`,`jual_barang`.`banyak_jual` AS `banyak_jual`,`jual_barang`.`harga_jual` AS `harga_jual`,(`jual_barang`.`banyak_jual` * `jual_barang`.`harga_jual`) AS `jumlah`,`barang`.`barcode` AS `barcode`,`barang`.`nama` AS `nama` from (`barang` join `jual_barang`) where (`barang`.`id_barang` = `jual_barang`.`id_barang`)) ;

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `beli_barang`
--
ALTER TABLE `beli_barang`
  MODIFY `id_beli_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `jual_barang`
--
ALTER TABLE `jual_barang`
  MODIFY `id_jual_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
