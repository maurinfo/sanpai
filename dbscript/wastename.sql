-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 05, 2019 at 11:49 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `wastename`
--

CREATE TABLE `wastename` (
  `ID` int(2) DEFAULT NULL,
  `CODE` int(4) DEFAULT NULL,
  `NAME` varchar(10) DEFAULT NULL,
  `YOMI` varchar(4) DEFAULT NULL,
  `UPDATED` varchar(10) DEFAULT NULL,
  `UPDATEBY` varchar(10) DEFAULT NULL,
  `ISACTIVE` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wastename`
--

INSERT INTO `wastename` (`ID`, `CODE`, `NAME`, `YOMI`, `UPDATED`, `UPDATEBY`, `ISACTIVE`) VALUES
(1, 10, 'ガラス＋金属くず', NULL, NULL, NULL, 1),
(2, 20, '金属くず＋汚泥', NULL, NULL, NULL, 1),
(3, 100, '燃えがら', NULL, NULL, NULL, 1),
(4, 200, '汚泥', NULL, NULL, NULL, 1),
(5, 300, '廃油', NULL, NULL, NULL, 1),
(6, 400, '廃酸', NULL, NULL, NULL, 1),
(7, 500, '廃アルカリ', NULL, NULL, NULL, 1),
(8, 600, '廃ﾌﾟﾗｽﾁｯｸ類', NULL, NULL, NULL, 1),
(9, 1200, '金属くず', NULL, NULL, NULL, 1),
(10, 1300, 'ガラスくず・陶磁器屑', NULL, NULL, NULL, 1),
(11, 7000, '○引火性廃油', NULL, NULL, NULL, 1),
(12, 7010, '○引火性廃油（有害）', NULL, NULL, NULL, 1),
(13, 7100, '○強酸', NULL, NULL, NULL, 1),
(14, 7110, '○強酸（有害）', NULL, NULL, NULL, 1),
(15, 7200, '○強アルカリ', NULL, NULL, NULL, 1),
(16, 7210, '○強アルカリ（有害）', NULL, NULL, NULL, 1),
(17, 7300, '○感染性廃棄物', NULL, NULL, NULL, 1),
(18, 7421, '○廃石綿等', NULL, NULL, NULL, 1),
(19, 7425, '○廃油（有害）', NULL, NULL, NULL, 1),
(20, 7426, '○汚泥（有害）', NULL, NULL, NULL, 1),
(21, 7427, '○廃酸（有害）', NULL, NULL, NULL, 1),
(22, 7428, '○廃アルカリ（有害）', NULL, NULL, NULL, 1),
(23, 7429, '○廃液', NULL, NULL, NULL, 1),
(24, 7435, 'ガラスくず', NULL, NULL, NULL, 1),
(25, 7436, '○感染性廃棄物', NULL, NULL, NULL, 1),
(26, NULL, '廃液', 'はいえき', NULL, NULL, 1),
(27, NULL, '○廃酸', NULL, NULL, NULL, 1),
(28, 7009, '○水銀等', 'すいぎん', NULL, NULL, 1);
