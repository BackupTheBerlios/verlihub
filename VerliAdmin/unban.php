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

IF($VA_setup['banlist_unban_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['unban_reason'] != "" && $_POST['unban'])
	{

	$result = $DB_hub->Query("SELECT * FROM banlist WHERE ip='".$_POST['ip']."' AND nick='".$_POST['nick']."' AND date_start='".$_POST['date_start']."'");
	IF($result->num_rows == 1)
		{
		$row = $result->Fetch_Assoc();
		$DB_hub->Query("INSERT INTO unbanlist (ban_type, ip, nick, host, share_size, email, range_fr, range_to, date_start, date_limit, date_unban, nick_op, unban_op, reason, unban_reason) VALUES ('".$row['ban_type']."', '".$row['ip']."', '".$row['nick']."', '".$row['host']."', '".$row['share_size']."', '".$row['email']."', '".$row['range_fr']."', '".$row['range_to']."', '".$row['date_start']."', '".$row['date_limit']."', ".Time().", '".$row['nick_op']."', '".$_COOKIE['nick']."', '".$row['reason']."', '".$_POST['unban_reason']."')");
		$DB_hub->Query("DELETE FROM banlist WHERE ip='".$row['ip']."' AND nick='".$row['nick']."' AND date_start='".$row['date_start']."'");

		IF($_POST['send_email'] && $_POST['email'] != "")
			{
			$message =  "HUB name : ".$VH_setup['hub_name']."\r\n";
			$message .= "HUB host : ".$VH_setup['hub_host'].":".$VH_setup['listen_port']."\r\n";
			$message .= "Your IP : ".$_POST['ip']."\r\n";
			$message .= "Your nick : ".$_POST['nick']."\r\n";
			$message .= "You has been unbanned by ".USR_NICK."\r\n";
			$message .= "\r\n";
			$message .= "BAN reason :\r\n";
			$message .= $row['reason']."\r\n";
			$message .= "\r\n";
			$message .= "Unban reason :\r\n";
			$message .= $_POST['unban_reason']."\r\n";
			$message .= "\r\n";
			$message .= "IF this IP or nick isn`t your, somebody used your e-mail on Direct Connect. We are sorry for that.\r\n";
			$message .= "\r\n";
			$message .= "Please do not respond to this message.";

			$headers = "X-mailer: VerliAdmin ".VA_VERSION." by bohyn";

//			Print $message;
//			Print "\r\n\r\n".$headers;
			@Mail($_POST['email'], "Unban notification", $message, $headers);
			}

		IF($VA_setup['log_unban'])
			{
			$action = "Unbaned user ".$_POST['nick']." IP:".$_POST['ip']." with reason: ".$_POST['unban_reason'];
			LogFile(USR_NICK, USR_CLASS, $action, "unban");
			}
		}
	StoreQueries();
	Header("Location: index.php?".Change_URL_Query("q", "banlist"));
	Die();
	}
ELSEIF($_POST['unban'])
	{VA_Message($err_msg_no_unban_reason, "warning");}?>

<FONT class="h2"><?Print $text_unban;?></FONT>

<BR><BR>

<FORM action="index.php?<?Print Change_URL_Query("q", "unban");?>" method="post">
<INPUT name="nick" type="hidden" value="<?Print $_POST['nick'];?>">
<INPUT name="ip" type="hidden" value="<?Print $_POST['ip'];?>">
<INPUT name="date_start" type="hidden" value="<?Print $_POST['date_start'];?>">
<TABLE class="fs9px b1">
	<TR>
		<TD align="right" class="b bg_light"><?Print $text_send_notification;?> : </TD>
		<TD class="bg_light">
<?			$_POST['email'] = EregI_Replace("_at_|\.at\.|-at-", "@", $_POST['email']);
			$_POST['email'] = EregI_Replace("_dot_|\.dot\.|-dot-", ".", $_POST['email']);
			IF(ValidateEmail($_POST['email']))
				{$_POST['send_email'] = 1;}?>
			<INPUT name="send_email" type="checkbox" value=1<?IF($_POST['send_email']){Print " checked";} IF($_COOKIE['brwsr_tp'] != "Opera"){Print " class=\"b0\"";}?>>
			<INPUT name="email" type="text" size=36 value="<?Print $_POST['email'];?>">
		</TD>
	</TR><TR>
		<TD align="right" valign="top" class="b bg_light"><?Print $text_unban_reason;?> : </TD>
		<TD class="bg_light"><TEXTAREA name="unban_reason" cols=40 rows=5></TEXTAREA></TD>
	</TR><TR>
		<TD colspan=2 align="right" class="bg_light">
			<INPUT class="b w75px" type="reset" value="<?Print $text_reset;?>">
			<INPUT class="b w75px" name="unban" type="submit" value="<?Print $text_send;?>">
		</TD>
	</TR>
</TABLE>
</FORM>
