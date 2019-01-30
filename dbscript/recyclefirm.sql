-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 30, 2019 at 12:48 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `recyclefirm`
--

CREATE TABLE `recyclefirm` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `yomi` varchar(255) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `telno` varchar(50) DEFAULT NULL,
  `faxno` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `isactive` int(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `prefectureid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recyclefirm`
--

INSERT INTO `recyclefirm` (`id`, `name`, `yomi`, `contactperson`, `department`, `zip`, `address1`, `address2`, `telno`, `faxno`, `email`, `notes`, `isactive`, `created_at`, `updated_at`, `prefectureid`) VALUES
(2, '株式会社　イージーエス', 'いーじーえす', NULL, NULL, '792-0003', '愛媛県新居浜市新田町3丁目1-39　1F', NULL, '0897-37-1098', NULL, NULL, NULL, 1, NULL, NULL, 0),
(3, '株式会社　京都環境保全公社　', 'きょうとほぜんこうし', NULL, NULL, '612-8244', '京都府京都市伏見区横大路千両松町126', NULL, '075-622-8080', '075-622-8286', NULL, NULL, 1, NULL, NULL, 0),
(28, '旭興産業株式会社', 'あ-あああ', '覗淵', '営業部', '612-8019', '京都市伏見区桃山町新町35番地', NULL, '075-623-5477', '075-623-5141', NULL, NULL, 1, NULL, NULL, 0),
(35, '旭興産業株式会社　横大路リサイクルセンター', 'あ', NULL, NULL, '612-8244', '京都府京都市伏見区横大路千両松町60-4', NULL, '075-623-5477', '075-623-5141', NULL, NULL, 0, '2019-01-22 13:04:01', '2019-01-22 13:04:01', 0),
(91, '株式会社　山本清掃', 'やまも', NULL, NULL, '612-8244', '京都府京都市伏見区横大路千両松町196-1', NULL, '075-623-5555', NULL, NULL, NULL, 1, NULL, NULL, 0),
(295, '野村興産株式会社　イトムカ鉱業所', 'のむら', NULL, NULL, '091-0162', '北海道常呂郡留辺蘂町富士見217番地1', NULL, '0157-45-2912', NULL, NULL, NULL, 1, NULL, NULL, 0),
(364, '野村興産株式会社　関西工場', 'のむら', NULL, NULL, '555-0041', '大阪府大阪市西淀川区中島2-4-143', NULL, '06-6476-0025', NULL, NULL, NULL, 1, NULL, NULL, 0),
(759, '株式会社京都環境保全公社　瑞穂', 'きょう', NULL, NULL, '612-8244', '京都府船井郡京丹波町猪鼻冠石1番1', NULL, '075-622-8080', NULL, NULL, NULL, 1, NULL, NULL, 0),
(872, '株式会社エム・アール・シー', 'えむあーる', NULL, NULL, '601-8143', '京都府京都市南区上鳥羽麻ノ本町117-1', NULL, '075-672-1000', NULL, NULL, NULL, 1, NULL, NULL, 0),
(1462, '日本リサイクルセンター株式会社', 'にほん', NULL, NULL, '530-0047', '大阪府大阪市北区西天満6-3-19', NULL, '06-6311-9071', NULL, NULL, NULL, 1, NULL, NULL, 0),
(1463, '株式会社京都製錬所', 'きょうと', NULL, NULL, NULL, '京都市亀岡市西別院町笑路落合4-3', NULL, '0771-27-2036', NULL, NULL, NULL, 1, NULL, NULL, 0),
(2212, '株式会社ヒロエー', 'ひろえ', NULL, NULL, '739-0256', '広島県東広島市志和町冠1045-1', NULL, '082-433-4238', NULL, NULL, NULL, 1, NULL, NULL, 0),
(3952, '野間化学工業株式会社', 'のまか', NULL, NULL, '615-0803', '京都市右京区西京極南庄境町66', NULL, '075-312-5741', NULL, NULL, NULL, 1, NULL, NULL, 0),
(6135, '千切屋株式会社', 'ちぎり', NULL, NULL, '604-8132', '京都市中京区高倉通三条下る丸屋町１６０', NULL, '075-221-1161', NULL, NULL, NULL, 1, NULL, NULL, 0),
(6137, 'reeee', 'あ', 'dふぁdsf', 'erwr', '123123', '12312312', '12321321321', '123123123213', '1231232131232', '1231212@fsfsfd.com', 'onte', 0, '2019-01-22 13:04:04', '2019-01-22 13:04:04', 1),
(6138, 're', 'あ', 'dふぁdsf', 'erwr', '123123', '12312312', '12321321321', '123123123213', '1231232131232', '1231212@fsfsfd.com', 'onte', 1, '2019-01-15 09:06:33', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recyclefirm`
--
ALTER TABLE `recyclefirm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recyclefirm`
--
ALTER TABLE `recyclefirm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6139;
