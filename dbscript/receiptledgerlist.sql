-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 11, 2019 at 05:04 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `receiptledgerlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `receiptledgerlist`  AS  select `accountledger`.`id` AS `id`,`accountledger`.`firmid` AS `firmid`,`accountledger`.`datetransacted` AS `datetransacted`,`accountledger`.`transactiontypeid` AS `transactiontypeid`,`accountledger`.`referenceid` AS `referenceid`,`accountledger`.`amount` AS `amount` from `accountledger` where (`accountledger`.`transactiontypeid` = 2) ;

--
-- VIEW  `receiptledgerlist`
-- Data: None
--

