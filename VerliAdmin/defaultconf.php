<?
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

// ---------------------------------------------------------------------

//Default VerliAdmin configuration values. Should not be changed
//If you want to change VerliAdmin configuration do it in SetupList
//table in verlihub database
$VA_setup['min_class'] =				3;
$VA_setup['language'] =					"cz|de|en|fr|hun|it|lv|pl|ru|sw";
$VA_setup['language_source'] =			0;
$VA_setup['login_time'] =				3600; // 1 hour
$VA_setup['date_format'] =				"d.m.Y";
$VA_setup['timedate_format'] =			"d.m.Y - H:i";
$VA_setup['time_format'] =				"H:m:s";
$VA_setup['create_indexes'] =			1;
$VA_setup['log_login'] =				0;
$VA_setup['log_addreg'] =				0;
$VA_setup['log_disablereg'] =			0;
$VA_setup['log_deletereg'] =			0;
$VA_setup['log_unkick'] =				0;
$VA_setup['log_unban'] =				0;
$VA_setup['log_settings'] =				0;
$VA_setup['log_dir'] =					"logs/";
$VA_setup['log_format'] =				"%logfilenick%%logfileaction%[%date% - %time%] %nick% (%class%) %ip% %action%";
$VA_setup['reglist_min_class'] =		3;
$VA_setup['reglist_order_by'] =			"class DESC, nick ASC";
$VA_setup['reglist_results'] =			50;
$VA_setup['reglist_nick'] =				1;
$VA_setup['reglist_class'] =			1;
$VA_setup['reglist_class_protect'] =	0;
$VA_setup['reglist_class_hidekick'] =	0;
$VA_setup['reglist_hide_kick'] =		0;
$VA_setup['reglist_reg_date'] =			1;
$VA_setup['reglist_reg_op'] =			1;
$VA_setup['reglist_pwd_change'] =		0;
$VA_setup['reglist_pwd_crypt'] =		0;
$VA_setup['reglist_login_pwd'] =		0;
$VA_setup['reglist_login_last'] =		1;
$VA_setup['reglist_logout_last'] =		1;
$VA_setup['reglist_login_cnt'] =		1;
$VA_setup['reglist_login_ip'] =			0;
$VA_setup['reglist_error_last'] =		0;
$VA_setup['reglist_error_cnt'] =		1;
$VA_setup['reglist_error_ip'] =			0;
$VA_setup['reglist_enabled'] =			0;
$VA_setup['reglist_email'] =			0;
$VA_setup['reglist_note_op'] =			0;
$VA_setup['reglist_note_usr'] =			0;
$VA_setup['register_class'] =			"4|4|5|10|10|10";
$VA_setup['disable_class'] =			"4|4|5|10|10|10";
$VA_setup['delete_class'] =				"4|4|10|10|10|11";
$VA_setup['setuplist_edit_class'] =		5;
$VA_setup['setuplist_min_class'] =		3;
$VA_setup['setuplist_order_by'] =		"var ASC";
$VA_setup['setuplist_results'] =		50;
$VA_setup['banlist_min_class'] =		3;
$VA_setup['banlist_order_by'] =			"date_start DESC";
$VA_setup['banlist_results'] =			50;
$VA_setup['banlist_unban_class'] =		3;
$VA_setup['banlist_ban_type'] =			0;
$VA_setup['banlist_ip'] =				1;
$VA_setup['banlist_nick'] =				1;
$VA_setup['banlist_host'] =				0;
$VA_setup['banlist_share_size'] =		0;
$VA_setup['banlist_email'] =			0;
$VA_setup['banlist_range_fr'] =			0;
$VA_setup['banlist_range_to'] =			0;
$VA_setup['banlist_date_start'] =		1;
$VA_setup['banlist_date_limit'] =		1;
$VA_setup['banlist_nick_op'] =			1;
$VA_setup['banlist_reason'] =			1;
$VA_setup['kicklist_min_class'] =	 	3;
$VA_setup['kicklist_order_by'] =	 	"time DESC";
$VA_setup['kicklist_results'] =			100;
$VA_setup['kicklist_unkick_class'] =	3;
$VA_setup['kicklist_nick'] =			1;
$VA_setup['kicklist_time'] =			1;
$VA_setup['kicklist_ip'] =				1;
$VA_setup['kicklist_host'] =			0;
$VA_setup['kicklist_share_size'] =		1;
$VA_setup['kicklist_email'] =			1;
$VA_setup['kicklist_op'] =				1;
$VA_setup['kicklist_reason'] =			1;
$VA_setup['kicklist_is_drop'] =			0;
$VA_setup['unbanlist_min_class'] =		3;
$VA_setup['unbanlist_order_by'] = 		"date_unban DESC";
$VA_setup['unbanlist_results'] =		50;
$VA_setup['unbanlist_ban_type'] =		0;
$VA_setup['unbanlist_ip'] =				1;
$VA_setup['unbanlist_nick'] =			1;
$VA_setup['unbanlist_host'] =			0;
$VA_setup['unbanlist_share_size'] =		1;
$VA_setup['unbanlist_email'] =			0;
$VA_setup['unbanlist_range_fr'] =		0;
$VA_setup['unbanlist_range_to'] =		0;
$VA_setup['unbanlist_date_start'] =		1;
$VA_setup['unbanlist_date_limit'] =		1;
$VA_setup['unbanlist_date_unban'] =		1;
$VA_setup['unbanlist_ban_op'] =			1;
$VA_setup['unbanlist_unban_op'] =		1;
$VA_setup['unbanlist_ban_reason'] =		1;
$VA_setup['unbanlist_unban_reason'] =	1;
$VA_setup['file_trigger_min_class'] =	3;
$VA_setup['file_trigger_edit_class'] =	10;
$VA_setup['file_trigger_order_by'] =	"command ASC";
$VA_setup['file_trigger_results'] =		50;
$VA_setup['file_trigger_command'] =		1;
$VA_setup['file_trigger_send_as'] =		1;
$VA_setup['file_trigger_flags'] =		1;
$VA_setup['file_trigger_def'] =			1;
$VA_setup['file_trigger_minclass'] =	1;
$VA_setup['file_trigger_maxclass'] =	1;
$VA_setup['file_trigger_descr'] =		1;
$VA_setup['userlog_min_class'] =		3;
$VA_setup['userlog_results'] =			100;
$VA_setup['userlog_order_by'] =			"id DESC";
$VA_setup['userlog_id'] =				1;
$VA_setup['userlog_nick'] =				1;
$VA_setup['userlog_ip'] =				1;
$VA_setup['userlog_date'] =				1;
$VA_setup['userlog_action'] =			1;
$VA_setup['userlog_info'] =				1;
$VA_setup['messanger_min_class'] =		11;
$VA_setup['messanger_min_post_class'] =	1;
$VA_setup['messanger_order_by'] =		"date_sent DESC";
$VA_setup['messanger_results'] =		50;
$VA_setup['messanger_expires_time'] =	604800; // = 7 days
$VA_setup['messanger_sender'] =			1;
$VA_setup['messanger_date_sent'] =		1;
$VA_setup['messanger_sender_ip'] =		0;
$VA_setup['messanger_receiver'] =		0;
$VA_setup['messanger_date_expires'] =	0;
$VA_setup['messanger_subject'] =		1;
$VA_setup['messanger_body'] =			1;
$VA_setup['stats_min_class'] =			0;
$VA_setup['stats_plugin'] =				0;
$VA_setup['stats_results'] =			10;
$VA_setup['commands_min_class'] =		3;

$VA_setup['pi_plug_min_class'] =		3;
$VA_setup['pi_plug_edit_class'] =              10;
$VA_setup['pi_plug_order_by'] =		"nick ASC";
$VA_setup['pi_plug_results'] =		50;
$VA_setup['pi_plug_nick'] =		1;
$VA_setup['pi_plug_path'] =		1;
$VA_setup['pi_plug_dest'] =			1;
$VA_setup['pi_plug_detail'] =			1;
$VA_setup['pi_plug_autoload'] =			1;
$VA_setup['pi_plug_reload'] =			1;
$VA_setup['pi_plug_unload'] =			1;
$VA_setup['pi_plug_error'] =			1;
$VA_setup['pi_plug_lastload'] =			1;
$VA_setup['log_deletepi_plug'] =				0;

?>
