-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 20, 2019 at 02:39 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemprice`
--

CREATE TABLE `itemprice` (
  `id` int(11) NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `itemunitid` int(11) DEFAULT NULL,
  `price` decimal(15,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemprice`
--
ALTER TABLE `itemprice`
  ADD PRIMARY KEY (`id`);
