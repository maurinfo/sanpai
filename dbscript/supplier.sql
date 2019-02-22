CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
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
  `taxinclusive` int(11) DEFAULT NULL,
  `roundofftypeid` int(11) DEFAULT NULL,
  `termid` int(11) DEFAULT NULL,
  `paymethodid` int(11) DEFAULT NULL,
  `cutoffdate` int(11) DEFAULT NULL,
  `collectdate` int(11) DEFAULT NULL,
  `showduedate` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `reportvisibility` int(11) DEFAULT NULL,
  `isactive` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1887;
