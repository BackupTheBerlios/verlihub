CREATE TABLE `temp_rights` (
  `nick` varchar(15) NOT NULL default '',
  `since` int(11) default NULL,
  `st_chat` int(11) default NULL,
  `st_search` int(11) default NULL,
  `st_ctm` int(11) default NULL,
  `st_pm` int(11) default NULL,
  PRIMARY KEY  (`nick`),
  KEY `creation_index` (`since`)
) TYPE=MyISAM;