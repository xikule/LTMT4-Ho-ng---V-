-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 05:41 PM
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
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'nhà xe nào đó', '0123'),
(5, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user` varchar(20) NOT NULL,
  `pass` int(20) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testing`
--

INSERT INTO `testing` (`id`, `name`, `address`, `email`, `user`, `pass`, `role`) VALUES
(1, NULL, NULL, NULL, 'admin', 123, 0),
(2, NULL, NULL, NULL, 'admin1', 111, 1),
(3, 'admin3', NULL, 'nn7504791@gmail.com', '', 1234, 0);

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
(3, '', '');

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
-- Indexes for table `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_cd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nha_xe`
--
ALTER TABLE `nha_xe`
  MODIFY `id_NX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chuyendi`
--
ALTER TABLE `chuyendi`
  ADD CONSTRAINT `chuyendi_ibfk_1` FOREIGN KEY (`id_NX`) REFERENCES `nhaxe` (`id_NX`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
