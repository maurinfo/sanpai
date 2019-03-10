/*
Navicat MySQL Data Transfer

Source Server         : LocalDB
Source Server Version : 80013
Source Host           : localhost:3306
Source Database       : kkcl

Target Server Type    : MYSQL
Target Server Version : 80013
File Encoding         : 65001

Date: 2019-03-10 18:29:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- View structure for manifestpending
-- ----------------------------
DROP VIEW IF EXISTS `manifestpending`;
CREATE ALGORITHM=UNDEFINED DEFINER=`marvin`@`%` SQL SECURITY DEFINER VIEW `manifestpending` AS select `manifest`.`id` AS `id`,`manifest`.`referenceno` AS `referenceno`,`manifest`.`datemanifest` AS `datemanifest`,`manifest`.`incharge` AS `incharge`,`manifest`.`contractorid` AS `contractorid`,`manifest`.`contractorbranchid` AS `contractorbranchid`,`manifest`.`permitclassid` AS `permitclassid`,`manifest`.`wasteclassid` AS `wasteclassid`,`manifest`.`itemid` AS `itemid`,`manifest`.`otheritemname` AS `otheritemname`,`manifest`.`qty` AS `qty`,`manifest`.`itemunitid` AS `itemunitid`,`manifest`.`1forwarderid` AS `1forwarderid`,`manifest`.`1forwardpermitid` AS `1forwardpermitid`,`manifest`.`1dateforward` AS `1dateforward`,`manifest`.`2forwarderid` AS `2forwarderid`,`manifest`.`2forwardpermitid` AS `2forwardpermitid`,`manifest`.`2dateforward` AS `2dateforward`,`manifest`.`3forwarderid` AS `3forwarderid`,`manifest`.`3forwardpermitid` AS `3forwardpermitid`,`manifest`.`3dateforward` AS `3dateforward`,`manifest`.`recyclefirmid` AS `recyclefirmid`,`manifest`.`recyclepermitid` AS `recyclepermitid`,`manifest`.`1recycledate` AS `1recycledate`,`manifest`.`2recycledate` AS `2recycledate`,`manifest`.`disposalmethodid` AS `disposalmethodid`,`manifest`.`datereceived` AS `datereceived`,`manifest`.`receivedbyid` AS `receivedbyid`,`manifest`.`created_at` AS `created_at`,`manifest`.`updated_at` AS `updated_at`,`manifest`.`notes` AS `notes`,`manifest`.`deliveryid` AS `deliveryid`,`manifest`.`datemailed` AS `datemailed`,`manifest`.`isactive` AS `isactive`,`forwarder`.`name` AS `forwarder`,`forwarder`.`yomi` AS `yomi`,`contractor`.`name` AS `contractor`,`contractorbranch`.`name` AS `contractorbranch`,`contractor`.`yomi` AS `contractor_yomi`,`contractorbranch`.`yomi` AS `contractorbranch_yomi`,`permitclass`.`name` AS `permitclass`,`wasteclass`.`name` AS `wasteclass`,`item`.`name` AS `itemname`,`itemunit`.`name` AS `itemunit`,`saledetail`.`id` AS `saledetailid` from (((((((((`manifest` left join `contractor` on((`manifest`.`contractorid` = `contractor`.`id`))) left join `contractorbranch` on((`manifest`.`contractorbranchid` = `contractorbranch`.`id`))) left join `permitclass` on((`manifest`.`permitclassid` = `permitclass`.`id`))) left join `wasteclass` on((`manifest`.`wasteclassid` = `wasteclass`.`id`))) left join `item` on((`manifest`.`itemid` = `item`.`id`))) left join `itemunit` on((`manifest`.`itemunitid` = `itemunit`.`id`))) left join `forwarder` on((`manifest`.`1forwarderid` = `forwarder`.`id`))) left join `employee` on((`manifest`.`receivedbyid` = `employee`.`id`))) left join `saledetail` on((`manifest`.`id` = `saledetail`.`manifestid`))) ;
