create database RD5 default character set utf8;

USE RD5;

-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2020 年 09 月 08 日 07:15
-- 伺服器版本： 5.7.26
-- PHP 版本： 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 資料庫： `RD5`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `accountid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `account`
--

INSERT INTO `account` (`accountid`, `password`, `amount`) VALUES
('root', 'root', 6900),
('yyyy', '1234', 6400);

-- --------------------------------------------------------

--
-- 資料表結構 `detail`
--

CREATE TABLE `detail` (
  `id` int(11) NOT NULL,
  `accountid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `typeamount` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `result` enum('OK','ERROR') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `detail`
--

INSERT INTO `detail` (`id`, `accountid`, `type`, `typeamount`, `date`, `result`) VALUES
(22, 'root', '存款', 2000, '2020-08-25 15:33:01', 'OK'),
(23, 'root', '存款', 5000, '2020-08-25 15:34:49', 'OK'),
(25, 'root', '提款', 5000, '2020-08-25 15:41:45', 'OK'),
(26, 'root', '存款', 2000, '2020-08-25 15:47:12', 'OK'),
(27, 'root', '存款', 5000, '2020-08-25 15:48:13', 'OK'),
(28, 'root', '提款', 5000, '2020-08-25 15:48:26', 'OK'),
(32, 'root', '存款', 0, '2020-08-25 16:15:50', 'OK'),
(33, 'root', '提款', 0, '2020-08-25 16:26:12', 'OK'),
(34, 'root', '存款', 100, '2020-08-25 16:35:45', 'OK'),
(35, 'root', '存款', 100, '2020-08-25 16:35:55', 'OK'),
(36, 'root', '存款', 1000, '2020-08-25 16:38:10', 'OK'),
(37, 'root', '存款', 100, '2020-08-25 16:50:23', 'OK'),
(38, 'root', '提款', 100, '2020-08-25 16:50:35', 'OK'),
(39, 'root', '提款', 100, '2020-08-25 16:51:59', 'OK'),
(40, 'yyyy', '存款', 2000, '2020-08-26 13:42:22', 'OK'),
(41, 'yyyy', '存款', 1000, '2020-08-26 13:42:41', 'OK'),
(42, 'yyyy', '存款', 200, '2020-08-26 13:43:12', 'OK'),
(43, 'yyyy', '提款', 200, '2020-08-26 13:43:23', 'OK'),
(44, 'yyyy', '存款', 200, '2020-08-26 14:01:47', 'OK'),
(45, 'yyyy', '存款', 2000, '2020-08-26 14:01:47', 'OK'),
(46, 'yyyy', '存款', 1000, '2020-08-26 14:03:07', 'OK'),
(47, 'yyyy', '存款', 200, '2020-08-26 14:03:31', 'OK'),
(48, 'yyyy', '存款', 5000, '2020-08-26 14:03:31', 'OK'),
(49, 'yyyy', '存款', 200, '2020-08-26 14:04:31', 'OK'),
(50, 'yyyy', '存款', 200, '2020-08-26 14:04:55', 'OK'),
(51, 'root', '提款', 100, '2020-09-08 09:45:58', 'OK'),
(52, 'root', '提款', 100, '2020-09-08 09:47:01', 'OK'),
(53, 'root', '存款', 2000, '2020-09-08 09:50:28', 'OK'),
(54, 'yyyy', '存款', 1000, '2020-09-08 09:52:12', 'OK');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountid`);

--
-- 資料表索引 `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountid` (`accountid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`accountid`) REFERENCES `account` (`accountid`);