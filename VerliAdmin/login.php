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
<FONT class="h2"><?Print $text_login;?></FONT>

<BR><BR>

<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE align="center" class="fs10px b1">
	<TR>
		<TD class="b right bg_light">&nbsp;&nbsp;<?Print $text_nick;?> :&nbsp;&nbsp;</TD>
		<TD class="bg_light"><INPUT class="w160px" name="nick" type="text" value="<?IF(IsSet($_POST['nick'])){Print $_POST['nick'];}?>">
	</TR><TR>
		<TD class="b right bg_light">&nbsp;&nbsp;<?Print $text_password;?> :&nbsp;&nbsp;</TD>
		<TD class="bg_light"><INPUT class="w160px" name="password" type="password"></TD>
	</TR><TR>
		<TD class="right bg_light" colspan=2><INPUT class="w75px" type="submit" value="<?Print $text_login;?>"></TD>
	</TR>
</TABLE>
</FORM>