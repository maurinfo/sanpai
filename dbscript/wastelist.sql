-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 04, 2019 at 01:38 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `wastelist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wastelist`  AS  select `item`.`id` AS `id`,`item`.`name` AS `name`,`item`.`yomi` AS `yomi`,`item`.`itemclassid` AS `itemclassid`,`item`.`itemcategoryid` AS `itemcategoryid`,`item`.`itemunitid` AS `itemunitid`,`item`.`created_at` AS `created_at`,`item`.`updated_at` AS `updated_at`,`item`.`isactive` AS `isactive`,`itemcategory`.`name` AS `category`,`itemunit`.`name` AS `unit` from ((`item` left join `itemcategory` on((`item`.`itemcategoryid` = `itemcategory`.`id`))) left join `itemunit` on((`item`.`itemunitid` = `itemunit`.`id`))) where (`item`.`itemclassid` = 0) ;

--
-- VIEW  `wastelist`
-- Data: None
--

