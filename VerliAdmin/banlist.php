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

IF($VA_setup['banlist_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}
?>

<FONT class="h2"><?Print $text_banlist;?></FONT>

<BR><BR>

<?
IF($_POST['age'] && $VA_setup['banlist_unban_class'] <= USR_CLASS) {
	$time = Time() - $_POST['age'];
	$DB_hub->Query("DELETE FROM banlist WHERE date_limit < ".$time);
	VA_Message($text_affected_rows." : ".$DB_hub->affected_rows, "info32");
	}

IF($_GET['page'] == ""){$_GET['page'] = 1;}
IF($_GET['orderby'] == ""){$_GET['orderby'] = $VA_setup['banlist_order_by'];}

IF($_GET['filter'] != "" && $_GET['filter_colum'] && $_GET['filter_type']) {
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "banlist", $_GET['filter_colum']);

	IF($_GET['filter_colum'] == "date_start" || $_GET['filter_colum'] == "date_limit")
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
	$query .= $DB_hub->Real_Escape_String($filter);
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}
IF($_GET['filter_active']) {
	IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
		{$query .= " AND";}
    ELSE
    	{$query = " WHERE";}
	$query .= " date_limit > ".Time();
	}

$result = $DB_hub->Query("SELECT Count(ip) AS `count` FROM `banlist`".$query);
$count = $result->Fetch_Assoc();
$result->Free_Result();
$total = $count['count'];
$pages = (int)(($total - 1) / $VA_setup['banlist_results']) + 1;
$first = $VA_setup['banlist_results'] * ($_GET['page'] - 1);

$colums = $VA_setup['banlist_ban_type'] + $VA_setup['banlist_ip'] + $VA_setup['banlist_nick'];
$colums += $VA_setup['banlist_host'] + $VA_setup['banlist_share_size'] + $VA_setup['banlist_email'];
$colums += $VA_setup['banlist_range_fr'] + $VA_setup['banlist_range_to'] + $VA_setup['banlist_date_start'];
$colums += $VA_setup['banlist_date_limit'] + $VA_setup['banlist_nick_op'] + $VA_setup['banlist_reason'];
$colums++;

$query  = "SELECT * FROM banlist".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['banlist_results'];
IF($debug[2]) {
	VA_Message($query, "bohyn32");
	Print "<BR>";
	}

IF($pages > 1)
	{Navigation();}
?>

<?IF($VA_setup['banlist_unban_class'] <= USR_CLASS) {?>
<FORM action="index.php?<?Print Change_URL_Query("page", "");?>" method="post">
<TABLE class="fs9px b1">
	<TR>
		<TD class="bg_light right b">&nbsp;<?Print $text_del_old_bans;?>&nbsp;:&nbsp;</TD>
		<TD class="bg_light">
			<INPUT name="age" type="text" size=4>
			<?Print $text_days;?>
			<INPUT class="w75px" name="del_old" type="submit" value="<?Print $text_delete;?>">
		</TD>
	</TR>
</TABLE>
</FORM>
<?}?>

<BR>

<TABLE class="fs9px b1">
	<TR><FORM action="index.php" method="get">
		<TD colspan=<?Print $colums;?> align="right" class="bg_light" nowrap>
			<FONT class="b"><?Print $text_filter;?> : </FONT>
			<INPUT name="q" type="hidden" value="banlist">
			<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
			<INPUT name="filter_active" id="filter_active" type="checkbox" value=1<?IF($_GET['filter_active']){Print " checked";} IF($_COOKIE['brwsr_tp'] != "Opera"){Print " class=\"b0\"";}?>><LABEL for="filter_active"><?Print $text_active_kicks;?></LABEL>&nbsp;&nbsp;
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum" size=1>
				<OPTION></OPTION>
				<OPTION value="ban_type"<?IF($_GET['filter_colum'] == "ban_type"){Print " selected";}?>><?Print $text_ban_type;?></OPTION>
				<OPTION value="ip"<?IF($_GET['filter_colum'] == "ip"){Print " selected";}?>><?Print $text_ip;?></OPTION>
				<OPTION value="nick"<?IF($_GET['filter_colum'] == "nick"){Print " selected";}?>><?Print $text_nick;?></OPTION>
				<OPTION value="host"<?IF($_GET['filter_colum'] == "host"){Print " selected";}?>><?Print $text_host;?></OPTION>
				<OPTION value="share_size"<?IF($_GET['filter_colum'] == "share_size"){Print " selected";}?>><?Print $text_share_size;?></OPTION>
				<OPTION value="email"<?IF($_GET['filter_colum'] == "email"){Print " selected";}?>><?Print $text_email;?></OPTION>
				<OPTION value="date_start"<?IF($_GET['filter_colum'] == "date_start"){Print " selected";}?>><?Print $text_date_start;?></OPTION>
				<OPTION value="date_limit"<?IF($_GET['filter_colum'] == "date_limit"){Print " selected";}?>><?Print $text_date_limit;?></OPTION>
				<OPTION value="nick_op"<?IF($_GET['filter_colum'] == "nick_op"){Print " selected";}?>><?Print $text_ban_op;?></OPTION>
				<OPTION value="reason"<?IF($_GET['filter_colum'] == "reason"){Print " selected";}?>><?Print $text_reason;?></OPTION>
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
		<TD width=16 class="bg_light">&nbsp;</TD>
		<?IF($VA_setup['banlist_ban_type']){?><TD align="right" class="b bg_light" nowrap><?Print $text_ban_type; PrintOrderBy("ban_type");?></TD><?}?>
		<?IF($VA_setup['banlist_ip']){?><TD class="b bg_light" nowrap><?Print $text_ip; PrintOrderBy("ip");?></TD><?}?>
		<?IF($VA_setup['banlist_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['banlist_host']){?><TD class="b bg_light" nowrap><?Print $text_host; PrintOrderBy("host");?></TD><?}?>
		<?IF($VA_setup['banlist_share_size']){?><TD class="b bg_light" nowrap><?Print $text_share_size; PrintOrderBy("share_size");?></TD><?}?>
		<?IF($VA_setup['banlist_email']){?><TD class="b bg_light" nowrap><?Print $text_email; PrintOrderBy("email");?></TD><?}?>
		<?IF($VA_setup['banlist_range_fr']){?><TD class="b bg_light" nowrap><?Print $text_range_fr; PrintOrderBy("range_fr");?></TD><?}?>
		<?IF($VA_setup['banlist_range_to']){?><TD class="b bg_light" nowrap><?Print $text_range_to; PrintOrderBy("range_to");?></TD><?}?>
		<?IF($VA_setup['banlist_date_start']){?><TD class="b bg_light" nowrap><?Print $text_date_start; PrintOrderBy("date_start");?></TD><?}?>
		<?IF($VA_setup['banlist_date_limit']){?><TD class="b bg_light" nowrap><?Print $text_date_limit; PrintOrderBy("date_limit");?></TD><?}?>
		<?IF($VA_setup['banlist_nick_op']){?><TD class="b bg_light" nowrap><?Print $text_ban_op; PrintOrderBy("nick_op");?></TD><?}?>
		<?IF($VA_setup['banlist_reason']){?><TD class="b bg_light" nowrap><?Print $text_reason; PrintOrderBy("reason");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{
		$row['nick'] = HTMLSpecialChars($row['nick']);
		$row['email'] = HTMLSpecialChars($row['email']);
		$row['nick_op'] = HTMLSpecialChars($row['nick_op']);
		$row['reason'] = HTMLSpecialChars($row['reason']);
	
		$info =  $text_ban_type." : ".$row['ban_type']."<BR>";
		$info .= $text_ip." : ".$row['ip']."<BR>";
		$info .= $text_nick." : ".$row['nick']."<BR>";
		$info .= $text_host." : ".$row['host']."<BR>";
		$info .= $text_share_size." : ".Number_Format($row['share_size'])." (".RoundShare($row['share_size']).")<BR>";
		$info .= $text_email." : ".$row['email']."<BR>";
		$info .= $text_range_fr." : ".Get_IP_From_Range($row['range_fr'])."<BR>";
		$info .= $text_range_to." : ".Get_IP_From_Range($row['range_to'])."<BR>";
		$info .= $text_date_start." : ".Date($VA_setup['timedate_format'], $row['date_start'])."<BR>";
		IF($row['date_limit'] > 0)
			{$info .= $text_date_limit." : ".Date($VA_setup['timedate_format'], $row['date_limit'])."<BR>";}
		ELSE
			{$info .= $text_date_limit." : ".$text_permanent."<BR>";}
		$info .= $text_ban_op." : ".$row['nick_op']."<BR>";
		$info .= $text_reason." :<BR>".EregI_Replace("(\r)?\n", "<BR>", $row['reason']);
		?>
		<TR onmouseover="JavaScript: return escape('<?Print AddSlashes($info);?>');">
			<FORM action="index.php?<?Print Change_URL_Query("q", "unban");?>" method="post">
				<INPUT name="ip" type="hidden" value="<?Print $row['ip'];?>">
				<INPUT name="nick" type="hidden" value="<?Print $row['nick'];?>">
				<INPUT name="email" type="hidden" value="<?Print $row['email'];?>">
				<INPUT name="date_start" type="hidden" value="<?Print $row['date_start'];?>">
			<TD class="bg_light" width=16>
				<?IF((Time() < $row['date_limit'] || $row['date_limit'] == 0) && $VA_setup['banlist_unban_class'] <= USR_CLASS) {?>
					<INPUT type="image" src="img/unban.gif" title="<?Print $text_unban;?>" class="b0">
					<?}
				ELSE
					{?><IMG src="img/space.gif" width=16 height=16><?}
			IF($browser != "Mozilla") {Print "</TD>";}?>
			</FORM>
			
			<?IF($VA_setup['banlist_ban_type']){?><TD align="right" class="bg_light"><?Print $row['ban_type'];?></TD><?}?>
			<?IF($VA_setup['banlist_ip']){?><TD class="bg_light"><?Print $row['ip'];?></TD><?}?>
			<?IF($VA_setup['banlist_nick']){?><TD class="bg_light"><?Print $row['nick'];?></TD><?}?>
			<?IF($VA_setup['banlist_host']){?><TD class="bg_light"><?Print $row['host'];?></TD><?}?>
			<?IF($VA_setup['banlist_share_size']){?><TD align="right" class="bg_light"><?Print RoundShare($row['share_size']);?></TD><?}?>
			<?IF($VA_setup['banlist_email']){?><TD class="bg_light"><?Print $row['email'];?></TD><?}?>
			<?IF($VA_setup['banlist_range_fr']){?><TD align="right" class="bg_light"><?Print Get_IP_From_Range($row['range_fr']);?></TD><?}?>
			<?IF($VA_setup['banlist_range_to']){?><TD align="right" class="bg_light"><?Print Get_IP_From_Range($row['range_to']);?></TD><?}?>
			<?IF($VA_setup['banlist_date_start']){?><TD class="bg_light"><?Print Date($VA_setup['timedate_format'], $row['date_start']);?></TD><?}?>
			<?IF($VA_setup['banlist_date_limit']){?><TD class="bg_light"><?IF($row['date_limit'] > 0){Print Date($VA_setup['timedate_format'], $row['date_limit']);}ELSE{Print $text_permanent;}?></TD><?}?>
			<?IF($VA_setup['banlist_nick_op']){?><TD class="bg_light"><?Print $row['nick_op'];?></TD><?}?>
			<?IF($VA_setup['banlist_reason']){?><TD class="bg_light"><?Print nl2br($row['reason']);?></TD><?}?>
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
		<TD class="bg_light">&nbsp;</TD>
		<?IF($VA_setup['banlist_ban_type']){?><TD align="right" class="b bg_light" nowrap><?Print $text_ban_type; PrintOrderBy("ban_type");?></TD><?}?>
		<?IF($VA_setup['banlist_ip']){?><TD class="b bg_light" nowrap><?Print $text_ip; PrintOrderBy("ip");?></TD><?}?>
		<?IF($VA_setup['banlist_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['banlist_host']){?><TD class="b bg_light" nowrap><?Print $text_host; PrintOrderBy("host");?></TD><?}?>
		<?IF($VA_setup['banlist_share_size']){?><TD class="b bg_light" nowrap><?Print $text_share_size; PrintOrderBy("share_size");?></TD><?}?>
		<?IF($VA_setup['banlist_email']){?><TD class="b bg_light" nowrap><?Print $text_email; PrintOrderBy("email");?></TD><?}?>
		<?IF($VA_setup['banlist_range_fr']){?><TD class="b bg_light" nowrap><?Print $text_range_fr; PrintOrderBy("range_fr");?></TD><?}?>
		<?IF($VA_setup['banlist_range_to']){?><TD class="b bg_light" nowrap><?Print $text_range_to; PrintOrderBy("range_to");?></TD><?}?>
		<?IF($VA_setup['banlist_date_start']){?><TD class="b bg_light" nowrap><?Print $text_date_start; PrintOrderBy("date_start");?></TD><?}?>
		<?IF($VA_setup['banlist_date_limit']){?><TD class="b bg_light" nowrap><?Print $text_date_limit; PrintOrderBy("date_limit");?></TD><?}?>
		<?IF($VA_setup['banlist_nick_op']){?><TD class="b bg_light" nowrap><?Print $text_ban_op; PrintOrderBy("nick_op");?></TD><?}?>
		<?IF($VA_setup['banlist_reason']){?><TD class="b bg_light" nowrap><?Print $text_reason; PrintOrderBy("reason");?></TD><?}?>
	</TR>
</TABLE>

<SCRIPT language="JavaScript" type="text/javascript" src="js/tooltip.js"></script>

<?
IF($pages > 1)
	{Navigation();}
?>
