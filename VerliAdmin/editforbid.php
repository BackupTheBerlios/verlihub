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

	IF($VA_setup['pi_forbid_edit_class'] > USR_CLASS) {
		Die(VA_Message($err_msg_no_access));
		}

	$_POST['word'] = $DB_hub->Real_Escape_String($_POST['word']);
	$flags = Array_Sum($_POST['flags']);

	$query  = "REPLACE INTO pi_forbid \n";
	$query .= "(word, check_mask, afclass, banreason) \n";
	$query .= "VALUES ('".$_POST['word']."', '".$flags."', '".$_POST['afclass']."', '".$_POST['banreason']."')";
	$DB_hub->Query($query);

	StoreQueries();

	//Return to pi_forbids
	Header("Location: index.php?".Change_URL_Query("q", "pi_forbid"));
	Die();
	}
?>

<FONT class="h2"><?Print $text_edit_plugin;?></FONT>

<BR><BR>

<?
IF($_GET['word']) {
	$query  = "SELECT * FROM pi_forbid \n";
	$query .= "WHERE `word` LIKE '".$_GET['word']."'";
	$result = $DB_hub->Query($query);
	$row = $result->Fetch_Assoc();
	$flags = GetValues($row['check_mask']);
	}
?>

<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE class="b1 fs9px">
	<TR>
		<TD class="bg_light right b"><?Print $text_word;?> : </TD>
		<TD class="bg_light"><INPUT name="word" class="w300px" type="text" value="<?Print $row['word'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_check_mask;?> : </TD>
		<TD class="bg_light">
       			<INPUT class="b0" id="flags_1" name="flags[1]" type="checkbox" value=1<?IF($flags[0]) {Print " checked";}?>><LABLE for="flag_1"><?Print $text_word_flag_1;?></LABLE><BR>
			<INPUT class="b0" id="flags_2" name="flags[2]" type="checkbox" value=2<?IF($flags[1]) {Print " checked";}?>><LABLE for="flag_2"><?Print $text_word_flag_2;?></LABLE><BR>
			<INPUT class="b0" id="flags_4" name="flags[4]" type="checkbox" value=4<?IF($flags[2]) {Print " checked";}?>><LABLE for="flag_4"><?Print $text_word_flag_4;?></LABLE><BR>
                 </TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_afclass;?> : </TD>
		<TD class="bg_light">
                <SELECT name="afclass">
				<OPTION value=0<?IF($row['afclass'] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($row['afclass'] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($row['afclass'] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($row['afclass'] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($row['afclass'] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($row['afclass'] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($row['afclass'] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
			</SELECT>
                </TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_banreason;?> : </TD>
		<TD class="bg_light"><INPUT name="banreason" class="w300px" type="text" value="<?Print $row['banreason'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right" colspan=2>
			<INPUT class="w75px" type="reset" value="<?Print $text_reset;?>">
			<INPUT class="w75px" name="submit" type="submit" value="<?Print $text_send;?>">
		</TD>
	</TR>
</TABLE>
</FORM>
