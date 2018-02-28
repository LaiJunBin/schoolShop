-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-02-28 15:57:34
-- 伺服器版本: 10.1.30-MariaDB
-- PHP 版本： 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `school`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `a_id` int(10) NOT NULL,
  `a_name` varchar(10) NOT NULL,
  `a_username` varchar(20) NOT NULL,
  `a_password` varchar(100) NOT NULL,
  `a_phone` varchar(20) NOT NULL,
  `a_level` varchar(10) NOT NULL,
  `a_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a_key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_username`, `a_password`, `a_phone`, `a_level`, `a_date`, `a_key`) VALUES
(6, 'Admin', 'admin', '12345', '0912345678', 'root', '2018-02-28 11:38:35', '202cb962ac59075b964b07152d234b70'),
(7, 'a', 'a', '12345', '0', '店長', '2018-02-28 11:44:17', '375a52cb87b22005816fe7a418ec6660'),
(8, 'asd', 'b', '12345', 'fas', '會計', '2018-02-28 11:48:31', '61becabc40b28581ca291c4c9c2c5d12');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `p_id` int(10) NOT NULL,
  `p_item` varchar(100) NOT NULL,
  `p_img` varchar(100) NOT NULL,
  `p_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_category` varchar(100) NOT NULL,
  `p_other` varchar(100) NOT NULL,
  `p_price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `product`
--

INSERT INTO `product` (`p_id`, `p_item`, `p_img`, `p_date`, `p_category`, `p_other`, `p_price`) VALUES
(1, '奶酥', 'images/product/奶酥吐司.jpg', '2018-02-28 14:54:17', '吐司', '種類:薄片...15,厚片...20', ''),
(2, '冬瓜茶', 'images/product/冬瓜茶.jpg', '2018-02-28 14:54:17', '飲料', '大小:中杯...15,大杯...20', ''),
(3, '冬瓜檸檬茶', 'images/product/冬瓜檸檬.jpg', '2018-02-28 14:54:17', '飲料', '大小:大杯...30', ''),
(4, '珍珠冬瓜鮮奶茶', 'images/product/珍珠冬瓜鮮奶茶.jpg', '2018-02-28 15:41:31', '每週之星', '', '25');

-- --------------------------------------------------------

--
-- 資料表結構 `product_category`
--

CREATE TABLE `product_category` (
  `p_id` int(10) NOT NULL,
  `p_category` varchar(100) NOT NULL,
  `p_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `product_category`
--

INSERT INTO `product_category` (`p_id`, `p_category`, `p_date`) VALUES
(0, '每週之星', '2018-02-28 15:12:38'),
(1, '吐司', '2018-02-28 12:34:13'),
(2, '飲料', '2018-02-28 14:54:38');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `u_id` int(10) NOT NULL,
  `u_name` varchar(10) NOT NULL,
  `u_username` varchar(255) NOT NULL,
  `u_category` varchar(255) NOT NULL,
  `u_gender` varchar(1) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_username`, `u_category`, `u_gender`, `u_password`, `u_phone`) VALUES
(7, 'ada', 'fasf', 'asasfa', '男', '123', 'ed'),
(8, 'adm', '12345', 'dddd', '男', '12345', '09876543');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- 資料表索引 `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`p_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表 AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表 AUTO_INCREMENT `product_category`
--
ALTER TABLE `product_category`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
