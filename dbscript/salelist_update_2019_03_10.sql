/*
Navicat MySQL Data Transfer

Source Server         : LocalDB
Source Server Version : 80013
Source Host           : localhost:3306
Source Database       : kkcl

Target Server Type    : MYSQL
Target Server Version : 80013
File Encoding         : 65001

Date: 2019-03-10 18:28:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- View structure for salelist
-- ----------------------------
DROP VIEW IF EXISTS `salelist`;
CREATE ALGORITHM=UNDEFINED DEFINER=`marvin`@`%` SQL SECURITY DEFINER VIEW `salelist` AS select `sale`.`id` AS `id`,`sale`.`referenceno` AS `referenceno`,`sale`.`customerid` AS `customerid`,`sale`.`datedelivered` AS `datedelivered`,`sale`.`subtotal` AS `subtotal`,`sale`.`autotax` AS `autotax`,`sale`.`tax` AS `tax`,`sale`.`total` AS `total`,`sale`.`note` AS `note`,`sale`.`updated` AS `updated`,`sale`.`updateby` AS `updateby`,`sale`.`isactive` AS `isactive`,`sale`.`showdate` AS `showdate`,`sale`.`invoiceid` AS `invoiceid`,`sale`.`dateprinted` AS `dateprinted`,`sale`.`postdate` AS `postdate`,`customer`.`code` AS `code`,`customer`.`name` AS `name`,`customer`.`yomi` AS `yomi` from (`sale` left join `customer` on((`sale`.`customerid` = `customer`.`id`))) ;
