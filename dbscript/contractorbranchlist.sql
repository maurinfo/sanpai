-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 27, 2019 at 03:33 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `contractorbranchlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contractorbranchlist`  AS  select `contractorbranch`.`id` AS `id`,`contractorbranch`.`contractorid` AS `contractorid`,`contractorbranch`.`name` AS `name`,`contractorbranch`.`yomi` AS `yomi`,`contractorbranch`.`contactperson` AS `contactperson`,`contractorbranch`.`department` AS `department`,`contractorbranch`.`zip` AS `zip`,`contractorbranch`.`prefectureid` AS `prefectureid`,`contractorbranch`.`address1` AS `address1`,`contractorbranch`.`address2` AS `address2`,`contractorbranch`.`telno` AS `telno`,`contractorbranch`.`faxno` AS `faxno`,`contractorbranch`.`email` AS `email`,`contractorbranch`.`notes` AS `notes`,`contractorbranch`.`isactive` AS `isactive`,`contractorbranch`.`created_at` AS `created_at`,`contractorbranch`.`updated_at` AS `updated_at`,`contractor`.`name` AS `contractor`,`contractor`.`zip` AS `contractorzip`,`contractor`.`address1` AS `contractoradd1`,`contractor`.`address2` AS `contractoradd2` from (`contractorbranch` left join `contractor` on((`contractorbranch`.`contractorid` = `contractor`.`id`))) ;

--
-- VIEW  `contractorbranchlist`
-- Data: None
--
