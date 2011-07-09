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

CREATE DATABASE TABLE `prefix_chars`(
  `cID`               int               NOT NULL auto_increment,
  `name`              varchar(25)       NOT NULL,
  `level`             TINYINT UNSIGNED  NOT NULL,
  `realm`             varchar(25)       NOT NULL,
  `class`             TINYINT UNSIGNED  NOT NULL,
  `race`              TINYINT UNSIGNED  NOT NULL,
  `gender`            BOOL              NOT NULL,
  `achievementPoints` INT               NOT NULL,
  `thumbnail`         varchar(255)      NOT NULL,
  `lastModified`      TIMESTAMP         NOT NULL,
  `updated`           TIMESTAMP         NOT NULL,
  PRIMARY KEY  (`cID`)
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_guild`{
`gID`               INT               NOT NULL auto_increment,
`name`              VARCHAR(25)       NOT NULL,
`realm`             VARCHAR(25)       NOT NULL,
`level`             TINYINT UNSIGNED  NOT NULL,
`members`           TINYINT UNSIGNED  NOT NULL,
`achievementPoints` SMALLINT UNSIGNED NOT NULL, 
`icon`              INT               NOT NULL,
`iconColor`         VARCHAR(8)        NOT NULL,
`border`            TINYINT           NOT NULL,
`borderColor`       VARCHAR(8)        NOT NULL,
`backgroundColor`   VARCHAR(8)        NOT NULL, 
PRIMARY KEY  (`gID`)
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_items`{
`iID`     int               NOT NULL,
`name`    varchar(50)       NOT NULL,
`icon`    varchar(255)      NOT NULL,
`quality` TINYINT UNSIGNED  NOT NULL,
PRIMARY KEY  (`iID`)
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_items_tool`{
`eiID`    int         NOT NULL auto_increment,
`iID`     int         NOT NULL UNQUIE,
`gem0`    int         NOT NULL,
`gem1`    int         NOT NULL,
`gem2`    int         NOT NULL,
`enchant` int         NOT NULL,
`set`     varchar(50) NOT NULL
`reforge` int         NOT NULL, 
PRIMARY KEY  (`eiID`)
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_achievements`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_appearance`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_items`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_talents`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_mounts`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_titles`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_stats`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_reputation`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_guild`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_professions`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_companions`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_progression`{
}TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_pets`{
}TYPE=MyISAM COLLATE utf8_general_ci;
