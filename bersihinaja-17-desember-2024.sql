-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2025 at 03:47 PM
-- Server version: 10.6.19-MariaDB-cll-lve
-- PHP Version: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `produkce_bersihinaja`
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
  `Kabupaten` int(11) NOT NULL,
  `Tanggal_Order` datetime NOT NULL,
  `timeout_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Ulasan` varchar(255) DEFAULT NULL,
  `Jumlah_Rating` int(11) DEFAULT NULL,
  `Id_Paket` varchar(11) DEFAULT NULL,
  `Id_Pekerja` varchar(11) NOT NULL,
  `Id_Customer` int(11) NOT NULL,
  `Total` varchar(255) DEFAULT NULL,
  `order_id` varchar(50) NOT NULL,
  `Status_Order` enum('Pending','Selesai') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`Id_Detail_Pemesanan`, `Id_Jenis_Layanan`, `Id_Pemesanan`, `Status_Pembayaran`, `Kabupaten`, `Tanggal_Order`, `timeout_at`, `updated_at`, `Ulasan`, `Jumlah_Rating`, `Id_Paket`, `Id_Pekerja`, `Id_Customer`, `Total`, `order_id`, `Status_Order`) VALUES
(109, 1, NULL, 'Dibayar', 3401, '2025-01-07 19:40:52', '2025-01-07 19:43:52', '2025-04-30 20:54:18', '', 5, NULL, '23', 2, '50000.00', '677d20d418f1f-1736253652', 'Selesai'),
(110, 1, NULL, 'Dibayar', 3401, '2025-01-07 19:41:21', '2025-01-07 19:44:21', '2025-04-30 20:35:15', 'Mantap', 5, NULL, '23', 2, '50000.00', '677d20f176c96-1736253681', 'Pending'),
(111, 2, NULL, 'Dibayar', 3401, '2025-01-07 21:24:31', '2025-01-07 21:27:31', '2025-01-07 21:58:51', 'pekerja hebat', 5, NULL, '20,21', 2, '75000.00', '677d391f64665-1736259871', 'Selesai'),
(112, 1, NULL, 'Dibatalkan', 3401, '2025-01-07 21:57:46', '2025-01-07 22:00:46', '2025-01-07 22:20:20', NULL, NULL, NULL, '22', 2, '50000', '677d40eaea908-1736261866', 'Pending'),
(113, 1, NULL, 'Dibatalkan', 3401, '2025-01-07 23:45:15', '2025-01-07 23:48:15', '2025-04-25 16:37:09', NULL, NULL, '1,3', '20', 2, '200000', '677d5a1becf9d-1736268315', 'Selesai'),
(114, 1, NULL, 'Dibatalkan', 3401, '2025-01-08 00:35:51', '2025-01-08 00:38:51', '2025-01-09 10:03:26', NULL, NULL, NULL, '21', 2, '50000', '677d65f743097-1736271351', 'Selesai'),
(115, 2, NULL, 'Dibatalkan', 3401, '2025-01-30 22:22:38', '2025-01-30 22:25:38', '2025-04-30 19:58:38', NULL, NULL, '1', '20', 2, '125000', '679b993e4382f-1738250558', 'Selesai'),
(116, 1, NULL, 'Dibatalkan', 3401, '2025-04-25 16:40:18', '2025-04-25 16:43:18', '2025-04-26 00:04:05', NULL, NULL, NULL, '21', 2, '50000', '680b588295494-1745574018', 'Pending'),
(117, 1, NULL, 'Dibatalkan', 3401, '2025-04-30 20:30:36', '2025-04-30 20:33:36', '2025-04-30 20:50:04', NULL, NULL, '3', '23', 2, '150000.00', '681225fcd9d75-1746019836-1746020032', 'Pending'),
(118, 1, NULL, 'Dibatalkan', 3401, '2025-04-30 20:31:34', '2025-04-30 20:34:34', '2025-04-30 20:45:19', NULL, NULL, NULL, '21', 2, '50000', '6812263622c60-1746019894', 'Pending'),
(119, 1, NULL, 'Dibatalkan', 3401, '2025-04-30 20:45:19', '2025-04-30 20:48:19', '2025-04-30 20:50:03', NULL, NULL, '1,3', '22', 2, '200000', '6812296fd6ce8-1746020719', 'Pending'),
(120, 1, NULL, 'Dibatalkan', 3401, '2025-04-30 20:55:42', '2025-04-30 20:58:42', '2025-04-30 21:12:54', NULL, NULL, '1', '21', 2, '100000.00', '68122bde5dca5-1746021342', 'Pending'),
(121, 1, NULL, 'Dibayar', 3401, '2025-04-30 21:00:40', '2025-04-30 21:03:40', '2025-04-30 22:32:31', 'bagus', NULL, '1', '21', 2, '100000.00', '68122d08ac888-1746021640-1746021683-1746021778', 'Pending'),
(122, 2, NULL, 'Dibatalkan', 3401, '2025-04-30 21:45:12', '2025-04-30 21:48:12', '2025-04-30 21:48:24', NULL, NULL, '1', '22', 2, '125000', '681237785b07f-1746024312', 'Pending'),
(123, 2, NULL, 'Dibatalkan', 3401, '2025-04-30 21:48:27', '2025-04-30 21:51:27', '2025-05-01 21:51:22', NULL, NULL, '3', '22', 2, '175000.00', '6812383b884fe-1746024507', 'Pending'),
(124, 1, NULL, 'Dibatalkan', 3401, '2025-04-30 21:49:39', '2025-04-30 21:52:39', '2025-04-30 22:16:31', NULL, NULL, '1,3', '22', 2, '200000', '68123883af914-1746024579', 'Pending'),
(125, 1, NULL, 'Dibatalkan', 3401, '2025-04-30 22:21:56', '2025-04-30 22:24:56', '2025-04-30 22:26:29', NULL, NULL, NULL, '23', 2, '50000', '68124014c56a5-1746026516', 'Pending'),
(126, 1, NULL, 'Dibatalkan', 3401, '2025-04-30 22:22:05', '2025-04-30 22:25:05', '2025-04-30 22:26:29', NULL, NULL, NULL, '22', 2, '50000', '6812401d532d3-1746026525', 'Pending'),
(127, 1, NULL, 'Dibatalkan', 3401, '2025-04-30 22:26:29', '2025-04-30 22:29:29', '2025-05-01 22:31:19', NULL, NULL, '1', '22', 2, '100000.00', '68124125af85f-1746026789', 'Pending'),
(128, 1, NULL, 'Dibatalkan', 3401, '2025-05-01 18:11:14', '2025-05-01 18:14:14', '2025-05-01 18:15:37', NULL, NULL, NULL, '23', 2, '50000', '681356d2dc2aa-1746097874', 'Pending'),
(129, 1, NULL, 'Dibatalkan', 3401, '2025-05-01 18:13:02', '2025-05-01 18:16:02', '2025-05-01 18:16:33', NULL, NULL, NULL, '23', 2, '50000', '6813573eef048-1746097982', 'Pending'),
(130, 1, NULL, 'Dibatalkan', 3401, '2025-05-01 18:16:33', '2025-05-01 18:19:33', '2025-05-01 18:19:57', NULL, NULL, '1,2,3', '22', 2, '275000', '68135811e3463-1746098193', 'Pending'),
(131, 1, NULL, 'Dibatalkan', 3401, '2025-05-01 18:19:57', '2025-05-01 18:22:57', '2025-05-01 18:25:37', NULL, NULL, '1,3', '22', 2, '200000.00', '681358ddaaed5-1746098397-1746098438-1746098690-174', 'Pending'),
(132, 1, NULL, 'Dibayar', 3401, '2025-05-01 18:29:16', '2025-05-01 18:32:16', '2025-05-01 18:33:34', '', 5, '1,3', '22', 2, '200000.00', '68135b0c78b11-1746098956', 'Pending'),
(133, 1, NULL, 'Dibayar', 3401, '2025-05-01 18:34:13', '2025-05-01 18:37:13', '2025-05-01 18:44:04', 'Pelayanan Ramah, Hasil Memuaskan. Recomended dehh pokoknyaa', 5, '1,3', '23', 2, '200000.00', '68135c358e950-1746099253', 'Pending'),
(134, 1, NULL, 'Dibatalkan', 3401, '2025-05-01 18:50:58', '2025-05-01 18:53:58', '2025-05-01 18:53:58', NULL, NULL, '1,3', '30', 2, '200000', '68136022ad5d8-1746100258', 'Pending'),
(135, 1, NULL, 'Dibatalkan', 3401, '2025-05-01 18:59:28', '2025-05-01 19:02:28', '2025-05-01 20:37:20', NULL, NULL, '1,3', '30', 30, '200000', '68136220c7991-1746100768', 'Pending'),
(136, 1, NULL, 'Dibatalkan', 3401, '2025-05-01 19:00:20', '2025-05-01 19:03:20', '2025-05-01 20:37:20', NULL, NULL, '1,3', '30', 2, '200000', '681362543ea5e-1746100820', 'Pending'),
(137, 2, NULL, 'Dibatalkan', 3401, '2025-05-01 20:49:38', '2025-05-01 20:52:38', '2025-05-01 21:03:18', NULL, NULL, '1', '30', 2, '125000', '68137bf29f498-1746107378-1746107478', 'Pending'),
(138, 1, NULL, 'Dibatalkan', 3401, '2025-05-01 21:42:24', '2025-05-01 21:45:24', '2025-05-01 22:19:16', NULL, NULL, NULL, '30', 2, '50000.00', '681388507ebdd-1746110544', 'Pending'),
(139, 2, NULL, 'Dibayar', 3401, '2025-05-01 22:05:19', '2025-05-01 22:08:19', '2025-05-01 22:12:57', 'pelayanan memuaskan', 5, '3', '30', 2, '175000.00', '68138daf79b24-1746111919', 'Pending'),
(140, 2, NULL, 'Dibatalkan', 3401, '2025-05-01 22:18:21', '2025-05-01 22:21:21', '2025-05-01 22:31:19', NULL, NULL, '3', '22', 2, '175000', '681390bd4bb92-1746112701-1746112785-1746112968', 'Pending');

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
(1, 'Small', 50000, 'small.png', '5 x 5', 2, '50 - 120 menit', 1, '<p>Small Cleaning Service Cocok untuk ruangan kecil seperti kamar tidur, kamar mandi, atau dapur dengan ukuran hingga 20 m&sup2;.</p>\r\n\r\n<p>- Pembersihan lantai dan dinding.</p>\r\n\r\n<p>- Pengelapan furnitur dan peralatan kecil.</p>\r\n\r\n<p>- Penghilangan debu dan sampah.</p>\r\n\r\n<p>- Penyegaran ruangan dengan pewangi.</p>\r\n'),
(2, 'Medium', 75000, 'MEDIUM1.png', '8 x 8', 3, '120 - 190 menit', 2, '<p>Ideal untuk ruangan berukuran sedang seperti ruang tamu, ruang makan, atau kantor kecil dengan ukuran antara 21-50 m&sup2;. Layanan ini meliputi:</p>\r\n\r\n<p>- Pembersihan menyeluruh lantai, dinding, dan kaca.</p>\r\n\r\n<p>- Penyedotan debu dari karpet dan sofa.</p>\r\n\r\n<p>- Pembersihan detail perabotan.</p>\r\n\r\n<p>- Pembersihan dan sanitasi area utama.</p>\r\n'),
(7, 'Large', 100000, 'LARGE.png', '10 x 10', 4, '190 - 240 menit', 3, '<p>Didesain untuk ruangan besar seperti aula, ruang konferensi, atau kantor besar dengan ukuran lebih dari 50 m&sup2;. Layanan ini mencakup:</p>\r\n\r\n<p>- Pembersihan menyeluruh untuk lantai, dinding, kaca, dan perabotan besar.</p>\r\n\r\n<p>- Pembersihan area dengan noda berat atau kotoran sulit.</p>\r\n\r\n<p>- Penyegaran udara dengan desinfektan dan pewangi ruangan.</p>\r\n\r\n<p>- Penyediaan tenaga tambahan untuk efisiensi.</p>\r\n');

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
  `Provinsi` int(11) NOT NULL,
  `Kabupaten` int(11) NOT NULL,
  `Alamat_User` varchar(255) NOT NULL,
  `No_Hp` char(15) NOT NULL,
  `Foto_User` varchar(255) NOT NULL,
  `KTP` char(16) NOT NULL,
  `Role_Id` enum('pekerja','customer','admin') NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` enum('Bekerja','Tidak Bekerja','','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_User`, `Nama_User`, `Email_User`, `Provinsi`, `Kabupaten`, `Alamat_User`, `No_Hp`, `Foto_User`, `KTP`, `Role_Id`, `Password`, `Status`) VALUES
(1, 'adminz', 'admin@gmail.com', 0, 0, 'jawa', '832', '', '1', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL),
(2, 'customer', 'customer@gmail.com', 34, 3401, '', '2147483647', '', '2147483647', 'customer', 'b39f008e318efd2bb988d724a161b61c6909677f', NULL),
(3, 'damarabaikjuga', 'damar@gmail.com', 0, 0, 'barcelona', '2147483647', 'user_6_1733227137.jpg', '2147483647', 'customer', 'afea99797bed0158663f5ef18a45e40eb615adfa', NULL),
(20, 'Pekerja', 'pekerja@gmail.com', 34, 3403, '', '2147483647', 'user_20_1736263488.jpg', '2147483647', 'pekerja', '3cb8f93c01dd0404808c9cc1b812b9ff50c6d802', 'Bekerja'),
(21, 'Pekerja 1', 'pekerja1@gmail.com', 34, 3401, '', '2147483647', 'user_21_1736263522.jpg', '2147483647', 'pekerja', 'beaec00c0d04c2903f9def1af6910fa24245ed41', 'Tidak Bekerja'),
(22, 'Pekerja 2', 'pekerja2@gmail.com', 34, 3401, '', '2147483647', 'user_22_1736263546.jpg', '2147483647', 'pekerja', '6e4b3b39173784d1ad3c0261f00824dbf823a57d', 'Tidak Bekerja'),
(23, 'joko', 'joko@gmail.com', 34, 3401, '', '2147483647', 'user_23_1736342904.jpg', '2147483647', 'pekerja', '97c358728f7f947c9a279ba9be88308395c7cc3a', 'Tidak Bekerja'),
(24, 'andi', 'andi@gmail.com', 35, 3512, '', '2147483647', '', '2147483647', 'pekerja', 'dbd122ef7b6a09ffecf5db9c9296320f3c94e707', 'Tidak Bekerja'),
(28, 'test', 'test@gmail.com', 72, 7271, '', '08123561241', '', '00235411515125', 'customer', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', ''),
(29, 'Customer 2', 'customer2@gmail.com', 34, 3404, '', '081234567890', '', '1234567891234567', 'customer', 'b39f008e318efd2bb988d724a161b61c6909677f', ''),
(30, 'Sindi', 'sindi@gmail.com', 34, 3401, '', '081234567890', 'user_30_1746100756.jpg', '1234567890987654', 'pekerja', 'e79af82dbbb7846153df00a790f76c8a17a60884', 'Tidak Bekerja'),
(31, 'ahmad', 'ahmad@gmail.com', 12, 1215, '', '08123123121', '', '213123123123', 'pekerja', 'a53a33601b8dd9d06ae9e50f1f30fbe957aba866', 'Tidak Bekerja');

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
  MODIFY `Id_Detail_Pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

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
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
