CREATE TABLE `prefix_realms` (
  `slug`        varchar(15)                   NOT NULL  PRIMARY KEY,
  `name`        varchar(25)                   NOT NULL,
  `type`        enum('pvp', 'pve', 'rp', 'rppvp')      NOT NULL,
  `queue`       BOOL                          NOT NULL,
  `status`      BOOL                          NOT NULL,
  `population`  enum('low', 'medium', 'high') NOT NULL,
  `refresh`     TIMESTAMP                     NOT NULL
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_chars`(
  `cID`               INT               NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
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
  UNIQUE(`name`, `realm`)
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_guild`(
`gID`               INT               NOT NULL AUTO_INCREMENT ,
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
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_items`(
`iID`     int               NOT NULL,
`name`    varchar(50)       NOT NULL,
`icon`    varchar(255)      NOT NULL,
`quality` TINYINT UNSIGNED  NULL,
PRIMARY KEY  (`iID`)
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_items_tool`(
`eiID`    int         NOT NULL AUTO_INCREMENT ,
`iID`     int         NOT NULL UNIQUE,
`gem0`    int         NOT NULL,
`gem1`    int         NOT NULL,
`gem2`    int         NOT NULL,
`enchant` int         NOT NULL,
`set`     varchar(50) NOT NULL,
`reforge` int         NOT NULL, 
PRIMARY KEY  (`eiID`)
)TYPE=MyISAM COLLATE utf8_general_ci;

#CREATE TABLE `prefix_char_achievements`(
#)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_appearance`(
`cID`               INT NOT NULL  PRIMARY KEY,
`faceVariation`     TINYINT UNSIGNED NOT NULL,
`skinColor`         TINYINT UNSIGNED NOT NULL,
`hairVariation`     TINYINT UNSIGNED NOT NULL,
`hairColor`         TINYINT UNSIGNED NOT NULL,
`featureVariation`  TINYINT UNSIGNED NOT NULL,
`showHelm`          BOOL NOT NULL,
`showCloak`         BOOL NOT NULL
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_items`(
`cID`                       INT NOT NULL,
`averageItemLevel`          INT NOT NULL,
`averageItemLevelEquipped`  INT NOT NULL,
`head`                      INT NULL,
`neck`                      INT NULL,
`shoulder`                  INT NULL,
`back`                      INT NULL,
`chest`                     INT NULL,
`shirt`                     INT NULL,
`tabard`                    INT NULL,
`wrist`                     INT NULL,
`hands`                     INT NULL,
`waist`                     INT NULL,
`legs`                      INT NULL,
`feet`                      INT NULL,
`finger1`                   INT NULL,
`finger2`                   INT NULL,
`trinket1`                  INT NULL,
`trinket2`                  INT NULL,
`mainHand`                  INT NULL,
`offHand`                   INT NULL,
`ranged`                    INT NULL,
PRIMARY KEY(`cID`)
)TYPE=MyISAM COLLATE utf8_general_ci;


CREATE TABLE `prefix_char_talents`(
`cID`               INT         NOT NULL,
`primName`          VARCHAR(50) NOT NULL,
`primIcon`          VARCHAR(50) NOT NULL,
`primTree0`         varChar(20) NOT NULL,
`primTree1`         varChar(20) NOT NULL,
`primTree2`         varChar(20) NOT NULL,
`primPrime0Item`    SMALLINT    NULL,
`primPrime0IGlyphe` INT         NULL,
`primPrime1Item`    SMALLINT    NULL,
`primPrime1IGlyphe` INT         NULL,
`primPrime2Item`    SMALLINT    NULL,
`primPrime2IGlyphe` INT         NULL,
`primMajor0Item`    SMALLINT    NULL,
`primMajor0IGlyphe` INT         NULL,
`primMajor1Item`    SMALLINT    NULL,
`primMajor1IGlyphe` INT         NULL,
`primMajor2Item`    SMALLINT    NULL,
`primMajor2IGlyphe` INT         NULL,
`primMinor0Item`    SMALLINT    NULL,
`primminor0IGlyphe` INT         NULL,
`primMinor1Item`    SMALLINT    NULL,
`primminor1IGlyphe` INT         NULL,
`primMinor2Item`    SMALLINT    NULL,
`primminor2IGlyphe` INT         NULL,
`secName`           VARCHAR(50) NULL,
`secIcon`           VARCHAR(50) NULL,
`secTree0`          varChar(20) NULL,
`secTree1`          varChar(20) NULL,
`secTree2`          varChar(20) NULL,
`secsece0Item`      SMALLINT    NULL,
`secsece0IGlyphe`   INT         NULL,
`secsece1Item`      SMALLINT    NULL,
`secsece1IGlyphe`   INT         NULL,
`secsece2Item`      SMALLINT    NULL,
`secsece2IGlyphe`   INT         NULL,
`secMajor0Item`     SMALLINT    NULL,
`secMajor0IGlyphe`  INT         NULL,
`secMajor1Item`     SMALLINT    NULL,
`secMajor1IGlyphe`  INT         NULL,
`secMajor2Item`     SMALLINT    NULL,
`secMajor2IGlyphe`  INT         NULL,
`secMinor0Item`     SMALLINT    NULL,
`secminor0IGlyphe`  INT         NULL,
`secMinor1Item`     SMALLINT    NULL,
`secminor1IGlyphe`  INT         NULL,
`secMinor2Item`     SMALLINT    NULL,
`secminor2IGlyphe`  INT         NULL,
PRIMARY KEY  (`cID`)
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_titles`(
`tID`   SMALLINT  UNSIGNED  NOT NULL  PRIMARY KEY,
`name`  VARCHAR(100)        NOT NULL
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_titles`(
`cID` INT                 NOT NULL,
`tID` SMALLINT  UNSIGNED  NOT NULL,
UNIQUE(`cID`, `tID`)
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_stats`(
`cID`               INT                             NOT NULL  PRIMARY KEY,
`health`            INT                             NOT NULL,
`powerType`         enum('mana','energie', 'rage')  NOT NULL,
`power`             INT                             NOT NULL,
`str`               INT                             NOT NULL,
`agi`               INT                             NOT NULL,
`sta`               INT                             NOT NULL,
`int`               INT                             NOT NULL,
`spr`               INT                             NOT NULL,
`attackPower`       INT                             NOT NULL,
`rangedAttackPower` INT                             NOT NULL,
`mastery`           FLOAT(8,6)                      NOT NULL,
`masteryRating`     INT                             NOT NULL,
`crit`              FLOAT(8,6)                      NOT NULL,
`critRating`        INT                             NOT NULL,
`hitRating`         INT                             NOT NULL,
`hasteRating`       INT                             NOT NULL,
`expertiseRating`   INT                             NOT NULL,
`spellPower`        INT                             NOT NULL,
`spellPen`          SMALLINT UNSIGNED               NOT NULL,
`spellCrit`         FLOAT(8,6)                      NOT NULL,
`spellCritRating`   INT                             NOT NULL,
`mana5`             FLOAT(6,1)                      NOT NULL,
`mana5Combat`       FLOAT(6,1)                      NOT NULL,
`armor`             INT                             NOT NULL,
`dodge`             FLOAT(8,6)                      NOT NULL,
`dodgeRating`       INT                             NOT NULL,
`parry`             FLOAT(8,6)                      NOT NULL,
`parryRating`       INT                             NOT NULL,
`block`             FLOAT(8,6)                      NOT NULL,
`blockRating`       INT                             NOT NULL,
`resil`             INT                             NOT NULL,
`mainHandDmgMin`    FLOAT(8,6)                      NOT NULL,
`mainHandDmgMax`    FLOAT(8,6)                      NOT NULL,
`mainHandSpeed`     FLOAT(2,1)                      NOT NULL,
`mainHandDps`       FLOAT(8,4)                      NOT NULL,
`mainHandExpertise` TINYINT                         NOT NULL,
`offHandDmgMin`     FLOAT(8,6)                      NOT NULL,
`offHandDmgMax`     FLOAT(8,6)                      NOT NULL, 
`offHandSpeed`      FLOAT(2,1)                      NOT NULL,
`offHandDps`        FLOAT(8,4)                      NOT NULL,
`offHandExpertise`  TINYINT                         NOT NULL,
`rangedDmgMin`      FLOAT(8,6)                      NOT NULL,
`rangedDmgMax`      FLOAT(8,6)                      NOT NULL,
`rangedSpeed`       FLOAT(2,1)                      NOT NULL,
`rangedDps`         FLOAT(8,4)                      NOT NULL,
`rangedCrit`        FLOAT(8,6)                      NOT NULL,
`rangedCritRating`  INT                             NOT NULL,
`rangedHitRating`   INT                             NOT NULL
)TYPE=MyISAM COLLATE utf8_general_ci;

#CREATE TABLE `prefix_char_reputation`(
#)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_guild`(
`cID` int NOT NULL,
`gID` int NOT NULL,
UNIQUE(`cID`, `gID`)
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_professions`(
`pID`     INT NOT NULL PRIMARY KEY,
`name`    VARCHAR(50) NOT NULL,
`icon`    VARCHAR(50) NOT NULL
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_professions`(
`cID`   INT               NOT NULL,
`pID`   INT               NOT NULL,
`range` SmallINT UNSIGNED NOT NULL,
`max`   SmallINT UNSIGNED NOT NULL,
UNIQUE(`cID`, `pID`)
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_companions`(
`cID`         INT           NOT NULL  PRIMARY KEY,
`mounts`      VARCHAR(255)  NULL,
`companions`  VARCHAR(255)  NULL
)TYPE=MyISAM COLLATE utf8_general_ci;

#CREATE TABLE `prefix_char_pets`(
#)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_instanzen`(
`inID`  MEDIUMINT     NOT NULL PRIMARY KEY,
`name`  varchar(30)   NOT NULL
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_bosse`(
`bID`           MEDIUMINT     NOT NULL PRIMARY KEY,
`inID`          MEDIUMINT     NOT NULL,
`name`          varchar(30)   NOT NULL,
`normalHealth`  INT UNSIGNED  NULL,
`heroicHealth`  INT UNSIGNED  NULL
)TYPE=MyISAM COLLATE utf8_general_ci;

CREATE TABLE `prefix_char_progression`(
`cID`         INT           NOT NULL,
`bID`         MEDIUMINT     NOT NULL,
`normalKills` MEDIUMINT     NOT NULL,
`heroicKills` MEDIUMINT     NOT NULL,
UNIQUE(`cID`, `bID`)
)TYPE=MyISAM COLLATE utf8_general_ci;
