-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 15, 2025 lúc 08:39 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dataproject`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyendi`
--

CREATE TABLE `chuyendi` (
  `id_cd` int(11) NOT NULL,
  `id_NX` int(11) NOT NULL,
  `diemKH` varchar(100) NOT NULL,
  `diemKT` varchar(100) NOT NULL,
  `lichTrinh` time NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chuyendi`
--

INSERT INTO `chuyendi` (`id_cd`, `id_NX`, `diemKH`, `diemKT`, `lichTrinh`, `gia`) VALUES
(6, 7, 'Ha Noi', 'HCM', '00:00:00', 500000),
(7, 6, 'Ha Noi', 'Hai Phong', '00:27:00', 100000),
(8, 8, 'Hai Phong', 'Ha Noi', '15:30:00', 200000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `testing`
--

CREATE TABLE `testing` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` int(20) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `testing`
--

INSERT INTO `testing` (`id`, `user`, `email`, `pass`, `role`) VALUES
(1, NULL, NULL, 123, 0),
(2, NULL, NULL, 111, 1),
(3, 'admin3', 'nn7504791@gmail.com', 1234, 0),
(4, '', 'd@gmail.com', 1, 0),
(6, 'lexuanvu', 'd2@gmail.com', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `discount_value` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `code`, `discount_value`) VALUES
(4, 'giam10', '10'),
(5, 'giam20', '20'),
(6, 'giam30', '30');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chuyendi`
--
ALTER TABLE `chuyendi`
  ADD PRIMARY KEY (`id_cd`),
  ADD KEY `id_NX` (`id_NX`);

--
-- Chỉ mục cho bảng `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chuyendi`
--
ALTER TABLE `chuyendi`
  MODIFY `id_cd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `testing`
--
ALTER TABLE `testing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
