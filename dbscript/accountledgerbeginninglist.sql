-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 19, 2019 at 12:01 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `accountledgerbeginninglist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `accountledgerbeginninglist`  AS  select `accountledgerbeginning`.`id` AS `id`,`accountledgerbeginning`.`fiscalyearid` AS `fiscalyearid`,`accountledgerbeginning`.`firmclassid` AS `firmclassid`,`accountledgerbeginning`.`firmid` AS `firmid`,`accountledgerbeginning`.`beginningbalance` AS `beginningbalance`,`fiscalyear`.`datestart` AS `datestart`,`fiscalyear`.`dateend` AS `dateend` from (`accountledgerbeginning` left join `fiscalyear` on((`accountledgerbeginning`.`fiscalyearid` = `fiscalyear`.`id`))) order by `accountledgerbeginning`.`firmclassid`,`accountledgerbeginning`.`firmid`,`fiscalyear`.`datestart` ;

--
-- VIEW  `accountledgerbeginninglist`
-- Data: None
--

