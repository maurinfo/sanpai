
--
-- Database: `kkcl`
--

-- --------------------------------------------------------

--
-- Structure for view `expenselist`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `expenselist`  AS  select `expense`.`id` AS `id`,`expense`.`referenceno` AS `referenceno`,`expense`.`supplierid` AS `supplierid`,`expense`.`datedelivered` AS `datedelivered`,`expense`.`subtotal` AS `subtotal`,`expense`.`autotax` AS `autotax`,`expense`.`tax` AS `tax`,`expense`.`total` AS `total`,`expense`.`note` AS `note`,`expense`.`updated` AS `updated`,`expense`.`updateby` AS `updateby`,`expense`.`isactive` AS `isactive`,`expense`.`showdate` AS `showdate`,`expense`.`billid` AS `billid`,`supplier`.`code` AS `code`,`supplier`.`name` AS `name`,`supplier`.`yomi` AS `yomi` from (`expense` left join `supplier` on((`expense`.`supplierid` = `supplier`.`id`))) ;

--
-- VIEW  `expenselist`
-- Data: None
--
