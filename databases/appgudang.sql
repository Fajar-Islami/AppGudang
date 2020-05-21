-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 08:37 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appgudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_hak_akses`
--

CREATE TABLE `app_hak_akses` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_menu`
--

CREATE TABLE `app_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_menu`
--

INSERT INTO `app_menu` (`id`, `menu`) VALUES
(1, 'Menu'),
(2, 'Transaksi'),
(3, 'User Management');

-- --------------------------------------------------------

--
-- Table structure for table `app_sub_menu`
--

CREATE TABLE `app_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `judul` varchar(20) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_sub_menu`
--

INSERT INTO `app_sub_menu` (`id`, `menu_id`, `judul`, `url`, `icon`, `status`) VALUES
(1, 1, 'Barang', 'admin/index', 'fas fa-fw fa-tachometer-alt', 0),
(2, 2, 'Barang Keluar', 'transaksi/keluar', 'far fa-fw fa-inbox-out', 0),
(3, 2, 'Barang Masuk', 'transaksi/keluar', 'far fa-fw fa-inbox-in', 0),
(4, 3, 'Peraturan User', 'user/index', 'fas fa-fw fa-users', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `Id_Barang` int(11) NOT NULL,
  `Nama_Barang` varchar(50) DEFAULT NULL,
  `Stok` int(11) NOT NULL,
  `Satuan_Id` int(11) DEFAULT NULL,
  `Jenis_Id` int(11) DEFAULT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`Id_Barang`, `Nama_Barang`, `Stok`, `Satuan_Id`, `Jenis_Id`, `user_id`) VALUES
(1, 'mouse', 70, 1, 1, '1317099_Fajar'),
(9, 'a', 10, 1, 1, '1317099_Fajar'),
(10, 'b', 0, 1, 1, '1317099_Fajar'),
(11, 'komputer', 1, 1, 2, '1317099_Fajar');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_keluar`
--

CREATE TABLE `data_barang_keluar` (
  `Id_Barang_Keluar` int(11) NOT NULL,
  `Id_User` varchar(128) DEFAULT NULL,
  `Id_Barang` int(11) DEFAULT NULL,
  `Jumlah_Keluar` int(11) DEFAULT NULL,
  `Tanggal_Keluar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang_keluar`
--

INSERT INTO `data_barang_keluar` (`Id_Barang_Keluar`, `Id_User`, `Id_Barang`, `Jumlah_Keluar`, `Tanggal_Keluar`) VALUES
(1, '1317099_Fajar', 1, 10, '2020-05-02'),
(2, '1317099_Fajar', 1, 20, '2020-05-02');

--
-- Triggers `data_barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_barang_keluar` AFTER INSERT ON `data_barang_keluar` FOR EACH ROW UPDATE `data_barang` SET `data_barang`.`stok` = `data_barang`.`stok` - NEW.jumlah_keluar WHERE `data_barang`.`id_barang` = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `Id_Barang_Masuk` int(11) NOT NULL,
  `Id_User` varchar(128) DEFAULT NULL,
  `Id_Barang` int(11) DEFAULT NULL,
  `Jumlah_Masuk` int(11) DEFAULT NULL,
  `Tanggal_Masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang_masuk`
--

INSERT INTO `data_barang_masuk` (`Id_Barang_Masuk`, `Id_User`, `Id_Barang`, `Jumlah_Masuk`, `Tanggal_Masuk`) VALUES
(3, '1317099_Fajar', 1, 100, '2020-05-01'),
(5, '1317099_Fajar', 9, 10, '2020-05-01'),
(6, '1317099_Fajar', 11, 1, '2020-05-03');

--
-- Triggers `data_barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_barang_masuk` AFTER INSERT ON `data_barang_masuk` FOR EACH ROW UPDATE `data_barang` SET `data_barang`.`stok` = `data_barang`.`stok` + NEW.jumlah_masuk WHERE `data_barang`.`id_barang` = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `data_jenis`
--

CREATE TABLE `data_jenis` (
  `Id_Jenis` int(11) NOT NULL,
  `Nama_Jenis` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_jenis`
--

INSERT INTO `data_jenis` (`Id_Jenis`, `Nama_Jenis`) VALUES
(1, 'Laptop'),
(2, 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `data_satuan`
--

CREATE TABLE `data_satuan` (
  `Id_Satuan` int(11) NOT NULL,
  `Nama_Satuan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_satuan`
--

INSERT INTO `data_satuan` (`Id_Satuan`, `Nama_Satuan`) VALUES
(1, 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `data_supplier`
--

CREATE TABLE `data_supplier` (
  `Id_Supplier` int(11) NOT NULL,
  `Nama_Supplier` varchar(50) DEFAULT NULL,
  `No_Telepon` varchar(12) DEFAULT NULL,
  `Alamat` varchar(100) DEFAULT NULL,
  `Id_Jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_supplier`
--

INSERT INTO `data_supplier` (`Id_Supplier`, `Nama_Supplier`, `No_Telepon`, `Alamat`, `Id_Jenis`) VALUES
(1, 'Fajar', '1317099', 'Jakarta', 1),
(2, 'Ahmad', '1234', 'Jakarta', 1),
(3, 'Fajar', '0896', 'Jakarta', 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `Id_User` varchar(100) NOT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Tanggal_Buat` date DEFAULT NULL,
  `role_id` enum('1','2') DEFAULT NULL,
  `Nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`Id_User`, `Password`, `Tanggal_Buat`, `role_id`, `Nama`) VALUES
('1317099_Fajar', '1234', '2020-05-01', '1', 'Ahmad Fajar Islami'),
('fajar_user', '12345', '2020-05-02', '2', 'Fajar Islami'),
('tanggal', '123', '2020-04-30', '1', 'haloo'),
('user', '12345', '2020-05-01', '2', 'User Tes1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_hak_akses`
--
ALTER TABLE `app_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_menu`
--
ALTER TABLE `app_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_sub_menu`
--
ALTER TABLE `app_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`Id_Barang`),
  ADD KEY `Jenis_Id` (`Jenis_Id`),
  ADD KEY `Satuan_Id` (`Satuan_Id`);

--
-- Indexes for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  ADD PRIMARY KEY (`Id_Barang_Keluar`),
  ADD KEY `Id_Barang` (`Id_Barang`),
  ADD KEY `Id_User` (`Id_User`);

--
-- Indexes for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD PRIMARY KEY (`Id_Barang_Masuk`),
  ADD KEY `Id_Barang` (`Id_Barang`),
  ADD KEY `Id_User` (`Id_User`);

--
-- Indexes for table `data_jenis`
--
ALTER TABLE `data_jenis`
  ADD PRIMARY KEY (`Id_Jenis`);

--
-- Indexes for table `data_satuan`
--
ALTER TABLE `data_satuan`
  ADD PRIMARY KEY (`Id_Satuan`);

--
-- Indexes for table `data_supplier`
--
ALTER TABLE `data_supplier`
  ADD PRIMARY KEY (`Id_Supplier`),
  ADD KEY `Id_Jenis` (`Id_Jenis`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`Id_User`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_hak_akses`
--
ALTER TABLE `app_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_menu`
--
ALTER TABLE `app_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_sub_menu`
--
ALTER TABLE `app_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `Id_Barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  MODIFY `Id_Barang_Keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `Id_Barang_Masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_jenis`
--
ALTER TABLE `data_jenis`
  MODIFY `Id_Jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_satuan`
--
ALTER TABLE `data_satuan`
  MODIFY `Id_Satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_supplier`
--
ALTER TABLE `data_supplier`
  MODIFY `Id_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `data_barang_ibfk_2` FOREIGN KEY (`Satuan_Id`) REFERENCES `data_satuan` (`Id_Satuan`);

--
-- Constraints for table `data_supplier`
--
ALTER TABLE `data_supplier`
  ADD CONSTRAINT `data_supplier_ibfk_1` FOREIGN KEY (`Id_Jenis`) REFERENCES `data_jenis` (`Id_Jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
