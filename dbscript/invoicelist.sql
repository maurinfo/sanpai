-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 18, 2019 at 01:40 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `invoicelist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `invoicelist`  AS  select `invoice`.`id` AS `id`,`invoice`.`referenceno` AS `referenceno`,`invoice`.`customerid` AS `customerid`,`invoice`.`datestart` AS `datestart`,`invoice`.`dateend` AS `dateend`,`invoice`.`datedue` AS `datedue`,`invoice`.`showduedate` AS `showduedate`,`invoice`.`bankacctdetail` AS `bankacctdetail`,`invoice`.`subtotal` AS `subtotal`,`invoice`.`autotax` AS `autotax`,`invoice`.`tax` AS `tax`,`invoice`.`total` AS `total`,`invoice`.`note` AS `note`,`invoice`.`updated` AS `updated`,`invoice`.`updateby` AS `updateby`,`invoice`.`isactive` AS `isactive`,`invoice`.`dateprinted` AS `dateprinted`,`invoice`.`postdate` AS `postdate`,`customer`.`yomi` AS `yomi`,`customer`.`name` AS `name` from (`invoice` left join `customer` on((`invoice`.`customerid` = `customer`.`id`))) where (`invoice`.`isactive` = 1) ;

--
-- VIEW  `invoicelist`
-- Data: None
--

