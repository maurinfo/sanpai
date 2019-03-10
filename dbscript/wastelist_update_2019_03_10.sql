/*
Navicat MySQL Data Transfer

Source Server         : LocalDB
Source Server Version : 80013
Source Host           : localhost:3306
Source Database       : kkcl

Target Server Type    : MYSQL
Target Server Version : 80013
File Encoding         : 65001

Date: 2019-03-10 18:28:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- View structure for wastelist
-- ----------------------------
DROP VIEW IF EXISTS `wastelist`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wastelist` AS select `item`.`id` AS `id`,`item`.`name` AS `name`,`item`.`yomi` AS `yomi`,`item`.`itemclassid` AS `itemclassid`,`item`.`itemcategoryid` AS `itemcategoryid`,`item`.`itemunitid` AS `itemunitid`,`item`.`created_at` AS `created_at`,`item`.`updated_at` AS `updated_at`,`item`.`isactive` AS `isactive`,`itemcategory`.`name` AS `category`,`itemunit`.`name` AS `unit` from ((`item` left join `itemcategory` on((`item`.`itemcategoryid` = `itemcategory`.`id`))) left join `itemunit` on((`item`.`itemunitid` = `itemunit`.`id`))) where (`item`.`itemclassid` = 0) ;
