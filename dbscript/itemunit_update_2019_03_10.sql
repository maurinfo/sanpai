/*
Navicat MySQL Data Transfer

Source Server         : LocalDB
Source Server Version : 80013
Source Host           : localhost:3306
Source Database       : kkcl

Target Server Type    : MYSQL
Target Server Version : 80013
File Encoding         : 65001

Date: 2019-03-10 18:26:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for itemunit
-- ----------------------------
DROP TABLE IF EXISTS `itemunit`;
CREATE TABLE `itemunit` (
`id`  int(11) NOT NULL ,
`code`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`name`  varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`yomi`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`updated`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
`updateby`  int(11) NULL DEFAULT NULL ,
`isactive`  int(11) NULL DEFAULT 1 ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of itemunit
-- ----------------------------
BEGIN;
INSERT INTO `itemunit` VALUES ('1', null, 'kg', 'あ', '2019-01-29 11:49:31', null, '1'), ('2', null, '本', 'が', '2019-01-29 11:49:31', null, '1'), ('3', null, 'L', 'か', '2019-01-29 11:49:31', null, '1'), ('4', null, '式', 'しき', '2019-01-29 11:49:31', null, '1'), ('5', null, '車', 'しゃ', '2019-01-29 11:49:31', null, '1'), ('6', null, '回', 'かい', '2019-01-29 11:49:31', null, '1'), ('7', null, '台', 'だい', '2019-01-29 11:49:31', null, '1'), ('8', null, '枚', 'まい', '2019-01-29 11:49:31', null, '1'), ('9', null, '箱', 'は', '2019-01-29 11:49:31', null, '1'), ('10', null, 'ドラム', 'どらむ', '2019-01-29 11:49:31', null, '1'), ('11', null, '個', 'こ', '2019-01-29 11:49:31', null, '1'), ('12', null, 'ヶ月間', 'かげつ', '2019-01-29 11:49:31', null, '1'), ('13', null, 'unit', 'u', '2019-02-25 12:18:11', null, '0'), ('14', null, '1test', '１', '2019-02-25 12:18:32', null, '1');
COMMIT;
