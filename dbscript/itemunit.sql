-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 04, 2019 at 08:26 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemunit`
--

CREATE TABLE `itemunit` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `yomi` varchar(20) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateby` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemunit`
--

INSERT INTO `itemunit` (`id`, `code`, `name`, `yomi`, `updated`, `updateby`, `isactive`) VALUES
(1, NULL, 'kg', 'あ', '2019-01-29 11:49:31', NULL, 1),
(2, NULL, '本', 'が', '2019-01-29 11:49:31', NULL, 1),
(3, NULL, 'L', 'か', '2019-01-29 11:49:31', NULL, 1),
(4, NULL, '式', 'しき', '2019-01-29 11:49:31', NULL, 1),
(5, NULL, '車', 'しゃ', '2019-01-29 11:49:31', NULL, 1),
(6, NULL, '回', 'かい', '2019-01-29 11:49:31', NULL, 1),
(7, NULL, '台', 'だい', '2019-01-29 11:49:31', NULL, 1),
(8, NULL, '枚', 'まい', '2019-01-29 11:49:31', NULL, 1),
(9, NULL, '箱', 'は', '2019-01-29 11:49:31', NULL, 1),
(10, NULL, 'ドラム', 'どらむ', '2019-01-29 11:49:31', NULL, 1),
(11, NULL, '個', 'こ', '2019-01-29 11:49:31', NULL, 1),
(12, NULL, 'ヶ月間', 'かげつ', '2019-01-29 11:49:31', NULL, 1),
(13, NULL, 'unit', 'u', '2019-02-25 12:18:11', NULL, 0),
(14, NULL, '1test', '１', '2019-02-25 12:18:32', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemunit`
--
ALTER TABLE `itemunit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itemunit`
--
ALTER TABLE `itemunit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
