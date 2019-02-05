-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 05, 2019 at 12:05 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `manifestlist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `manifestlist`  AS  select `manifest`.`id` AS `id`,`manifest`.`referenceno` AS `referenceno`,`manifest`.`datemanifest` AS `datemanifest`,`manifest`.`incharge` AS `incharge`,`manifest`.`contractorid` AS `contractorid`,`manifest`.`contractorbranchid` AS `contractorbranchid`,`manifest`.`permitclassid` AS `permitclassid`,`manifest`.`wasteclassid` AS `wasteclassid`,`manifest`.`itemid` AS `itemid`,`manifest`.`otheritemname` AS `otheritemname`,`manifest`.`qty` AS `qty`,`manifest`.`itemunitid` AS `itemunitid`,`manifest`.`1forwarderid` AS `1forwarderid`,`manifest`.`1forwardpermitid` AS `1forwardpermitid`,`manifest`.`1dateforward` AS `1dateforward`,`manifest`.`2forwarderid` AS `2forwarderid`,`manifest`.`2forwardpermitid` AS `2forwardpermitid`,`manifest`.`2dateforward` AS `2dateforward`,`manifest`.`3forwarderid` AS `3forwarderid`,`manifest`.`3forwardpermitid` AS `3forwardpermitid`,`manifest`.`3dateforward` AS `3dateforward`,`manifest`.`recyclefirmid` AS `recyclefirmid`,`manifest`.`recyclepermitid` AS `recyclepermitid`,`manifest`.`1recycledate` AS `1recycledate`,`manifest`.`2recycledate` AS `2recycledate`,`manifest`.`disposalmethodid` AS `disposalmethodid`,`manifest`.`datereceived` AS `datereceived`,`manifest`.`receivedbyid` AS `receivedbyid`,`manifest`.`created_at` AS `created_at`,`manifest`.`updated_at` AS `updated_at`,`manifest`.`isactive` AS `isactive`,`manifest`.`notes` AS `notes`,`manifest`.`deliveryid` AS `deliveryid`,`manifest`.`datemailed` AS `datemailed`,`contractor`.`name` AS `contractor`,(`contractor`.`address1` or `contractor`.`address2`) AS `contractoraddress`,`contractorbranch`.`name` AS `contractorbranch`,(`contractorbranch`.`address1` or `contractorbranch`.`address2`) AS `contbranchaddress`,`permitclass`.`name` AS `permitclass`,`wasteclass`.`name` AS `wasteclass`,`item`.`name` AS `itemname`,`itemunit`.`name` AS `itemunit`,`forwarder`.`name` AS `forwarder`,`employee`.`name` AS `receivedby`,`permit`.`permitno` AS `permitno` from (((((((((`manifest` left join `contractor` on((`manifest`.`contractorid` = `contractor`.`id`))) left join `contractorbranch` on((`manifest`.`contractorbranchid` = `contractorbranch`.`id`))) left join `permitclass` on((`manifest`.`permitclassid` = `permitclass`.`id`))) left join `wasteclass` on((`manifest`.`wasteclassid` = `wasteclass`.`id`))) left join `item` on((`manifest`.`itemid` = `item`.`id`))) left join `itemunit` on((`manifest`.`itemunitid` = `itemunit`.`id`))) left join `forwarder` on((`manifest`.`1forwarderid` = `forwarder`.`id`))) left join `employee` on((`manifest`.`receivedbyid` = `employee`.`id`))) left join `permit` on((`manifest`.`1forwarderid` = `permit`.`id`))) ;

--
-- VIEW  `manifestlist`
-- Data: None
--

