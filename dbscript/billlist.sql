-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 01, 2019 at 02:33 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `billlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `billlist`  AS  select `bill`.`id` AS `id`,`bill`.`referenceno` AS `referenceno`,`bill`.`supplierid` AS `supplierid`,`bill`.`datestart` AS `datestart`,`bill`.`dateend` AS `dateend`,`bill`.`datedue` AS `datedue`,`bill`.`showduedate` AS `showduedate`,`bill`.`bankacctdetail` AS `bankacctdetail`,`bill`.`subtotal` AS `subtotal`,`bill`.`autotax` AS `autotax`,`bill`.`tax` AS `tax`,`bill`.`total` AS `total`,`bill`.`note` AS `note`,`bill`.`updated` AS `updated`,`bill`.`updateby` AS `updateby`,`bill`.`isactive` AS `isactive`,`bill`.`postdate` AS `postdate`,`supplier`.`code` AS `code`,`supplier`.`yomi` AS `yomi`,`supplier`.`name` AS `name` from (`bill` left join `supplier` on((`bill`.`supplierid` = `supplier`.`id`))) ;

--
-- VIEW  `billlist`
-- Data: None
--
