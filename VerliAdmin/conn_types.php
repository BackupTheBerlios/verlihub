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

IF($VA_setup['conn_types_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['identifier']) {
	$DB_hub->Query("DELETE FROM conn_types WHERE identifier = '".$_POST['identifier']."'");
	}
?>

<FONT class="h2"><?Print $text_conn_types;?></FONT>

<BR><BR>

<?
IF(!IsSet($_GET['page']))
	$_GET['page'] = 1;
IF(!IsSet($_GET['orderby']))
	$_GET['orderby'] = $VA_setup['conn_types_order_by'];

IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
	{
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "conn_types", $_GET['filter_colum']);

	$query = " WHERE `".$DB_hub->Real_Escape_String($_GET['filter_colum'])."` LIKE '";
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "ends")
		{$query .= "%";}
	$query .= $DB_hub->Real_Escape_String($_GET['filter']);
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}

$result = $DB_hub->Query("SELECT Count(identifier) AS `count` FROM conn_types".$query);
$count = $result->Fetch_Assoc();
$total = $count['count'];
$result->Free_Result();
$pages = (int)(($total - 1) / $VA_setup['conn_types_results']) + 1;
$first = $VA_setup['conn_types_results'] * ($_GET['page'] - 1);

$colums = $VA_setup['conn_types_identifier'] + $VA_setup['conn_types_description'];
$colums += $VA_setup['conn_types_tag_min_slots'] + $VA_setup['conn_types_tag_max_slots'];
$colums += $VA_setup['conn_types_tag_min_limit'] + $VA_setup['conn_types_tag_min_ls_ratio']+2;


$query = "SELECT * FROM conn_types".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['conn_types_results'];
IF($debug[2]) {
	VA_Message($query, "bohyn32");
	Print "<BR>";
	}

IF($pages > 1)
	{Navigation();}
?>

<TABLE class="fs9px b1">
	<TR>
		<FORM action="index.php?<?Print Change_URL_Query("q", "edittype");?>" method="post">
		<TD class="bg_light" colspan=<?Print $colums;?>><INPUT type="submit" value="<?Print $text_add_new_type;?>"></TD>
		</FORM>
	</TR><TR>
		<FORM aciton="index.php" method="get">
		<TD class="bg_light right" colspan=<?Print $colums;?> nowrap>
			<INPUT name="q" type="hidden" value="conn_types">
			<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum">
				<OPTION> </OPTION>
				<OPTION value="identifier"<?IF($_GET['filter_colum'] == "identifier"){Print " selected";}?>><?Print $text_identifier;?></OPTION>
				<OPTION value="description"<?IF($_GET['filter_colum'] == "description"){Print " selected";}?>><?Print $text_description;?></OPTION>
				<OPTION value="tag_min_slots"<?IF($_GET['filter_colum'] == "tag_min_slots"){Print " selected";}?>><?Print $text_tag_min_slots;?></OPTION>
				<OPTION value="tag_max_slots"<?IF($_GET['filter_colum'] == "tag_max_slots"){Print " selected";}?>><?Print $text_tag_max_slots;?></OPTION>
				<OPTION value="tag_min_limit"<?IF($_GET['filter_colum'] == "tag_min_limit"){Print " selected";}?>><?Print $text_tag_min_limit;?></OPTION>
				<OPTION value="tag_min_ls_ratio"<?IF($_GET['filter_colum'] == "tag_min_ls_ratio"){Print " selected";}?>><?Print $text_tag_min_ls_ratio;?></OPTION>
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
		<?IF($VA_setup['conn_types_identifier']){?><TD class="b bg_light" nowrap><?Print $text_identifier; PrintOrderBy("identifier");?></TD><?}?>
		<?IF($VA_setup['conn_types_description']){?><TD class="b bg_light" nowrap><?Print $text_description; PrintOrderBy("description");?></TD><?}?>
		<?IF($VA_setup['conn_types_tag_min_slots']){?><TD class="b bg_light" nowrap><?Print $text_tag_min_slots; PrintOrderBy("tag_min_slots");?></TD><?}?>
		<?IF($VA_setup['conn_types_tag_max_slots']){?><TD class="b bg_light" nowrap><?Print $text_tag_max_slots; PrintOrderBy("tag_max_slots");?></TD><?}?>
		<?IF($VA_setup['conn_types_tag_min_limit']){?><TD class="b bg_light" nowrap><?Print $text_tag_min_limit; PrintOrderBy("tag_min_limit");?></TD><?}?>
		<?IF($VA_setup['conn_types_tag_min_ls_ratio']){?><TD class="b bg_light" nowrap><?Print $text_tag_min_ls_ratio; PrintOrderBy("tag_mi_ls_ratio");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{?>
		<TR>
			<FORM action="index.php?<?Print Change_URL_Query("q", "editplugin");?>" method="post">
				<INPUT name="identifier" type="hidden" value="<?Print $row['identifier'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['conn_types_edit_class'] <= USR_CLASS) {?>
					<A href="index.php?<?Print Change_URL_Query("q", "edittype", "identifier", $row['identifier']);?>">
						<IMG src="img/edit_off.gif" title="<?Print $text_edit;?>" width=16 height=16 id="<?Print $row['identifier'];?>" onMouseOver="ChangeImg('<?Print $row['identifier'];?>', 'img/edit_on.gif');" onMouseOut="ChangeImg('<?Print $row['identifier'];?>', 'img/edit_off.gif');">
					</A>
					<?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

			<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
				<INPUT name="identifier" type="hidden" value="<?Print $row['identifier'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['conn_types_edit_class'] <= USR_CLASS){?><INPUT type="image" src="img/delete.gif" title="<?Print $text_delete;?>" class="b0" onClick="return ConfirmLink(this, '<?Print $text_deltype_confirm." ".$row['identifier']."?";?>')"><?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

         		<?IF($VA_setup['conn_types_identifier']){?><TD class="bg_light"><?Print $row['identifier'];?></TD><?}?>
           		<?IF($VA_setup['conn_types_description']){?><TD class="bg_light"><?Print $row['description'];?></TD><?}?>
             		<?IF($VA_setup['conn_types_tag_min_slots']){?><TD class="bg_light"><?Print $row['tag_min_slots'];?></TD><?}?>
               		<?IF($VA_setup['conn_types_tag_max_slots']){?><TD class="bg_light"><?Print $row['tag_max_slots'];?></TD><?}?>
                 	<?IF($VA_setup['conn_types_tag_min_limit']){?><TD class="bg_light"><?Print $row['tag_min_limit'];?></TD><?}?>
                   	<?IF($VA_setup['conn_types_tag_min_ls_ratio']){?><TD class="bg_light"><?Print $row['tag_min_ls_ratio'];?></TD><?}?>
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
		<?IF($VA_setup['conn_types_identifier']){?><TD class="b bg_light" nowrap><?Print $text_identifier; PrintOrderBy("identifier");?></TD><?}?>
		<?IF($VA_setup['conn_types_description']){?><TD class="b bg_light" nowrap><?Print $text_description; PrintOrderBy("description");?></TD><?}?>
		<?IF($VA_setup['conn_types_tag_min_slots']){?><TD class="b bg_light" nowrap><?Print $text_tag_min_slots; PrintOrderBy("tag_min_slots");?></TD><?}?>
		<?IF($VA_setup['conn_types_tag_max_slots']){?><TD class="b bg_light" nowrap><?Print $text_tag_max_slots; PrintOrderBy("tag_max_slots");?></TD><?}?>
		<?IF($VA_setup['conn_types_tag_min_limit']){?><TD class="b bg_light" nowrap><?Print $text_tag_min_limit; PrintOrderBy("tag_min_limit");?></TD><?}?>
		<?IF($VA_setup['conn_types_tag_min_ls_ratio']){?><TD class="b bg_light" nowrap><?Print $text_tag_min_ls_ratio; PrintOrderBy("tag_mi_ls_ratio");?></TD><?}?>
	</TR>
</TABLE>

<?
IF($pages > 1)
	{Navigation();}
?>
