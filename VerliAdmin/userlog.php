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

IF($VA_setup['userlog_min_class'] > USR_CLASS)
	{Die(VA_Error($err_msg_no_access));}
?>

<FONT class="h2"><?Print $text_userlog;?></FONT>

<BR><BR>

<?
IF($_GET['page'] == ""){$_GET['page'] = 1;}
IF($_GET['orderby'] == ""){$_GET['orderby'] = $VA_setup['userlog_order_by'];}

IF($_GET['filter'] != "" && $_GET['filter_colum'] && $_GET['filter_type']) {
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "pi_iplog", $_GET['filter_colum']);
	
	IF($_GET['filter_colum'] == "date")
		{$filter = DateToInt($_GET['filter']);}
	ELSE
		{$filter = $_GET['filter'];}
	
	IF($_GET['filter_type'] == "less")
		{$query = " WHERE `".$_GET['filter_colum']."` < '";}
	ELSEIF($_GET['filter_type'] == "greater")
		{$query = " WHERE `".$_GET['filter_colum']."` > '";}
	ELSE
		{$query = " WHERE `".$_GET['filter_colum']."` LIKE '";}

	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "ends")
		{$query .= "%";}
	$query .= $DB_hub->Rela_Escape_String($filter);
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}

$result = $DB_hub->Query("SELECT Count(ip) AS `count` FROM `pi_iplog`".$query);
$count = $result->Fetch_Assoc();
$result->Free_Result();
$total = $count['count'];
$pages = (int)(($total - 1) / $VA_setup['userlog_results']) + 1;
$first = $VA_setup['userlog_results'] * ($_GET['page'] - 1);

$colums  = $VA_setup['userlog_id'] + $VA_setup['userlog_date'];
$colums += $VA_setup['userlog_action'] + $VA_setup['userlog_ip'];
$colums += $VA_setup['userlog_nick'] + $VA_setup['userlog_info'];

$query = "SELECT * FROM pi_iplog".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['userlog_results'];
IF($debug[2]) {
	VA_Message($query, "bohyn32");
	Print "<BR>";
	}

IF($pages > 1)
	{Navigation();}
?>

<TABLE class="fs9px b1">
	<TR><FORM action="index.php" method="get">
		<TD colspan=<?Print $colums;?> align="right" class="bg_light" nowrap>
			<FONT class="b"><?Print $text_filter;?> : </FONT>
			<INPUT name="q" type="hidden" value="userlog">
			<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
			<INPUT name="filter_active" id="filter_active" type="checkbox" value=1<?IF($_GET['filter_active']){Print " checked";} IF($_COOKIE['brwsr_tp'] != "Opera"){Print " class=\"b0\"";}?>><LABEL for="filter_active"><?Print $text_active_kicks;?></LABEL>&nbsp;&nbsp;
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum" size=1>
				<OPTION></OPTION>
				<OPTION value="id"<?IF($_GET['filter_colum'] == "id"){Print " selected";}?>><?Print $text_id;?></OPTION>
				<OPTION value="date"<?IF($_GET['filter_colum'] == "date"){Print " selected";}?>><?Print $text_date;?></OPTION>
				<OPTION value="nick"<?IF($_GET['filter_colum'] == "nick"){Print " selected";}?>><?Print $text_nick;?></OPTION>
				<OPTION value="ip"<?IF($_GET['filter_colum'] == "ip"){Print " selected";}?>><?Print $text_ip;?></OPTION>
<!--			<OPTION value="action"<?IF($_GET['filter_colum'] == "action"){Print " selected";}?>><?Print $text_action;?></OPTION>
				<OPTION value="info"<?IF($_GET['filter_colum'] == "info"){Print " selected";}?>><?Print $text_info;?></OPTION>-->
			</SELECT>
			&nbsp;&nbsp;
			<SELECT name="filter_type" size=1>
				<OPTION></OPTION>
				<OPTION value="contains"<?IF($_GET['filter_type'] == "contains"){Print " selected";}?>><?Print $text_contains;?></OPTION>
				<OPTION value="equal"<?IF($_GET['filter_type'] == "equal"){Print " selected";}?>><?Print $text_equal;?></OPTION>
				<OPTION value="begins"<?IF($_GET['filter_type'] == "begins"){Print " selected";}?>><?Print $text_begins;?></OPTION>
				<OPTION value="ends"<?IF($_GET['filter_type'] == "ends"){Print " selected";}?>><?Print $text_ends;?></OPTION>
				<OPTION value="greater"<?IF($_GET['filter_type'] == "greater"){Print " selected";}?>><?Print $text_greater;?></OPTION>
				<OPTION value="less"<?IF($_GET['filter_type'] == "less"){Print " selected";}?>><?Print $text_less;?></OPTION>
			</SELECT>
			&nbsp;&nbsp;
			<FONT class="b"><?Print $text_filter;?> : </FONT>
			<INPUT name="filter" type="text" size=35 value="<?Print $_GET['filter'];?>" class="12px">
			<INPUT type="submit" class="12px" value="<?Print $text_show;?>">
		</TD></FORM>
	</TR><TR>
		<?IF($VA_setup['userlog_id']){?><TD align="right" class="b bg_light" nowrap><?Print $text_id; PrintOrderBy("id");?></TD><?}?>
		<?IF($VA_setup['userlog_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['userlog_ip']){?><TD class="b bg_light" nowrap><?Print $text_ip; PrintOrderBy("ip");?></TD><?}?>
		<?IF($VA_setup['userlog_date']){?><TD class="b bg_light" nowrap><?Print $text_date; PrintOrderBy("date");?></TD><?}?>
		<?IF($VA_setup['userlog_action']){?><TD class="b bg_light" nowrap><?Print $text_action; PrintOrderBy("action");?></TD><?}?>
		<?IF($VA_setup['userlog_info']){?><TD class="b bg_light" nowrap><?Print $text_info; PrintOrderBy("info");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{
		$row['nick'] = HTMLSpecialChars($row['nick']);
		?>
		<TR>
			<?IF($VA_setup['userlog_id']){?><TD align="right" class="bg_light"><?Print $row['id'];?></TD><?}?>
			<?IF($VA_setup['userlog_nick']){?><TD class="bg_light"><?Print $row['nick'];?></TD><?}?>
			<?IF($VA_setup['userlog_ip']){?><TD class="bg_light"><?Print $row['ip'];?></TD><?}?>
			<?IF($VA_setup['userlog_date']){?><TD class="bg_light"><?Print Date($VA_setup['timedate_format'], $row['date']);?></TD><?}?>
			<?IF($VA_setup['userlog_action']) {?>
				<TD class="bg_light">
					<?$action = "text_action_".$row['action'];
					Print $$action;?>
				</TD>
				<?}?>
			<?IF($VA_setup['userlog_info']) {?>
				<TD class="bg_light">
					<?$info = "text_info_".$row['info'];
					Print $$info;?>
				</TD>
				<?}?>
		</TR>
	<?	}
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
		<?IF($VA_setup['userlog_id']){?><TD align="right" class="b bg_light" nowrap><?Print $text_id; PrintOrderBy("id");?></TD><?}?>
		<?IF($VA_setup['userlog_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['userlog_ip']){?><TD class="b bg_light" nowrap><?Print $text_ip; PrintOrderBy("ip");?></TD><?}?>
		<?IF($VA_setup['userlog_date']){?><TD class="b bg_light" nowrap><?Print $text_date; PrintOrderBy("date");?></TD><?}?>
		<?IF($VA_setup['userlog_action']){?><TD class="b bg_light" nowrap><?Print $text_action; PrintOrderBy("action");?></TD><?}?>
		<?IF($VA_setup['userlog_info']){?><TD class="b bg_light" nowrap><?Print $text_info; PrintOrderBy("info");?></TD><?}?>
	</TR>
</TABLE>

<?
IF($pages > 1)
	{Navigation();}
?>
