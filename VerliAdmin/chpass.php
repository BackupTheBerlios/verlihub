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

<FONT class="h2"><?Print $text_change_password;?></FONT>

<BR><BR>

<FORM action="index.php" method="post">
<INPUT name="pwd_change" type="hidden" value=1>
<TABLE align="center" class="fs9px b1">
	<TR>
		<TD class="b right bg_light">&nbsp;&nbsp;<?Print $text_nick;?> :&nbsp;&nbsp;</TD>
		<TD class="bg_light"><INPUT class="w160px" name="nick" type="text" value="<?Print $_POST['nick'];?>">
	</TR><TR>
		<TD class="b right bg_light">&nbsp;&nbsp;<?Print $text_password;?> :&nbsp;&nbsp;</TD>
		<TD class="bg_light"><INPUT class="w160px" name="password" type="password"></TD>
	</TR><TR>
		<TD class="b right bg_light">&nbsp;&nbsp;<?Print $text_password_confirm;?> :&nbsp;&nbsp;</TD>
		<TD class="bg_light"><INPUT class="w160px" name="password2" type="password"></TD>
	</TR><TR>
		<TD class="b right bg_light"><LABEL for="crypted2">&nbsp;&nbsp;<?Print $text_md5_hash;?></LABEL> :&nbsp;&nbsp;</TD>
		<TD class="bg_light"><INPUT name="crypted" id="crypted2" type="radio" class="b0" value=2></TD>
	</TR><TR>
		<TD class="b right bg_light"><LABEL for="crypted1">&nbsp;&nbsp;<?Print $text_crypted;?></LABEL> :&nbsp;&nbsp;</TD>
		<TD class="bg_light"><INPUT name="crypted" id="crypted1" type="radio" class="b0" value=1 checked></TD>
	</TR><TR>
		<TD class="b right bg_light"><LABEL for="crypted0">&nbsp;&nbsp;<?Print $text_plain;?></LABEL> :&nbsp;&nbsp;</TD>
		<TD class="bg_light"><INPUT name="crypted" id="crypted0" type="radio" class="b0" value=0></TD>
	</TR><TR>
		<TD class="right bg_light" colspan=2>
			<INPUT class="w75px" type="reset" value="<?Print $text_reset;?>">
			<INPUT class="w75px" name="ch_pwd_only" type="submit" value="<?Print $text_change_password;?>">
			<INPUT class="w75px" type="submit" value="<?Print $text_login;?>">
		</TD>
	</TR>
</TABLE>
</FORM>