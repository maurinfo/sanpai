/*
Navicat MySQL Data Transfer

Source Server         : LocalDB
Source Server Version : 80013
Source Host           : localhost:3306
Source Database       : kkcl

Target Server Type    : MYSQL
Target Server Version : 80013
File Encoding         : 65001

Date: 2019-03-10 18:25:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`yomi`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`itemclassid`  int(11) NULL DEFAULT NULL ,
`itemcategoryid`  int(11) NULL DEFAULT NULL ,
`itemunitid`  int(11) NULL DEFAULT NULL ,
`created_at`  timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
`updated_at`  timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
`isactive`  int(1) NULL DEFAULT 1 ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=106

;

-- ----------------------------
-- Records of item
-- ----------------------------
BEGIN;
INSERT INTO `item` VALUES ('1', '蛍光灯', null, '0', '0', '1', null, null, '1'), ('2', '電池', null, '0', '1', '1', null, null, '1'), ('3', '水銀灯', null, '0', '0', '1', null, null, '1'), ('4', '廃ランプ類', null, '0', '0', '1', null, null, '1'), ('5', '廃試薬・廃薬品類', null, '0', '2', '1', null, null, '1'), ('6', '汚泥', null, '0', '2', '1', null, null, '1'), ('7', 'ナトリウムランプ', null, '0', null, '1', null, null, '1'), ('8', 'バッテリー', null, '0', '1', '1', null, null, '1'), ('9', 'イグナイトロン', null, '0', '2', '1', null, null, '1'), ('10', 'フロッピ－', null, '0', '2', '1', null, null, '1'), ('11', 'シリカゲル', null, '0', '2', '1', null, null, '1'), ('12', 'OA機器', null, '0', '2', '1', null, null, '1'), ('13', '金属くず', null, '0', '2', '1', null, null, '1'), ('14', '水銀', 'すいぎん', '0', '2', '1', null, null, '1'), ('15', 'スカイドロール', null, '0', '2', '1', null, null, '1'), ('16', '体温計・温度計・血圧計', 'け', '0', '2', '1', null, null, '0'), ('17', '廃プラスチック', null, '0', '2', '1', null, null, '1'), ('18', 'エタノール', null, '0', '2', '1', null, null, '1'), ('19', 'アンプルビン類', null, '0', '2', '1', null, null, '1'), ('20', '廃液', null, '0', '2', '1', null, null, '1'), ('21', '医療廃棄物', null, '0', '2', '1', null, null, '1'), ('22', '器具類', null, '0', '2', '1', null, null, '1'), ('23', '農薬', null, '0', '2', '1', null, null, '1'), ('24', 'スラッジ', null, '0', '2', '1', null, null, '1'), ('25', '鉱油類', null, '0', '2', '1', null, null, '1'), ('26', 'キレート', null, '0', '2', '1', null, null, '1'), ('27', '試薬ビン', null, '0', '2', '1', null, null, '1'), ('28', 'アスベスト', null, '0', '2', '1', null, null, '1'), ('29', '活性炭', null, '0', '2', '1', null, null, '1'), ('30', '空気電池', null, '0', '1', '1', null, null, '1'), ('31', 'リチウム電池', null, '0', '1', '1', null, null, '1'), ('32', '石綿', null, '0', '2', '1', null, null, '1'), ('33', 'セパレーター', null, '0', '2', '1', null, null, '1'), ('34', '廃ろ布', null, '0', '2', '1', null, null, '1'), ('35', '塗装かす', null, '0', '2', '1', null, null, '1'), ('36', '顔料', null, '0', '2', '1', null, null, '1'), ('37', '鉛・鉛付着物', null, '0', '2', '1', null, null, '1'), ('38', '水銀付着物', 'すいぎん', '0', '2', '1', null, null, '1'), ('39', '特殊電池類', null, '0', '1', '1', null, null, '1'), ('40', 'リチウム屑', null, '0', '2', '1', null, null, '1'), ('41', '感染性廃棄物', null, '0', '2', '1', null, null, '1'), ('43', '運搬費', 'う', '1', '-1', '5', null, null, '1'), ('44', '調整', 'ん', '1', '-1', '4', null, null, '1'), ('45', '廃薬品類', 'い', '1', '-1', '4', null, null, '0'), ('46', '廃試薬類', 'い', '1', '-1', '4', null, null, '1'), ('47', '器具類', 'い', '1', '-1', '4', null, null, '0'), ('48', '廃液類', 'い', '1', '-1', '4', null, null, '1'), ('49', '蛍光灯用ケース', 'け', '1', '-1', '9', null, null, '0'), ('50', '被膜付蛍光灯', 'あい', '1', '-1', '1', null, null, '0'), ('51', '値引き', 'を', '1', '-1', '4', null, null, '0'), ('52', 'リチウム電池', 'お', '1', '-1', '1', null, null, '1'), ('53', '前月分', 'ん', '1', '-1', '4', null, null, '1'), ('54', '営業費', 'えいぎょうひ', '1', '-1', '4', null, null, '1'), ('55', '当月分', 'ん', '1', '-1', '4', null, null, '1'), ('56', 'サークラインケース', 'さ', '1', '-1', '9', null, null, '0'), ('57', '事務補助費', 'を', '1', '-1', '4', null, null, '1'), ('58', '蛍光灯ケース　リース', 'けいこう', '1', '-1', '7', null, null, '1'), ('59', 'ダンボール', 'だんぼーる', '1', '-1', '8', null, null, '1'), ('60', '塩化カルシウム', 'えんか', '0', '2', '1', null, null, '1'), ('61', '重クロム酸カリウム', 'じゅう', '0', '2', '1', null, null, '1'), ('62', 'マーキュロクロム', 'まーき', '0', '2', '1', null, null, '1'), ('63', 'アセトニトリル廃液', 'あせと', '0', '2', '1', null, null, '1'), ('64', '塩酸　', 'えんさ', '0', '2', '1', null, null, '1'), ('65', '液状石炭酸', 'えきじ', '0', '2', '1', null, null, '1'), ('66', 'ヨードチンキ', 'よーど', '0', '2', '1', null, null, '1'), ('67', '塩化鉛電池くず', 'えんか', '0', '2', '1', null, null, '1'), ('68', '塩化第二水銀', 'えんか', '0', '2', '1', null, null, '1'), ('69', 'カセイソーダ', 'かせい', '0', '2', '1', null, null, '1'), ('70', '水銀含有物', 'すいぎん', '0', '2', '1', null, null, '1'), ('71', 'ポリ容器', 'ぽり', '0', '2', '1', null, null, '1'), ('72', '産廃税', 'お', '1', '-1', '4', null, null, '1'), ('73', '廃蛍光灯処理', 'う', '1', '-1', '4', null, null, '1'), ('74', '血圧計・温度計等', 'い', '1', '-1', '4', null, null, '0'), ('75', '　　　　　　　　上　　　記', null, '1', '-1', '4', null, null, '1'), ('76', '廃電池処理', 'う', '1', '-1', '4', null, null, '1'), ('77', '収集費', 'う', '1', '-1', '5', null, null, '1'), ('78', '収集運搬費', 'う', '1', '-1', '5', null, null, '1'), ('79', '契約書作成費', 'い', '1', '-1', '4', null, null, '1'), ('80', '作業費', 'え', '1', '-1', '4', null, null, '1'), ('81', '経営指導料', 'を', '1', '-1', '4', null, null, '1'), ('82', '廃蛍光灯処理', 'あ', '1', '-1', '1', null, null, '1'), ('83', '廃電池処理', 'あ', '1', '-1', '1', null, null, '1'), ('84', 'ポリタンク', 'ぽりたん', '1', '-1', '2', null, null, '1'), ('85', 'ビニール袋', 'び', '1', '-1', '8', null, null, '1'), ('86', '特別収集費', 'う', '1', '-1', '5', null, null, '1'), ('87', '廃ランプ類処理', 'あ', '1', '-1', '1', null, null, '1'), ('88', '廃ランプ類処理', 'う', '1', '-1', '4', null, null, '1'), ('89', '水銀処理', 'すいぎん', '1', '-1', '1', null, null, '1'), ('90', '廃プラ', 'はいぷら', '0', '2', '1', null, null, '0'), ('91', '蛍光灯', 'う', '1', '-1', '1', null, null, '0'), ('92', '蛍光灯皮膜付', 'あ', '0', '0', '1', null, null, '1'), ('93', '酸化第二水銀', 'さんかだいにすいぎん', '0', '2', '1', null, null, '1'), ('94', '電子棚札（ﾘﾁｳﾑ電池）', null, '0', '1', '1', null, null, '1'), ('95', '処分費', 'しょぶんひ', '1', '-1', '1', null, null, '1'), ('96', '体温計', 'たいおんけい', '0', '2', '1', null, null, '1'), ('97', '血圧計', 'けつあつけい', '0', '2', '1', null, null, '1'), ('98', '温度計', 'おんど', '0', '2', '1', null, null, '0'), ('99', '吐酒石', null, '0', '2', '1', null, null, '1'), ('100', '水銀スイッチ', 'すいぎん', '0', '2', '1', null, null, '1'), ('101', 'マニフェスト', 'まにふぇすと', '1', '-1', '8', null, null, '1');
INSERT INTO `item` VALUES ('102', 'ドラム缶', 'どらむ', '1', '-1', '2', null, null, '1'), ('103', '水銀化合物', 'すいぎん', '0', '2', '1', null, null, '1'), ('104', '計器類', 'けいき', '0', '2', '1', null, null, '1'), ('105', 'その他', 'そのた', '0', '2', '1', '2019-01-13 16:25:19', '2019-01-13 16:25:19', '0');
COMMIT;

-- ----------------------------
-- Auto increment value for item
-- ----------------------------
ALTER TABLE `item` AUTO_INCREMENT=106;
