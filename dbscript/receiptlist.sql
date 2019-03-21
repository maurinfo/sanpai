-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 17, 2019 at 06:22 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `receiptlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `receiptlist`  AS  select `receipt`.`id` AS `id`,`receipt`.`referenceno` AS `referenceno`,`receipt`.`customerid` AS `customerid`,`receipt`.`datereceipt` AS `datereceipt`,`receipt`.`bankaccountid` AS `bankaccountid`,`receipt`.`amount0` AS `amount0`,`receipt`.`amount1` AS `amount1`,`receipt`.`amount2` AS `amount2`,`receipt`.`amount3` AS `amount3`,`receipt`.`amount4` AS `amount4`,`receipt`.`amount5` AS `amount5`,`receipt`.`amount6` AS `amount6`,`receipt`.`total` AS `total`,`receipt`.`note` AS `note`,`receipt`.`updated` AS `updated`,`receipt`.`updateby` AS `updateby`,`receipt`.`isactive` AS `isactive`,`receipt`.`invoiceid` AS `invoiceid`,`customer`.`yomi` AS `yomi`,`customer`.`code` AS `code`,`customer`.`name` AS `customer` from (`receipt` left join `customer` on((`receipt`.`customerid` = `customer`.`id`))) ;

--
-- VIEW  `receiptlist`
-- Data: None
--

