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

IF($VA_setup['pi_plug_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['nick']) {
	$DB_hub->Query("DELETE FROM pi_plug WHERE nick = '".$_POST['nick']."'");
	}
?>

<FONT class="h2"><?Print $text_pi_plug;?></FONT>

<BR><BR>

<?
IF(!IsSet($_GET['page']))
	$_GET['page'] = 1;
IF(!IsSet($_GET['orderby']))
	$_GET['orderby'] = $VA_setup['pi_plug_order_by'];

IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
	{
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "pi_plug", $_GET['filter_colum']);
	
	$query = " WHERE `".$DB_hub->Real_Escape_String($_GET['filter_colum'])."` LIKE '";
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "ends")
		{$query .= "%";}
	$query .= $DB_hub->Real_Escape_String($_GET['filter']);
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}

$result = $DB_hub->Query("SELECT Count(nick) AS `count` FROM pi_plug".$query);
$count = $result->Fetch_Assoc();
$total = $count['count'];
$result->Free_Result();
$pages = (int)(($total - 1) / $VA_setup['pi_plug_results']) + 1;
$first = $VA_setup['pi_plug_results'] * ($_GET['page'] - 1);

$colums = $VA_setup['pi_plug_nick'] + $VA_setup['pi_plug_path'];
$colums += $VA_setup['pi_plug_dest'] + $VA_setup['pi_plug_detail'];
$colums += $VA_setup['pi_plug_autoload'] + $VA_setup['pi_plug_reload'];
$colums += $VA_setup['pi_plug_unload'] + $VA_setup['pi_plug_error'];
$colums += $VA_setup['pi_plug_lastload'] + 2;

$query = "SELECT * FROM pi_plug".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['pi_plug_results'];
IF($debug[2]) {
	VA_Message($query, "bohyn32");
	Print "<BR>";
	}

IF($pages > 1)
	{Navigation();}
?>

<TABLE class="fs9px b1">
	<TR>
		<FORM action="index.php?<?Print Change_URL_Query("q", "editplugin");?>" method="post">
		<TD class="bg_light" colspan=<?Print $colums;?>><INPUT type="submit" value="<?Print $text_add_new_plugin;?>"></TD>
		</FORM>
	</TR><TR>
		<FORM aciton="index.php" method="get">
		<TD class="bg_light right" colspan=<?Print $colums;?> nowrap>
			<INPUT name="q" type="hidden" value="pi_plug">
			<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum">
				<OPTION> </OPTION>
				<OPTION value="nick"<?IF($_GET['filter_colum'] == "nick"){Print " selected";}?>><?Print $text_nick;?></OPTION>
				<OPTION value="path"<?IF($_GET['filter_colum'] == "path"){Print " selected";}?>><?Print $text_path;?></OPTION>
				<OPTION value="dest"<?IF($_GET['filter_colum'] == "dest"){Print " selected";}?>><?Print $text_dest;?></OPTION>
				<OPTION value="detail"<?IF($_GET['filter_colum'] == "detail"){Print " selected";}?>><?Print $text_detail;?></OPTION>
				<OPTION value="autoload"<?IF($_GET['filter_colum'] == "autoload"){Print " selected";}?>><?Print $text_autoload;?></OPTION>
				<OPTION value="reload"<?IF($_GET['filter_colum'] == "reload"){Print " selected";}?>><?Print $text_reload;?></OPTION>
				<OPTION value="unload"<?IF($_GET['filter_colum'] == "unload"){Print " selected";}?>><?Print $text_unload;?></OPTION>
				<OPTION value="error"<?IF($_GET['filter_colum'] == "error"){Print " selected";}?>><?Print $text_error;?></OPTION>
				<OPTION value="lastload"<?IF($_GET['filter_colum'] == "lastload"){Print " selected";}?>><?Print $text_lastload;?></OPTION>
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
		<?IF($VA_setup['pi_plug_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['pi_plug_path']){?><TD class="b bg_light" nowrap><?Print $text_path; PrintOrderBy("path");?></TD><?}?>
		<?IF($VA_setup['pi_plug_dest']){?><TD class="b bg_light" nowrap><?Print $text_dest; PrintOrderBy("dest");?></TD><?}?>
		<?IF($VA_setup['pi_plug_detail']){?><TD class="b bg_light" nowrap><?Print $text_detail; PrintOrderBy("detail");?></TD><?}?>
		<?IF($VA_setup['pi_plug_autoload']){?><TD class="b bg_light" nowrap><?Print $text_autoload; PrintOrderBy("autoload");?></TD><?}?>
		<?IF($VA_setup['pi_plug_reload']){?><TD class="b bg_light" nowrap><?Print $text_reload; PrintOrderBy("reload");?></TD><?}?>
		<?IF($VA_setup['pi_plug_unload']){?><TD class="b bg_light" nowrap><?Print $text_unload; PrintOrderBy("unload");?></TD><?}?>
		<?IF($VA_setup['pi_plug_error']){?><TD class="b bg_light" nowrap><?Print $text_error; PrintOrderBy("error");?></TD><?}?>
		<?IF($VA_setup['pi_plug_lastload']){?><TD class="b bg_light" nowrap><?Print $text_lastload; PrintOrderBy("lastload");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{?>
		<TR>
			<FORM action="index.php?<?Print Change_URL_Query("q", "editplugin");?>" method="post">
				<INPUT name="nick" type="hidden" value="<?Print $row['nick'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['pi_plug_edit_class'] <= USR_CLASS) {?>
					<A href="index.php?<?Print Change_URL_Query("q", "editplugin", "nick", $row['nick']);?>">
						<IMG src="img/edit_off.gif" title="<?Print $text_edit;?>" width=16 height=16 id="<?Print $row['nick'];?>" onMouseOver="ChangeImg('<?Print $row['nick'];?>', 'img/edit_on.gif');" onMouseOut="ChangeImg('<?Print $row['nick'];?>', 'img/edit_off.gif');">
					</A>
					<?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

			<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
				<INPUT name="nick" type="hidden" value="<?Print $row['nick'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['pi_plug_edit_class'] <= USR_CLASS){?><INPUT type="image" src="img/delete.gif" title="<?Print $text_delete;?>" class="b0"><?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

//         		<?IF($VA_setup['pi_plug_nick']){?><TD class="bg_light"><?Print "<a href=\"index.php?q=pi_".$row['nick']."\">".$row['nick']."</a>";?></TD><?}?>
         		<?IF($VA_setup['pi_plug_nick']){?><TD class="bg_light"><?Print $row['nick'];?></TD><?}?>
           		<?IF($VA_setup['pi_plug_path']){?><TD class="bg_light"><?Print $row['path'];?></TD><?}?>
             		<?IF($VA_setup['pi_plug_dest']){?><TD class="bg_light"><?Print $row['dest'];?></TD><?}?>
               		<?IF($VA_setup['pi_plug_detail']){?><TD class="bg_light"><?Print $row['detail'];?></TD><?}?>
                 	<?IF($VA_setup['pi_plug_autoload']){?><TD class="bg_light"><?IF($row['autoload']) Print "yes"; ELSE Print "no";?></TD><?}?>
                   	<?IF($VA_setup['pi_plug_reload']){?><TD class="bg_light"><?IF($row['reload']) Print "yes"; ELSE Print "no";?></TD><?}?>
                     	<?IF($VA_setup['pi_plug_unload']){?><TD class="bg_light"><?IF($row['unload']) Print "yes"; ELSE Print "no";?></TD><?}?>
                       	<?IF($VA_setup['pi_plug_error']){?><TD class="bg_light"><?Print $row['error'];?></TD><?}?>
                        <?IF($VA_setup['pi_plug_lastload']){?><TD class="bg_light"><?Print Date($VA_setup['timedate_format'], $row['lastload']);?></TD><?}?>
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
		<?IF($VA_setup['pi_plug_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['pi_plug_path']){?><TD class="b bg_light" nowrap><?Print $text_path; PrintOrderBy("path");?></TD><?}?>
		<?IF($VA_setup['pi_plug_dest']){?><TD class="b bg_light" nowrap><?Print $text_dest; PrintOrderBy("dest");?></TD><?}?>
		<?IF($VA_setup['pi_plug_detail']){?><TD class="b bg_light" nowrap><?Print $text_detail; PrintOrderBy("detail");?></TD><?}?>
		<?IF($VA_setup['pi_plug_autoload']){?><TD class="b bg_light" nowrap><?Print $text_autoload; PrintOrderBy("autoload");?></TD><?}?>
		<?IF($VA_setup['pi_plug_reload']){?><TD class="b bg_light" nowrap><?Print $text_reload; PrintOrderBy("reload");?></TD><?}?>
		<?IF($VA_setup['pi_plug_unload']){?><TD class="b bg_light" nowrap><?Print $text_unload; PrintOrderBy("unload");?></TD><?}?>
		<?IF($VA_setup['pi_plug_error']){?><TD class="b bg_light" nowrap><?Print $text_error; PrintOrderBy("error");?></TD><?}?>
		<?IF($VA_setup['pi_plug_lastload']){?><TD class="b bg_light" nowrap><?Print $text_lastload; PrintOrderBy("lastload");?></TD><?}?>
	</TR>
</TABLE>

<?
IF($pages > 1)
	{Navigation();}
?>
