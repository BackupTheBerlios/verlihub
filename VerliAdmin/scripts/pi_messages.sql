CREATE TABLE `pi_messages` (
  `sender` varchar(32) NOT NULL default '',
  `date_sent` int(11) NOT NULL default '0',
  `sender_ip` varchar(15) default NULL,
  `receiver` varchar(32) NOT NULL default '',
  `date_expires` int(11) default NULL,
  `subject` varchar(128) default NULL,
  `body` text,
  PRIMARY KEY  (`sender`,`date_sent`)
) TYPE=MyISAM;