CREATE TABLE `contractorbranch` (
  `id` int(11) NOT NULL,
  `contractorid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `yomi` varchar(255) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `zip` varchar(12) DEFAULT NULL,
  `prefectureid` int(11) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `telno` varchar(50) DEFAULT NULL,
  `faxno` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `isactive` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
