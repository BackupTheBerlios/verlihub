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

	IF($VA_setup['setuplist_edit_class'] > USR_CLASS) {
		Die(VA_Messages($err_msg_no_access, "error"));
		}
	
	IF(IsSet($_POST['val1']))
		{$_POST['val'] = $_POST['val1']."|".$_POST['val2']."|".$_POST['val3']."|".$_POST['val4']."|".$_POST['val5']."|".$_POST['val10'];}
	
	
	IF($_POST['vtype'] == "boolean" && ((boolean)$_POST['val'] != $_POST['val'])) {
		Die(VA_Message($err_msg_wrong_vtype, "error"));
		}
	ELSEIF($_POST['vtype'] == "int" && ((int)$_POST['val'] != $_POST['val'])) {
		Die(VA_Message($err_msg_wrong_vtype, "error"));
		}
	ELSEIF($_POST['vtype'] == "float" && ((float)$_POST['val'] != $_POST['val'])) {
		Die(VA_Message($err_msg_wrong_vtype, "error"));
		}
	ELSEIF($_POST['vtype'] == "class" && !Ereg("^([1-5]|1[0-1])|(([1-5]|1[0-1])\|([1-5]|1[0-1])\|([1-5]|1[0-1])\|([1-5]|1[0-1])\|([1-5]|1[0-1])\|([1-5]|1[0-1]))$", $_POST['val'])) {
		Die(VA_Message($err_msg_wrong_vtype, "error"));
		}

	$_POST['val'] = $DB_hub->Real_Escape_String($_POST['val']);
	$_POST['help'] = $DB_hub->Real_Escape_String($_POST['help']);

	IF($_POST['file'] == "defaults")
		{$_POST['file'] = "config";}
	
	$query  = "REPLACE INTO SetupList \n";
	$query .= "(file, var, val) \n";
	$query .= "VALUES ('".$_POST['file']."', '".$_POST['var']."', '".$_POST['val']."')";
	$DB_hub->Query($query);
	
	IF($_POST['help'] != "" && $_POST['applies'] != "" && $_POST['vtype'])
		{$DB_hub->Query("REPLACE INTO setuphelp (var, vtype, help, applies) VALUES ('".$_POST['var']."', '".$_POST['vtype']."', '".$_POST['help']."', '".$_POST['applies']."')");}

	IF($VA_setup['log_settings'])
		{
		IF($_POST['file'] == config)
			{$value = $VH_setup[$_POST['var']];}
		ELSE
			{$value = $VA_setup[$_POST['var']];}
		$action = "Changed setting ".$_POST['var']." ".$value." -> ".$_POST['val'];
		LogFile(USR_NICK, USR_CLASS, $action, "settings");
		}

	StoreQueries();

	Header("Location: index.php?".Change_URL_Query("q", "setuplist")."#".$_POST['file']."_".$_POST['var']);
	Die();
	}
?>

<FONT class="h2"><?Print $text_edit_setup;?></FONT>

<BR><BR>

<?
IF($VA_setup['setuplist_edit_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_GET['var'] != "")
	{
	$result = $DB_hub->Query("SELECT * FROM SetupList WHERE var LIKE '".$_GET['var']."' AND file LIKE '".$_GET['file']."'");
	$setuphelp = $DB_hub->Query("SELECT * FROM setuphelp WHERE var LIKE '".$_GET['var']."'");
	$row = $result->Fetch_Assoc();
	$result->Free_Result();
	$help = $setuphelp->Fetch_Assoc();
	$setuphelp->Free_Result();
	
	}
?>
<FORM action="index.php?<?Print Change_URL_Query("file", "", "val", "");?>" method="post">
<?IF($_GET['var'] != "")
	{?>
	<INPUT name="var" type="hidden" value="<?Print $row['var'];?>">
	<INPUT name="file" type="hidden" value="<?Print $row['file'];?>">
<?	}?>

<TABLE class="fs9px b1">
	<TR>
		<TD align="right" class="b bg_light"><?Print $text_file;?> : </TD>
		<TD class="bg_light">
			<?
			IF($_GET['file'] != "")
				{Print $row['file'];}
			ELSE
				{?><INPUT class="w300px" name="file" type="text"><?}?>
		</TD>
	</TR>
	<TR>
		<TD align="right" class="b bg_light"><?Print $text_var;?> : </TD>
		<TD class="bg_light">
			<?IF($_GET['var'] != "")
				{Print $row['var'];}
			ELSE
				{?><INPUT class="w300px" name="var" type="text"><?}?>
		</TD>
	</TR>
	<TR>
		<TD valign="top" align="right" class="b bg_light"><?Print $text_val;?> : </TD>
		<TD class="bg_light">
			<?IF($help['vtype'] == "class" && ($help['var'] != "register_class" && $help['var'] != "disable_class" && $help['var'] != "delete_class"))
				{?>
				<SELECT name="val" size=1>
				<OPTION value=0<?IF($row['val'] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($row['val'] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($row['val'] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($row['val'] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($row['val'] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($row['val'] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($row['val'] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
				<OPTION value=11<?IF($row['val'] == 11){Print " selected";}?>><?Print $text_disable;?> (11)</OPTION>
				</SELECT>
<?			}ELSEIF($help['vtype'] == "class")
				{
				$value = FetchClass($row['val']);
				?>
				<FONT class="b"><?Print $text_class;?> 1 </CLASS>
				<SELECT name="val1" size=1>
				<OPTION value=0<?IF($value[1] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($value[1] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($value[1] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($value[1] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($value[1] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($value[1] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($value[1] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
				<OPTION value=11<?IF($value[1] == 11){Print " selected";}?>><?Print $text_disable;?> (11)</OPTION>
				</SELECT>
				<BR>
				
				<FONT class="b"><?Print $text_class;?> 2 </FONT>
				<SELECT name="val2" size=1>
				<OPTION value=0<?IF($value[2] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($value[2] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($value[2] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($value[2] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($value[2] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($value[2] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($value[2] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
				<OPTION value=11<?IF($value[2] == 11){Print " selected";}?>><?Print $text_disable;?> (11)</OPTION>
				</SELECT>
				<BR>
				
				<FONT class="b"><?Print $text_class;?> 3 </FONT>
				<SELECT name="val3" size=1>
				<OPTION value=0<?IF($value[3] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($value[3] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($value[3] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($value[3] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($value[3] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($value[3] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($value[3] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
				<OPTION value=11<?IF($value[3] == 11){Print " selected";}?>><?Print $text_disable;?> (11)</OPTION>
				</SELECT>
				<BR>
				
				<FONT class="b"><?Print $text_class;?> 4 </FONT>
				<SELECT name="val4" size=1>
				<OPTION value=0<?IF($value[4] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($value[4] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($value[4] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($value[4] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($value[4] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($value[4] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($value[4] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
				<OPTION value=11<?IF($value[4] == 11){Print " selected";}?>><?Print $text_disable;?> (11)</OPTION>
				</SELECT>
				<BR>
				
				<FONT class="b"><?Print $text_class;?> 5 </FONT>
				<SELECT name="val5" size=1>
				<OPTION value=0<?IF($value[5] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($value[5] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($value[5] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($value[5] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($value[5] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($value[5] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($value[5] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
				<OPTION value=11<?IF($value[5] == 11){Print " selected";}?>><?Print $text_disable;?> (11)</OPTION>
				</SELECT>
				<BR>
				
				<FONT class="b"><?Print $text_class;?> 10</FONT>
				<SELECT name="val10" size=1>
				<OPTION value=0<?IF($value[10] == 0){Print " selected";}?>><?Print $text_guest;?> (0)</OPTION>
				<OPTION value=1<?IF($value[10] == 1){Print " selected";}?>><?Print $text_reg;?> (1)</OPTION>
				<OPTION value=2<?IF($value[10] == 2){Print " selected";}?>><?Print $text_vip;?> (2)</OPTION>
				<OPTION value=3<?IF($value[10] == 3){Print " selected";}?>><?Print $text_op;?> (3)</OPTION>
				<OPTION value=4<?IF($value[10] == 4){Print " selected";}?>><?Print $text_chief_op;?> (4)</OPTION>
				<OPTION value=5<?IF($value[10] == 5){Print " selected";}?>><?Print $text_admin;?> (5)</OPTION>
				<OPTION value=10<?IF($value[10] == 10){Print " selected";}?>><?Print $text_master;?> (10)</OPTION>
				<OPTION value=11<?IF($value[10] == 11){Print " selected";}?>><?Print $text_disable;?> (11)</OPTION>
				</SELECT>
<?			}ELSEIF($help['vtype'] == "boolean"){?>
				<SELECT name="val" size=1>
				<OPTION value=0<?IF($row['val'] == 0){Print " selected";}?>><?Print $text_disabled;?></OPTION>
				<OPTION value=1<?IF($row['val'] == 1){Print " selected";}?>><?Print $text_enabled;?></OPTION>
<?			}ELSEIF($help['vtype'] == "text"){?>
				<TEXTAREA class="w300px" name="val" rows=5 wrap="soft"><?Print $row['val'];?></TEXTAREA>
<?			}ELSE{?>
				<INPUT class="w300px" name="val" type="text" value="<?Print $row['val'];?>">
<?				}?>
		</TD>
	</TR><TR>
		<TD align="right" class="b bg_light"><?Print $text_vtype;?> : </TD>
		<TD class="bg_light">
<?			IF($help['vtype'] == ""){?>
			<SELECT name="vtype" size=1>
			<OPTION value=""></OPTION>
			<OPTION value="string">String</OPTION>
			<OPTION value="int">Int</OPTION>
			<OPTION value="float">Float</OPTION>
			<OPTION value="boolean">Boolean</OPTION>
			<OPTION value="class">Class</OPTION>
			<OPTION value="text">Text</OPTION>
			</SELECT>
<?			}ELSE
				{Print $help['vtype']."<INPUT name=\"vtype\" type=\"hidden\" value=\"".$help['vtype']."\">";}?>
		</TD>
	</TR>
	<TR>
		<TD align="right" class="b bg_light"><?Print $text_applies;?> : </TD>
		<TD class="bg_light">
<?			IF($help['applies'] == ""){?>
			<SELECT name="applies" size=1>
			<OPTION value=""></OPTION>
			<OPTION value="not">Not</OPTION>
			<OPTION value="new">New</OPTION>
			<OPTION value="now">Now</OPTION>
			</SELECT>
<?			}ELSE
				{Print $help['applies']."<INPUT name=\"applies\" type=\"hidden\" value=\"".$help['applies']."\">";}?>
		</TD>
	</TR><TR>
		<TD align="center" class="b bg_light"><IMG src="img/info32.gif" width=32 height=32 alt="<?Print $text_help;?>"></TD>
		<TD class="bg_light"><TEXTAREA class="w300px" name="help" rows=5 wrap="soft"><?Print $help['help'];?></TEXTAREA></TD>
	</TR><TR>
		<TD align="right" colspan=2 class="bg_light">
			<INPUT class="w75px" name="reset" type="reset" value="<?Print $text_reset;?>" class="b">
			<INPUT class="w75px" name="submit" type="submit" value="<?Print $text_send;?>" class="b">
		</TD>
	</TR>
</TABLE>
</FORM>