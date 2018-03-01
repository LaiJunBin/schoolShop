-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-03-01 16:43:34
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
(6, 'admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '0912345678', 'root', '2018-02-28 11:38:35', '202cb962ac59075b964b07152d234b70'),
(7, 'a', 'a', '827ccb0eea8a706c4c34a16891f84e7b', '0', '店長', '2018-02-28 11:44:17', '375a52cb87b22005816fe7a418ec6660'),
(8, 'asd', 'b', '827ccb0eea8a706c4c34a16891f84e7b', 'fas', '會計', '2018-02-28 11:48:31', '61becabc40b28581ca291c4c9c2c5d12');

-- --------------------------------------------------------

--
-- 資料表結構 `order_status`
--

CREATE TABLE `order_status` (
  `o_code` varchar(100) NOT NULL,
  `o_status` varchar(100) NOT NULL DEFAULT '新訂單',
  `o_pay` varchar(1) NOT NULL DEFAULT 'F'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `order_status`
--

INSERT INTO `order_status` (`o_code`, `o_status`, `o_pay`) VALUES
('20180301001', '已完成', 'T'),
('20180301002', '新訂單', 'F'),
('20180301003', '新訂單', 'F');

-- --------------------------------------------------------

--
-- 資料表結構 `order_table`
--

CREATE TABLE `order_table` (
  `o_id` int(10) NOT NULL,
  `o_user` varchar(100) NOT NULL,
  `o_code` varchar(100) NOT NULL,
  `o_item` varchar(100) NOT NULL,
  `o_price` varchar(100) NOT NULL,
  `o_amount` varchar(100) NOT NULL,
  `o_other` varchar(100) NOT NULL,
  `o_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `o_reserve` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `order_table`
--

INSERT INTO `order_table` (`o_id`, `o_user`, `o_code`, `o_item`, `o_price`, `o_amount`, `o_other`, `o_date`, `o_reserve`) VALUES
(1, 'admin', '20180301001', '珍珠冬瓜鮮奶茶', '25', '2', '一般', '2018-03-01 09:16:06', '第3節下課(11:00)'),
(2, 'admin', '20180301001', '奶酥', '20', '1', '厚片', '2018-03-01 09:16:06', '第3節下課(11:00)'),
(3, 'admin', '20180301002', '奶酥', '15', '3', '薄片', '2018-03-01 09:29:06', '第2節下課(10:00)'),
(8, 'admin', '20180301003', '珍珠冬瓜鮮奶茶', '25', '3', '一般', '2018-03-01 23:30:40', '第7節下課(3:00)'),
(9, 'admin', '20180301003', '冬瓜茶', '20', '3', '大杯', '2018-03-01 23:30:40', '第7節下課(3:00)'),
(10, 'admin', '20180301003', '冬瓜茶', '15', '1', '中杯', '2018-03-01 23:30:40', '第7節下課(3:00)');

-- --------------------------------------------------------

--
-- 資料表結構 `problem`
--

CREATE TABLE `problem` (
  `p_id` int(10) NOT NULL,
  `p_title` varchar(100) NOT NULL,
  `p_option` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `problem`
--

INSERT INTO `problem` (`p_id`, `p_title`, `p_option`) VALUES
(1, '校園e指購系統使用滿意度', '非常滿意,滿意,普通,不滿意,非常不滿意'),
(2, '對餐點的滿意度', '非常滿意,滿意,普通,不滿意,非常不滿意'),
(3, '對本次服務的滿意度', '非常滿意,滿意,普通,不滿意,非常不滿意'),
(4, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '是,否');

-- --------------------------------------------------------

--
-- 資料表結構 `problem_record`
--

CREATE TABLE `problem_record` (
  `p_id` int(10) NOT NULL,
  `p_title` varchar(100) NOT NULL,
  `p_solution` varchar(100) NOT NULL,
  `p_user` varchar(100) NOT NULL,
  `p_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `problem_record`
--

INSERT INTO `problem_record` (`p_id`, `p_title`, `p_solution`, `p_user`, `p_date`) VALUES
(1, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:32'),
(2, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:32'),
(3, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(4, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(5, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(6, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(7, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(8, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(9, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(10, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(11, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(12, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(13, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(14, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(15, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:33'),
(16, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:49'),
(17, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(18, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(19, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(20, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(21, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(22, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(23, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(24, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(25, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(26, '校園e指購系統使用滿意度', '非常滿意', 'admin', '2018-03-01 11:23:50'),
(27, '校園e指購系統使用滿意度', '滿意', 'admin', '2018-03-01 11:24:03'),
(28, '校園e指購系統使用滿意度', '滿意', 'admin', '2018-03-01 11:24:03'),
(29, '校園e指購系統使用滿意度', '滿意', 'admin', '2018-03-01 11:24:03'),
(30, '校園e指購系統使用滿意度', '普通', 'admin', '2018-03-01 11:24:11'),
(31, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:36'),
(32, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:36'),
(33, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:36'),
(34, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(35, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(36, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(37, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(38, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(39, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(40, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(41, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(42, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(43, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(44, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(45, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(46, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(47, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(48, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(49, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(50, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(51, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(52, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(53, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(54, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(55, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(56, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:37'),
(57, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:50'),
(58, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:50'),
(59, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:50'),
(60, '對餐點的滿意度', '非常滿意', 'admin', '2018-03-01 11:24:50'),
(61, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(62, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(63, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(64, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(65, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(66, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(67, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(68, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(69, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(70, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(71, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(72, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(73, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(74, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(75, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(76, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(77, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(78, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(79, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(80, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(81, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(82, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(83, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(84, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(85, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(86, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(87, '對本次服務的滿意度', '非常滿意', 'admin', '2018-03-01 11:26:28'),
(88, '對本次服務的滿意度', '滿意', 'admin', '2018-03-01 11:26:28'),
(89, '對本次服務的滿意度', '滿意', 'admin', '2018-03-01 11:26:28'),
(90, '對本次服務的滿意度', '滿意', 'admin', '2018-03-01 11:26:28'),
(91, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(92, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(93, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(94, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(95, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(96, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(97, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(98, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(99, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(100, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(101, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(102, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(103, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(104, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(105, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(106, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(107, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(108, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(109, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(110, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(111, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(112, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(113, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(114, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(115, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:03'),
(116, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:04'),
(117, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:04'),
(118, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:04'),
(119, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:04'),
(120, '是否有因為校園e指購系統而減少訂餐等待、排隊時間', '非常滿意', 'admin', '2018-03-01 11:27:04');

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
(8, 'adm', '12345', 'dddd', '男', '12345', '09876543'),
(9, '1234', '1234', '1234', '男', '1234', '1234');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- 資料表索引 `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`o_code`);

--
-- 資料表索引 `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`o_id`);

--
-- 資料表索引 `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`p_id`);

--
-- 資料表索引 `problem_record`
--
ALTER TABLE `problem_record`
  ADD PRIMARY KEY (`p_id`);

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
-- 使用資料表 AUTO_INCREMENT `order_table`
--
ALTER TABLE `order_table`
  MODIFY `o_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表 AUTO_INCREMENT `problem`
--
ALTER TABLE `problem`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表 AUTO_INCREMENT `problem_record`
--
ALTER TABLE `problem_record`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
