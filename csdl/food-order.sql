-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220611.3e6b0abbe2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 30, 2022 lúc 03:56 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `food-order`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Huỳnh đăng nghĩa', 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(28, 'Lẩu', 'Food_Category_752.jpg', 'Yes', 'Yes'),
(30, 'Bún ', 'Food_Category_747.jpg', 'Yes', 'Yes'),
(40, 'Nước', 'Food_Category_774.jpg', 'Yes', 'Yes'),
(41, 'Cơm', 'Food_Category_70.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(30, 'Lẩu bò', 'gồm: bò, hành, xả, ...', 80000, 'Food-Name-9803.jpg', 28, 'Yes', 'Yes'),
(31, 'Lẩu hải sản', 'Gồm: tôm, thịt, xúc xích, ....', 60000, 'Food-Name-1031.jpg', 28, 'Yes', 'Yes'),
(32, 'Lẩu chay', 'gồm: nấm, kimchi, ớt, ....', 45000, 'Food-Name-2445.jpg', 28, 'Yes', 'Yes'),
(33, 'Lẩu nấm', 'Gồm: nấm, kimchi, rau,....', 35000, 'Food-Name-9222.jpg', 28, 'Yes', 'Yes'),
(36, 'Bún bò', 'Gồm: hành, bún, bò, ...', 25000, 'Food-Name-194.jpg', 30, 'Yes', 'Yes'),
(37, 'Bún riêu', 'Gồm: cua, chả, hành, ...', 25000, 'Food-Name-2780.jpg', 30, 'Yes', 'Yes'),
(40, 'Bún măng vịt', 'Gồm: vịt, hành, măng, ...', 25000, 'Food-Name-7017.jpg', 30, 'Yes', 'Yes'),
(41, 'Bún đậu mắm tôm', 'Gồm: bún, mắm tôm, dồi nướng, ...', 38000, 'Food-Name-794.jpg', 30, 'Yes', 'Yes'),
(43, 'Nước dâu', 'Gồm: dâu, lá, nước, ...', 17000, 'Food-Name-491.jpg', 40, 'Yes', 'Yes'),
(44, 'Trà đào', 'Gồm: trà, đào, ...', 22000, 'Food-Name-7224.jpg', 40, 'Yes', 'Yes'),
(45, 'Nước dưa hấu', 'Gồm: dưa, lá, ...', 22000, 'Food-Name-1542.jpg', 40, 'Yes', 'Yes'),
(46, 'Nước chanh', 'Gồm: chanh, lá chanh, ... ', 17000, 'Food-Name-7049.jpg', 40, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(6, 'Lẩu bò', 80000, 1, 80000, '2022-06-02 04:24:57', 'Delivered', 'nghia', '12345', 'nghia@gmail.com', '123lvh'),
(17, 'Lẩu nấm(2) Lẩu bò(1) Lẩu chay(1) ', 195000, 4, 195000, '2022-06-08 12:53:54', 'Ordered', 'nghia', '0905321220', 'huynhdangnghia68@gmail.com', '631 LÊ VĂN HIẾN, HÒA HẢI, NGŨ HÀNH SƠN, ĐÀ NẴNG'),
(18, 'Lẩu nấm(2) Bún bò(3) ', 145000, 5, 725000, '2022-06-08 03:11:32', 'On Delivery', 'nghia', '123', 'nghia@gmail.com', '631 LÊ VĂN HIẾN, HÒA HẢI, NGŨ HÀNH SƠN, ĐÀ NẴNG');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



