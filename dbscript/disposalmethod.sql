-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 05, 2019 at 10:59 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposalmethod`
--

CREATE TABLE `disposalmethod` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `yomi` varchar(255) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `updateby` int(11) DEFAULT NULL,
  `isactive` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disposalmethod`
--

INSERT INTO `disposalmethod` (`id`, `code`, `name`, `yomi`, `updated`, `updateby`, `isactive`) VALUES
(1, NULL, '破砕', NULL, NULL, NULL, 0),
(2, NULL, '選別', NULL, NULL, NULL, 1),
(3, NULL, '焙焼', NULL, NULL, NULL, 1),
(4, NULL, '中和', NULL, NULL, NULL, 1),
(5, NULL, '焼却', NULL, NULL, NULL, 1),
(6, NULL, '埋立', NULL, NULL, NULL, 1),
(7, NULL, '再生', NULL, NULL, NULL, 1),
(8, NULL, '分離', NULL, NULL, NULL, 1),
(9, NULL, '洗浄', NULL, NULL, NULL, 1),
(10, NULL, '解体', NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposalmethod`
--
ALTER TABLE `disposalmethod`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposalmethod`
--
ALTER TABLE `disposalmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
