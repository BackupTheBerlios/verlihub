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

IF($VA_setup['pi_forbid_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['word']) {
	$DB_hub->Query("DELETE FROM pi_forbid WHERE word = '".$_POST['word']."'");
	}
?>

<FONT class="h2"><?Print $text_pi_forbid;?></FONT>

<BR><BR>

<?
IF(!IsSet($_GET['page']))
	$_GET['page'] = 1;
IF(!IsSet($_GET['orderby']))
	$_GET['orderby'] = $VA_setup['pi_forbid_order_by'];

IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
	{
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "pi_forbid", $_GET['filter_colum']);

	$query = " WHERE `".$DB_hub->Real_Escape_String($_GET['filter_colum'])."` LIKE '";
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "ends")
		{$query .= "%";}
	$query .= $DB_hub->Real_Escape_String($_GET['filter']);
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}

$result = $DB_hub->Query("SELECT Count(word) AS `count` FROM pi_forbid".$query);
$count = $result->Fetch_Assoc();
$total = $count['count'];
$result->Free_Result();
$pages = (int)(($total - 1) / $VA_setup['pi_forbid_results']) + 1;
$first = $VA_setup['pi_forbid_results'] * ($_GET['page'] - 1);

$colums = $VA_setup['pi_forbid_word'] + $VA_setup['pi_forbid_check_mask'];
$colums += $VA_setup['pi_forbid_afclass'] + $VA_setup['pi_forbid_banreason'] + 2;

$query = "SELECT * FROM pi_forbid".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['pi_forbid_results'];

IF($pages > 1)
	{Navigation();}
?>

<TABLE class="fs9px b1">
	<TR>
		<FORM action="index.php?<?Print Change_URL_Query("q", "editforbid");?>" method="post">
		<TD class="bg_light" colspan=<?Print $colums;?>><INPUT type="submit" value="<?Print $text_add_new_word;?>"></TD>
		</FORM>
	</TR><TR>
		<FORM aciton="index.php" method="get">
		<TD class="bg_light right" colspan=<?Print $colums;?> nowrap>
			<INPUT name="q" type="hidden" value="pi_forbid">
			<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum">
				<OPTION> </OPTION>
				<OPTION value="word"<?IF($_GET['filter_colum'] == "word"){Print " selected";}?>><?Print $text_word;?></OPTION>
				<OPTION value="check_mask"<?IF($_GET['filter_colum'] == "check_mask"){Print " selected";}?>><?Print $text_check_mask;?></OPTION>
				<OPTION value="afclass"<?IF($_GET['filter_colum'] == "afclass"){Print " selected";}?>><?Print $text_afclass;?></OPTION>
				<OPTION value="banreason"<?IF($_GET['filter_colum'] == "banreason"){Print " selected";}?>><?Print $text_banreason;?></OPTION>
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
		<?IF($VA_setup['pi_forbid_word']){?><TD class="b bg_light" nowrap><?Print $text_word; PrintOrderBy("word");?></TD><?}?>
		<?IF($VA_setup['pi_forbid_check_mask']){?><TD class="b bg_light" nowrap><?Print $text_check_mask; PrintOrderBy("check_mask");?></TD><?}?>
		<?IF($VA_setup['pi_forbid_afclass']){?><TD class="b bg_light" nowrap><?Print $text_afclass; PrintOrderBy("afclass");?></TD><?}?>
		<?IF($VA_setup['pi_forbid_banreason']){?><TD class="b bg_light" nowrap><?Print $text_banreason; PrintOrderBy("banreason");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{?>
		<TR>
			<FORM action="index.php?<?Print Change_URL_Query("q", "editforbid");?>" method="post">
				<INPUT name="word" type="hidden" value="<?Print $row['word'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['pi_forbid_edit_class'] <= USR_CLASS) {?>
					<A href="index.php?<?Print Change_URL_Query("q", "editforbid", "word", $row['word']);?>">
						<IMG src="img/edit_off.gif" title="<?Print $text_edit;?>" width=16 height=16 id="<?Print $row['word'];?>" onMouseOver="ChangeImg('<?Print $row['word'];?>', 'img/edit_on.gif');" onMouseOut="ChangeImg('<?Print $row['word'];?>', 'img/edit_off.gif');">
					</A>
					<?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

			<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
				<INPUT name="word" type="hidden" value="<?Print $row['word'];?>">
			<TD class="bg_light">
				<?IF($VA_setup['pi_forbid_edit_class'] <= USR_CLASS){?><INPUT type="image" src="img/delete.gif" title="<?Print $text_delete;?>" class="b0" onClick="return ConfirmLink(this, '<?Print $text_delword_confirm." ".$row['word']."?";?>')"><?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>

         		<?IF($VA_setup['pi_forbid_word']){?><TD class="bg_light"><?Print $row['word'];?></TD><?}?>
           		<?IF($VA_setup['pi_forbid_check_mask']){?><TD class="bg_light"><?Print $row['check_mask'];?></TD><?}?>
             		<?IF($VA_setup['pi_forbid_afclass']){?><TD class="bg_light"><?Print $row['afclass'];?></TD><?}?>
               		<?IF($VA_setup['pi_forbid_banreason']){?><TD class="bg_light"><?Print $row['banreason'];?></TD><?}?>
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
		<?IF($VA_setup['pi_forbid_word']){?><TD class="b bg_light" nowrap><?Print $text_word; PrintOrderBy("word");?></TD><?}?>
		<?IF($VA_setup['pi_forbid_check_mask']){?><TD class="b bg_light" nowrap><?Print $text_check_mask; PrintOrderBy("check_mask");?></TD><?}?>
		<?IF($VA_setup['pi_forbid_afclass']){?><TD class="b bg_light" nowrap><?Print $text_afclass; PrintOrderBy("afclass");?></TD><?}?>
		<?IF($VA_setup['pi_forbid_banreason']){?><TD class="b bg_light" nowrap><?Print $text_banreason; PrintOrderBy("banreason");?></TD><?}?>
	</TR>
</TABLE>

<?
IF($pages > 1)
	{Navigation();}
?>
