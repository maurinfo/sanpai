-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 24, 2019 at 02:48 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `paymentlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `paymentlist`  AS  select `payment`.`id` AS `id`,`payment`.`referenceno` AS `referenceno`,`payment`.`supplierid` AS `supplierid`,`payment`.`datepayment` AS `datepayment`,`payment`.`bankaccountid` AS `bankaccountid`,`payment`.`amount0` AS `amount0`,`payment`.`amount1` AS `amount1`,`payment`.`amount2` AS `amount2`,`payment`.`amount3` AS `amount3`,`payment`.`amount4` AS `amount4`,`payment`.`amount5` AS `amount5`,`payment`.`amount6` AS `amount6`,`payment`.`total` AS `total`,`payment`.`note` AS `note`,`payment`.`updated` AS `updated`,`payment`.`updateby` AS `updateby`,`payment`.`isactive` AS `isactive`,`payment`.`invoiceid` AS `invoiceid`,`supplier`.`yomi` AS `yomi`,`supplier`.`name` AS `supplier` from (`payment` left join `supplier` on((`payment`.`supplierid` = `supplier`.`id`))) ;

--
-- VIEW  `paymentlist`
-- Data: None
--

