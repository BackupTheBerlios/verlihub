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

//Die if too curious user
IF($VA_setup['banlist_unban_class'] > USR_CLASS) {
	Die(VA_Message($err_msg_no_access, "error"));
	}

IF($_POST['register'] && $_POST['answer'] != "" && !NickExist($row['nick'], $DB_hub)) {
	//Register nick (status 1)
	//Insert into reglist
	$query  = "INSERT INTO reglist \n";
	$query .= "(nick, reg_date, reg_op, note_op) \n";
	$query .= "VALUES ('".$_POST['nick']."', UNIX_TIMESTAMP(), '".$_COOKIE['nick']."', '".$_POST['answer']."')";
	$DB_hub->Query($query);

	//Update va_unban
	$query  = "UPDATE va_unban \n";
	$query .= "SET status = 1, op = '".$_COOKIE['nick']."', time_op = UNIX_TIMESTAMP(), answer = '".$_POST['answer']."' \n";
	$query .= "WHERE nick LIKE '".$_POST['nick']."' AND ip = '".$_POST['ip']."'";
	$DB_hub->Query($query);
	Header("Location: index.php?".Change_URL_Query("q", "unban_admin"));
	}
ELSEIF($_POST['unban_ip'] && $_POST['answer'] != "" && $_POST['ip']!="_nickban_") {
	//Unban IP (status 2)
	Unban(1, $_POST['ip'], $_POST['answer']);

	//Update va_unban
	$query  = "UPDATE va_unban \n";
	$query .= "SET status = 2, op = '".$_COOKIE['nick']."', time_op = UNIX_TIMESTAMP(), answer = '".$_POST['answer']."' \n";
	$query .= "WHERE nick LIKE '".$_POST['nick']."' AND ip = '".$_POST['ip']."'";
	$DB_hub->Query($query);
	Header("Location: index.php?".Change_URL_Query("q", "unban_admin"));
	}
ELSEIF($_POST['unban_nick'] && $_POST['answer'] != "" && $_POST['nick']!="_ipban_") {
	//Unban nick (status 3)
	Unban(2, $_POST['nick'], $_POST['answer']);

	//Update va_unban
	$query  = "UPDATE va_unban \n";
	$query .= "SET status = 3, op = '".$_COOKIE['nick']."', time_op = UNIX_TIMESTAMP(), answer = '".$_POST['answer']."' \n";
	$query .= "WHERE nick LIKE '".$_POST['nick']."' AND ip = '".$_POST['ip']."'";
	$DB_hub->Query($query);
	Header("Location: index.php?".Change_URL_Query("q", "unban_admin"));
	}
ELSEIF($_POST['unban'] && $_POST['answer'] != "" && $_POST['nick']!="_ipban_" && $_POST['ip']!="_nickban_") {
	//Unban nick & IP (status 4)
	Unban(0, $_POST['ip'], $_POST['answer']);
	Unban(0, $_POST['nick'], $_POST['answer']);

	$query  = "UPDATE va_unban
				SET status = 4, op = '".USR_NICK."', time_op = UNIX_TIMESTAMP(), answer = '".$_POST['answer']."'
				WHERE nick LIKE '".$_POST['nick']."' AND ip = '".$_POST['ip']."'";
	$DB_hub->Query($query);
	Header("Location: index.php?".Change_URL_Query("q", "unban_admin"));
	}
ELSEIF($_POST['refuse'] && $_POST['answer'] != "") {
	//Refuse unban (status 5)
	$query  = "UPDATE va_unban \n";
	$query .= "SET status = 5, op = '".USR_NICK."', time_op = UNIX_TIMESTAMP(), answer = '".$_POST['answer']."' \n";
	$query .= "WHERE nick LIKE '".$_POST['nick']."' AND ip = '".$_POST['ip']."'";
	$DB_hub->Query($query);
	Header("Location: index.php?".Change_URL_Query("q", "unban_admin"));
	}
ELSEIF(!$_POST['answer'] && ($_POST['register'] || $_POST['unban_nick'] || $_POST['unban_ip'] || $_POST['unban'] || $_POST['refuse'])) {
	//No answer sent
	VA_Message($err_msg_no_answer, "error");
	}
?>



<FONT class="h2"><?Print $text_unbans;?></FONT>

<BR><BR>

<?
IF(!IsSet($_GET['page']))
	{$_GET['page'] = 1;}

$result = $DB_hub->Query("SELECT Count(nick) AS `count` FROM va_unban WHERE status = 0");
$count = $result->Fetch_Assoc();
IF($count['count']==0) Header("Location: index.php");
$pages = (int)($total / 10000 + 1);
$first = 10 * ($_GET['page'] - 1);

Print $total;

IF($pages > 1)
	{Navigation();}

$result = $DB_hub->Query("SELECT * FROM va_unban WHERE status = 0 ORDER BY time DESC");
WHILE($row = $result->Fetch_Assoc()) {
	$registered = NickExist($row['nick'], $DB_hub);

/*	IF($registered)
		{$ban_result = $DB_hub->Query("SELECT * FROM banlist WHERE nick LIKE '".$row['nick']."' AND nick NOT LIKE '_%ban_' AND (`date_limit` > UNIX_TIMESTAMP() OR `date_limit` IS NULL) ORDER BY date_start DESC");}
	ELSE
		{$ban_result = $DB_hub->Query("SELECT * FROM banlist WHERE (nick LIKE '".$row['nick']."' OR ip = '".$row['ip']."') AND (nick NOT LIKE '_%ban_' AND ip NOT LIKE '_%ban_') AND (`date_limit` > UNIX_TIMESTAMP() OR `date_limit` IS NULL) ORDER BY date_start DESC");}*/
	$query = "SELECT * FROM banlist WHERE ";
	IF($row['nick']=="_ipban_")
        $query .= "ip LIKE '".$row['ip']."'";
	ELSEIF($row['ip']=="_nickban_")
        $query .= "nick LIKE '".$row['nick']."'";
        ELSE
        $query .= "nick LIKE '".$row['nick']."' AND ip LIKE '".$row['ip']."'";
        $query .= " AND (`date_limit` > UNIX_TIMESTAMP() OR `date_limit` IS NULL) ORDER BY date_start DESC";
        $ban_result = $DB_hub->Query($query);
	IF($ban_result->num_rows > 0) {

?>		<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
		<INPUT name="nick" type="hidden" value="<?Print $row['nick'];?>">
		<INPUT name="ip" type="hidden" value="<?Print $row['ip'];?>">
		<TABLE align="center" class="fs10px b1 w100pr">
			<TR>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_nick;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light">&nbsp;&nbsp;<?IF($row['nick']=="_ipban_") Print $text_ip_ban; ELSE Print HTMLSpecialChars($row['nick']);?>&nbsp;&nbsp;</TD>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_ip;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light">&nbsp;&nbsp;<?IF($row['ip']=="_nickban_") Print $text_nick_ban; ELSE Print $row['ip'];?>&nbsp;&nbsp;</TD>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_time;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light">&nbsp;&nbsp;<?Print Date($VA_setup['timedate_format'], $row['time']);?>&nbsp;&nbsp;</TD>
			</TR><TR>
				<TD class="bg_light b top right">&nbsp;&nbsp;<?Print $text_comment;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light top" colspan=5>&nbsp;&nbsp;<?Print nl2br(HTMLSpecialChars($row['comment']));?>&nbsp;&nbsp;</TD>
			</TR>
<?		WHILE($ban = $ban_result->Fetch_Assoc()) {
?>
			<TR>
				<TD colspan=6 class="bg_light center b">
<?					IF($row['nick']!="_ipban_" AND $row['ip']!="_nickban_") {
						$ban_type = 0;
						Print $text_nick_ip_ban;
						}
					ELSEIF($row['nick'] == "_ipban_") {
						$ban_type = 1;
						Print $text_ip_ban;
						}
					ELSEIF($row['ip'] == "_nickban_") {
						$ban_type = 2;
						Print $text_nick_ban;
                                                }
?>				</TD>
			</TR><TR>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_nick;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light<?IF($ban_type != 1){Print " red";}?>">&nbsp;&nbsp;<?IF($ban['nick']=="_ipban_") Print $text_ip_ban; ELSE Print HTMLSpecialChars($ban['nick']);?>&nbsp;&nbsp;</TD>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_ip;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light<?IF($ban_type != 2){Print " red";}?>">&nbsp;&nbsp;<?IF($ban['ip']=="_nickban_") Print $text_nick_ban; ELSE Print $ban['ip'];?>&nbsp;&nbsp;</TD>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_date_start;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light">&nbsp;&nbsp;<?Print Date($VA_setup['timedate_format'], $ban['date_start']);?>&nbsp;&nbsp;</TD>
			</TR><TR>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_op;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light">&nbsp;&nbsp;<?Print HTMLSpecialChars($ban['nick_op']);?>&nbsp;&nbsp;</TD>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_share_size;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light">&nbsp;&nbsp;<?Print RoundShare($ban['share_size'])." (".Number_Format($ban['share_size']);?> B)&nbsp;&nbsp;</TD>
				<TD class="bg_light b right">&nbsp;&nbsp;<?Print $text_date_limit;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light">&nbsp;&nbsp;<?Print Date($VA_setup['timedate_format'], $ban['date_limit']);?>&nbsp;&nbsp;</TD>
			</TR><TR>
				<TD class="bg_light b top right">&nbsp;&nbsp;<?Print $text_reason;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light top" colspan=5>&nbsp;&nbsp;<?Print nl2br(HTMLSpecialChars($ban['reason']));?>&nbsp;&nbsp;</TD>
			</TR>
<?			}?>
			<TR>
				<TD class="b bg_light right top">&nbsp;&nbsp;<?Print $text_answer;?>&nbsp;:&nbsp;</TD>
				<TD class="bg_light" colspan=5>
					<TEXTAREA class="w100pr" name="answer" rows=<?IF($_COOKIE['brwsr_tp'] == "Mozilla"){Print 1;} ELSE{Print 2;}?>></TEXTAREA>
				</TD>
			</TR><TR>
				<TD class="bg_light right" colspan=6>
					<?IF(!$registered){?><INPUT type="submit" name="register" value="<?Print $text_register_nick;?>"><?}?>
					<?IF($row['nick']!="_ipban_"){?><INPUT type="submit" name="unban_nick" value="<?Print $text_unban." ".$text_nick;?>"><?}?>
					<?IF($row['ip']!="_nickban_"){?><INPUT type="submit" name="unban_ip" value="<?Print $text_unban." ".$text_ip;?>"><?}?>
					<?IF($row['nick']!="_ipban_" and $row['ip']!="_nickban_"){?><INPUT type="submit" name="unban" value="<?Print $text_unban." ".$text_ip." & ".$text_nick;?>"><?}?>
					<INPUT type="submit" name="refuse" value="<?Print $text_refuse;?>">
				</TD>
			</TR>
		</TABLE>
		</FORM>
<?		}
	}

IF($pages > 1)
	{Navigation();}
?>
