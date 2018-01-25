-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th1 25, 2018 lúc 03:04 PM
-- Phiên bản máy phục vụ: 5.7.21-0ubuntu0.16.04.1
-- Phiên bản PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `haposoft`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `staff`
--

INSERT INTO `staff` (`id_staff`, `name`, `username`, `password`, `role`) VALUES
(1, 'Anh Đức', 'anhduc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'Ngọc Hiền', 'ngochien@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2),
(3, 'Tiến Dũng', 'tiendung@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(4, 'Quang Hải', 'quanghai@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `time_staff`
--

CREATE TABLE `time_staff` (
  `id` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `start_pause_time` varchar(50) NOT NULL,
  `end_pause_time` varchar(50) NOT NULL,
  `created_time` int(11) NOT NULL,
  `created_day` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `work_time` varchar(50) NOT NULL,
  `pause_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `time_staff`
--

INSERT INTO `time_staff` (`id`, `id_staff`, `start_time`, `end_time`, `start_pause_time`, `end_pause_time`, `created_time`, `created_day`, `month`, `year`, `work_time`, `pause_time`) VALUES
(1, 1, '8:00', '19:00', '0:00', '0:00', 1516845277, '25/01/2018', '01', '2018', '36000', '0'),
(2, 1, '8:30', '17:50', '9:00', '9:30', 1516845355, '25/01/2018', '01', '2018', '28200', '0'),
(3, 1, '8:15', '18:30', '0:00', '0:00', 1516846303, '25/01/2018', '01', '2018', '33300', '0'),
(4, 1, '7:30', '18:30', '8:30', '9:00', 1516847404, '25/01/2018', '01', '2018', '34200', '1800'),
(5, 3, '8:30', '17:50', '9:00', '9:30', 1516845355, '25/01/2018', '01', '2018', '28200', '0'),
(6, 3, '8:30', '17:50', '9:00', '9:30', 1516845355, '25/01/2018', '01', '2018', '28200', '0'),
(7, 4, '8:00', '19:00', '0:00', '0:00', 1516845277, '25/01/2018', '01', '2018', '36000', '0');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Chỉ mục cho bảng `time_staff`
--
ALTER TABLE `time_staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `time_staff`
--
ALTER TABLE `time_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
