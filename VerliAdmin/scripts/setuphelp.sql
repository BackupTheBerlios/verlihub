# This file is part of VerliAdmin by bohyn, www interface for VerliHub.
# http://bohyn.czechweb.cz
# 
# VerliAdmin is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 
# VerliAdmin is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with VerliAdmin; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
# --------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `setuphelp` (
`var` VARCHAR( 32 ) NOT NULL ,
`vtype` ENUM( 'string', 'int', 'float', 'boolean', 'class', 'text' ) NOT NULL ,
`help` TEXT,
`applies` ENUM( 'not', 'new', 'now' ) NOT NULL ,
PRIMARY KEY ( `var` ) ); 

# -------------------------------------------------------------------
# Update version =< 0.2.5

UPDATE setuphelp SET var='setuplist_min_class' WHERE var='setuplist_class_view';
UPDATE setuphelp SET var='setuplist_edit_class' WHERE var='setuplist_class_edit';

# -------------------------------------------------------------------
# VerliAdmin configuration help

INSERT delayed ignore INTO setuphelp VALUES ('min_class', 'class', 'Min class which will be allowed to enter VerliAdmin', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('language', 'string', 'Languages that should be used by VerliAdmin separated by | (first one is default). Each language must have two files language.php and img/languageflag.gif', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('login_time', 'int', 'Time in seconds after which cookie will be deleted because of inactivity.', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('date_format', 'string', 'Date format (PHP syntax)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('time_format', 'string', 'Time format (PHP syntax)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('timedate_format', 'string', 'Date & time format (PHP syntax)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('create_indexes', 'boolean', 'If 1 VA automaticly index tables for faster queries (increase table size)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('user_images', 'boolean', 'Perl regular expresions for icon before nick in reglist and in top-left information table. Expresion and image are separated by \',\' and ended with \';\'', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('time_format', 'text', '', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_login', 'boolean', 'Log logins and logouts in VerliAdmin', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_addreg', 'boolean', 'Log adding of new users', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_disablereg', 'boolean', 'Log disabling of regs', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_deletereg', 'boolean', 'Log deleting of regs', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_unkick', 'boolean', 'Log deleting of kicks', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_unban', 'boolean', 'Log unbans', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_settings', 'boolean', 'Log setting changes', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_dir', 'string', 'Path to login directory. VerliAdmin must have access to write in this directory and must must be reacheable. If not null path must be ended with /', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('log_format', 'string', 'There you can write everyting you want. Following variables are available: %date% (see setting date_format); %time% (see setting time_format); %nick% (nick of reg user); %class% (class of reg user); %ip% (IP of reg user); %host% (host name of reg user); %action% (what is he/she doing); %logfilenick% (log actios by op nick); %logfileaction% (log actions by type of action); %logfilenick% or %logfileaction% MUST be in log_format strin or it will not work. Note all these variabled are caseisensitive', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_order_by', 'string', 'Order in which regs will be sorted by default (SQL syntax)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_results', 'int', 'Number of results per page in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('register_class', 'class', 'Which class can be registred by who (class)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('disable_class', 'class', 'Which class can be diasbled (not romoved from table) by who (class)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('delete_class', 'class', 'Which class can be deleted (permanently removed from table) by who (class)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_min_class', 'class', 'Minimum class to access reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_nick', 'boolean', 'Show nick colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_class', 'boolean', 'Show class colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_class_protect', 'boolean', 'Show class_protect colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_class_hidekick', 'boolean', 'Show class_hidekick colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_hide_kick', 'boolean', 'Show hide_kick colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_reg_date', 'boolean', 'Show nick reg_date in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_reg_op', 'boolean', 'Show reg_op colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_pwd_change', 'boolean', 'Show pwd_chande colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_pwd_crypt', 'boolean', 'Show pwd_crypt colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_login_pwd', 'boolean', 'Show login_pwd colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_login_last', 'boolean', 'Show login_last colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_logout_last', 'boolean', 'Show logout_last colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_login_cnt', 'boolean', 'Show login_cnt colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_login_ip', 'boolean', 'Show login_ip colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_error_last', 'boolean', 'Show error_last colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_error_cnt', 'boolean', 'Show error_cnt colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_error_ip', 'boolean', 'Show error_ip colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_enabled', 'boolean', 'Show enabled colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_email', 'boolean', 'Show email colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_note_op', 'boolean', 'Show note_op colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_note_usr', 'boolean', 'Show note_usr colum in reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('reglist_min_class', 'class', 'Minimum class to access reglist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('setuplist_edit_class', 'class', 'Select which minimum class can change verlihub and VeriAdmin settings', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('setuplist_min_class', 'class', 'Select which minimum class can view verlihub and VeriAdmin settings', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('setuplist_order_by', 'string', 'Order in which setuplist will be sorted by default (SQL syntax)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('setuplist_results', 'int', 'Number of results per page in setuplist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_min_class', 'class', 'Minimum class to access banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_order_by', 'string', 'Order in which banlist will be sorted by default (SQL syntax)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_results', 'int', 'Number of results per page in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_unban_class', 'class', 'Which class is minimum to unban', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_ban_type', 'boolean', 'Show ban_type colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_ip', 'boolean', 'Show ip colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_nick', 'boolean', 'Show nick colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_host', 'boolean', 'Show host colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_share_size', 'boolean', 'Show share_size colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_email', 'boolean', 'Show email colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_range_fr', 'boolean', 'Show fange_fr colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_range_to', 'boolean', 'Show range_to colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_date_start', 'boolean', 'Show date_start colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_date_limit', 'boolean', 'Show date_limit colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_nick_op', 'boolean', 'Show nick_op colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('banlist_reason', 'boolean', 'Show reason colum in banlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_min_class', 'class', 'Minimum class to access kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_order_by', 'string', 'Order in which kicklist will be sorted by default (SQL syntax)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_results', 'int', 'Number of results per page in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_unkick_class', 'class', 'Which minimum class will be allowed to delete (permanently remove from table)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_nick', 'boolean', 'Show nick colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_time', 'boolean', 'Show time colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_ip', 'boolean', 'Show ip colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_host', 'boolean', 'Show host colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_share_size', 'boolean', 'Show share_size colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_email', 'boolean', 'Show email colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_op', 'boolean', 'Show op colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_reason', 'boolean', 'Show reason colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('kicklist_is_drop', 'boolean', 'Show is_drop colum in kicklist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_min_class', 'class', 'Minimum class to access unbanlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_order_by', 'string', 'Order in which unbanlist will be sorted by default (SQL syntax)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_results', 'int', 'Number of results per page in unabnlist', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_ip', 'boolean', 'Show ip colum in unbanlist (IP)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_nick', 'boolean', 'Show nick colum in unbanlist (Nick)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_host', 'boolean', 'Show host colum in unbanlist (Inetrnet provider if avaliable)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_share_size', 'boolean', 'Show share_size colum in unbanlist (Share size)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_email', 'boolean', 'Show email colum in unbanlist (Email of banned nick/IP if available)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_range_fr', 'boolean', 'Show range_fr colum in unbanlist (IP range from (only on IP range ban))', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_range_to', 'boolean', 'Show range_to colum in unbanlist (IP range to (only on IP range ban))', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_date_start', 'boolean', 'Show date_start colum in unbanlist (Date of ban)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_date_limit', 'boolean', 'Show date_limit colum in unbanlist (Date till ban will be active)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_date_unban', 'boolean', 'Show date_unban colum in unbanlist (Date of unban)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_ban_op', 'boolean', 'Show ban_op colum in unbanlist (nick of ban OP)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_unban_op', 'boolean', 'Show unban_op colum in unbanlist (nick of unban OP)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_ban_reason', 'boolean', 'Show ban_reason colum in unbanlist (ban reason)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('unbanlist_unban_reason', 'boolean', 'Show unban_reason colum in unbanlist (unban reason)', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_min_class', 'class', 'Minimum class to access file triggers', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_order_by', 'string', 'Default order of file triggers', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_results', 'int', 'Number of triggers per page', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_edit_class', 'class', 'Minimum class to edit triggers', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_command', 'boolean', 'Show command colum in file_trigger', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_send_as', 'boolean', 'Show send_as colum in file_trigger', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_def', 'boolean', 'Show def colum in file_trigger', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_descr', 'boolean', 'Show descr colum in file_trigger', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_minclass', 'boolean', 'Show min_class colum in file_trigger', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('file_trigger_maxclass', 'boolean', 'Show min_class colum in file_trigger', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_min_class', 'class', 'Minimum class to access messages. Disable if you don`t have that plugin', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_min_post_class', 'class', 'Minimum class to post messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_order_by', 'string', 'Default order of messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_results', 'int', 'Number of messages per page', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_expire_time', 'int', 'Time after which message expires', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_sender', 'boolean', 'Show sender colum in away messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_date_sent', 'boolean', 'Show date_sent colum in away messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_sender_ip', 'boolean', 'Show sender_ip colum in away messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_receiver', 'boolean', 'Show reciver colum in away messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_date_expires', 'boolean', 'Show sender colum in away messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_subject', 'boolean', 'Show sender body in away messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('messanger_body', 'boolean', 'Show sender subject in away messages', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_min_class', 'class', 'Minimum class to access messages. Disable if you don`t have that plugin', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_order_by', 'string', 'Default order of userlog', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_results', 'int', 'Number of rows per page', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_id', 'boolean', 'Show \'id\' colum in user log', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_date', 'boolean', 'Show \'date\' colum in user log', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_action', 'boolean', 'Show \'action\' colum in user log', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_ip', 'boolean', 'Show \'ip\' colum in user log', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_nick', 'boolean', 'Show \'nick\' colum in user log', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('userlog_info', 'boolean', 'Show \'info\' colum in user log', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('stats_min_class', 'class', 'Minimum class to access statisctis', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('stats_plugin', 'boolean', 'Enable if you have statistic plugin', 'now');
INSERT delayed ignore INTO setuphelp VALUES ('commands_min_class', 'class', 'Minimum class to access help page', 'now');

# -------------------------------------------------------------------
# Verlihub configuration help

INSERT delayed ignore INTO setuphelp VALUES ('extra_listen_ports','string','the space separated list of port numbers that hubs should listen at\r\nNote: any invalid port number will lead hub not to start','not');
INSERT delayed ignore INTO setuphelp VALUES ('bc_reply','string','you can leave this blank.. If you send a broadcast message, this is set to your nick, and the pm sent to verlihub\'s bot are trensfered to nick contained here','now');
INSERT delayed ignore INTO setuphelp VALUES ('cc_zone1','string','a list of country codes for zone 1\r\nstart , separate and end with :\r\ne.g. :AA:BB:CC:','not');
INSERT delayed ignore INTO setuphelp VALUES ('cc_zone2','string','a list of country codes for zone 2 start , separate and end with : e.g. :AA:BB:CC:','not');
INSERT delayed ignore INTO setuphelp VALUES ('cc_zone3','string','a list of country codes for zone 3 start , separate and end with : e.g. :AA:BB:CC:','not');
INSERT delayed ignore INTO setuphelp VALUES ('cc_zone4','string','a list of country codes for zone 4 start , separate and end with : e.g. :AA:BB:CC:','not');
INSERT delayed ignore INTO setuphelp VALUES ('cc_zone5','string','a list of country codes for zone 5 start , separate and end with : e.g. :AA:BB:CC:','not');
INSERT delayed ignore INTO setuphelp VALUES ('max_message_size','int','maximum size of incoming single message','now');
INSERT delayed ignore INTO setuphelp VALUES ('check_rctm','int','drop users who give different nick in revocnnectome','now');
INSERT delayed ignore INTO setuphelp VALUES ('check_ctm','int','disconnect users who give different ip in commnect to me','now');
INSERT delayed ignore INTO setuphelp VALUES ('log_level','int','intensity of logging events 5 logs all (input, output, etc), 0 logs nothing','now');
INSERT delayed ignore INTO setuphelp VALUES ('hub_security','string','The name of hub security','not');
INSERT delayed ignore INTO setuphelp VALUES ('step_delay','int','delay in [�s] on every step, gives the processor time not to be cooked','now');
INSERT delayed ignore INTO setuphelp VALUES ('delayed_search','boolean','is search to be sent in server timer (1) or immediately(0), cpu effect is enourmous','now');
INSERT delayed ignore INTO setuphelp VALUES ('nicklist_on_login','boolean','disable sending of nicklist before user sends myinfo (usually leave this on=1)','new');
INSERT delayed ignore INTO setuphelp VALUES ('timer_serv_period','int','period [s] of timer executed only with the server, this executes the connection timers too','now');
INSERT delayed ignore INTO setuphelp VALUES ('timer_conn_period','int','period of timer executed for every connection','now');
INSERT delayed ignore INTO setuphelp VALUES ('listen_ip','string','ip address on which server listens','not');
INSERT delayed ignore INTO setuphelp VALUES ('listen_port','int','port on which server listens','not');
INSERT delayed ignore INTO setuphelp VALUES ('nick_prefix','string','prefix before nick, to allow user in','new');
INSERT delayed ignore INTO setuphelp VALUES ('db_data','string','mysql database to use on the host','not');
INSERT delayed ignore INTO setuphelp VALUES ('db_pass','string','mysql passwrd','not');
INSERT delayed ignore INTO setuphelp VALUES ('db_user','string','mysql username','not');
INSERT delayed ignore INTO setuphelp VALUES ('db_host','string','mysql database hostname','not');
INSERT delayed ignore INTO setuphelp VALUES ('max_chat_lines','int','number of lines allowed per chat message','now');
INSERT delayed ignore INTO setuphelp VALUES ('max_chat_msg','int','size of max allowed chat message for normal users in [B]','now');
INSERT delayed ignore INTO setuphelp VALUES ('nick_chars','string','chars allowed for nick','new');
INSERT delayed ignore INTO setuphelp VALUES ('min_nick','int','min length of nickname','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_nick','int','max length of nickname','new');
INSERT delayed ignore INTO setuphelp VALUES ('tban_kick','int','time period of not allowing to login kicked users after kick [s]','now');
INSERT delayed ignore INTO setuphelp VALUES ('max_share','int','maximum share [MB]','new');
INSERT delayed ignore INTO setuphelp VALUES ('min_share_ops','int','min share for ops class>= 3 [MB]','new');
INSERT delayed ignore INTO setuphelp VALUES ('min_share_reg','int','min share for class >=2 [MB]','new');
INSERT delayed ignore INTO setuphelp VALUES ('min_share','int','Minimum share in megabytes','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_extra_admins','int','number of extra admins, on full hub','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_extra_ops','int','number of ops that can login after hub is full of normal users','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users','int','maximum count of normal users','new');
INSERT delayed ignore INTO setuphelp VALUES ('hub_name','string','The name of hub','new');
INSERT delayed ignore INTO setuphelp VALUES ('dns_lookup','boolean','lookup hostnames in dns on new user connection, note that this may slow down hub enormously, due to request to a remote (DNS) machine','new');
INSERT delayed ignore INTO setuphelp VALUES ('hub_desc','string','the description that is 1)sent to hublist 2) sent as $HubTopic','now');
INSERT delayed ignore INTO setuphelp VALUES ('hub_host','string','the hostname that is sent to hublist when being registered (the one you want your users to connect to)','now');
INSERT delayed ignore INTO setuphelp VALUES ('hub_owner','string','I\'m not realy sure what hublist uses this for','now');
INSERT delayed ignore INTO setuphelp VALUES ('max_users0','int','user limit for the default CC zone; keep this high unles you want to use CC_wones, then this will limit the number of stangers','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users1','int','user limit for the cc_zone1\r\nsee also variable cc_zone1','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users2','int','user limit for the cc_zone2\r\nsee also variable cc_zone2','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users3','int','user limit for the cc_zone3\r\nsee also variable cc_zone3','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users4','int','user limit for the cc_zone4\r\nsee also variable cc_zone4','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users5','int','user limit for the cc_zone5\r\nsee also variable cc_zone5','new');
INSERT delayed ignore INTO setuphelp VALUES ('optimize_userlist','boolean','don\'t change this, it\'s experimental, and probably should be removed','new');
INSERT delayed ignore INTO setuphelp VALUES ('show_tags','int','the way of displaying user\'s tags in userlist\r\n0 - show no tags to noone\r\n1 - show user\'s tags to ops only\r\n2 - show user\'s tags to all','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_allow_none','boolean','Allow users that have no tag in description? yes=1/no=0\r\nyes does not mean disabling tag parsing and control','new');
INSERT delayed ignore INTO setuphelp VALUES ('ul_portion','int','this is related to the optimize_userlist (read that one first)','new');
INSERT delayed ignore INTO setuphelp VALUES ('chat_default_on','boolean','normal users can receive chat?\r\n','new');
INSERT delayed ignore INTO setuphelp VALUES ('delayed_myinfo','boolean','CPU optimisation, on user\'s login hiss MyINFO is sent a little bit later, together with others...','new');
INSERT delayed ignore INTO setuphelp VALUES ('hide_all_kicks','boolean','Are kick messages to be shown in the main chat ??','now');
INSERT delayed ignore INTO setuphelp VALUES ('hublist_host','string','the space separated list of hublist registration centers where hub wants to be registered, Be carefull what you put here, first make sure that those addresses are active on port hublist_port (default 2501)','now');
INSERT delayed ignore INTO setuphelp VALUES ('hublist_port','int','port number for hublist registrator','now');
INSERT delayed ignore INTO setuphelp VALUES ('max_extra_regs','int','the extra to the userlimit for registered users (applies to any type of userlimit)','new');
INSERT delayed ignore INTO setuphelp VALUES ('int_search','int','minimal interval in [s]econds for non-ops can search','now');
INSERT delayed ignore INTO setuphelp VALUES ('ip_zone4_max','string','the upper limit for the ip zone (correspondin to max_users4)','new');
INSERT delayed ignore INTO setuphelp VALUES ('ip_zone4_min','string','the lower limit for the ip zone (correspondin to max_users4)','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_share_reg','int','maximum share [MB] for registered users','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users0','int','user limit for the cc_zone0','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users1','int','user limit for the cc_zone1','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users2','int','user limit for the cc_zone2','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users3','int','user limit for the cc_zone3','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_users4','int','user limit for the ip range zone4','new');
INSERT delayed ignore INTO setuphelp VALUES ('min_frequency','string','the Real number corresponding to minimum \"cycle\" frequency; This affects directly the \"hub is busy\" messages, that are sent when the mean time between two cycles is too long.\r\n\r\nto disable the <<antilag>> feature, set this to 0; use 0.1 to allow some kind of lags, with over 0.5 you\'ll probably never see a lag due to CPU incapacity','now');
INSERT delayed ignore INTO setuphelp VALUES ('msg_banned','text','a text sent to every banned user attempting to login','new');
INSERT delayed ignore INTO setuphelp VALUES ('msg_hub_full','text','a text sent to users that cannot login due to any type of user limit (country codes, reg-only hubs etc...)','new');
INSERT delayed ignore INTO setuphelp VALUES ('min_search_chars','int','minimal length of search string, this is to prevent useless searches like \".\" etc.. You can also disable searching in the hub (of course OPs are not concerned)','now');
INSERT delayed ignore INTO setuphelp VALUES ('msg_chat_onoff','text','This message is sent to all users htat are off the chat see: chat_default_on','new');
INSERT delayed ignore INTO setuphelp VALUES ('msg_nick_prefix','text','This message is sent to users that don\'t meet nick-prefix criteria','new');
INSERT delayed ignore INTO setuphelp VALUES ('nick_prefix_cc','boolean','Require non-registered users to have their country code prefix in form of [CC] ([US] for example) in front of their nicks','new');
INSERT delayed ignore INTO setuphelp VALUES ('opchat_name','string','The nam eof the opchat bot (leave empty to disable opchat)','not');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host0','string','the address of a hub to which redirected users are sent\r\nthe choice between redir_host0 ... 9 is random, leave blank to disable redirect to this host, you can even put your own hostname','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host1','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host2','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host3','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host4','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host5','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host6','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host7','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host8','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host9','string','the address of a hub to which redirected users are sent','now');
INSERT delayed ignore INTO setuphelp VALUES ('send_user_ip','boolean','turns on/off the $UserIP extention','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_hs_ratio','string','tha maximal ratio between Hubs and Slots (as in the tag) leave this a high number in order to disable the H/S checking feature','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_hubs','int','the upper limit of the hub users are conected on (as in tags)','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_28kbps','int','maximum number of openned slots for users with connection 28kbps','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_28kbps','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_28kbps','string','minimum value of (\"overall\") upload limiter for users with connection 28kbps\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_28kbps','string','minimum value of per slot upload limiter for users with connection 28kbps ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_33_6kbps','int','maximum number of openned slots for users with connection 33kbps','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_33_6kbps','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_33_6kbps','string','minimum value of (\"overall\") upload limiter for users with connection 33kbps\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_33_6kbps','string','minimum value of per slot upload limiter for users with connection 33kbps ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_56kbps','int','maximum number of openned slots for users with connection 56kbps','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_56kbps','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_56kbps','string','minimum value of (\"overall\") upload limiter for users with connection 56kbps\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_56kbps','string','minimum value of per slot upload limiter for users with connection 56kbps ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_modem','int','maximum number of openned slots for users with connection modem','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_modem','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_modem','string','minimum value of (\"overall\") upload limiter for users with connection modem\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_modem','string','minimum value of per slot upload limiter for users with connection modem ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_isdn','int','maximum number of openned slots for users with connection ISDN','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_isdn','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_isdn','string','minimum value of (\"overall\") upload limiter for users with connection ISDN\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_isdn','string','minimum value of per slot upload limiter for users with connection ISDN ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_cable','int','maximum number of openned slots for users with connection cable','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_cable','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_cable','string','minimum value of (\"overall\") upload limiter for users with connection cable\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_cable','string','minimum value of per slot upload limiter for users with connection cable ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_dsl','int','maximum number of openned slots for users with connection dsl','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_dsl','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_dsl','string','minimum value of (\"overall\") upload limiter for users with connection dsl\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_dsl','string','minimum value of per slot upload limiter for users with connection dsl ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_satellite','int','maximum number of openned slots for users with connection satetlite','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_satellite','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_satellite','string','minimum value of (\"overall\") upload limiter for users with connection satetlite\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_satellite','string','minimum value of per slot upload limiter for users with connection sateltite ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_microwave','int','maximum number of openned slots for users with connection microwave','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_microwave','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_microwave','string','minimum value of (\"overall\") upload limiter for users with connection microwave\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_microwave','string','minimum value of per slot upload limiter for users with connection microwave ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_wireless','int','maximum number of openned slots for users with connection wireless','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_wireless','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_wireless','string','minimum value of (\"overall\") upload limiter for users with connection wireless\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_wireless','string','minimum value of per slot upload limiter for users with connection wireless ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_lant1','int','maximum number of openned slots for users with connection LAN T1','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_lant1','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_lant1','string','minimum value of (\"overall\") upload limiter for users with connection LAN T1\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_lant1','string','minimum value of per slot upload limiter for users with connection LAN T1 ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_max_slots_lant3','int','maximum number of openned slots for users with connection LAN T3','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_slots_lant3','int','minimum of opened slots per connection type','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_limit_lant3','string','minimum value of (\"overall\") upload limiter for users with connection LAN T3\r\nnedative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_lant3','string','minimum value of per slot upload limiter for users with connection LAN T3 ; negative value disables checking','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_ls_ratio_default','string','the _default applies for unlisted conection types','new');
INSERT delayed ignore INTO setuphelp VALUES ('use_reglist_cache','boolean','Preloads reglist into the memory, this redices number of MySQL queries,  ans thus improves performance. Newly (by external means) added regs have to wait until the cahce is reloaded','not');
INSERT delayed ignore INTO setuphelp VALUES ('use_penlist_cache','boolean','preload a penalty (and temp user rights) list into ram, improves preformance, reduce mysql queries','not');
INSERT delayed ignore INTO setuphelp VALUES ('hublist_send_minshare','boolean','send the MINSHARE info to hublist in description','now');
INSERT delayed ignore INTO setuphelp VALUES ('replace_from','','','');
INSERT delayed ignore INTO setuphelp VALUES ('replace_to','','','');
INSERT delayed ignore INTO setuphelp VALUES ('max_repeat_char','','','');
INSERT delayed ignore INTO setuphelp VALUES ('max_upcase_percent','','','');
INSERT delayed ignore INTO setuphelp VALUES ('allways_ask_password','boolean','(security) if set, allows you to specify a temporary password for a user, which does not give him access to the right, but let\'s him enter (and change password) only knowing the password ','new');
INSERT delayed ignore INTO setuphelp VALUES ('desc_insert_mode','boolean','(cosmetic) inserts A,P or 5 (the mode) in the shortcut of descritpoin','new');
INSERT delayed ignore INTO setuphelp VALUES ('int_login','int','this is the length of a minimum interval for a nick to be allowed to login','new');
INSERT delayed ignore INTO setuphelp VALUES ('max_upload_kbps','string','(experimental) upload limiter','now');
INSERT delayed ignore INTO setuphelp VALUES ('min_share_use_hub','int','search and download is disabled when users don\'t meet this minimum','new');
INSERT delayed ignore INTO setuphelp VALUES ('msg_change_pwd','text','a message sent when password is required to be changed','now');
INSERT delayed ignore INTO setuphelp VALUES ('msg_welcome_admin','string','message to be sent to main chat when admin log in (%[nick] is replaced)','new');
INSERT delayed ignore INTO setuphelp VALUES ('msg_replace_ban','string','if not empty, defines string to put instead of the _ban_ statement in kick messages','now');
INSERT delayed ignore INTO setuphelp VALUES ('msg_downgrade','text','message asking user to downgrade when he dosn to meat the tag_min_version_xxx criteria','now');
INSERT delayed ignore INTO setuphelp VALUES ('msg_upgrade','text','message asking user to upgrade when he dosn to meat the tag_min_version_xxx ','now');
INSERT delayed ignore INTO setuphelp VALUES ('redir_host_max','int','gives the max index of redir_host to be used for random choise','now');
INSERT delayed ignore INTO setuphelp VALUES ('reg_class_difference','int','the min difference between classes when registering a user (e.g class 4 can do 4-reg_class_difference users)','now');
INSERT delayed ignore INTO setuphelp VALUES ('save_lang','boolean','tell is language strings are to be dumped into db on startup to allow you translations or modification (later they are loaded from the db)','not');
INSERT delayed ignore INTO setuphelp VALUES ('send_user_info','boolean','on user login the info about him is sent or not','new');
INSERT delayed ignore INTO setuphelp VALUES ('tag_min_class_ignore','class','min user class that is not checked for tags and stuff','new');
INSERT delayed ignore INTO setuphelp VALUES ('timer_hublist_period','int','number of seconds between two hublist registrations','now');
INSERT delayed ignore INTO setuphelp VALUES ('timer_reloadcfg_period','int','num of seconds between attempts ro reload config from database (0 disables reloading)','now');
INSERT delayed ignore INTO setuphelp VALUES ('tag_sum_hubs','int','if the hub part of tag is like H:X/Y/Z\r\nthis means the number of the left counts to be summed (2 means hubs=X+Y)','new');
INSERT delayed ignore INTO setuphelp VALUES ('int_flood_pm_period','int','the checking period in seconds, tor the PM antiflood protection','new');
INSERT delayed ignore INTO setuphelp VALUES ('int_flood_pm_limit','int','maximal number of PMs allowed user to send in a int_flood_pm_period','new');
INSERT delayed ignore INTO setuphelp VALUES ('classdif_download','int','class difference for download' ,'now');
INSERT delayed ignore INTO setuphelp VALUES ('classdif_pm','int','class difference for private msg','now');
INSERT delayed ignore INTO setuphelp VALUES ('classdif_reg','int','class difference for registering users','now');
INSERT delayed ignore INTO setuphelp VALUES ('classdif_kick','int','class difference for kicking', 'now');