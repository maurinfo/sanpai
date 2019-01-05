-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 05, 2019 at 11:55 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `furigana` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `telno` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `position` varchar(255) NOT NULL,
  `hiredate` date NOT NULL,
  `schedulein` time DEFAULT NULL,
  `scheduleout` time DEFAULT NULL,
  `resigndate` date DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `accesslevel` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `furigana`, `birthdate`, `gender`, `zip`, `address1`, `address2`, `telno`, `email`, `position`, `hiredate`, `schedulein`, `scheduleout`, `resigndate`, `username`, `password`, `accesslevel`, `created_at`, `updated_at`) VALUES
(60, 'Jun Maurin', 'じゅん', '1981-10-09', 1, '123-0864', '4-12-11 Shikahama', '201 Famiru Bireji', '08088723514', 'maurinfo@icloud.com', 'IT', '1901-11-14', '00:00:00', '00:00:00', '1901-11-07', 'gmaurin', 'jun1234567890', 0, '2019-01-01 15:15:22', '2019-01-01 15:15:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
