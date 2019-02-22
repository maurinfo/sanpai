-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 22, 2019 at 11:01 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `salelist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `salelist`  AS  select `sale`.`id` AS `id`,`sale`.`referenceno` AS `referenceno`,`sale`.`customerid` AS `customerid`,`sale`.`datedelivered` AS `datedelivered`,`sale`.`subtotal` AS `subtotal`,`sale`.`autotax` AS `autotax`,`sale`.`tax` AS `tax`,`sale`.`total` AS `total`,`sale`.`note` AS `note`,`sale`.`updated` AS `updated`,`sale`.`updateby` AS `updateby`,`sale`.`isactive` AS `isactive`,`sale`.`showdate` AS `showdate`,`sale`.`invoiceid` AS `invoiceid`,`sale`.`dateprinted` AS `dateprinted`,`sale`.`postdate` AS `postdate`,`customer`.`code` AS `code`,`customer`.`name` AS `name`,`customer`.`yomi` AS `yomi` from (`sale` left join `customer` on((`sale`.`customerid` = `customer`.`id`))) ;

--
-- VIEW  `salelist`
-- Data: None
--

