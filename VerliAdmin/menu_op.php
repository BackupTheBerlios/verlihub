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
?>

<TABLE align="center" class="b0 header">
	<TR>
		<?IF($VA_setup['reglist_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=reglist" class="reglist" title="<?Print $text_reglist;?>"><?Print $text_reglist;?></A></TD><?}
		IF($VA_setup['kicklist_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=kicklist&filter_active=1&filter=<?Print $_GET['filter'];?>" class="kicklist" title="<?Print $text_kicklist;?>"><?Print $text_kicklist;?></A></TD><?}
		IF($VA_setup['banlist_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=banlist&filter_active=1&filter=<?Print $_GET['filter'];?>" class="banlist" title="<?Print $text_banlist;?>"><?Print $text_banlist;?></A></TD><?}
		IF($VA_setup['unbanlist_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=unbanlist&filter_active=1&filter=<?Print $_GET['filter'];?>" class="unbanlist" title="<?Print $text_unbanlist;?>"><?Print $text_unbanlist;?></A></TD><?}
		IF($VA_setup['setuplist_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=setuplist&filter_file=VA_config" class="setuplist" title="<?Print $text_setuplist;?>"><?Print $text_setuplist;?></A></TD><?}
		IF($VA_setup['file_trigger_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=file_trigger" class="trigger" title="<?Print $text_file_trigger;?>"><?Print $text_file_trigger;?></A></TD><?}
		IF($VA_setup['userlog_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=userlog" class="userlog" title="<?Print $text_userlog;?>"><?Print $text_userlog;?></A></TD><?}
		IF($VA_setup['commands_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=commands" class="commands" title="<?Print $text_commands;?>"><?Print $text_commands;?></A></TD><?}
		IF($VA_setup['pi_plug_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=pi_plug" class="pi_plug" title="<?Print $text_pi_plug;?>"><?Print $text_pi_plug;?></A></TD><?}?>
	</TR>
</TABLE>
