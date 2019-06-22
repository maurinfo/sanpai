-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 22, 2019 at 04:59 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `salelist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `salelist`  AS  select `sale`.`id` AS `id`,`sale`.`referenceno` AS `referenceno`,`sale`.`customerid` AS `customerid`,`sale`.`datedelivered` AS `datedelivered`,`sale`.`subtotal` AS `subtotal`,`sale`.`autotax` AS `autotax`,`sale`.`tax` AS `tax`,`sale`.`total` AS `total`,`sale`.`note` AS `note`,`sale`.`updated` AS `updated`,`sale`.`updateby` AS `updateby`,`sale`.`isactive` AS `isactive`,`sale`.`showdate` AS `showdate`,`sale`.`invoiceid` AS `invoiceid`,`sale`.`dateprinted` AS `dateprinted`,`sale`.`postdate` AS `postdate`,`customer`.`code` AS `code`,`customer`.`yomi` AS `yomi`,`customer`.`name` AS `name`,`saleprintlist`.`referenceid` AS `referenceid` from ((`sale` left join `customer` on((`sale`.`customerid` = `customer`.`id`))) left join `saleprintlist` on((`sale`.`id` = `saleprintlist`.`referenceid`))) where (`sale`.`isactive` = 1) ;

--
-- VIEW  `salelist`
-- Data: None
--

