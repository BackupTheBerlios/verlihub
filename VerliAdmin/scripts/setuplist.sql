/*
Copyright (c) 2004 by Petr Bohac
--------------------------------
This file is part of VerliAdmin by bohyn, www interface for VerliHub.
http://bohyn.czechweb.cz

VerliAdmin is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

VerliAdmin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with VerliAdmin; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

CREATE TABLE IF NOT EXISTS `SetupList` (
  `file` varchar(15) NOT NULL default '',
  `var` varchar(32) NOT NULL default '',
  `val` text,
  PRIMARY KEY  (`file`,`var`)
) TYPE=MyISAM;

-- -------------------------------------------------------------------

-- Update from =< 0.2.5
UPDATE SetupList SET var='setuplist_min_class' WHERE var='setuplist_class_view' AND file='VerliAdmin';
UPDATE SetupList SET var='setuplist_edit_class' WHERE var='setuplist_class_edit' AND file='VerliAdmin';

-- -------------------------------------------------------------------

-- Update from =< 0.3 RC3
UPDATE SetupList SET val='cz|de|en|fr|hun|it|lv|pl|ro|ru|sw' WHERE var='language' AND file='VerliAdmin';

-- -------------------------------------------------------------------

INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'min_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'language', 'cz|de|en|fr|hun|it|lv|pl|ro');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'login_time', '3600');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'date_format', 'd.m.Y');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'time_format', 'H:i:s');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'timedate_format', 'd.m.Y - H:i');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'create_indexes', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'user_images', '^((\[)|(\())[Bb][Oo][Tt]((\])|(\))), bot.gif;\n^(\[[Oo][Pp]\])?(\([Cc][Zz]\))?[Bb][Oo][Hh][Yy][Nn]$, bohyn16.gif;\n^[Vv][Ee][Rr][Ll][Ii][Bb][Aa]$, verliba16.gif');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_login', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_addreg', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_disablereg', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_deletereg', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_unkick', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_unban', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_settings', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_dir', 'logs/');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'log_format', '%logfilenick%%logfileaction%[%date% - %time%] %nick% (%class%) %ip% %action%');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_min_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_order_by', 'class DESC, nick ASC');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_results', '50');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'register_class', '4|4|5|10|10|10');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'disable_class', '4|4|5|10|10|10');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'delete_class', '4|4|10|10|10|11');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_nick', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_class', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_class_protect', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_class_hidekick', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_hide_kick', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_reg_date', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_reg_op', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_pwd_change', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_pwd_crypt', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_login_pwd', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_login_last', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_logout_last', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_login_cnt', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_login_ip', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_error_last', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_error_cnt', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_error_ip', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_enabled', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_email', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_note_op', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'reglist_note_usr', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'setuplist_edit_class', '10');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'setuplist_min_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'setuplist_order_by', 'var ASC');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'setuplist_results', '50');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_min_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_unban_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_order_by', 'date_start DESC');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_results', '50');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_ban_type', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_ip', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_nick', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_host', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_share_size', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_email', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_range_fr', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_range_to', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_date_start', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_date_limit', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_nick_op', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'banlist_reason', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_min_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_unkick_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_order_by', 'time DESC');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_results', '50');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_nick', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_time', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_ip', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_host', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_share_size', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_email', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_op', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_reason', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'kicklist_is_drop', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_min_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_order_by', 'date_unban DESC');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_results', '50');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_ip', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_nick', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_host', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_share_size', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_email', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_range_fr', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_range_to', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_date_start', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_date_limit', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_date_unban', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_ban_op', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_unban_op', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_ban_reason', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'unbanlist_unban_reason', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_min_class', '3');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_order_by', 'command');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_results', '50');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_edit_class', '10');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_command', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_send_as', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_def', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_descr', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_minclass', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'file_trigger_maxclass', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_min_class', '11');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_results', '100');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_order_by', 'id DESC');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_id', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_nick', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_ip', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_date', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_action', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'userlog_info', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_min_class', '11');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_min_post_class', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_order_by', 'date_sent DESC');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_results', '50');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_expire_time', '604800');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_sender', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_date_sent', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_sender_ip', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_receiver', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_date_expires', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_subject', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'messanger_body', '1');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'stats_min_class', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'stats_plugin', '0');
INSERT delayed ignore INTO SetupList VALUES ('VerliAdmin', 'commands_min_class', '3');
