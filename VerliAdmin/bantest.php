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

//status 0 = waiting
//status 1 = registered
//status 2 = unbanned IP
//status 3 = unbanned nick
//status 4 = unbanned IP & nick
//status 5 = refused
?>

<FONT class="h2"><?Print $text_ban_test;?></FONT>

<BR><BR>


<?
IF($_GET['nick'] && ValidateIP($_GET['ip'])) {
	IF(NickExist($_GET['nick'], $DB_hub))
		$result = $DB_hub->Query("SELECT ip FROM banlist WHERE ip LIKE '".$_GET['ip']."'");
	ELSE
		$result = $DB_hub->Query("SELECT nick FROM banlist WHERE ip LIKE '".$_GET['ip']."' OR nick LIKE '".$_GET['nick']."'");

	IF($result->num_rows) {
		StoreQueries($DB_hub);
		Header("Location: index.php?".Change_URL_Query("q", "unban_request"));
		Die();
		}
	ELSE
		VA_Message($text_banfree, "info32");

	RETURN TRUE;
	}
?>


<FORM action="index.php" method="get">
<INPUT name="q" type="hidden" value="bantest">
<TABLE class="b1 fs10px">
	<TR>
		<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_nick;?>&nbsp;:&nbsp;&nbsp;</TD>
		<TD class="b bg_light"><INPUT class="w160px" name="nick" type="text" value="<?IF(Defined("USER_NICK")){Print USER_NICK;} ELSE{Print $_GET['nick'];}?>"></TD>
	</TR><TR>
		<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_ip;?>&nbsp;:&nbsp;&nbsp;</TD>
		<TD class="b bg_light"><INPUT class="w160px" name="ip" type="text" value="<?IF($_GET['ip']){Print $_GET['ip'];} ELSE{Print $_SERVER['REMOTE_ADDR'];}?>"></TD>
	</TR><TR>
		<TD class="b bg_light right" colspan=2><INPUT class="w75px" type="submit" value="<?Print $text_check;?>"></TD>
	</TR>
</TABLE>
</FORM>
