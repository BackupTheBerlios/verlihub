CREATE TABLE `unbanlist` (
  `ban_type` tinyint(4) default '0',
  `ip` varchar(15) default NULL,
  `nick` varchar(30) default NULL,
  `host` text,
  `share_size` varchar(15) default NULL,
  `email` varchar(128) default NULL,
  `range_fr` int(11) default NULL,
  `range_to` int(11) default NULL,
  `date_start` int(11) default '0',
  `date_limit` int(11) default NULL,
  `date_unban` int(11) default NULL,
  `nick_op` varchar(30) default NULL,
  `unban_op` varchar(30) default NULL,
  `reason` text,
  `unban_reason` text,
  UNIQUE KEY `ip` (`ip`,`nick`,`date_unban`)
) TYPE=MyISAM;