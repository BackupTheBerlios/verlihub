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

IF($VA_setup['file_trigger_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['command']) {
	$DB_hub->Query("DELETE FROM file_trigger WHERE command = '".$_POST['command']."'");
	}
?>

<FONT class="h2"><?Print $text_file_trigger;?></FONT>

<BR><BR>

<?
IF(!IsSet($_GET['page']))
	$_GET['page'] = 1;
IF(!IsSet($_GET['orderby']))
	$_GET['orderby'] = $VA_setup['file_trigger_order_by'];

IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
	{
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "file_trigger", $_GET['filter_colum']);
	
	$query = " WHERE `".$DB_hub->Real_Escape_String($_GET['filter_colum'])."` LIKE '";
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "ends")
		{$query .= "%";}
	$query .= $DB_hub->Real_Escape_String($_GET['filter']);
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}

$result = $DB_hub->Query("SELECT Count(command) AS `count` FROM file_trigger".$query);
$count = $result->Fetch_Assoc();
$total = $count['count'];
$result->Free_Result();
$pages = (int)(($total - 1) / $VA_setup['file_trigger_results']) + 1;
$first = $VA_setup['file_trigger_results'] * ($_GET['page'] - 1);

$colums = $VA_setup['file_trigger_command'] + $VA_setup['file_trigger_send_as'];
$colums += $VA_setup['file_trigger_def'] + $VA_setup['file_trigger_descr'];
$colums += $VA_setup['file_trigger_min_class'] + $VA_setup['file_trigger_max_class'] + 2;

$query = "SELECT * FROM file_trigger".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['file_trigger_results'];
IF($debug[2]) {
	VA_Message($query, "bohyn32");
	Print "<BR>";
	}

IF($pages > 1)
	{Navigation();}
?>

<TABLE class="fs9px b1">
	<TR>
		<FORM action="index.php?<?Print Change_URL_Query("q", "edittrigger");?>" method="post">
		<TD class="bg_light" colspan=<?Print $colums;?>><INPUT type="submit" value="<?Print $text_add_new_trigger;?>"></TD>
		</FORM>
	</TR><TR>
		<FORM aciton="index.php" method="get">
		<TD class="bg_light right" colspan=<?Print $colums;?> nowrap>
			<INPUT name="q" type="hidden" value="file_trigger">
			<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum">
				<OPTION> </OPTION>
				<OPTION value="command"<?IF($_GET['filter_colum'] == "command"){Print " selected";}?>><?Print $text_command;?></OPTION>
				<OPTION value="send_as"<?IF($_GET['filter_colum'] == "send_as"){Print " selected";}?>><?Print $text_send_as;?></OPTION>
				<OPTION value="def"<?IF($_GET['filter_colum'] == "def"){Print " selected";}?>><?Print $text_def;?></OPTION>
				<OPTION value="descr"<?IF($_GET['filter_colum'] == "descr"){Print " selected";}?>><?Print $text_descr;?></OPTION>
				<OPTION value="min_class"<?IF($_GET['filter_colum'] == "min_class"){Print " selected";}?>><?Print $text_min_class;?></OPTION>
				<OPTION value="max_class"<?IF($_GET['filter_colum'] == "max_class"){Print " selected";}?>><?Print $text_max_class;?></OPTION>
				<OPTION value="flags"<?IF($_GET['filter_colum'] == "flags"){Print " selected";}?>><?Print $text_flags;?></OPTION>
			</SELECT>
			&nbsp;&nbsp;
			<SELECT name="filter_type" size=1>
				<OPTION> </OPTION>
				<OPTION value="contains"<?IF($_GET['filter_type'] == "contains"){Print " selected";}?>><?Print $text_contains;?></OPTION>
				<OPTION value="equal"<?IF($_GET['filter_type'] == "equal"){Print " selected";}?>><?Print $text_equal;?></OPTION>
				<OPTION value="begins"<?IF($_GET['filter_type'] == "begins"){Print " selected";}?>><?Print $text_begins;?></OPTION>
				<OPTION value="ends"<?IF($_GET['filter_type'] == "ends"){Print " selected";}?>><?Print $text_ends;?></OPTION>
			</SELECT>
			&nbsp;&nbsp;
			<INPUT name="filter" type="text" size=35 value="<?Print $_GET['filter'];?>" class="9px">
			<INPUT class="w75px" type="submit" value="<?Print $text_show;?>" class="9px">
		</TD>
		</FORM>
	</TR>
	<TR>
		<TD class="bg_light" colspan=2 width=32>&nbsp;</TD>
		<?IF($VA_setup['file_trigger_command']){?><TD class="b bg_light" nowrap><?Print $text_command; PrintOrderBy("command");?></TD><?}?>
		<?IF($VA_setup['file_trigger_send_as']){?><TD class="b bg_light" nowrap><?Print $text_send_as; PrintOrderBy("send_as");?></TD><?}?>
		<?IF($VA_setup['file_trigger_def']){?><TD class="b bg_light" nowrap><?Print $text_def; PrintOrderBy("def");?></TD><?}?>
		<?IF($VA_setup['file_trigger_descr']){?><TD class="b bg_light" nowrap><?Print $text_descr; PrintOrderBy("descr");?></TD><?}?>
		<?IF($VA_setup['file_trigger_minclass']){?><TD class="b bg_light" nowrap><?Print $text_min_class; PrintOrderBy("min_class");?></TD><?}?>
		<?IF($VA_setup['file_trigger_maxclass']){?><TD class="b bg_light" nowrap><?Print $text_max_class; PrintOrderBy("max_class");?></TD><?}?>
		<?IF($VA_setup['file_trigger_flags']){?><TD class="b bg_light" nowrap><?Print $text_flags; PrintOrderBy("flags");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{?>
		<TR>
			<FORM action="index.php?<?Print Change_URL_Query("q", "edittrigger");?>" method="post">
				<INPUT name="command" type="hidden" value="<?Print $row['command'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['file_trigger_edit_class'] <= USR_CLASS) {?>
					<A href="index.php?<?Print Change_URL_Query("q", "edittrigger", "command", $row['command']);?>">
						<IMG src="img/edit_off.gif" title="<?Print $text_edit;?>" width=16 height=16 id="<?Print $row['command'];?>" onMouseOver="ChangeImg('<?Print $row['command'];?>', 'img/edit_on.gif');" onMouseOut="ChangeImg('<?Print $row['command'];?>', 'img/edit_off.gif');">
					</A>
					<?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>
			
			<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
				<INPUT name="command" type="hidden" value="<?Print $row['command'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['file_trigger_edit_class'] <= USR_CLASS){?><INPUT type="image" src="img/delete.gif" title="<?Print $text_delete;?>" class="b0"><?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

			<?IF($VA_setup['file_trigger_command']){?><TD class="bg_light"><?Print $row['command'];?></TD><?}?>
			<?IF($VA_setup['file_trigger_send_as']){?><TD class="bg_light"><?Print $row['send_as'];?></TD><?}?>
			<?IF($VA_setup['file_trigger_def']){?><TD class="bg_light"><?Print $row['def'];?></TD><?}?>
			<?IF($VA_setup['file_trigger_descr']){?><TD class="bg_light"><?Print $row['descr'];?></TD><?}?>
			<?IF($VA_setup['file_trigger_minclass']){?><TD class="bg_light"><?Print $row['min_class'];?></TD><?}?>
			<?IF($VA_setup['file_trigger_maxclass']){?><TD class="bg_light"><?Print $row['max_class'];?></TD><?}?>
			<?IF($VA_setup['file_trigger_flags']){?><TD class="bg_light"><?Print $row['flags'];?></TD><?}?>
		</TR>
<?		}
	$result->Free_Result();
	}
ELSE {?>
	<TR>
		<TD class="b bg_light center" colspan=<?Print $colums;?>>
			<BR>
			&lt;&lt;&lt;&nbsp;&nbsp;<?Print $text_no_results;?>&nbsp;&nbsp;&gt;&gt;&gt;
			<BR><BR>
		</TD>
	</TR>
<?	}?>
	<TR>
		<TD class="bg_light" colspan=2 width=32>&nbsp;</TD>
		<?IF($VA_setup['file_trigger_command']){?><TD class="b bg_light" nowrap><?Print $text_command; PrintOrderBy("command");?></TD><?}?>
		<?IF($VA_setup['file_trigger_send_as']){?><TD class="b bg_light" nowrap><?Print $text_send_as; PrintOrderBy("send_as");?></TD><?}?>
		<?IF($VA_setup['file_trigger_def']){?><TD class="b bg_light" nowrap><?Print $text_def; PrintOrderBy("def");?></TD><?}?>
		<?IF($VA_setup['file_trigger_descr']){?><TD class="b bg_light" nowrap><?Print $text_descr; PrintOrderBy("descr");?></TD><?}?>
		<?IF($VA_setup['file_trigger_minclass']){?><TD class="b bg_light" nowrap><?Print $text_min_class; PrintOrderBy("min_class");?></TD><?}?>
		<?IF($VA_setup['file_trigger_maxclass']){?><TD class="b bg_light" nowrap><?Print $text_max_class; PrintOrderBy("max_class");?></TD><?}?>
		<?IF($VA_setup['file_trigger_flags']){?><TD class="b bg_light" nowrap><?Print $text_flags; PrintOrderBy("flags");?></TD><?}?>
	</TR>
</TABLE>

<?
IF($pages > 1)
	{Navigation();}
?>
