SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `default_schema` ;
USE `default_schema` ;

-- -----------------------------------------------------
-- Table `default_schema`.`prefix_realms`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_realms` (
  `slug` VARCHAR(15) NOT NULL ,
  `name` VARCHAR(25) NOT NULL ,
  `type` ENUM('pvp', 'pve', 'rp', 'rppvp') NOT NULL ,
  `queue`  NOT NULL ,
  `status`  NOT NULL ,
  `population` ENUM('low', 'medium', 'high') NOT NULL ,
  `refresh` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`slug`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_chars`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_chars` (
  `cID` INT NOT NULL AUTO_INCREMENT ,
  `accid` INT NULL ,
  `raidid` INT NULL ,
  `name` VARCHAR(25) NOT NULL ,
  `level` TINYINT UNSIGNED NULL DEFAULT NULL ,
  `realm` VARCHAR(25) NOT NULL ,
  `class` TINYINT UNSIGNED NULL DEFAULT NULL ,
  `race` TINYINT UNSIGNED NULL DEFAULT NULL ,
  `gender`  NULL DEFAULT NULL ,
  `achievementPoints` INT NULL DEFAULT NULL ,
  `thumbnail` VARCHAR(255) NULL DEFAULT NULL ,
  `lastModified` TIMESTAMP NOT NULL ,
  `updated` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`cID`) ,
  UNIQUE INDEX (`name` ASC, `realm` ASC) ,
  INDEX `fk_realm` (`realm` ASC) ,
  CONSTRAINT `fk_realm`
    FOREIGN KEY (`realm` )
    REFERENCES `default_schema`.`prefix_realms` (`slug` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_guild`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_guild` (
  `gID` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(25) NOT NULL ,
  `realm` VARCHAR(25) NOT NULL ,
  `level` TINYINT UNSIGNED NOT NULL ,
  `members` TINYINT UNSIGNED NOT NULL ,
  `achievementPoints` SMALLINT UNSIGNED NOT NULL ,
  `icon` INT NOT NULL ,
  `iconColor` VARCHAR(8) NOT NULL ,
  `border` TINYINT NOT NULL ,
  `borderColor` VARCHAR(8) NOT NULL ,
  `backgroundColor` VARCHAR(8) NOT NULL ,
  PRIMARY KEY (`gID`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_items`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_items` (
  `iID` INT NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  `icon` VARCHAR(255) NOT NULL ,
  `quality` TINYINT UNSIGNED NULL DEFAULT NULL ,
  PRIMARY KEY (`iID`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_items_tool`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_items_tool` (
  `eiID` INT NOT NULL AUTO_INCREMENT ,
  `iID` INT NOT NULL ,
  `gem0` INT NOT NULL ,
  `gem1` INT NOT NULL ,
  `gem2` INT NOT NULL ,
  `enchant` INT NOT NULL ,
  `set` VARCHAR(50) NOT NULL ,
  `reforge` INT NOT NULL ,
  UNIQUE INDEX (`iID` ASC) ,
  PRIMARY KEY (`eiID`) ,
  INDEX `fk_item_id` (`iID` ASC) ,
  CONSTRAINT `fk_item_id`
    FOREIGN KEY (`iID` )
    REFERENCES `default_schema`.`prefix_items` (`iID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_appearance`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_appearance` (
  `cID` INT NOT NULL ,
  `faceVariation` TINYINT UNSIGNED NOT NULL ,
  `skinColor` TINYINT UNSIGNED NOT NULL ,
  `hairVariation` TINYINT UNSIGNED NOT NULL ,
  `hairColor` TINYINT UNSIGNED NOT NULL ,
  `featureVariation` TINYINT UNSIGNED NOT NULL ,
  `showHelm`  NOT NULL ,
  `showCloak`  NOT NULL ,
  PRIMARY KEY (`cID`) ,
  INDEX `fk_char_id` (`cID` ASC) ,
  CONSTRAINT `fk_char_id`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_items`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_items` (
  `cID` INT NOT NULL ,
  `averageItemLevel` INT NOT NULL ,
  `averageItemLevelEquipped` INT NOT NULL ,
  `head` INT NULL DEFAULT NULL ,
  `neck` INT NULL DEFAULT NULL ,
  `shoulder` INT NULL DEFAULT NULL ,
  `back` INT NULL DEFAULT NULL ,
  `chest` INT NULL DEFAULT NULL ,
  `shirt` INT NULL DEFAULT NULL ,
  `tabard` INT NULL DEFAULT NULL ,
  `wrist` INT NULL DEFAULT NULL ,
  `hands` INT NULL DEFAULT NULL ,
  `waist` INT NULL DEFAULT NULL ,
  `legs` INT NULL DEFAULT NULL ,
  `feet` INT NULL DEFAULT NULL ,
  `finger1` INT NULL DEFAULT NULL ,
  `finger2` INT NULL DEFAULT NULL ,
  `trinket1` INT NULL DEFAULT NULL ,
  `trinket2` INT NULL DEFAULT NULL ,
  `mainHand` INT NULL DEFAULT NULL ,
  `offHand` INT NULL DEFAULT NULL ,
  `ranged` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`cID`) ,
  INDEX `fk_item_IDs` (`averageItemLevel` ASC, `averageItemLevelEquipped` ASC, `head` ASC, `neck` ASC, `shoulder` ASC, `back` ASC, `chest` ASC, `shirt` ASC, `tabard` ASC, `wrist` ASC, `hands` ASC, `legs` ASC, `feet` ASC, `waist` ASC, `finger1` ASC, `finger2` ASC, `trinket1` ASC, `trinket2` ASC, `mainHand` ASC, `offHand` ASC, `ranged` ASC) ,
  INDEX `fk_char_id` (`cID` ASC) ,
  CONSTRAINT `fk_item_IDs`
    FOREIGN KEY (`averageItemLevel` , `averageItemLevelEquipped` , `head` , `neck` , `shoulder` , `back` , `chest` , `shirt` , `tabard` , `wrist` , `hands` , `legs` , `feet` , `waist` , `finger1` , `finger2` , `trinket1` , `trinket2` , `mainHand` , `offHand` , `ranged` )
    REFERENCES `default_schema`.`prefix_items_tool` (`eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` , `eiID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_char_id`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_talents`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_talents` (
  `cID` INT NOT NULL ,
  `primName` VARCHAR(50) NOT NULL ,
  `primIcon` VARCHAR(50) NOT NULL ,
  `primTree0` VARCHAR(20) NOT NULL ,
  `primTree1` VARCHAR(20) NOT NULL ,
  `primTree2` VARCHAR(20) NOT NULL ,
  `primPrime0Item` SMALLINT NULL DEFAULT NULL ,
  `primPrime0IGlyphe` INT NULL DEFAULT NULL ,
  `primPrime1Item` SMALLINT NULL DEFAULT NULL ,
  `primPrime1IGlyphe` INT NULL DEFAULT NULL ,
  `primPrime2Item` SMALLINT NULL DEFAULT NULL ,
  `primPrime2IGlyphe` INT NULL DEFAULT NULL ,
  `primMajor0Item` SMALLINT NULL DEFAULT NULL ,
  `primMajor0IGlyphe` INT NULL DEFAULT NULL ,
  `primMajor1Item` SMALLINT NULL DEFAULT NULL ,
  `primMajor1IGlyphe` INT NULL DEFAULT NULL ,
  `primMajor2Item` SMALLINT NULL DEFAULT NULL ,
  `primMajor2IGlyphe` INT NULL DEFAULT NULL ,
  `primMinor0Item` SMALLINT NULL DEFAULT NULL ,
  `primminor0IGlyphe` INT NULL DEFAULT NULL ,
  `primMinor1Item` SMALLINT NULL DEFAULT NULL ,
  `primminor1IGlyphe` INT NULL DEFAULT NULL ,
  `primMinor2Item` SMALLINT NULL DEFAULT NULL ,
  `primminor2IGlyphe` INT NULL DEFAULT NULL ,
  `secName` VARCHAR(50) NULL DEFAULT NULL ,
  `secIcon` VARCHAR(50) NULL DEFAULT NULL ,
  `secTree0` VARCHAR(20) NULL DEFAULT NULL ,
  `secTree1` VARCHAR(20) NULL DEFAULT NULL ,
  `secTree2` VARCHAR(20) NULL DEFAULT NULL ,
  `secsece0Item` SMALLINT NULL DEFAULT NULL ,
  `secsece0IGlyphe` INT NULL DEFAULT NULL ,
  `secsece1Item` SMALLINT NULL DEFAULT NULL ,
  `secsece1IGlyphe` INT NULL DEFAULT NULL ,
  `secsece2Item` SMALLINT NULL DEFAULT NULL ,
  `secsece2IGlyphe` INT NULL DEFAULT NULL ,
  `secMajor0Item` SMALLINT NULL DEFAULT NULL ,
  `secMajor0IGlyphe` INT NULL DEFAULT NULL ,
  `secMajor1Item` SMALLINT NULL DEFAULT NULL ,
  `secMajor1IGlyphe` INT NULL DEFAULT NULL ,
  `secMajor2Item` SMALLINT NULL DEFAULT NULL ,
  `secMajor2IGlyphe` INT NULL DEFAULT NULL ,
  `secMinor0Item` SMALLINT NULL DEFAULT NULL ,
  `secminor0IGlyphe` INT NULL DEFAULT NULL ,
  `secMinor1Item` SMALLINT NULL DEFAULT NULL ,
  `secminor1IGlyphe` INT NULL DEFAULT NULL ,
  `secMinor2Item` SMALLINT NULL DEFAULT NULL ,
  `secminor2IGlyphe` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`cID`) ,
  INDEX `fk_char_id` (`cID` ASC) ,
  CONSTRAINT `fk_char_id`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_titles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_titles` (
  `tID` SMALLINT UNSIGNED NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`tID`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_titles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_titles` (
  `cID` INT NOT NULL ,
  `tID` SMALLINT UNSIGNED NOT NULL ,
  UNIQUE INDEX (`cID` ASC, `tID` ASC) ,
  INDEX `fk_cID` (`cID` ASC) ,
  INDEX `fk_titels_ID` (`tID` ASC) ,
  CONSTRAINT `fk_cID`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_titels_ID`
    FOREIGN KEY (`tID` )
    REFERENCES `default_schema`.`prefix_titles` (`tID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_stats`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_stats` (
  `cID` INT NOT NULL ,
  `health` INT NOT NULL ,
  `powerENGINE` ENUM('mana','energie', 'rage') NOT NULL ,
  `power` INT NOT NULL ,
  `str` INT NOT NULL ,
  `agi` INT NOT NULL ,
  `sta` INT NOT NULL ,
  `int` INT NOT NULL ,
  `spr` INT NOT NULL ,
  `attackPower` INT NOT NULL ,
  `rangedAttackPower` INT NOT NULL ,
  `mastery` FLOAT(8,6) NOT NULL ,
  `masteryRating` INT NOT NULL ,
  `crit` FLOAT(8,6) NOT NULL ,
  `critRating` INT NOT NULL ,
  `hitRating` INT NOT NULL ,
  `hasteRating` INT NOT NULL ,
  `expertiseRating` INT NOT NULL ,
  `spellPower` INT NOT NULL ,
  `spellPen` SMALLINT UNSIGNED NOT NULL ,
  `spellCrit` FLOAT(8,6) NOT NULL ,
  `spellCritRating` INT NOT NULL ,
  `mana5` FLOAT(6,1) NOT NULL ,
  `mana5Combat` FLOAT(6,1) NOT NULL ,
  `armor` INT NOT NULL ,
  `dodge` FLOAT(8,6) NOT NULL ,
  `dodgeRating` INT NOT NULL ,
  `parry` FLOAT(8,6) NOT NULL ,
  `parryRating` INT NOT NULL ,
  `block` FLOAT(8,6) NOT NULL ,
  `blockRating` INT NOT NULL ,
  `resil` INT NOT NULL ,
  `mainHandDmgMin` FLOAT(8,6) NOT NULL ,
  `mainHandDmgMax` FLOAT(8,6) NOT NULL ,
  `mainHandSpeed` FLOAT(2,1) NOT NULL ,
  `mainHandDps` FLOAT(8,4) NOT NULL ,
  `mainHandExpertise` TINYINT NOT NULL ,
  `offHandDmgMin` FLOAT(8,6) NOT NULL ,
  `offHandDmgMax` FLOAT(8,6) NOT NULL ,
  `offHandSpeed` FLOAT(2,1) NOT NULL ,
  `offHandDps` FLOAT(8,4) NOT NULL ,
  `offHandExpertise` TINYINT NOT NULL ,
  `rangedDmgMin` FLOAT(8,6) NOT NULL ,
  `rangedDmgMax` FLOAT(8,6) NOT NULL ,
  `rangedSpeed` FLOAT(2,1) NOT NULL ,
  `rangedDps` FLOAT(8,4) NOT NULL ,
  `rangedCrit` FLOAT(8,6) NOT NULL ,
  `rangedCritRating` INT NOT NULL ,
  `rangedHitRating` INT NOT NULL ,
  PRIMARY KEY (`cID`) ,
  INDEX `fk_chars` (`cID` ASC) ,
  CONSTRAINT `fk_chars`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_guild`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_guild` (
  `cID` INT NOT NULL ,
  `gID` INT NOT NULL ,
  UNIQUE INDEX (`cID` ASC, `gID` ASC) ,
  INDEX `fk_c_ID` (`cID` ASC) ,
  INDEX `fk_guild_id` (`gID` ASC) ,
  CONSTRAINT `fk_c_ID`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_guild_id`
    FOREIGN KEY (`gID` )
    REFERENCES `default_schema`.`prefix_guild` (`gID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_professions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_professions` (
  `pID` INT NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  `icon` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`pID`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_professions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_professions` (
  `cID` INT NOT NULL ,
  `pID` INT NOT NULL ,
  `range` SMALLINT UNSIGNED NOT NULL ,
  `max` SMALLINT UNSIGNED NOT NULL ,
  UNIQUE INDEX (`cID` ASC, `pID` ASC) ,
  INDEX `fk_chars_ID` (`cID` ASC) ,
  INDEX `fk_prof_ID` (`pID` ASC) ,
  CONSTRAINT `fk_chars_ID`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prof_ID`
    FOREIGN KEY (`pID` )
    REFERENCES `default_schema`.`prefix_professions` (`pID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_companions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_companions` (
  `cID` INT NOT NULL ,
  `mounts` VARCHAR(255) NULL DEFAULT NULL ,
  `companions` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`cID`) ,
  INDEX `fk_char_id` (`cID` ASC) ,
  CONSTRAINT `fk_char_id`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_instanzen`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_instanzen` (
  `inID` MEDIUMINT NOT NULL ,
  `name` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`inID`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_bosse`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_bosse` (
  `bID` MEDIUMINT NOT NULL ,
  `inID` MEDIUMINT NOT NULL ,
  `name` VARCHAR(30) NOT NULL ,
  `normalHealth` INT UNSIGNED NULL DEFAULT NULL ,
  `heroicHealth` INT UNSIGNED NULL DEFAULT NULL ,
  PRIMARY KEY (`bID`) ,
  INDEX `fk_boss_id` (`bID` ASC) ,
  INDEX `fk_int_ID` (`inID` ASC) ,
  CONSTRAINT `fk_boss_id`
    FOREIGN KEY (`bID` )
    REFERENCES `default_schema`.`prefix_bosse` (`bID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_int_ID`
    FOREIGN KEY (`inID` )
    REFERENCES `default_schema`.`prefix_instanzen` (`inID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_char_progression`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_char_progression` (
  `cID` INT NOT NULL ,
  `bID` MEDIUMINT NOT NULL ,
  `normalKills` MEDIUMINT NOT NULL ,
  `heroicKills` MEDIUMINT NOT NULL ,
  UNIQUE INDEX (`cID` ASC, `bID` ASC) ,
  INDEX `fk_char_id` (`cID` ASC) ,
  INDEX `fk_boss_id` (`bID` ASC) ,
  CONSTRAINT `fk_char_id`
    FOREIGN KEY (`cID` )
    REFERENCES `default_schema`.`prefix_chars` (`cID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_boss_id`
    FOREIGN KEY (`bID` )
    REFERENCES `default_schema`.`prefix_bosse` (`bID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_raid_gruppen`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_raid_gruppen` (
  `ID` INT NOT NULL ,
  `name` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`ID`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_wow_regions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_wow_regions` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `server` VARCHAR(25) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_wow_locale`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_wow_locale` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `rid` TINYINT UNSIGNED NOT NULL ,
  `short` VARCHAR(5) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_dkp_his`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_dkp_his` (
  `char` INT NOT NULL ,
  `time` TIMESTAMP NOT NULL ,
  `dscription` TEXT NOT NULL ,
  `change` INT NOT NULL DEFAULT 0 )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `default_schema`.`prefix_dkp_rules`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `default_schema`.`prefix_dkp_rules` (
  `id` INT NOT NULL ,
  `description` TEXT NOT NULL ,
  `changes` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `default_schema`.`prefix_wow_regions`
-- -----------------------------------------------------
START TRANSACTION;
USE `default_schema`;
INSERT INTO `default_schema`.`prefix_wow_regions` (`id`, `server`) VALUES (1, 'us.battle.net');
INSERT INTO `default_schema`.`prefix_wow_regions` (`id`, `server`) VALUES (2, 'eu.battle.net');
INSERT INTO `default_schema`.`prefix_wow_regions` (`id`, `server`) VALUES (3, 'kr.battle.net');
INSERT INTO `default_schema`.`prefix_wow_regions` (`id`, `server`) VALUES (4, 'tw.battle.net');
INSERT INTO `default_schema`.`prefix_wow_regions` (`id`, `server`) VALUES (5, 'battlenet.com.cn');

COMMIT;

-- -----------------------------------------------------
-- Data for table `default_schema`.`prefix_wow_locale`
-- -----------------------------------------------------
START TRANSACTION;
USE `default_schema`;
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (1, 1, 'en_US');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (2, 1, 'en_MX');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (3, 2, 'en_GB');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (4, 2, 'es_ES');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (5, 2, 'fr_FR');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (6, 2, 'ru_RU');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (7, 2, 'de_DE');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (8, 3, 'ko_KR');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (9, 4, 'zh_TW');
INSERT INTO `default_schema`.`prefix_wow_locale` (`id`, `rid`, `short`) VALUES (10, 5, 'zh_CN');

COMMIT;
