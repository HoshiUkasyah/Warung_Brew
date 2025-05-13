-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 05:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warungbrew`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` bigint(20) NOT NULL,
  `nominal_uang` bigint(20) NOT NULL,
  `total_bayar` bigint(20) NOT NULL,
  `waktu_bayar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `nominal_uang`, `total_bayar`, `waktu_bayar`) VALUES
(2505122140705, 122222222, 83000, '2025-05-13 05:44:18'),
(2505122142869, 400000, 26000, '2025-05-13 05:46:31'),
(2505131527612, 400000, 316000, '2025-05-13 08:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_menu`
--

CREATE TABLE `tb_kategori_menu` (
  `id_kat_menu` int(11) NOT NULL,
  `jenis_menu` int(2) NOT NULL,
  `kategori_menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori_menu`
--

INSERT INTO `tb_kategori_menu` (`id_kat_menu`, `jenis_menu`, `kategori_menu`) VALUES
(1, 1, 'Nasi'),
(2, 1, 'Snack'),
(3, 1, 'Mie'),
(4, 2, 'Jus'),
(5, 2, 'Teh'),
(7, 2, 'Kopi'),
(8, 1, 'Seafood');

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_order`
--

CREATE TABLE `tb_list_order` (
  `id_list_order` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `kode_order` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `catatan` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_list_order`
--

INSERT INTO `tb_list_order` (`id_list_order`, `menu`, `kode_order`, `jumlah`, `catatan`, `status`) VALUES
(4, 16, 2505122142869, 2, '', 2),
(5, 15, 2505122140705, 3, 'proses', 2),
(8, 16, 2505122140705, 3, '', 0),
(9, 17, 2505122140705, 1, 'mo', 2),
(10, 15, 2505131527612, 12, 'hola', 0),
(11, 17, 2505131527612, 14, '123', 0),
(12, 16, 2505122141916, 45, '', 0),
(13, 18, 2505122141916, 20, '', 0),
(14, 20, 2505122141916, 24, '', 0),
(15, 19, 2505132031100, 12, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `kategori` int(2) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id`, `foto`, `nama_menu`, `keterangan`, `kategori`, `harga`, `stok`) VALUES
(15, '36271-1.png', 'Mie Goreng', 'Enak', 3, 10000, 20),
(16, '8897-2.png', 'Burger', 'enak', 2, 13000, 12),
(17, '69633-7.png', 'Bakso', '+mie kuning', 3, 14000, 31),
(18, '29004-4.png', 'Kopi susu', 'Susu kambing nasional', 5, 5000, 12),
(19, '51414-5.png', 'Es Jeruk Nipis', 'Asem sekali', 4, 6000, 14),
(20, '38468-14.png', 'Kepiting Saus Padang', 'Saus ala Padang', 8, 30000, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` bigint(20) NOT NULL,
  `pelanggan` varchar(255) NOT NULL,
  `meja` int(11) NOT NULL,
  `pelayan` int(11) NOT NULL,
  `waktu_order` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `pelanggan`, `meja`, `pelayan`, `waktu_order`) VALUES
(2505122140705, 'gw', 14, 1, '2025-05-12 14:40:59'),
(2505122141916, 'aji', 13, 1, '2025-05-13 03:17:22'),
(2505122142869, 'fa', 54, 1, '2025-05-12 14:49:33'),
(2505131527612, 'coba', 90, 1, '2025-05-13 08:28:52'),
(2505132031100, 'Keren', 17, 1, '2025-05-13 13:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `NoHP` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `Nama`, `username`, `password`, `level`, `NoHP`, `alamat`) VALUES
(1, 'Admin', 'admin@admin.com', 'c93ccd78b2076528346216b3b2f701e6', 1, '0816412316237', 'PT. Admin'),
(4, 'Mochi', 'mochi@enak.com', '5f4dcc3b5aa765d61d8327deb882cf99', 4, '083456275943', ''),
(5, 'Pelayan', 'Pelayan@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, '08021308451', 'Jogja'),
(19, 'Dapur', 'dapur@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 4, '08133531313', 'Dapur'),
(20, 'Kasir', 'kasir@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '081246261234', 'Konter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_kategori_menu`
--
ALTER TABLE `tb_kategori_menu`
  ADD PRIMARY KEY (`id_kat_menu`);

--
-- Indexes for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD PRIMARY KEY (`id_list_order`),
  ADD KEY `tb_list_order_menu` (`menu`),
  ADD KEY `tb_list_order_order` (`kode_order`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_menu` (`kategori`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `tb_order` (`pelayan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori_menu`
--
ALTER TABLE `tb_kategori_menu`
  MODIFY `id_kat_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  MODIFY `id_list_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2505132031101;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD CONSTRAINT `tb_list_order_menu` FOREIGN KEY (`menu`) REFERENCES `tb_menu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_list_order_order` FOREIGN KEY (`kode_order`) REFERENCES `tb_order` (`id_order`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD CONSTRAINT `tb_menu` FOREIGN KEY (`kategori`) REFERENCES `tb_kategori_menu` (`id_kat_menu`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order` FOREIGN KEY (`pelayan`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
