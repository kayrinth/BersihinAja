-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 01:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bersihinaja`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`) VALUES
(1, 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'adminzzz');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `Id_Detail_Pemesanan` int(11) NOT NULL,
  `Id_Jenis_Layanan` int(11) NOT NULL,
  `Id_Pemesanan` int(11) DEFAULT NULL,
  `Status_Pembayaran` varchar(255) DEFAULT NULL,
  `Kabupaten` int(255) NOT NULL,
  `Tanggal_Order` datetime NOT NULL,
  `Ulasan` varchar(255) DEFAULT NULL,
  `Jumlah_Rating` int(11) DEFAULT NULL,
  `Id_Paket` varchar(11) DEFAULT NULL,
  `Id_Pekerja` varchar(11) NOT NULL,
  `Id_Customer` int(11) NOT NULL,
  `Total` varchar(255) DEFAULT NULL,
  `order_id` varchar(50) NOT NULL,
  `timeout_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `Status_Order` enum('Pending','Selesai') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`Id_Detail_Pemesanan`, `Id_Jenis_Layanan`, `Id_Pemesanan`, `Status_Pembayaran`, `Kabupaten`, `Tanggal_Order`, `Ulasan`, `Jumlah_Rating`, `Id_Paket`, `Id_Pekerja`, `Id_Customer`, `Total`, `order_id`, `timeout_at`, `updated_at`, `Status_Order`) VALUES
(87, 7, NULL, 'Dibatalkan', 3401, '2025-01-06 23:55:07', NULL, NULL, '3', '25,26,27', 23, '200000', '677c0aebccc18-1736182507', '2025-01-06 23:58:07', '2025-01-07 07:29:32', 'Pending'),
(88, 1, NULL, 'Dibatalkan', 3401, '2025-01-07 15:57:12', NULL, NULL, '3', '24', 23, '150000', '677cec6904ded-1736240233', '2025-01-07 16:00:12', '2025-01-07 16:00:36', 'Selesai'),
(89, 1, NULL, 'Dibayar', 3401, '2025-01-07 16:00:44', 'asik bangett', 5, NULL, '24', 23, '50000.00', '677ced3c4be49-1736240444-1736240479', '2025-01-07 16:03:44', '2025-01-07 16:01:45', 'Selesai'),
(90, 2, NULL, 'Dibayar', 3401, '2025-01-07 20:08:38', 'asik banget\r\n', 5, NULL, '25,26', 23, '75000.00', '677d27563cea5-1736255318', '2025-01-07 20:11:38', '2025-01-07 20:09:06', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_layanan`
--

CREATE TABLE `jenis_layanan` (
  `Id_Services` int(11) NOT NULL,
  `Nama_Layanan` varchar(255) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Foto_Layanan` varchar(255) NOT NULL,
  `Ukuran_Ruangan` varchar(20) NOT NULL,
  `Maksimal_Jam` int(11) NOT NULL,
  `Estimasi` varchar(100) NOT NULL,
  `Jumlah_Cleaner` int(10) NOT NULL,
  `Deskripsi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_layanan`
--

INSERT INTO `jenis_layanan` (`Id_Services`, `Nama_Layanan`, `Harga`, `Foto_Layanan`, `Ukuran_Ruangan`, `Maksimal_Jam`, `Estimasi`, `Jumlah_Cleaner`, `Deskripsi`) VALUES
(1, 'Small', 50000, 'SMALL.png', '5 x 5', 2, '50menit - 120menit', 1, '<p>Small Cleaning Service Cocok untuk ruangan kecil seperti kamar tidur, kamar mandi, atau dapur dengan ukuran hingga 20 m&sup2;.</p>\r\n\r\n<p>- Pembersihan lantai dan dinding.&nbsp;</p>\r\n\r\n<p>- Pengelapan furnitur dan peralatan kecil.</p>\r\n\r\n<p>- Penghilangan debu dan sampah.</p>\r\n\r\n<p>- Penyegaran ruangan dengan pewangi.</p>\r\n'),
(2, 'Medium', 75000, 'MEDIUM.png', '8 x 8', 3, '120menit - 190menit', 2, 'Ideal untuk ruangan berukuran sedang seperti ruang tamu, ruang makan, atau kantor kecil dengan ukuran antara 21-50 m². Layanan ini meliputi:  Pembersihan menyeluruh lantai, dinding, dan kaca. Penyedotan debu dari karpet dan sofa. Pembersihan detail perabotan. Pembersihan dan sanitasi area utama.'),
(7, 'Large', 100000, 'large.png', '10 x 10', 4, '190-240 menit', 3, 'Didesain untuk ruangan besar seperti aula, ruang konferensi, atau kantor besar dengan ukuran lebih dari 50 m². Layanan ini mencakup:  Pembersihan menyeluruh untuk lantai, dinding, kaca, dan perabotan besar. Pembersihan area dengan noda berat atau kotoran sulit. Penyegaran udara dengan desinfektan dan pewangi ruangan. Penyediaan tenaga tambahan untuk efisiensi.');

-- --------------------------------------------------------

--
-- Table structure for table `paket_layanan`
--

CREATE TABLE `paket_layanan` (
  `Id_Paket` int(11) NOT NULL,
  `Nama_Paket` varchar(255) NOT NULL,
  `Harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_layanan`
--

INSERT INTO `paket_layanan` (`Id_Paket`, `Nama_Paket`, `Harga`) VALUES
(1, 'Cuci Sofa', 50000),
(2, 'Cuci Karpet', 75000),
(3, 'Pembersihan Halaman', 100000),
(4, 'Eco-Friendly', 120000);

-- --------------------------------------------------------

--
-- Table structure for table `paket_pemesanan`
--

CREATE TABLE `paket_pemesanan` (
  `Id_Paket_Pemesanan` int(11) NOT NULL,
  `Id_Services` int(11) NOT NULL,
  `Id_Paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id_User` int(11) NOT NULL,
  `Nama_User` varchar(255) NOT NULL,
  `Email_User` varchar(255) NOT NULL,
  `Provinsi` varchar(100) NOT NULL,
  `Kabupaten` varchar(100) NOT NULL,
  `Alamat_User` varchar(255) DEFAULT NULL,
  `No_Hp` int(15) NOT NULL,
  `Foto_User` varchar(255) NOT NULL,
  `KTP` int(16) NOT NULL,
  `Role_Id` enum('pekerja','customer','admin') NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` enum('Bekerja','Tidak Bekerja','','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_User`, `Nama_User`, `Email_User`, `Provinsi`, `Kabupaten`, `Alamat_User`, `No_Hp`, `Foto_User`, `KTP`, `Role_Id`, `Password`, `Status`) VALUES
(35, 'Ahmad Joy', 'pekerja2@gmail.com', '34', '3471', NULL, 2147483647, 'user_35_1750412231.jpg', 2147483647, 'pekerja', '$2y$10$DATszPG3PMXJotC9A4ngKu.aQK5WwRUmT56kEEijNIWf.mTWf6EVq', 'Tidak Bekerja'),
(36, 'Damar Mantap', 'pekerja3@gmail.com', '34', '3471', NULL, 2147483647, 'user_36_1750412246.jpg', 2147483647, 'pekerja', '$2y$10$9.aNtaiV7RzIZVSk3M8DP.9oQocyooeJTC/hM5f7iXXGjHbh/inOy', 'Tidak Bekerja'),
(37, 'Arif Muantad', 'pekerja4@gmail.com', '34', '3471', NULL, 2147483647, 'user_37_1750412264.jpg', 2147483647, 'pekerja', '$2y$10$TgY7xvyB3xZMYO/TlOgale31M7s1UFer3zLwIYjyX7SNdy8UIMcDi', 'Tidak Bekerja'),
(38, 'damar', 'damaradi@gmail.com', '34', '3471', NULL, 2147483647, '', 2147483647, 'customer', '$2y$10$USQx20za2Xt/KGi.op.aBOU8zSDZGqqgUoyqLPEythQgKk4JmaOVy', ''),
(39, 'Joko Subagyo', 'pekerja1@gmail.com', '34', '3471', NULL, 2147483647, 'user_39_1750412206.jpg', 2147483647, 'pekerja', '$2y$10$hiAGDNpv2qqKnShaZxzaNuLgtUSKtBv0q2Pyme3TgPHZNJDbfTnkC', 'Tidak Bekerja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`Id_Detail_Pemesanan`),
  ADD KEY `Id_Jenis_Layanan` (`Id_Jenis_Layanan`),
  ADD KEY `Id_Pemesanan` (`Id_Pemesanan`),
  ADD KEY `id_paket` (`Id_Paket`),
  ADD KEY `Id_User` (`Id_Pekerja`),
  ADD KEY `Id_Customer` (`Id_Customer`),
  ADD KEY `Id_Pemesanan_2` (`Id_Pemesanan`);

--
-- Indexes for table `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  ADD PRIMARY KEY (`Id_Services`);

--
-- Indexes for table `paket_layanan`
--
ALTER TABLE `paket_layanan`
  ADD PRIMARY KEY (`Id_Paket`);

--
-- Indexes for table `paket_pemesanan`
--
ALTER TABLE `paket_pemesanan`
  ADD PRIMARY KEY (`Id_Paket_Pemesanan`),
  ADD KEY `Id_Services` (`Id_Services`),
  ADD KEY `Id_Paket` (`Id_Paket`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `Id_Detail_Pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  MODIFY `Id_Services` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paket_layanan`
--
ALTER TABLE `paket_layanan`
  MODIFY `Id_Paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket_pemesanan`
--
ALTER TABLE `paket_pemesanan`
  MODIFY `Id_Paket_Pemesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
