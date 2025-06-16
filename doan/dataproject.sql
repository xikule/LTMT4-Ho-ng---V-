-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 16, 2025 lúc 01:18 PM
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
-- Cấu trúc bảng cho bảng `chi_tiet_ve`
--

CREATE TABLE `chi_tiet_ve` (
  `id_ct` int(11) NOT NULL,
  `id_ve` int(11) NOT NULL,
  `so_ghe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Cấu trúc bảng cho bảng `nha_xe`
--

CREATE TABLE `nha_xe` (
  `id_NX` int(11) NOT NULL,
  `tenNX` varchar(100) DEFAULT NULL,
  `soDT` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nha_xe`
--

INSERT INTO `nha_xe` (`id_NX`, `tenNX`, `soDT`) VALUES
(6, 'test', '2424242424'),
(7, 'test2', '22222222'),
(8, 'test3', '3333333333');

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
-- Cấu trúc bảng cho bảng `ve`
--

CREATE TABLE `ve` (
  `id_ve` int(11) NOT NULL,
  `id_cd` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tuyenDuong` varchar(100) NOT NULL,
  `lichTrinh` time NOT NULL,
  `ngayDat` date NOT NULL,
  `ghe` varchar(100) NOT NULL,
  `tongGia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ve`
--

INSERT INTO `ve` (`id_ve`, `id_cd`, `id`, `tuyenDuong`, `lichTrinh`, `ngayDat`, `ghe`, `tongGia`) VALUES
(31, 7, 6, 'Ha Noi - Hai Phong', '00:27:00', '2025-06-18', '6,7', '180000');

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
-- Chỉ mục cho bảng `chi_tiet_ve`
--
ALTER TABLE `chi_tiet_ve`
  ADD PRIMARY KEY (`id_ct`),
  ADD UNIQUE KEY `id_ve` (`id_ve`,`so_ghe`);

--
-- Chỉ mục cho bảng `chuyendi`
--
ALTER TABLE `chuyendi`
  ADD PRIMARY KEY (`id_cd`),
  ADD KEY `id_NX` (`id_NX`);

--
-- Chỉ mục cho bảng `nha_xe`
--
ALTER TABLE `nha_xe`
  ADD PRIMARY KEY (`id_NX`);

--
-- Chỉ mục cho bảng `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`id_ve`),
  ADD KEY `id_cd` (`id_cd`),
  ADD KEY `fk_ve_testing` (`id`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_ve`
--
ALTER TABLE `chi_tiet_ve`
  MODIFY `id_ct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chuyendi`
--
ALTER TABLE `chuyendi`
  MODIFY `id_cd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `nha_xe`
--
ALTER TABLE `nha_xe`
  MODIFY `id_NX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `testing`
--
ALTER TABLE `testing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `ve`
--
ALTER TABLE `ve`
  MODIFY `id_ve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_ve`
--
ALTER TABLE `chi_tiet_ve`
  ADD CONSTRAINT `chi_tiet_ve_ibfk_1` FOREIGN KEY (`id_ve`) REFERENCES `ve` (`id_ve`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ve`
--
ALTER TABLE `ve`
  ADD CONSTRAINT `fk_ve_testing` FOREIGN KEY (`id`) REFERENCES `testing` (`id`),
  ADD CONSTRAINT `ve_ibfk_1` FOREIGN KEY (`id_cd`) REFERENCES `chuyendi` (`id_cd`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
