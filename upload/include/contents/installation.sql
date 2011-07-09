CREATE TABLE `prefix_realms` (
  `slug` varchar(15) NOT NULL,
  `name` varchar(25) NOT NULL,
  `type` enum('pvp', 'pve', 'rp') NOT NULL,
  `queue` BOOL NOT NULL,
  `status` BOOL NOT NULL,
  `population` enum('low', 'medium', 'high') NOT NULL,
  `refresh` TIMESTAMP NOT NULL, 
  PRIMARY KEY  (`slug`)
)TYPE=MyISAM COLLATE utf8_general_ci;
