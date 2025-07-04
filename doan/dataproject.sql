-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 09:15 AM
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
-- Database: `dataproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `chuyendi`
--

CREATE TABLE `chuyendi` (
  `id_cd` int(11) NOT NULL,
  `id_NX` int(11) NOT NULL,
  `diemKH` varchar(100) NOT NULL,
  `diemKT` varchar(100) NOT NULL,
  `lichTrinh` time NOT NULL,
  `ngayDi` date NOT NULL,
  `gia` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chuyendi`
--

INSERT INTO `chuyendi` (`id_cd`, `id_NX`, `diemKH`, `diemKT`, `lichTrinh`, `ngayDi`, `gia`) VALUES
(9, 9, 'Ha noi', 'Hai Phong', '07:30:00', '2025-03-07', '250.000'),
(12, 9, 'Ha noi', 'Hai Phong', '07:30:00', '2025-04-07', '250000'),
(13, 9, 'Ha noi', 'Hai Phong', '07:30:00', '2025-05-07', '250000'),
(14, 9, 'Hai Phong', 'Ha Noi', '08:00:00', '2025-03-07', '250000'),
(15, 9, 'Hai Phong', 'Ha Noi', '08:00:00', '2025-04-07', '250000'),
(16, 9, 'Hai Phong', 'Ha Noi', '08:00:00', '2025-05-07', '250000'),
(17, 10, 'TP HCM', 'Da Lat', '09:00:00', '2025-03-07', '290000'),
(18, 10, 'TP HCM', 'Da Lat', '09:00:00', '2025-04-07', '290000'),
(19, 10, 'TP HCM', 'Da Lat', '09:00:00', '2025-05-07', '290000'),
(20, 10, 'Da Lat', 'TP HCM', '09:30:00', '2025-05-07', '290000'),
(21, 0, 'Da Lat', 'TP HCM', '09:30:00', '2025-04-07', '290000'),
(22, 0, 'Da Lat', 'TP HCM', '00:00:00', '2025-04-07', '290000'),
(23, 10, 'Da Lat', 'TP HCM', '00:00:00', '2025-05-07', '290000'),
(24, 11, 'Da Lat', 'TP HCM', '14:30:00', '2025-05-07', '280000'),
(25, 11, 'Da Lat', 'TP HCM', '14:30:00', '2025-06-07', '280000'),
(27, 11, 'Da Lat', 'Da Nang', '10:45:00', '2025-03-07', '420000'),
(28, 11, 'Da Lat', 'Da Nang', '10:45:00', '2025-05-07', '420000'),
(29, 11, 'Da Lat', 'Da Nang', '10:45:00', '2025-07-07', '420000'),
(30, 12, 'Hai Phong', 'Thanh Hoa', '08:00:00', '2025-04-07', '320000'),
(31, 12, 'Hai Phong', 'Thanh Hoa', '08:00:00', '2025-06-07', '320000'),
(32, 12, 'Hai Phong', 'Thanh Hoa', '08:00:00', '2025-08-07', '320000'),
(33, 12, 'Thanh Hoa', 'Hai Phong', '08:45:00', '2025-05-07', '310000'),
(34, 12, 'Thanh Hoa', 'Hai Phong', '10:00:00', '2025-05-07', '310000'),
(35, 13, 'Nghe An', 'Ha Noi', '06:00:00', '2025-07-07', '270000'),
(36, 13, 'Nghe An', 'Ha Noi', '06:00:00', '2025-08-07', '270000'),
(37, 13, 'Nghe An', 'Ha Noi', '06:00:00', '2025-09-07', '270000'),
(38, 13, 'Ha Noi', 'Nghe An', '05:30:00', '2025-08-07', '270000'),
(39, 13, 'Ha Noi', 'Nghe An', '05:30:00', '2025-07-07', '270000'),
(40, 13, 'Ha Noi', 'Nghe An', '06:30:00', '2025-10-07', '270000'),
(41, 14, 'Ha Noi', 'Sapa', '04:00:00', '2025-04-07', '340000'),
(42, 14, 'Ha Noi', 'Sapa', '06:00:00', '2025-04-07', '340000'),
(43, 14, 'Ha Noi', 'Sapa', '08:00:00', '2025-04-07', '340000'),
(44, 14, 'Sapa', 'Ha Noi', '08:00:00', '2025-05-07', '340000'),
(46, 0, '', '', '00:00:00', '0000-00-00', '0'),
(47, 0, '', '', '00:00:00', '0000-00-00', '0'),
(48, 0, '', '', '00:00:00', '0000-00-00', '0'),
(49, 0, '', '', '00:00:00', '0000-00-00', '0'),
(50, 0, '', '', '00:00:00', '0000-00-00', '0'),
(51, 9, 'hà nội', 'thanh hóa', '13:31:00', '2025-07-01', '300000');

-- --------------------------------------------------------

--
-- Table structure for table `nha_xe`
--

CREATE TABLE `nha_xe` (
  `id_NX` int(11) NOT NULL,
  `tenNX` varchar(100) DEFAULT NULL,
  `soDT` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nha_xe`
--

INSERT INTO `nha_xe` (`id_NX`, `tenNX`, `soDT`) VALUES
(9, 'Phương Trang (FUTA Bus)', '0999999999'),
(10, 'Hoàng Long', '0988888888'),
(11, 'Mai Linh', '0977777777'),
(12, 'Văn Minh', '0966666666'),
(13, 'An Phú Quý', '0955555555'),
(14, 'Phong Phú', '0944444444'),
(15, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` int(20) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `email`, `pass`, `role`) VALUES
(1, 'admin', NULL, 1, 1),
(3, 'admin3', 'nn7504791@gmail.com', 1234, 0),
(6, 'lexuanvu', 'd2@gmail.com', 1, 0),
(7, 'hoangvanvu', 'kimminhhoang058@gmail.com', 111111, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ve`
--

CREATE TABLE `ve` (
  `id_ve` int(11) NOT NULL,
  `id_cd` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tuyenDuong` varchar(100) NOT NULL,
  `lichTrinh` time NOT NULL,
  `ngayDi` date NOT NULL,
  `ghe` varchar(100) NOT NULL,
  `tongGia` varchar(100) DEFAULT NULL,
  `trangthai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ve`
--

INSERT INTO `ve` (`id_ve`, `id_cd`, `id`, `tuyenDuong`, `lichTrinh`, `ngayDi`, `ghe`, `tongGia`, `trangthai`) VALUES
(48, 9, 6, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '11,15,19', '750000', 'Da hoan tien'),
(49, 12, 6, 'Ha noi - Hai Phong', '07:30:00', '2025-04-07', '16,14', '500000', 'Da hoan tien'),
(53, 9, 6, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '8,12', '500000', 'Da thanh toan'),
(55, 9, 6, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '13,9', '500000', 'Da hoan tien'),
(56, 9, 6, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '6,10', '500000', 'Da thanh toan'),
(57, 9, 6, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '3,7,16', '750000', 'Da thanh toan'),
(58, 9, 6, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '22,25', '500000', 'Da thanh toan'),
(59, 13, 6, 'Ha noi - Hai Phong', '07:30:00', '2025-05-07', '1,2,3,4,8,7,6,5,9,10,13,14,18,17,21,25,29,30,26,22,23,27,31,32,28,24,20,16,12,11,15,19', '5600000', 'Da thanh toan'),
(60, 17, 3, 'TP HCM - Da Lat', '09:00:00', '2025-03-07', '3', '261000', 'Da hoan tien'),
(61, 9, 3, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '2', '225000', 'Da hoan tien'),
(62, 9, 3, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '4', '250000', 'Da thanh toan'),
(63, 14, 3, 'Hai Phong - Ha Noi', '08:00:00', '2025-03-07', '4', '250000', 'Da thanh toan'),
(64, 9, 3, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '1', '250000', 'Da thanh toan'),
(65, 51, 3, 'hà nội - thanh hóa', '13:31:00', '2025-07-01', '3', '300000', 'Da thanh toan'),
(66, 9, 7, 'Ha noi - Hai Phong', '07:30:00', '2025-03-07', '5', '250000', 'Da thanh toan');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `discount_value` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `code`, `discount_value`) VALUES
(4, 'giam10', '10'),
(5, 'giam20', '20'),
(6, 'giam30', '30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chuyendi`
--
ALTER TABLE `chuyendi`
  ADD PRIMARY KEY (`id_cd`),
  ADD KEY `id_NX` (`id_NX`);

--
-- Indexes for table `nha_xe`
--
ALTER TABLE `nha_xe`
  ADD PRIMARY KEY (`id_NX`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`id_ve`),
  ADD KEY `id_cd` (`id_cd`),
  ADD KEY `fk_ve_user` (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chuyendi`
--
ALTER TABLE `chuyendi`
  MODIFY `id_cd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `nha_xe`
--
ALTER TABLE `nha_xe`
  MODIFY `id_NX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ve`
--
ALTER TABLE `ve`
  MODIFY `id_ve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ve`
--
ALTER TABLE `ve`
  ADD CONSTRAINT `fk_ve_testing` FOREIGN KEY (`id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_ve_user` FOREIGN KEY (`id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `ve_ibfk_1` FOREIGN KEY (`id_cd`) REFERENCES `chuyendi` (`id_cd`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
