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
-- Structure for view `invoiceprintlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `invoiceprintlist`  AS  select `printq`.`typeid` AS `typeid`,`printq`.`referenceid` AS `referenceid`,`printq`.`addedbyid` AS `addedbyid` from `printq` where (`printq`.`typeid` = 2) ;

--
-- VIEW  `invoiceprintlist`
-- Data: None
--

