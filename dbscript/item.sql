-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 20, 2019 at 02:38 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `yomi` varchar(255) DEFAULT NULL,
  `itemclassid` int(11) DEFAULT NULL,
  `itemcategoryid` int(11) DEFAULT NULL,
  `itemunitid` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isactive` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `yomi`, `itemclassid`, `itemcategoryid`, `itemunitid`, `created_at`, `updated_at`, `isactive`) VALUES
(0, 'その他', 'そのた', 0, 2, 1, '2019-01-13 07:25:19', '2019-01-13 07:25:19', 0),
(1, '蛍光灯', NULL, 0, 0, 1, NULL, NULL, 1),
(2, '電池', NULL, 0, 1, 1, NULL, NULL, 1),
(3, '水銀灯', NULL, 0, 0, 1, NULL, NULL, 1),
(4, '廃ランプ類', NULL, 0, 0, 1, NULL, NULL, 1),
(5, '廃試薬・廃薬品類', NULL, 0, 2, 1, NULL, NULL, 1),
(6, '汚泥', NULL, 0, 2, 1, NULL, NULL, 1),
(7, 'ナトリウムランプ', NULL, 0, NULL, 1, NULL, NULL, 1),
(8, 'バッテリー', NULL, 0, 1, 1, NULL, NULL, 1),
(9, 'イグナイトロン', NULL, 0, 2, 1, NULL, NULL, 1),
(10, 'フロッピ－', NULL, 0, 2, 1, NULL, NULL, 1),
(11, 'シリカゲル', NULL, 0, 2, 1, NULL, NULL, 1),
(12, 'OA機器', NULL, 0, 2, 1, NULL, NULL, 1),
(13, '金属くず', NULL, 0, 2, 1, NULL, NULL, 1),
(14, '水銀', 'すいぎん', 0, 2, 1, NULL, NULL, 1),
(15, 'スカイドロール', NULL, 0, 2, 1, NULL, NULL, 1),
(16, '体温計・温度計・血圧計', 'け', 0, 2, 1, NULL, NULL, 0),
(17, '廃プラスチック', NULL, 0, 2, 1, NULL, NULL, 1),
(18, 'エタノール', NULL, 0, 2, 1, NULL, NULL, 1),
(19, 'アンプルビン類', NULL, 0, 2, 1, NULL, NULL, 1),
(20, '廃液', NULL, 0, 2, 1, NULL, NULL, 1),
(21, '医療廃棄物', NULL, 0, 2, 1, NULL, NULL, 1),
(22, '器具類', NULL, 0, 2, 1, NULL, NULL, 1),
(23, '農薬', NULL, 0, 2, 1, NULL, NULL, 1),
(24, 'スラッジ', NULL, 0, 2, 1, NULL, NULL, 1),
(25, '鉱油類', NULL, 0, 2, 1, NULL, NULL, 1),
(26, 'キレート', NULL, 0, 2, 1, NULL, NULL, 1),
(27, '試薬ビン', NULL, 0, 2, 1, NULL, NULL, 1),
(28, 'アスベスト', NULL, 0, 2, 1, NULL, NULL, 1),
(29, '活性炭', NULL, 0, 2, 1, NULL, NULL, 1),
(30, '空気電池', NULL, 0, 1, 1, NULL, NULL, 1),
(31, 'リチウム電池', NULL, 0, 1, 1, NULL, NULL, 1),
(32, '石綿', NULL, 0, 2, 1, NULL, NULL, 1),
(33, 'セパレーター', NULL, 0, 2, 1, NULL, NULL, 1),
(34, '廃ろ布', NULL, 0, 2, 1, NULL, NULL, 1),
(35, '塗装かす', NULL, 0, 2, 1, NULL, NULL, 1),
(36, '顔料', NULL, 0, 2, 1, NULL, NULL, 1),
(37, '鉛・鉛付着物', NULL, 0, 2, 1, NULL, NULL, 1),
(38, '水銀付着物', 'すいぎん', 0, 2, 1, NULL, NULL, 1),
(39, '特殊電池類', NULL, 0, 1, 1, NULL, NULL, 1),
(40, 'リチウム屑', NULL, 0, 2, 1, NULL, NULL, 1),
(41, '感染性廃棄物', NULL, 0, 2, 1, NULL, NULL, 1),
(43, '運搬費', 'う', 1, -1, 5, NULL, NULL, 1),
(44, '調整', 'ん', 1, -1, 4, NULL, NULL, 1),
(45, '廃薬品類', 'い', 1, -1, 4, NULL, NULL, 0),
(46, '廃試薬類', 'い', 1, -1, 4, NULL, NULL, 1),
(47, '器具類', 'い', 1, -1, 4, NULL, NULL, 0),
(48, '廃液類', 'い', 1, -1, 4, NULL, NULL, 1),
(49, '蛍光灯用ケース', 'け', 1, -1, 9, NULL, NULL, 0),
(50, '被膜付蛍光灯', 'あい', 1, -1, 1, NULL, NULL, 0),
(51, '値引き', 'を', 1, -1, 4, NULL, NULL, 0),
(52, 'リチウム電池', 'お', 1, -1, 1, NULL, NULL, 1),
(53, '前月分', 'ん', 1, -1, 4, NULL, NULL, 1),
(54, '営業費', 'えいぎょうひ', 1, -1, 4, NULL, NULL, 1),
(55, '当月分', 'ん', 1, -1, 4, NULL, NULL, 1),
(56, 'サークラインケース', 'さ', 1, -1, 9, NULL, NULL, 0),
(57, '事務補助費', 'を', 1, -1, 4, NULL, NULL, 1),
(58, '蛍光灯ケース　リース', 'けいこう', 1, -1, 7, NULL, NULL, 1),
(59, 'ダンボール', 'だんぼーる', 1, -1, 8, NULL, NULL, 1),
(60, '塩化カルシウム', 'えんか', 0, 2, 1, NULL, NULL, 1),
(61, '重クロム酸カリウム', 'じゅう', 0, 2, 1, NULL, NULL, 1),
(62, 'マーキュロクロム', 'まーき', 0, 2, 1, NULL, NULL, 1),
(63, 'アセトニトリル廃液', 'あせと', 0, 2, 1, NULL, NULL, 1),
(64, '塩酸　', 'えんさ', 0, 2, 1, NULL, NULL, 1),
(65, '液状石炭酸', 'えきじ', 0, 2, 1, NULL, NULL, 1),
(66, 'ヨードチンキ', 'よーど', 0, 2, 1, NULL, NULL, 1),
(67, '塩化鉛電池くず', 'えんか', 0, 2, 1, NULL, NULL, 1),
(68, '塩化第二水銀', 'えんか', 0, 2, 1, NULL, NULL, 1),
(69, 'カセイソーダ', 'かせい', 0, 2, 1, NULL, NULL, 1),
(70, '水銀含有物', 'すいぎん', 0, 2, 1, NULL, NULL, 1),
(71, 'ポリ容器', 'ぽり', 0, 2, 1, NULL, NULL, 1),
(72, '産廃税', 'お', 1, -1, 4, NULL, NULL, 1),
(73, '廃蛍光灯処理', 'う', 1, -1, 4, NULL, NULL, 1),
(74, '血圧計・温度計等', 'い', 1, -1, 4, NULL, NULL, 0),
(75, '　　　　　　　　上　　　記', NULL, 1, -1, 4, NULL, NULL, 1),
(76, '廃電池処理', 'う', 1, -1, 4, NULL, NULL, 1),
(77, '収集費', 'う', 1, -1, 5, NULL, NULL, 1),
(78, '収集運搬費', 'う', 1, -1, 5, NULL, NULL, 1),
(79, '契約書作成費', 'い', 1, -1, 4, NULL, NULL, 1),
(80, '作業費', 'え', 1, -1, 4, NULL, NULL, 1),
(81, '経営指導料', 'を', 1, -1, 4, NULL, NULL, 1),
(82, '廃蛍光灯処理', 'あ', 1, -1, 1, NULL, NULL, 1),
(83, '廃電池処理', 'あ', 1, -1, 1, NULL, NULL, 1),
(84, 'ポリタンク', 'ぽりたん', 1, -1, 2, NULL, NULL, 1),
(85, 'ビニール袋', 'び', 1, -1, 8, NULL, NULL, 1),
(86, '特別収集費', 'う', 1, -1, 5, NULL, NULL, 1),
(87, '廃ランプ類処理', 'あ', 1, -1, 1, NULL, NULL, 1),
(88, '廃ランプ類処理', 'う', 1, -1, 4, NULL, NULL, 1),
(89, '水銀処理', 'すいぎん', 1, -1, 1, NULL, NULL, 1),
(90, '廃プラ', 'はいぷら', 0, 2, 1, NULL, NULL, 0),
(91, '蛍光灯', 'う', 1, -1, 1, NULL, NULL, 0),
(92, '蛍光灯皮膜付', 'あ', 0, 0, 1, NULL, NULL, 1),
(93, '酸化第二水銀', 'さんかだいにすいぎん', 0, 2, 1, NULL, NULL, 1),
(94, '電子棚札（ﾘﾁｳﾑ電池）', NULL, 0, 1, 1, NULL, NULL, 1),
(95, '処分費', 'しょぶんひ', 1, -1, 1, NULL, NULL, 1),
(96, '体温計', 'たいおんけい', 0, 2, 1, NULL, NULL, 1),
(97, '血圧計', 'けつあつけい', 0, 2, 1, NULL, NULL, 1),
(98, '温度計', 'おんど', 0, 2, 1, NULL, NULL, 0),
(99, '吐酒石', NULL, 0, 2, 1, NULL, NULL, 1),
(100, '水銀スイッチ', 'すいぎん', 0, 2, 1, NULL, NULL, 1),
(101, 'マニフェスト', 'まにふぇすと', 1, -1, 8, NULL, NULL, 1),
(102, 'ドラム缶', 'どらむ', 1, -1, 2, NULL, NULL, 1),
(103, '水銀化合物', 'すいぎん', 0, 2, 1, NULL, NULL, 1),
(104, '計器類', 'けいき', 0, 2, 1, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
