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

<FONT class="h2"><?Print $text_unban_request;?></FONT>

<BR><BR>

<?
IF(IsSet($_POST['delete'])) {
	$query  = "DELETE FROM va_unban
				WHERE nick LIKE '".$_POST['nick']."' AND ip = '".$_POST['ip']."'";
	$DB_hub->Query($query);
	Header("Location: index.php?q=bantest");
	Die();
	}

IF($_POST['send'] && $_POST['comment']) {
	$DB_hub->Query("INSERT ignore INTO va_unban (ip, nick, email, comment, time) VALUES ('".$_GET['ip']."', '".$_GET['nick']."', '".$_POST['email']."', '".$_POST['comment']."', UNIX_TIMESTAMP())");
	VA_Alert($text_unban_inserted, "info32", "index.php?".$_SERVER['QUERY_STRING']);
	RETURN TRUE;
	}

//	Taulka banu
IF(NickExist($_GET['nick'], $DB_hub))
	$result = $DB_hub->Query("SELECT * FROM banlist WHERE nick LIKE '".$_GET['nick']."'");
ELSE
	$result = $DB_hub->Query("SELECT * FROM banlist WHERE nick LIKE '".$_GET['nick']."' OR ip = '".$_GET['ip']."'");

IF($result->num_rows) {?>
	<TABLE class="b1 fs10px">
<?	WHILE($ban = $result->Fetch_Assoc()) {?>
		<TR>
			<TD colspan=6 class="bg_light center b">
<?				IF(StrToLower($_GET['nick']) == StrToLower($ban['nick']) && $_GET['ip'] == $ban['ip']) {
					$ban_type = 0;
					Print $text_nick_ip_ban;
					}
				ELSEIF($row['ip'] == $ban['ip']) {
					$ban_type = 1;
					Print $text_ip_ban;
					}
				ELSE {
					$ban_type = 2;
					Print $text_nick_ban;
					}
?>			</TD>
		</TR><TR>
			<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_nick;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light<?IF($ban_type != 1){Print " red";}?>">&nbsp;&nbsp;<?Print HTMLSpecialChars($ban['nick']);?>&nbsp;&nbsp;</TD>
			<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_date_start;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print Date($VA_setup['timedate_format'], $ban['date_start']);?>&nbsp;&nbsp;</TD>
			<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_share_size;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print RoundShare($ban['share_size'])." (".Number_Format($ban['share_size']);?> B)&nbsp;&nbsp;</TD>
		</TR><TR>
			<TD class="bg_light b right<?IF($ban_type != 2){Print " red";}?>">&nbsp;&nbsp;<?Print $text_ip;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print HTMLSpecialChars($ban['ip']);?>&nbsp;&nbsp;</TD>
			<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_date_limit;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print Date($VA_setup['timedate_format'], $ban['date_limit']);?>&nbsp;&nbsp;</TD>
			<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_remaining;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print UpTime($ban['date_limit'] - Time());?>&nbsp;&nbsp;</TD>
		</TR><TR>
			<TD class="bg_light b top right">&nbsp;&nbsp;<?Print $text_reason;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light top" colspan=5>&nbsp;&nbsp;<?Print nl2br(HTMLSpecialChars($ban['reason']));?>&nbsp;&nbsp;</TD>
		</TR>
<?		}?>
	</TABLE>
	<BR>
<?	}
$result->Free_Result();

//	Pozadavek unbanu
$request = $DB_hub->Query("SELECT * FROM va_unban WHERE nick LIKE '".$_GET['nick']."' AND ip = '".$_GET['ip']."'");
IF($request->num_rows) {
	$row = $request->Fetch_Assoc();
	$row['nick'] = HTMLSpecialChars($row['nick']);
	$row['answer'] = nl2br(HTMLSpecialChars($row['answer']));
	$row['comment'] = nl2br(HTMLSpecialChars($row['comment']));
	?>
	<TABLE class="b1 fs10px">
		<TR>
			<TD class="b bg_light center" colspan=8><?Print $text_unban_request;?></TD>
		</TR><TR>
			<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_status;?>&nbsp;:&nbsp;&nbsp;</TD>
			<TD class="bg_light">
				&nbsp;&nbsp;
<?				IF($row['status'] == 0) {Print $text_pending;}
				ELSEIF($row['status'] == 1) {Print $text_registered;}
				ELSEIF($row['status'] == 5) {Print $text_refused;}
				ELSE {Print $text_unbanned;}?>
				&nbsp;&nbsp;</TD>
			<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_nick;?>&nbsp;:&nbsp;&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print $row['nick'];?>&nbsp;&nbsp;</TD>
			<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_ip;?>&nbsp;:&nbsp;&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print $row['ip'];?>&nbsp;&nbsp;</TD>
			<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_date;?>&nbsp;:&nbsp;&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print Date($VA_setup['timedate_format'], $row['time']);?>&nbsp;&nbsp;</TD>
		</TR><TR>
			<TD class="b bg_light right top">&nbsp;&nbsp;<?Print $text_comment;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light" colspan=7>&nbsp;&nbsp;<?Print $row['comment'];?>&nbsp;&nbsp;</TD>
		</TR><TR>
			<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_answer;?>&nbsp;:&nbsp;</TD>
			<TD class="bg_light" colspan=7>&nbsp;&nbsp;<?Print nl2br(HTMLSpecialChars($row['answer']));?>&nbsp;&nbsp;</TD>
		</TR><TR>
			<TD class="bg_light right" colspan=8><INPUT class="w75px" name="delete" type="submit" value="<?Print $text_delete;?>"></TEXTAREA></TD>
		</TR>
	</TABLE>
<?	}
ELSE {
//        Unban request form
?>
	<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
	<TABLE class="b1 fs10px">
		<TR>
			<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_nick;?>&nbsp;&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print $_GET['nick'];?>&nbsp;&nbsp;</TD>
		</TR><TR>
			<TD class="b bg_light right">&nbsp;&nbsp;<?Print $text_ip;?>&nbsp;&nbsp;</TD>
			<TD class="bg_light">&nbsp;&nbsp;<?Print $_GET['ip'];?>&nbsp;&nbsp;</TD>
		</TR><TR>
			<TD class="b bg_light right top">&nbsp;&nbsp;<?Print $text_comment;?>&nbsp;&nbsp;</TD>
			<TD class="bg_light"><TEXTAREA class="w300px" name="comment" rows=3></TEXTAREA></TD>
		</TR><TR>
			<TD class="bg_light right" colspan=2><INPUT name="send" class="w75px" type="submit" value="<?Print $text_send;?>"></TEXTAREA></TD>
		</TR>
	</TABLE>
	</FORM>
<?	}?>
