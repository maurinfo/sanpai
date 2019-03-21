/*
Navicat MySQL Data Transfer

Source Server         : LocalDB
Source Server Version : 80013
Source Host           : localhost:3306
Source Database       : kkcl

Target Server Type    : MYSQL
Target Server Version : 80013
File Encoding         : 65001

Date: 2019-03-10 18:27:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- View structure for saledetaillist
-- ----------------------------
DROP VIEW IF EXISTS `saledetaillist`;
CREATE ALGORITHM=UNDEFINED DEFINER=`marvin`@`%` SQL SECURITY DEFINER VIEW `saledetaillist` AS select `saledetail`.`id` AS `id`,`saledetail`.`saleid` AS `saleid`,`saledetail`.`datedelivered` AS `datedelivered`,`saledetail`.`manifestid` AS `manifestid`,`saledetail`.`itemid` AS `itemid`,`item`.`name` AS `item_name`,`saledetail`.`itemunitid` AS `itemunitid`,`itemunit`.`name` AS `itemunit_name`,`saledetail`.`qty` AS `qty`,`saledetail`.`price` AS `price`,`saledetail`.`amount` AS `amount`,`saledetail`.`spec` AS `spec`,`saledetail`.`isactive` AS `isactive`,`manifest`.`referenceno` AS `referenceno`,`contractorbranch`.`name` AS `contractorbranch_name` from ((((`saledetail` join `manifest` on((`saledetail`.`manifestid` = `manifest`.`id`))) join `contractorbranch` on((`manifest`.`contractorbranchid` = `contractorbranch`.`id`))) join `item` on((`saledetail`.`itemid` = `item`.`id`))) join `itemunit` on((`saledetail`.`itemunitid` = `itemunit`.`id`))) ;


create view as select saledetail.*, manifest.datemanifest,manifest.referenceno, manifest.contractorbranchid, contractorbranch.name as contractorbranch_name,item.name as item_name, manifest.otheritemname, itemunit.name as itemunit_name from saledetail left join manifest on saledetail.manifestid=manifest.id left join item on saledetail.itemid=item.id left join itemunit on saledetail.itemunitid=itemunit.id left join contractorbranch on manifest.contractorbranchid=contractorbranch.id

order by saledetail.id
