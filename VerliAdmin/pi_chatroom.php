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

IF($VA_setup['pi_chatroom_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['nick']) {
	$DB_hub->Query("DELETE FROM pi_chatroom WHERE nick = '".$_POST['nick']."'");
	}
?>

<FONT class="h2"><?Print $text_pi_chatroom;?></FONT>

<BR><BR>

<?
IF(!IsSet($_GET['page']))
	$_GET['page'] = 1;
IF(!IsSet($_GET['orderby']))
	$_GET['orderby'] = $VA_setup['pi_chatroom_order_by'];

IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
	{
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "pi_chatroom", $_GET['filter_colum']);

	$query = " WHERE `".$DB_hub->Real_Escape_String($_GET['filter_colum'])."` LIKE '";
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "ends")
		{$query .= "%";}
	$query .= $DB_hub->Real_Escape_String($_GET['filter']);
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}

$result = $DB_hub->Query("SELECT Count(nick) AS `count` FROM pi_chatroom".$query);
$count = $result->Fetch_Assoc();
$total = $count['count'];
$result->Free_Result();
$pages = (int)(($total - 1) / $VA_setup['pi_chatroom_results']) + 1;
$first = $VA_setup['pi_chatroom_results'] * ($_GET['page'] - 1);

$colums = $VA_setup['pi_chatroom_nick'] + $VA_setup['pi_chatroom_topic'];
$colums += $VA_setup['pi_chatroom_creator'] + $VA_setup['pi_chatroom_min_class'];
$colums += $VA_setup['pi_chatroom_auto_class_min'] + $VA_setup['pi_chatroom_auto_class_max'];
$colums += $VA_setup['pi_chatroom_auto_cc'] + 2;

$query = "SELECT * FROM pi_chatroom".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['pi_chatroom_results'];

IF($pages > 1)
	{Navigation();}
?>

<TABLE class="fs9px b1">
	<TR>
		<FORM action="index.php?<?Print Change_URL_Query("q", "editchatroom");?>" method="post">
		<TD class="bg_light" colspan=<?Print $colums;?>><INPUT type="submit" value="<?Print $text_add_new_room;?>"></TD>
		</FORM>
	</TR><TR>
		<FORM aciton="index.php" method="get">
		<TD class="bg_light right" colspan=<?Print $colums;?> nowrap>
			<INPUT name="q" type="hidden" value="pi_chatroom">
			<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum">
				<OPTION> </OPTION>
				<OPTION value="nick"<?IF($_GET['filter_colum'] == "nick"){Print " selected";}?>><?Print $text_nick;?></OPTION>
				<OPTION value="topic"<?IF($_GET['filter_colum'] == "topic"){Print " selected";}?>><?Print $text_topic;?></OPTION>
				<OPTION value="creator"<?IF($_GET['filter_colum'] == "creator"){Print " selected";}?>><?Print $text_creator;?></OPTION>
				<OPTION value="min_class"<?IF($_GET['filter_colum'] == "min_class"){Print " selected";}?>><?Print $text_min_class;?></OPTION>
				<OPTION value="auto_class_min"<?IF($_GET['filter_colum'] == "auto_class_min"){Print " selected";}?>><?Print $text_auto_class_min;?></OPTION>
				<OPTION value="auto_class_max"<?IF($_GET['filter_colum'] == "auto_class_max"){Print " selected";}?>><?Print $text_auto_class_max;?></OPTION>
				<OPTION value="auto_cc"<?IF($_GET['filter_colum'] == "auto_cc"){Print " selected";}?>><?Print $text_auto_cc;?></OPTION>
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
		<?IF($VA_setup['pi_chatroom_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_topic']){?><TD class="b bg_light" nowrap><?Print $text_topic; PrintOrderBy("topic");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_creator']){?><TD class="b bg_light" nowrap><?Print $text_creator; PrintOrderBy("creator");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_min_class']){?><TD class="b bg_light" nowrap><?Print $text_min_class; PrintOrderBy("min_class");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_auto_class_min']){?><TD class="b bg_light" nowrap><?Print $text_auto_class_min; PrintOrderBy("auto_class_min");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_auto_class_max']){?><TD class="b bg_light" nowrap><?Print $text_auto_class_max; PrintOrderBy("auto_class_max");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_auto_cc']){?><TD class="b bg_light" nowrap><?Print $text_auto_cc; PrintOrderBy("auto_cc");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{?>
		<TR>
			<FORM action="index.php?<?Print Change_URL_Query("q", "editchatroom");?>" method="post">
				<INPUT name="nick" type="hidden" value="<?Print $row['nick'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['pi_chatroom_edit_class'] <= USR_CLASS) {?>
					<A href="index.php?<?Print Change_URL_Query("q", "editchatroom", "nick", $row['nick']);?>">
						<IMG src="img/edit_off.gif" title="<?Print $text_edit;?>" width=16 height=16 id="<?Print $row['nick'];?>" onMouseOver="ChangeImg('<?Print $row['nick'];?>', 'img/edit_on.gif');" onMouseOut="ChangeImg('<?Print $row['nick'];?>', 'img/edit_off.gif');">
					</A>
					<?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

			<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
				<INPUT name="nick" type="hidden" value="<?Print $row['nick'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['pi_chatroom_edit_class'] <= USR_CLASS){?><INPUT type="image" src="img/delete.gif" title="<?Print $text_delete;?>" class="b0" onClick="return ConfirmLink(this, '<?Print $text_delroom_confirm." ".$row['nick']."?";?>')"><?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

         		<?IF($VA_setup['pi_chatroom_nick']){?><TD class="bg_light"><?Print $row['nick'];?></TD><?}?>
           		<?IF($VA_setup['pi_chatroom_topic']){?><TD class="bg_light"><?Print $row['topic'];?></TD><?}?>
             		<?IF($VA_setup['pi_chatroom_creator']){?><TD class="bg_light"><?Print $row['creator'];?></TD><?}?>
               		<?IF($VA_setup['pi_chatroom_min_class']){?><TD class="bg_light"><?Print $row['min_class'];?></TD><?}?>
                 	<?IF($VA_setup['pi_chatroom_auto_class_min']){?><TD class="bg_light"><? Print $row['auto_class_min'];?></TD><?}?>
                   	<?IF($VA_setup['pi_chatroom_auto_class_max']){?><TD class="bg_light"><? Print $row['auto_class_max'];?></TD><?}?>
                     	<?IF($VA_setup['pi_chatroom_auto_cc']){?><TD class="bg_light"><? Print $row['auto_cc'];?></TD><?}?>
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
		<?IF($VA_setup['pi_chatroom_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_topic']){?><TD class="b bg_light" nowrap><?Print $text_topic; PrintOrderBy("topic");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_creator']){?><TD class="b bg_light" nowrap><?Print $text_creator; PrintOrderBy("creator");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_min_class']){?><TD class="b bg_light" nowrap><?Print $text_min_class; PrintOrderBy("min_class");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_auto_class_min']){?><TD class="b bg_light" nowrap><?Print $text_auto_class_min; PrintOrderBy("auto_class_min");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_auto_class_max']){?><TD class="b bg_light" nowrap><?Print $text_auto_class_max; PrintOrderBy("auto_class_max");?></TD><?}?>
		<?IF($VA_setup['pi_chatroom_auto_cc']){?><TD class="b bg_light" nowrap><?Print $text_auto_cc; PrintOrderBy("auto_cc");?></TD><?}?>
	</TR>
</TABLE>

<?
IF($pages > 1)
	{Navigation();}
?>
