CREATE TABLE `prefix_beispiel` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tid` smallint(6) NOT NULL default '0',
  `autor` varchar(100) NOT NULL default '',
  `pic` varchar(100) NOT NULL default '',
  `homepage` varchar(100) NULL default '',
  `aboutme` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
)TYPE=MyISAM;