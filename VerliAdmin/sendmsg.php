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

IF($_POST['submit'])
	{//Submitted add / edit reg user
	IF(USR_CLASS >= 1)
		{$_POST['sender'] = USR_NICK;}
	
	IF($_POST['subject'] != "")
		{
		IF($_POST['body'] != "")
			{
			IF($_POST['receiver'] != "")
				{
				IF($_POST['sender'] != "")
					{
					IF(!USR_CLASS)
						{
						IF(NickExist($_POST['sender'],$DB_hub)) {
							Die(VA_Message($err_msg_guest_sending_as_reg, "error"));
							}
						}
					$time = Time();
					$expires = $time + $VA_setup['messanger_expire_time'];
					$_POST['sender'] = $DB_hub->Real_Escape_String($_POST['sender']);
					$_POST['receiver'] = $DB_hub->Real_Escape_String($_POST['receiver']);
					$_POST['subject'] = $DB_hub->Real_Escape_String($_POST['subject']);
					$_POST['body'] = $DB_hub->Real_Escape_String($_POST['body']);
					
					$query  = "INSERT INTO pi_messages \n";
					$query .= "(sender, date_sent, sender_ip, receiver, date_expires, subject, body) \n";
					$query .= "VALUES ('".$_POST['sender']."', '".$time."', '".$_SERVER['REMOTE_ADDR']."', '".$_POST['receiver']."', '".$expires."', '".$_POST['subject']."', '".$_POST['body']."')";
					$DB_hub->Query($query);
					}
				ELSE
					{VA_Message($err_msg_enter_nick, "warning");}
				}
			ELSE
				{VA_Message($err_msg_enter_receiver, "warning");}
			}
		ELSE
			{VA_Message($err_msg_enter_body, "warning");}
		}
	ELSE
		{VA_Message($err_msg_enter_subject, "warning");}

	StoreQueries();

	//Return to messanger
	Header("Location: index.php?".Change_URL_Query("q", "messanger"));
	}
?>
	
<FONT class="h2"><?Print $text_send_message;?></FONT>

<BR><BR>

<?
IF($VA_setup['messanger_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_GET['receiver'])
	{$_POST['receiver'] = $_GET['receiver'];}
?>

<FORM action="index.php?<?Print Change_URL_Query("receiver", "");?>" method="post">
<TABLE class="fs9px b1">
	<TR>
		<TD class="bg_light b"><?Print $text_sender;?> : </TD>
		<TD class="bg_light b">
			<?IF(USR_CLASS == 0)
				{?><INPUT class="w300px" name="sender" type="text" value="<?Print $_POST['sender'];?>"><?}
			ELSE
				{Print $_COOKIE['nick'];}?>
		</TD>
	</TR><TR>
		<TD class="bg_light b right"><?Print $text_receiver;?> : </TD>
		<TD class="bg_light b"><INPUT class="w300px" name="receiver" type="text" value="<?Print $_POST['receiver'];?>"></TD>
	</TR><TR>
		<TD class="bg_light b right"><?Print $text_subject;?> : </TD>
		<TD class="bg_light b"><INPUT class="w300px" name="subject" type="text" value="<?Print $_POST['subject'];?>"></TD>
	</TD><TR>
		<TD class="bg_light b right top"><?Print $text_body?> : </TD>
		<TD class="bg_light b"><TEXTAREA class="w300px" name="body" rows=8><?Print $_POST['body']?></TEXTAREA></TD>
	</TR><TR>
		<TD class="bg_light right" colspan=2>
			<INPUT class="w75px" type="reset" value="<?Print $text_reset;?>">
			<INPUT class="w75px" name="submit" type="submit" value="<?Print $text_send;?>">
		</TD>
	</TR>
</TABLE>
</FORM>
