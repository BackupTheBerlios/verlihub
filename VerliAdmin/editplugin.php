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

	IF($VA_setup['pi_plug_edit_class'] > USR_CLASS) {
		Die(VA_Message($err_msg_no_access));
		}

	$_POST['nick'] = $DB_hub->Real_Escape_String($_POST['nick']);
	$_POST['path'] = $DB_hub->Real_Escape_String($_POST['path']);
	$_POST['dest'] = $DB_hub->Real_Escape_String($_POST['dest']);
	$_POST['detail'] = $DB_hub->Real_Escape_String($_POST['detail']);

	$query  = "REPLACE INTO pi_plug \n";
	$query .= "(command, send_as, def, descr, min_class, max_class, flags) \n";
	$query .= "VALUES ('".$_POST['command']."', '".$_POST['send_as']."', '".$_POST['def']."', '".$_POST['descr']."', '".$_POST['min_class']."', '".$_POST['max_class']."', '".$flags."')";
	$DB_hub->Query($query);

	StoreQueries();
	
	//Return to pi_plugs
	Header("Location: index.php?".Change_URL_Query("q", "pi_plug"));
	Die();
	}
?>
	
<FONT class="h2"><?Print $text_edit_trigger;?></FONT>

<BR><BR>

<?
IF($_GET['command']) {
	$query  = "SELECT * FROM pi_plug \n";
	$query .= "WHERE `command` LIKE '".$_GET['command']."'";
	$result = $DB_hub->Query($query);
	$row = $result->Fetch_Assoc();
	$flags = GetValues($row['flags']);
	}
?>

<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE class="b1 fs9px">
	<TR>
		<TD class="bg_light right b"><?Print $text_command;?> : </TD>
		<TD class="bg_light"><INPUT name="command" class="w300px" type="text" value="<?Print $row['command'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_send_as;?> : </TD>
		<TD class="bg_light"><INPUT name="send_as" class="w300px" type="text" value="<?Print $row['send_as'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_min_class;?> : </TD>
		<TD class="bg_light">
			<SELECT name="min_class">
				<OPTION value=0<?IF($row['min_class'] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($row['min_class'] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($row['min_class'] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($row['min_class'] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($row['min_class'] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($row['min_class'] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($row['min_class'] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
			</SELECT>
		</TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_max_class;?> : </TD>
		<TD class="bg_light">
			<SELECT name="max_class">
				<OPTION value=0<?IF($row['max_class'] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($row['max_class'] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($row['max_class'] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($row['max_class'] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($row['max_class'] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($row['max_class'] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($row['max_class'] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
			</SELECT>
		</TD>
	</TR><TR>
		<TD class="b bg_light right top"><?Print $text_flags;?> : </TD>
		<TD class="bg_light">
			<INPUT class="b0" id="flags_1" name="flags[1]" type="checkbox" value=1<?IF($flags[0]) {Print " checked";}?>><LABLE for="flag_1"><?Print $text_trigger_flag_1;?></LABLE><BR>
			<INPUT class="b0" id="flags_2" name="flags[2]" type="checkbox" value=2<?IF($flags[1]) {Print " checked";}?>><LABLE for="flag_2"><?Print $text_trigger_flag_2;?></LABLE><BR>
			<INPUT class="b0" id="flags_4" name="flags[4]" type="checkbox" value=4<?IF($flags[2]) {Print " checked";}?>><LABLE for="flag_4"><?Print $text_trigger_flag_4;?></LABLE><BR>
			<INPUT class="b0" id="flags_8" name="flags[8]" type="checkbox" value=8<?IF($flags[3]) {Print " checked";}?>><LABLE for="flag_8"><?Print $text_trigger_flag_8;?></LABLE><BR>
			<INPUT class="b0" id="flags_16" name="flags[16]" type="checkbox" value=16<?IF($flags[4]) {Print " checked";}?>><LABLE for="flag_16"><?Print $text_trigger_flag_16;?></LABLE><BR>
			<INPUT class="b0" id="flags_32" name="flags[32]" type="checkbox" value=32<?IF($flags[5]) {Print " checked";}?>><LABLE for="flag_32"><?Print $text_trigger_flag_32;?></LABLE>
		</TD>
	</TR><TR>
		<TD class="b bg_light right top"><?Print $text_def;?> : </TD>
		<TD class="bg_light"><TEXTAREA name="def" class="w300px" rows=8><?Print $row['descr'];?></TEXTAREA></TD>
	</TR><TR>
		<TD class="bg_light top right b"><?Print $text_descr;?> : </TD>
		<TD class="bg_light"><TEXTAREA name="descr" class="w300px" rows=3><?Print $row['descr'];?></TEXTAREA></TD>
	</TR><TR>
		<TD class="bg_light right" colspan=2>
			<INPUT class="w75px" type="reset" value="<?Print $text_reset;?>">
			<INPUT class="w75px" name="submit" type="submit" value="<?Print $text_send;?>">
		</TD>
	</TR>
</TABLE>
</FORM>
