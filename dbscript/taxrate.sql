-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 04, 2019 at 10:47 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `taxrate`
--

CREATE TABLE `taxrate` (
  `id` int(11) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `rate` decimal(15,4) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updateby` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taxrate`
--

INSERT INTO `taxrate` (`id`, `startdate`, `enddate`, `rate`, `updated`, `updateby`, `isactive`) VALUES
(1, '2013-04-01', '2014-03-31', '5.0000', '2019-03-04 00:58:17', NULL, 1),
(2, '2014-04-01', NULL, '8.0000', '2019-03-04 00:58:17', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `taxrate`
--
ALTER TABLE `taxrate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `taxrate`
--
ALTER TABLE `taxrate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
