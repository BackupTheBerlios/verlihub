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

IF($_POST['submit']) {
	//Add / edit trigger

	IF($VA_setup['pi_chatroom_edit_class'] > USR_CLASS) {
		Die(VA_Message($err_msg_no_access));
		}

	$_POST['nick'] = $DB_hub->Real_Escape_String($_POST['nick']);
	$_POST['topic'] = $DB_hub->Real_Escape_String($_POST['topic']);
	$_POST['creator'] = $DB_hub->Real_Escape_String($_POST['creator']);

	$query  = "REPLACE INTO pi_chatroom \n";
	$query .= "(nick, topic, creator, min_class, auto_class_min, auto_class_max, auto_cc) \n";
	$query .= "VALUES ('".$_POST['nick']."', '".$_POST['topic']."', '".$_POST['creator']."', '".$_POST['min_class']."', '".$_POST['auto_class_min']."', '".$_POST['auto_class_max']."', '".$_POST['auto_cc']."')";
	$DB_hub->Query($query);

	StoreQueries();

	//Return to pi_chatrooms
	Header("Location: index.php?".Change_URL_Query("q", "pi_chatroom"));
	Die();
	}
?>

<FONT class="h2"><?Print $text_edit_plugin;?></FONT>

<BR><BR>

<?
IF($_GET['nick']) {
	$query  = "SELECT * FROM pi_chatroom \n";
	$query .= "WHERE `nick` LIKE '".$_GET['nick']."'";
	$result = $DB_hub->Query($query);
	$row = $result->Fetch_Assoc();
	}
?>

<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE class="b1 fs9px">
	<TR>
		<TD class="bg_light right b"><?Print $text_nick;?> : </TD>
		<TD class="bg_light"><INPUT name="nick" class="w300px" type="text" value="<?Print $row['nick'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_topic;?> : </TD>
		<TD class="bg_light"><INPUT name="topic" class="w300px" type="text" value="<?Print $row['topic'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_creator;?> : </TD>
		<TD class="bg_light"><INPUT name="creator" class="w300px" type="text" value="<?Print $row['creator'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_min_class;?> : </TD>
		<TD class="bg_light"><INPUT name="min_class" class="w300px" type="text" value="<?Print $row['min_class'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_auto_class_min;?> : </TD>
		<TD class="bg_light"><INPUT name="auto_class_min" class="w300px" type="text" value="<?Print $row['auto_class_min'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_auto_class_max;?> : </TD>
		<TD class="bg_light"><INPUT name="auto_class_max" class="w300px" type="text" value="<?Print $row['auto_class_max'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_auto_cc;?> : </TD>
		<TD class="bg_light"><INPUT name="auto_cc" class="w300px" type="text" value="<?Print $row['auto_cc'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right" colspan=2>
			<INPUT class="w75px" type="reset" value="<?Print $text_reset;?>">
			<INPUT class="w75px" name="submit" type="submit" value="<?Print $text_send;?>">
		</TD>
	</TR>
</TABLE>
</FORM>
