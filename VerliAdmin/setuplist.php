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

IF($VA_setup['setuplist_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}
?>
<FONT class="h2"><?Print $text_setuplist;?></FONT>

<BR><BR>

<?
IF($_GET['orderby'] == ""){$_GET['orderby'] = $VA_setup['setuplist_order_by'];}
IF($_GET['page'] == ""){$_GET['page'] = 1;}

IF($_GET['filter_file'] == "VA_config")
	{$query = " WHERE (file LIKE 'verliadmin' OR file LIKE 'config')";}
ELSEIF($_GET['filter_file'] == "defaults")
	{$query = " WHERE file LIKE 'defaults'";}
ELSEIF($_GET['filter_file'] == "VerliAdmin")
	{$query = " WHERE file LIKE 'verliadmin'";}
ELSEIF($_GET['filter_file'] == "config")
	{$query = " WHERE file LIKE 'config'";}

IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
	{
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "SetupList", $_GET['filter_colum']);
	IF(!$_GET['filter_file'])
		{$query .= " WHERE";}
	IF($_GET['filter_file'])
		{$query .= " AND";}
	$query .= "`".$_GET['filter_colum']."` LIKE '";
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "ends")
		{$query .= "%";}
	$query .= $DB_hub->Real_Escape_String($_GET['filter']);
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}

$result = $DB_hub->Query("SELECT Count(var) AS `count` FROM SetupList".$query);
$count = $result->Fetch_Assoc();
$total = $count['count'];
$result->Free_Result();
$pages = (int)(($total - 1) / $VA_setup['setuplist_results']) + 1;
$first = $VA_setup['setuplist_results'] * ($_GET['page'] - 1);

$query  = "SELECT * FROM SetupList".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['setuplist_results'];
IF($debug[2]) {
	VA_Message($query, "bohyn32");
	Print "<BR>";
	}

IF($pages > 1)
	{Navigation();}
?>
<TABLE class="fs9px b1">
<?
IF($VA_setup['setuplist_edit_class'] <= USR_CLASS)
	{?>
	<TR>
		<FORM action="index.php?<?Print Change_URL_Query("q", "editsetuplist");?>" method="post">
		<TD class="bg_light" colspan=7><INPUT type="submit" value="<?Print $text_add_new_setup?>"></TD>
		</FORM>
	</TR>
<?	}?>
	<TR>
		<FORM action="index.php" action="get">
		<INPUT name="q" type="hidden" value="setuplist">
		<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
		<TD class="bg_light right" colspan=7>
			<FONT class="b"><?Print $text_file;?> : </FONT>
			<SELECT name="filter_file" size=1>
				<OPTION value="VA_config"<?IF($_GET['filter_file'] == "VA_config"){Print " selected";}?>>Config + VerliAdmin</OPTION>
				<OPTION value="config"<?IF($_GET['filter_file'] == "config"){Print " selected";}?>>Config</OPTION>
				<OPTION value="VerliAdmin"<?IF($_GET['filter_file'] == "VerliAdmin"){Print " selected";}?>>VerliAdmin</OPTION>
				<OPTION value="defaults"<?IF($_GET['filter_file'] == "defaults"){Print " selected";}?>>Defaults</OPTION>
				<OPTION value=""<?IF($_GET['filter_file'] == ""){Print " selected";}?>><?Print $text_all;?></OPTION>
			</SELECT>
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum" size=1>
				<OPTION></OPTION>
				<OPTION value="var"<?IF($_GET['filter_colum'] == "var"){Print " selected";}?>><?Print $text_var;?></OPTION>
				<OPTION value="val"<?IF($_GET['filter_colum'] == "val"){Print " selected";}?>><?Print $text_val;?></OPTION>
			</SELECT>
			<SELECT name="filter_type" size=1>
				<OPTION></OPTION>
				<OPTION value="contains"<?IF($_GET['filter_type'] == "contains"){Print " selected";}?>><?Print $text_contains;?></OPTION>
				<OPTION value="equal"<?IF($_GET['filter_type'] == "equal"){Print " selected";}?>><?Print $text_equal;?></OPTION>
				<OPTION value="begins"<?IF($_GET['filter_type'] == "begins"){Print " selected";}?>><?Print $text_begins;?></OPTION>
				<OPTION value="ends"<?IF($_GET['filter_type'] == "ends"){Print " selected";}?>><?Print $text_ends;?></OPTION>
			</SELECT>
			<INPUT name="filter" size=25 type="text" value="<?Print $_GET['filter'];?>">
			<INPUT type="submit" value="<?Print $text_show;?>">
		</TD>
		</FORM>
	</TR>
	<TR>
		<TD width=16 class="bg_light">&nbsp;</TD>
		<TD class="b bg_light"><?Print $text_file; PrintOrderBy("file");?></TD>
		<TD class="b bg_light"><?Print $text_var; PrintOrderBy("var");?></TD>
		<TD class="b bg_light"><?Print $text_val; PrintOrderBy("val");?></TD>
		<TD class="b bg_light"><?Print $text_vtype;?></TD>
		<TD class="b bg_light"><?Print $text_help;?></TD>
		<TD class="b bg_light"><?Print $text_applies;?></TD>
	</TR>
<?
IF($total > 0) {
	$setuphelp = $DB_hub->Query("SELECT * FROM setuphelp");
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{
		$row['val'] = nl2br(HTMLSpecialChars($row['val']));

		WHILE($help = $setuphelp->Fetch_Assoc()) {
			IF($help['var'] == $row['var']) {
				$help['help'] = nl2br(HTMLSpecialChars($help['help']));
				BREAK;
				}
			}
		$setuphelp->Data_Seek(0);
		
		$class = TRUE;
		IF($help['vtype'] == "class") {
			IF($row['var'] == "delete_class") {
				$delete = FetchClass($VA_setup['delete_class']);
				IF(!$delete[1] && !$delete[2] && !$delete[3] && !$delete[4] && !$delete[5] && !$delete[10])
					{$class = FALSE;}
				}
			ELSEIF($row['var'] == "disable_class") {
				$disable = FetchClass($VA_setup['disable_class']);
				IF(!$delete[1] && !$disable[2] && !$disable[3] && !$disable[4] && !$disable[5] && !$disable[10])
					{$class = FALSE;}
				}
			ELSEIF($row['var'] == "register_class") {
				$register = FetchClass($VA_setup['register_class']);
				IF(!$register[1] && !$register[2] && !$register[3] && !$register[4] && !$register[5] && !$register[10])
					{$class = FALSE;}
				}
			ELSE {
				IF($row['val'] > USR_CLASS)
					{$class = FALSE;}
				}
			}
		?>
		<TR>
			<TD class="bg_light">
				<?IF($VA_setup['setuplist_edit_class'] <= USR_CLASS && $class) {?>
					<A href="index.php?<?Print Change_URL_Query("q", "editsetuplist","file", $row['file'], "var", $row['var']);?>" name="<?Print $row['file']."_".$row['var'];?>">
						<IMG src="img/edit_off.gif" title="<?Print $text_edit_setup;?>" width=16 height=16 id="<?Print $row['file']."_".$row['var'];?>" onMouseOver="ChangeImg('<?Print $row['file']."_".$row['var'];?>', 'img/edit_on.gif');" onMouseOut="ChangeImg('<?Print $row['file']."_".$row['var'];?>', 'img/edit_off.gif');">
					</A>
<?					}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			
			<TD class="bg_light" nowrap><?Print $row['file'];?></TD>
			<TD class="bg_light" nowrap><?Print $row['var'];?></TD>
			<TD class="bg_light<?IF($help['help'] == "int" || $help['help'] == "class"){Print " right";}?>"><?Print $row['val'];?></TD>
			<TD class="bg_light"><?Print $help['vtype'];?></TD>
			<TD class="bg_light"><?Print $help['help'];?></TD>
			<TD class="bg_light"><?Print $help['applies'];?></TD>
		</TR>
	<?	}
	$result->Free_Result();
	$setuphelp->Free_Result();
	}
ELSE {?>
	<TR>
		<TD class="b bg_light center" colspan=7>
			<BR>
			&lt;&lt;&lt;&nbsp;&nbsp;<?Print $text_no_results;?>&nbsp;&nbsp;&gt;&gt;&gt;
			<BR><BR>
		</TD>
	</TR>
<?	}?>
	<TR>
		<TD class="bg_light">&nbsp;</TD>
		<TD class="b bg_light"><?Print $text_file; PrintOrderBy("file");?></TD>
		<TD class="b bg_light"><?Print $text_var; PrintOrderBy("var");?></TD>
		<TD class="b bg_light"><?Print $text_val; PrintOrderBy("val");?></TD>
		<TD class="b bg_light"><?Print $text_vtype;?></TD>
		<TD class="b bg_light"><?Print $text_help;?></TD>
		<TD class="b bg_light"><?Print $text_applies; ?></TD>
	</TR>
</TABLE>

<?
IF($pages > 1)
	{Navigation();}
?>
