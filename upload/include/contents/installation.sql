CREATE TABLE `prefix_realms` (
  `slug`        varchar(15)                   NOT NULL,
  `name`        varchar(25)                   NOT NULL,
  `type`        enum('pvp', 'pve', 'rp')      NOT NULL,
  `queue`       BOOL                          NOT NULL,
  `status`      BOOL                          NOT NULL,
  `population`  enum('low', 'medium', 'high') NOT NULL,
  `refresh`     TIMESTAMP                     NOT NULL, 
  PRIMARY KEY  (`slug`)
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE DATABASE TABLE `prefix_realms`(
  `cID`     int NOT NULL auto_increment,
  `name`    varchar(25) NOT NULL,
  `level`   TINYINT UNSIGNED NOT NULL,
  `realm`   varchar(25) NOT NULL,
  `class`   TINYINT UNSIGNED NOT NULL,
  `race`    TINYINT UNSIGNED NOT NULL,
  `gender`  BOOL NOT NULL,
  `achievementPoints` INT NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `lastModified` TIMESTAMP NOT NULL,
  `updated` TIMESTAMP NOT NULL,
  PRIMARY KEY  (`cID`)
)TYPE=MyISAM COLLATE utf8_general_ci;