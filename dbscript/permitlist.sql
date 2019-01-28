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
-- Structure for view `permitlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `permitlist`  AS  select `permit`.`id` AS `id`,`permit`.`permitno` AS `permitno`,`permit`.`permitclassid` AS `permitclassid`,`permit`.`prefectureid` AS `prefectureid`,`permit`.`permittype` AS `permittype`,`permit`.`firmid` AS `firmid`,`permit`.`dateexpire` AS `dateexpire`,`permit`.`isactive` AS `isactive`,`permitclass`.`name` AS `permitclass`,`prefecture`.`name` AS `prefecture` from ((`permit` left join `permitclass` on((`permit`.`permitclassid` = `permitclass`.`id`))) left join `prefecture` on((`permit`.`prefectureid` = `prefecture`.`id`))) ;

--
-- VIEW  `permitlist`
-- Data: None
--

