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

<TABLE class="b1 fs9px">
	<TR>
		<TD class="bg_light" nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_nick."</FONT> : ".$user['nick'];?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_pwd_crypt."</FONT> : "; IF($user['pwd_crypt'] == 1){Print $text_crypted;}ELSEIF($user['pwd_crypt'] == 2){Print $text_md5_hash;}ELSE{Print $text_noncrypted;}?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_pwd_set."</FONT> : "; IF($user['login_pwd']){Print $text_yes;}ELSE{Print $text_no;}?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_class."</FONT> : ".GetClassName($user['class'])." (".$user['class'].")";?>&nbsp;&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light" colspan=2 nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_login_last."</FONT> : ".Date($VA_setup['timedate_format'], $user['login_last']);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=2 nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_login_ip."</FONT> : ".$user['login_ip'];?>&nbsp;&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light" colspan=2 nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_error_last."</FONT> : ".Date($VA_setup['timedate_format'], $user['error_last']);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=2 nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_error_ip."</FONT> : ".$user['error_ip'];?>&nbsp;&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light" colspan=2 nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_reg_date."</FONT> : ".Date($VA_setup['timedate_format'], $user['reg_date']);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=2 nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_reg_op."</FONT> : ".$user['reg_op'];?>&nbsp;&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light" nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_login_cnt."</FONT> : ".$user['login_cnt'];?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_error_cnt."</FONT> : ".$user['error_cnt'];?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_class_protect."</FONT> : ".$user['class_protect'];?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" nowrap>&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light" colspan=4 nowrap>&nbsp;&nbsp;<?Print "<FONT class=\"b\">".$text_hide_keys."</FONT> : ";IF($user['hide_keys']){Print $text_yes;} ELSE{Print $text_no;}?>&nbsp;&nbsp;</TD>
	</TR>
</TABLE>

<BR>