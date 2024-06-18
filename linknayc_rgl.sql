-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 18, 2024 lúc 06:59 PM
-- Phiên bản máy phục vụ: 10.3.39-MariaDB-cll-lve
-- Phiên bản PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `linknayc_rgl`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cookie`
--

CREATE TABLE `cookie` (
  `cookie` varchar(30) NOT NULL,
  `id_username` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `cookie`
--

INSERT INTO `cookie` (`cookie`, `id_username`) VALUES
('K1ZSsMksfC6C0PprYoYyZqxsDQCPQH', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kh`
--

CREATE TABLE `kh` (
  `stt` int(11) NOT NULL,
  `cookie_kh` varchar(30) NOT NULL,
  `id_link` int(11) NOT NULL,
  `date_time_request` datetime NOT NULL,
  `data_time_return` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `kh`
--

INSERT INTO `kh` (`stt`, `cookie_kh`, `id_link`, `date_time_request`, `data_time_return`, `ip`, `info`) VALUES
(31, 'O07kPV0OXsA3ALC9SS0CDvsN2jd6U8', 10, '2024-06-18 11:16:20', '2024-06-18 11:16:26', '183.80.56.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0'),
(32, 'au9w8wZjpodi55bR7akksJvY6iQdp6', 10, '2024-06-18 11:27:05', '2024-06-18 11:27:11', '183.80.56.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36'),
(33, 'O07kPV0OXsA3ALCknS91WSGs8AEfvN', 10, '2024-06-18 11:56:20', '2024-06-18 11:56:26', '183.80.56.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link`
--

CREATE TABLE `link` (
  `id_link` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `input_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `output_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `kiem_tien` int(1) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `link`
--

INSERT INTO `link` (`id_link`, `id_user`, `input_link`, `output_link`, `kiem_tien`, `date_time`) VALUES
(10, 1, 'https://www.facebook.com/huutkang93/', 'thang', 0, '2024-06-18 11:12:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ho_ten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `admin` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdt` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ngan_hang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `so_tai_khoan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `ho_ten`, `admin`, `email`, `sdt`, `ngan_hang`, `so_tai_khoan`) VALUES
(1, 'thang', '202cb962ac59075b964b07152d234b70', '', 0, '', '', '', ''),
(2, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '', '', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `kh`
--
ALTER TABLE `kh`
  ADD PRIMARY KEY (`stt`);

--
-- Chỉ mục cho bảng `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id_link`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `kh`
--
ALTER TABLE `kh`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `link`
--
ALTER TABLE `link`
  MODIFY `id_link` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
