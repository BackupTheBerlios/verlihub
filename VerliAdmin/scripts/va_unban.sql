#
# Struktura tabulky `va_unban`
#

CREATE TABLE IF NOT EXISTS `va_unban` (
  `nick` varchar(32) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `email` varchar(40) NOT NULL default '',
  `time` int(11) unsigned NOT NULL default '0',
  `status` tinyint(4) NOT NULL default '0',
  `comment` text NOT NULL,
  `op` varchar(30) NOT NULL default '',
  `time_op` int(11) NOT NULL default '0',
  `answer` text NOT NULL,
  PRIMARY KEY  (`nick`,`ip`),
  KEY `status` (`status`)
) TYPE=MyISAM;
