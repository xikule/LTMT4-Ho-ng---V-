-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 07:27 PM
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
(2, NULL, NULL, NULL, 'admin1', 111, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE nha_xe (
    id_NX INT AUTO_INCREMENT PRIMARY KEY,
    tenNX VARCHAR(100),
    soDT VARCHAR(20)
);

CREATE TABLE voucher (
    id_voucher INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(100),
    discount_value VARCHAR(20)
);
CREATE TABLE chuyendi (
    id_cd INT AUTO_INCREMENT PRIMARY KEY,      		-- Khóa chính
    id_NX INT NOT NULL,                          	-- Khóa ngoại (liên kết nhà xe)
    diemKH VARCHAR(100) NOT NULL,                	-- Điểm xuất phát
    diemKT VARCHAR(100) NOT NULL,                	-- Điểm đến
    lichTrinh TIME NOT NULL,                    	-- Giờ đi
    gia INT NOT NULL,					-- Giá vé
    FOREIGN KEY (id_NX) REFERENCES nhaxe(id_NX)     	-- Khóa ngoại đến bảng nhaxe
    );
