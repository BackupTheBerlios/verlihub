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
	//Escape strings for safety use in MySQL
	$_POST['oldnick'] = $DB_hub->Real_Escape_String($_POST['oldnick']);
	$_POST['nick'] = $DB_hub->Real_Escape_String($_POST['nick']);
	$_POST['reg_op'] = $DB_hub->Real_Escape_String($_POST['reg_op']);
	$_POST['note_op'] = $DB_hub->Real_Escape_String($_POST['note_op']);
	$_POST['note_usr'] = $DB_hub->Real_Escape_String($_POST['note_usr']);

	//Get informations about editted user
	$result = $DB_hub->Query("SELECT `class`, `enabled` FROM reglist WHERE nick='".$_POST['oldnick']."'");
	$row = $result->Fetch_Assoc();

	$register_class = FetchClass($VA_setup['register_class']);
	$disable_class = FetchClass($VA_setup['disable_class']);

	IF($register_class[$row['class']] > USR_CLASS) {
		//User is not allowed to register this class
		Die(VA_Message($err_msg_no_access, "error"));
		}
	IF($disable_class[$row['class']] > USR_CLASS && $row['enabled'] && !$_POST['enabled']) {
		//User tryed to disable this user with no disable rights
		Die(VA_Message($err_msg_no_access, "error"));
		}

	IF($_POST['new'])
		{//Adding new user
		IF(NickExist($_POST['nick'],$DB_hub)) {
			//User already exists
			Die(VA_Message($err_msg_user_exist, "error"));
			}
		ELSE {
			$query  = "INSERT INTO reglist \n";
			$query .= "(nick, class, class_protect, class_hidekick, hide_kick, reg_date, reg_op, pwd_crypt, enabled, note_op, note_usr) \n";
			$query .= "VALUES ('".$_POST['nick']."', '".$_POST['class']."', '".$_POST['class_protect']."', '".$_POST['class_hidekick']."', '".$_POST['hide_kick']."', UNIX_TIMESTAMP(), '".USR_NICK."', 1, '".$_POST['enabled']."', '".$_POST['note_op']."', '".$_POST['note_usr']."')";
		        }
	}
	ELSE {
		//Change existing user settings
		$query  = "UPDATE reglist \n";
		$query .= "SET `nick`='".$_POST['nick']."', `class`='".$_POST['class']."', `class_protect`='".$_POST['class_protect']."', `class_hidekick`='".$_POST['class_hidekick']."', `hide_kick`='".$_POST['hide_kick']."', `enabled`='".$_POST['enabled']."', `note_op`='".$_POST['note_op']."', `note_usr`='".$_POST['note_usr']."' \n";
		$query .= "WHERE `nick` LIKE '".$_POST['oldnick']."'";
		}
	$DB_hub->Query($query);

	IF($VA_setup['log_addreg'])
		{//Log this action if loging is enabled
		$action = "Added / edited reg user ".$_POST['nick']." wit class ".$_POST['class'];
		LogFile(USR_NICK, USR_CLASS, $action, "login");
		}

	StoreQueries();

	//Return to reglist
	Header("Location: index.php?".Change_URL_Query("q", "reglist")."#".$_POST['nick']);
	}

// ---------------------------------------------------------------------
?>

<FONT class="h2"><?Print $text_addreg;?></FONT>

<BR><BR>

<?
$register_class = FetchClass($VA_setup['register_class']);
$disable_class = FetchClass($VA_setup['disable_class']);

$result = $DB_hub->Query("SELECT * FROM reglist WHERE nick LIKE '".$_GET['nick']."'");
IF($result->num_rows == 1) {
	//User is not allowed to edit this user
	$row = $result->Fetch_Assoc();
	IF($register_class[$row['class']] > USR_CLASS)
		Die(VA_Message($err_msg_no_access, "error"));
	}
ELSEIF(USR_CLASS >= $register_class[1] || USR_CLASS >= $register_class[2] || USR_CLASS >= $register_class[3] || USR_CLASS >= $register_class[4] || USR_CLASS >= $register_class[5] || USR_CLASS >= $register_class[10]) {
	//User is allowed to register some class (At least one)
	$new = 1;//Adding new user = true
	}
ELSE {
	//User has no addres access (Can`t register any class)
	Die(VA_Message($err_msg_no_access, "error"));
	}

//Replace special characters by safety ones
$row['nick'] = HTMLSpecialChars($row['nick']);
$row['reg_op'] = HTMLSpecialChars($row['reg_op']);
$row['note_op'] = HTMLSpecialChars($row['note_op']);
$row['note_usr'] = HTMLSpecialChars($row['note_usr']);
?>
<?IF($_POST['submit']){echo "asdadas";}?>
<FORM action="index.php?<?Print Change_URL_Query("nick","");?>" method="post">
<INPUT name="oldnick" type="hidden" value="<?Print $row['nick'];?>">
<?IF($new){Print "<INPUT name=\"new\" type=\"hidden\" value=\"1\">";}?>
<TABLE class="fs9px b1">
	<TR>
		<TD align="right" class="b bg_light"><?Print $text_nick;?> : </TD>
		<TD class="bg_light"><INPUT class="w160px" name="nick" type="text" size=20 value="<?Print $row['nick'];?>"></TD>
	</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_class;?> : </TD>
		<TD class="bg_light">
			<SELECT name="class" size=1>
			<?IF($register_class[1] <= USR_CLASS){?><OPTION value=1<?IF($row['class'] == 1 || $new){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION><?}?>
			<?IF($register_class[2] <= USR_CLASS){?><OPTION value=2<?IF($row['class'] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION><?}?>
			<?IF($register_class[3] <= USR_CLASS){?><OPTION value=3<?IF($row['class'] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION><?}?>
			<?IF($register_class[4] <= USR_CLASS){?><OPTION value=4<?IF($row['class'] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION><?}?>
			<?IF($register_class[5] <= USR_CLASS){?><OPTION value=5<?IF($row['class'] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION><?}?>
			<?IF($register_class[10] <= USR_CLASS){?><OPTION value=10<?IF($row['class'] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION><?}?>
		</TD>
	</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_class_protect;?> : </TD>
		<TD class="bg_light">
			<SELECT name="class_protect" size=1>
			<?IF(USR_CLASS >= 1){?><OPTION value=1<?IF($row['class_protect'] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION><?}?>
			<?IF(USR_CLASS >= 2){?><OPTION value=2<?IF($row['class_protect'] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION><?}?>
			<?IF(USR_CLASS >= 3){?><OPTION value=3<?IF($row['class_protect'] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION><?}?>
			<?IF(USR_CLASS >= 4){?><OPTION value=4<?IF($row['class_protect'] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION><?}?>
			<?IF(USR_CLASS >= 5){?><OPTION value=5<?IF($row['class_protect'] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION><?}?>
			<?IF(USR_CLASS >= 10){?><OPTION value=10<?IF($row['class_protect'] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION><?}?>
		</TD>
</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_class_hidekick;?> : </TD>
		<TD class="bg_light">
			<SELECT name="class_hidekick" size=1>
			<OPTION value=0<?IF($row['class_hidekick'] == 0 || $new){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
			<OPTION value=1<?IF($row['class_hidekick'] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
			<OPTION value=2<?IF($row['class_hidekick'] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
			<OPTION value=3<?IF($row['class_hidekick'] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
			<OPTION value=4<?IF($row['class_hidekick'] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
			<OPTION value=5<?IF($row['class_hidekick'] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
			<OPTION value=10<?IF($row['class_hidekick'] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
		</TD>
	</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_hide_kick;?> : </TD>
		<TD class="bg_light">
		<SELECT name="hide_kick" size=1>
			<OPTION value=0<?IF($row['hide_kick'] == 0){Print " selected";}?>><?Print $text_no;?></OPTION>
			<OPTION value=1<?IF($row['hide_kick'] == 1){Print " selected";}?>><?Print $text_yes;?></OPTION>
		</TD>
	</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_reg_date;?> : </TD>
		<TD class="bg_light"><?IF(!$new){Print Date($VA_setup['timedate_format'], $row['reg_date']);}ELSE{Print Date($VA_setup['date_format'], Time());}?></TD>
	</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_reg_op;?> : </TD>
		<?IF($new){Print "<TD class=\"bg_light\">".USR_NICK;}ELSE{Print "<TD class=\"bg_light\">".$row['reg_op'];}?></TD>
	</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_pwd_crypt;?> : </TD>
		<TD class="bg_light">
			<SELECT name="pwd_crypt" size=1<?IF(!$new){Print " disabled";}?>>
			<OPTION value=0<?IF($row['pwd_crypt'] == 0){Print " selected";}?>><?Print $text_plain;?></OPTION>
			<OPTION value=1<?IF($row['pwd_crypt'] == 1 || $new){Print " selected";}?>><?Print $text_crypted;?></OPTION>
			<OPTION value=2<?IF($row['pwd_crypt'] == 2){Print " selected";}?>><?Print $text_md5_hash;?></OPTION>
		</TD>
	</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_enabled;?> : </TD>
		<TD class="bg_light">
			<SELECT name="enabled" size=1<?IF($disable_class[$row['class']] > USR_CLASS && !$new){Print " disabled";}?>>
			<OPTION value=0<?IF($row['enabled'] == 0){Print " selected";}?>><?Print $text_no;?></OPTION>
			<OPTION value=1<?IF($row['enabled'] == 1 || $new){Print " selected";}?>><?Print $text_yes;?></OPTION>
			<?IF($disable_class[$row['class']] > USR_CLASS && !$new){?>
			<INPUT name="enabled" type="hidden" value="<?Print $row['enabled'];?>">
			<?}?>
		</TD>
	</TR><TR>
		<TD align="right" valign="top" class="b bg_light"><?Print $text_note_op;?> : </TD>
		<TD class="bg_light"><TEXTAREA class="w160px" name="note_op" rows=3><?Print $row['note_op'];?></TEXTAREA></TD>
	</TR><TR>
		<TD align="right" valign="top" class="b bg_light"><?Print $text_note_usr;?> : </TD>
		<TD class="bg_light"><TEXTAREA class="w160px" name="note_usr" rows=3><?Print $row['note_usr'];?></TEXTAREA></TD>
	</TR><TR>
		<TD align="right" colspan=2 class="bg_light">
			<INPUT class="w75px" name="reset" type="reset" value="<?Print $text_reset;?>" class="b">
			<INPUT class="w75px" name="submit" type="submit" value="<?Print $text_send;?>" class="b">
		</TD>
	</TR>
<TABLE>
</FORM>
