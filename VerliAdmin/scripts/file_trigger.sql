CREATE TABLE `file_trigger` (
  `command` varchar(15) NOT NULL default '',
  `send_as` varchar(15) default 'hub-security',
  `def` text,
  `descr` text,
  `min_class` int(11) default NULL,
  PRIMARY KEY  (`command`)
) TYPE=MyISAM;