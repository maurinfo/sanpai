-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 28, 2019 at 04:37 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `forwarderlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `forwarderlist`  AS  select `forwarder`.`id` AS `id`,`forwarder`.`name` AS `name`,`forwarder`.`yomi` AS `yomi`,`forwarder`.`contactperson` AS `contactperson`,`forwarder`.`department` AS `department`,`forwarder`.`zip` AS `zip`,`forwarder`.`prefectureid` AS `prefectureid`,`forwarder`.`address1` AS `address1`,`forwarder`.`address2` AS `address2`,`forwarder`.`telno` AS `telno`,`forwarder`.`faxno` AS `faxno`,`forwarder`.`email` AS `email`,`forwarder`.`notes` AS `notes`,`forwarder`.`isactive` AS `isactive`,`forwarder`.`created_at` AS `created_at`,`forwarder`.`updated_at` AS `updated_at`,if(isnull(`permit`.`id`),0,1) AS `haspermit` from (`forwarder` left join (select distinct `permit`.`firmid` AS `id` from `permit` where (`permit`.`isactive` = 1)) `permit` on((`forwarder`.`id` = `permit`.`id`))) where (`forwarder`.`isactive` = 1) ;

--
-- VIEW  `forwarderlist`
-- Data: None
--

