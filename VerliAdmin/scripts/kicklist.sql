CREATE TABLE `kicklist` (
  `nick` varchar(30) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  `ip` varchar(15) default NULL,
  `host` text,
  `share_size` varchar(15) default NULL,
  `email` varchar(128) default NULL,
  `reason` text,
  `op` varchar(30) NOT NULL default '',
  `is_drop` tinyint(1) default NULL,
  PRIMARY KEY  (`nick`,`time`),
  KEY `op_index` (`op`),
  KEY `ip_index` (`ip`),
  KEY `drop_index` (`is_drop`)
) TYPE=MyISAM;