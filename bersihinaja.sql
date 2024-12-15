-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 06:13 AM
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
-- Table structure for table `detail_pekerja`
--

CREATE TABLE `detail_pekerja` (
  `Id_Pekerja` int(11) NOT NULL,
  `Id_Detail_Pemesanan` int(11) NOT NULL,
  `Id_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `Id_Detail_Pemesanan` int(11) NOT NULL,
  `Id_Jenis_Layanan` int(11) NOT NULL,
  `Id_Pemesanan` int(11) DEFAULT NULL,
  `Total` int(11) NOT NULL,
  `Status_Pembayaran` varchar(255) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `Tanggal_Order` datetime NOT NULL,
  `Ulasan` varchar(255) DEFAULT NULL,
  `Jumlah_Rating` int(11) DEFAULT NULL,
  `Id_Paket` int(11) NOT NULL,
  `Id_Pekerja` varchar(11) NOT NULL,
  `Id_Customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`Id_Detail_Pemesanan`, `Id_Jenis_Layanan`, `Id_Pemesanan`, `Total`, `Status_Pembayaran`, `Alamat`, `Tanggal_Order`, `Ulasan`, `Jumlah_Rating`, `Id_Paket`, `Id_Pekerja`, `Id_Customer`) VALUES
(10, 2, NULL, 260001, 'Belum Dibayar', 'barcelona', '2024-12-15 06:07:43', NULL, NULL, 3, '11,12', 6);

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
(1, 'Small', 100000, '48c7f410-5081-429d-816c-7e3a4c91fc304.jpeg', '5 x 5', 2, '50menit - 120menit', 1, 'Small Cleaning Service\nCocok untuk ruangan kecil seperti kamar tidur, kamar mandi, atau dapur dengan ukuran hingga 20 m².\n\n- Pembersihan lantai dan dinding.\n- Pengelapan furnitur dan peralatan kecil.\n- Penghilangan debu dan sampah.\n- Penyegaran ruangan dengan pewangi.\n'),
(2, 'Mediumm', 160001, '1728882578543.jpg', '10 x 1', 3, '120menit - 190menit', 2, 'Ideal untuk ruangan berukuran sedang seperti ruang tamu, ruang makan, atau kantor kecil dengan ukuran antara 21-50 m². Layanan ini meliputi:  Pembersihan menyeluruh lantai, dinding, dan kaca. Penyedotan debu dari karpet dan sofa. Pembersihan detail perabotan. Pembersihan dan sanitasi area utama.'),
(7, 'large', 50000, 'mu.jpg', '10 x 11', 3, '1 menit', 1, 'Didesain untuk ruangan besar seperti aula, ruang konferensi, atau kantor besar dengan ukuran lebih dari 50 m². Layanan ini mencakup:  Pembersihan menyeluruh untuk lantai, dinding, kaca, dan perabotan besar. Pembersihan area dengan noda berat atau kotoran sulit. Penyegaran udara dengan desinfektan dan pewangi ruangan. Penyediaan tenaga tambahan untuk efisiensi.');

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
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `Id_Pemesanan` int(11) NOT NULL,
  `Id_Customer` int(11) DEFAULT NULL,
  `Id_Pekerja` int(11) DEFAULT NULL,
  `Id_Jenis_Layanan` int(11) DEFAULT NULL,
  `Notifikasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id_User` int(11) NOT NULL,
  `Nama_User` varchar(255) NOT NULL,
  `Email_User` varchar(255) NOT NULL,
  `Alamat_User` varchar(255) NOT NULL,
  `No_Hp` int(15) NOT NULL,
  `Foto_User` varchar(255) NOT NULL,
  `KTP` int(16) NOT NULL,
  `Role_Id` enum('pekerja','customer','admin') NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_User`, `Nama_User`, `Email_User`, `Alamat_User`, `No_Hp`, `Foto_User`, `KTP`, `Role_Id`, `Password`) VALUES
(6, 'damarabaikjuga', 'damar@gmail.com', 'barcelona', 2147483647, 'user_6_1733227137.jpg', 2147483647, 'customer', 'afea99797bed0158663f5ef18a45e40eb615adfa'),
(9, 'adminz', 'admin@gmail.com', 'jawa', 832, '', 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(10, 'coba', 'coba@gmail.com', 'barcelona', 812345678, '', 2147483647, 'customer', '34f70892f40cd3b2a340769c070c4f1a02335d87'),
(11, 'pekerja1', 'pekerja1@gmail.com', 'barcelona', 8, 'user_11_1733983551.jpg', 123456, 'pekerja', '3cb8f93c01dd0404808c9cc1b812b9ff50c6d802'),
(12, 'pekerja2', 'pekerja2@gmail.com', 'barcelona', 81, 'user_12_1733983599.jpeg', 123456, 'pekerja', '3cb8f93c01dd0404808c9cc1b812b9ff50c6d802');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_pekerja`
--
ALTER TABLE `detail_pekerja`
  ADD PRIMARY KEY (`Id_Pekerja`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`Id_Detail_Pemesanan`),
  ADD KEY `Id_Jenis_Layanan` (`Id_Jenis_Layanan`),
  ADD KEY `Id_Pemesanan` (`Id_Pemesanan`),
  ADD KEY `id_paket` (`Id_Paket`),
  ADD KEY `Id_User` (`Id_Pekerja`),
  ADD KEY `Id_Customer` (`Id_Customer`);

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
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`Id_Pemesanan`),
  ADD KEY `Id_Customer` (`Id_Customer`),
  ADD KEY `Id_Jenis_Layanan` (`Id_Jenis_Layanan`),
  ADD KEY `Id_Pekerja` (`Id_Pekerja`);

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
-- AUTO_INCREMENT for table `detail_pekerja`
--
ALTER TABLE `detail_pekerja`
  MODIFY `Id_Pekerja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `Id_Detail_Pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `Id_Pemesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`Id_Pemesanan`) REFERENCES `pemesanan` (`Id_Pemesanan`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`Id_Jenis_Layanan`) REFERENCES `jenis_layanan` (`Id_Services`),
  ADD CONSTRAINT `detail_pemesanan_ibfk_3` FOREIGN KEY (`Id_Paket`) REFERENCES `paket_layanan` (`Id_Paket`);

--
-- Constraints for table `paket_pemesanan`
--
ALTER TABLE `paket_pemesanan`
  ADD CONSTRAINT `paket_pemesanan_ibfk_1` FOREIGN KEY (`Id_Services`) REFERENCES `jenis_layanan` (`Id_Services`),
  ADD CONSTRAINT `paket_pemesanan_ibfk_2` FOREIGN KEY (`Id_Paket`) REFERENCES `paket_layanan` (`Id_Paket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
