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

<FONT class="h2"><?Print $text_help;?></FONT>

<BR><BR>

<TABLE class="b1 fs9px">
	<TR>
		<TD class="bg_light b" nowrap><?Print $text_command;?></TD>
		<TD class="bg_light b" nowrap><?Print $text_shortcut;?></TD>
		<TD class="bg_light b" nowrap><?Print $text_parametrs;?></TD>
		<TD class="bg_light b" nowrap><?Print $text_class;?></TD>
		<TD class="bg_light b" nowrap><?Print $text_help;?></TD>
		<TD class="bg_light b" nowrap>VH</TD>
		<TD class="bg_light b" nowrap>VA</TD>
	</TR><TR>
		<TD class="bg_light" nowrap>+kick</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">1</TD>
		<TD class="bg_light"><?Print $text_cmd_pkick_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>+me</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;message&gt;</TD>
		<TD class="bg_light right">0</TD>
		<TD class="bg_light"><?Print $text_cmd_me_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>+motd</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">0</TD>
		<TD class="bg_light"><?Print $text_cmd_motd_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>+myinfo</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">0</TD>
		<TD class="bg_light"><?Print $text_cmd_myinfo_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>+myip</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">0</TD>
		<TD class="bg_light"><?Print $text_cmd_myip_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>+passwd</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;password&gt;</TD>
		<TD class="bg_light right">1</TD>
		<TD class="bg_light"><?Print $text_cmd_passwd_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>+regme</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>[&lt;message&gt;]</TD>
		<TD class="bg_light right">0</TD>
		<TD class="bg_light"><?Print $text_cmd_regme_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>+report</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;[ &lt;message&gt;]</TD>
		<TD class="bg_light right">0</TD>
		<TD class="bg_light"><?Print $text_cmd_report_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_info_cmds;?></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!getinfo</TD>
		<TD class="bg_light" nowrap>!gn</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_getinfo_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!getip</TD>
		<TD class="bg_light" nowrap>!gi</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_getip_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!gethost</TD>
		<TD class="bg_light" nowrap>!gh</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_gethost_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!whoip</TD>
		<TD class="bg_light" nowrap>!wip</TD>
		<TD class="bg_light" nowrap>&lt;ip&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_wip_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!whorange</TD>
		<TD class="bg_light" nowrap>!wrange</TD>
		<TD class="bg_light" nowrap>&lt;ip_min&gt;..&lt;ip_max&gt;<BR>&lt;ip&gt;/&lt;bitmask&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_wrange_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!infoban</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick/ip&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_infoban_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!reginfo</TD>
		<TD class="bg_light" nowrap>!rinfo</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_rinfo_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_ban_cmds;?></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!kick</TD>
		<TD class="bg_light" nowrap>!ki</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_kick_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!hidekick</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_hidekick_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!ban</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;ip&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_ban_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!bantemp</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;ip&gt; &lt;time&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_bantemp_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!bannick</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_bannick_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banip</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;ip&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banip_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banhost1</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banhost1_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banhost2</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banhost2_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banhost3</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banhost3_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banhostr1</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banhostr1_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banprefix</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;prefix&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banprefix_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banshare</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;share&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banshare_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banemail</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;email&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banemail_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!banrange</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;ipmin&gt;..&lt;ipmax&gt; &lt;reason&gt;<BR>&lt;ip&gt;/&lt;bitmask&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_banrange_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!drop</TD>
		<TD class="bg_light" nowrap>!dr</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_drop_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!infoban</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick/ip&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_infoban_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_unban_cmds;?></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unban</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick/ip&gt; &lt;unban_reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unban_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbannick</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;unban_reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbannick_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanip</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;ip&gt; &lt;unban_reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanip_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanhost1</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanhost1_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanhost2</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanhost2_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanhost3</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanhost3_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanhostr1</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanhostr1_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanprefix</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;prefix&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanprefix_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanshare</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;share&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanshare_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanemail</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;email&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanemail_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unbanrange</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;ip&gt; &lt;reason&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_unbanrange_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_reg_cmds;?></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regnew</TD>
		<TD class="bg_light" nowrap>!rnew</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;[ &lt;class&gt;]</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_rnew_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regclass</TD>
		<TD class="bg_light" nowrap>!rclass</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;class&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_rclass_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regpasswd</TD>
		<TD class="bg_light" nowrap>!rpass</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;[ &lt;password&gt;]</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_rpasswd_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regdel</TD>
		<TD class="bg_light" nowrap>!rdel, !rd</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_rdel_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regdisable</TD>
		<TD class="bg_light" nowrap>!r0</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_rdisable_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regenable</TD>
		<TD class="bg_light" nowrap>!r1</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_renable_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!reginfo</TD>
		<TD class="bg_light" nowrap>!rinfo</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">3</TD>
		<TD class="bg_light"><?Print $text_cmd_rinfo_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regprotect</TD>
		<TD class="bg_light" nowrap>!rprotect</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;class&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_rprotect_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!reghidekick</TD>
		<TD class="bg_light" nowrap>!rhidekick</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_rhidekick_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regset</TD>
		<TD class="bg_light" nowrap>!r=</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;variable&gt; &lt;value&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_rset_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!class</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;[ &lt;class&gt;]</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_class_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protect</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;[ &lt;class&gt;]</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_protect_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_gag_cmds;?></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!nochat</TD>
		<TD class="bg_light" nowrap>!gag</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_gag_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!nosearch</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_nosearch_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!nopm</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_nopm_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!noctm</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_noctm_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_setup_cmds;?></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!getconfig</TD>
		<TD class="bg_light" nowrap>!gc</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_gc_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!set</TD>
		<TD class="bg_light" nowrap>!=</TD>
		<TD class="bg_light" nowrap>&lt;variable&gt; &lt;value&gt;</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_set_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!vaset</TD>
		<TD class="bg_light" nowrap>!va=</TD>
		<TD class="bg_light" nowrap>&lt;variable&gt; &lt;value&gt;</TD>
		<TD class="bg_light right"><?Print $VA_setup['setuplist_edit_class'];?></TD>
		<TD class="bg_light"><?Print $text_cmd_vaset_help;?><BR></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!userlimit</TD>
		<TD class="bg_light" nowrap>!ul</TD>
		<TD class="bg_light" nowrap>&lt;userlimit&gt;[ &lt;time&gt;]</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_userlimit_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!reload</TD>
		<TD class="bg_light" nowrap>!re</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_reload_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!hublist</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">10</TD>
		<TD class="bg_light"><?Print $text_cmd_hublist_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!plugin</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;plugin&gt;</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_plugin_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!plugout</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;plugin&gt;</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_plugout_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!pluglist</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>all</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_pluglist_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!plugreload</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;plugin&gt;</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_plugreload_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_proto_cmds;?></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protoall_hubname</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;hub_name&gt;</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protoall_hubname_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protoall_hello</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protoall_hello_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protoall_quit</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protoall_quit_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protoall_pm</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;message&gt;</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protoall_pm_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protoall_chat</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;message&gt;</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protoall_chat_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protoall_redir</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;host/ip&gt;</TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protoall_redir_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protoall_any</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protoall_any_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protoactive_*</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protoactive_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protohello_*</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protohello_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!protouser_*</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">5</TD>
		<TD class="bg_light"><?Print $text_cmd_protouser_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_other_cmds;?></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!broadcast</TD>
		<TD class="bg_light" nowrap>!bc</TD>
		<TD class="bg_light" nowrap>&lt;message&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_broadcast_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!ccbroadcast</TD>
		<TD class="bg_light" nowrap>!ccbc</TD>
		<TD class="bg_light" nowrap>&lt;:cc:&gt; &lt;message&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_ccbroadcast_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!regs</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;message&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_regs_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!ops</TD>
		<TD class="bg_light" nowrap>!oc</TD>
		<TD class="bg_light" nowrap>&lt;message&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_ops_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!flood</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;message&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_flood_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!hideme</TD>
		<TD class="bg_light" nowrap>!hm</TD>
		<TD class="bg_light" nowrap>&lt;class&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_hideme_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!hidekick</TD>
		<TD class="bg_light" nowrap>!hk</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt; &lt;class&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_hidekick_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!unhidekick</TD>
		<TD class="bg_light" nowrap>!uhk</TD>
		<TD class="bg_light" nowrap>&lt;nick&gt;</TD>
		<TD class="bg_light right">4</TD>
		<TD class="bg_light"><?Print $text_cmd_unhidekick_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!logout</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">1</TD>
		<TD class="bg_light"><?Print $text_cmd_logout_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light" nowrap>!quit</TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light" nowrap></TD>
		<TD class="bg_light right">10</TD>
		<TD class="bg_light"><?Print $text_cmd_quit_help;?></TD>
		<TD class="bg_light b" nowrap><IMG src="img/checked.gif" width=13 height=13></TD>
		<TD class="bg_light b" nowrap><IMG src="img/nochecked.gif" width=13 height=13></TD>
	</TR><TR>
		<TD class="bg_light b" nowrap><?Print $text_command;?></TD>
		<TD class="bg_light b" nowrap><?Print $text_shortcut;?></TD>
		<TD class="bg_light b" nowrap><?Print $text_parametrs;?></TD>
		<TD class="bg_light b" nowrap><?Print $text_class;?></TD>
		<TD class="bg_light b" nowrap><?Print $text_help;?></TD>
		<TD class="bg_light b" nowrap>VH</TD>
		<TD class="bg_light b" nowrap>VA</TD>
	</TR>
</TABLE>
