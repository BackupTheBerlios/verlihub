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

======================================================================
*/

IF($VA_setup['kicklist_min_class'] > USR_CLASS)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['nick'] && $_POST['time']) {
	IF($VA_setup['kicklist_unban_class'] <= USR_CLASS) {
		$DB_hub->Query("DELETE FROM kicklist WHERE nick='".$_POST['nick']."' AND time=".$_POST['time']);
		IF($VA_setup['log_unkick']) {
			$action = "Unkicked ".$_POST['nick'];
			LogFile(USR_NICK, USR_CLASS, $action, "unkick");
		}
	}
	ELSE
		{Die(VA_Message($err_msg_no_access, "error"));}
}?>

<FONT class="h2"><?Print $text_kicklist;?></FONT>

<BR><BR>

<?
IF($_POST['age'] && $VA_setup['kicklist_unkick_class'] <= USR_CLASS) {
	$time = Time() - ($_POST['age'] * 24 * 3600);
	$DB_hub->Query("DELETE FROM kicklist WHERE time < ".$time);
	VA_Message($text_affected_rows." : ".VA_Affected_Rows($DB_hub), "info32");
}

IF($_GET['page'] == ""){$_GET['page'] = 1;}
IF($_GET['orderby'] == ""){$_GET['orderby'] = $VA_setup['kicklist_order_by'];}

IF($_GET['filter'] != "" && $_GET['filter_colum'] != "") {
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "kicklist", $_GET['filter_colum']);

	IF($_GET['filter_colum'] == "time")
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

$result = $DB_hub->Query("SELECT Count(ip) AS `count` FROM kicklist".$query);
$count = $result->Fetch_Assoc();
$total = $count['count'];
$result->Free_Result();
$pages = (int)(($total - 1) / $VA_setup['kicklist_results']) + 1;
$first = $VA_setup['kicklist_results'] * ($_GET['page'] - 1);

$colums  = $VA_setup['kicklist_nick'] + $VA_setup['kicklist_time'];
$colums += $VA_setup['kicklist_ip'] + $VA_setup['kicklist_host'];
$colums += $VA_setup['kicklist_share_size'] + $VA_setup['kicklist_email'];
$colums += $VA_setup['kicklist_op'] + $VA_setup['kicklist_reason'];

$query  = "SELECT * FROM kicklist".$query;
$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['kicklist_results'];
IF($debug[2]) {
	VA_Message($query, "bohyn32");
	Print "<BR>";
	}

IF($pages > 1)
	{Navigation();}

IF($VA_setup['kicklist_unkick_class'] <= USR_CLASS) {
?>
<FORM action="index.php?<?Print Change_URL_Query("page", "");?>" method="post">
<TABLE class="fs9px b1">
	<TR>
		<TD class="bg_light right b">&nbsp;<?Print $text_del_old_kicks;?>&nbsp;:&nbsp;</TD>
		<TD class="bg_light">
			<INPUT name="age" type="text" size=4>
			<?Print $text_days;?>
			<INPUT class="w75px" name="del_old" type="submit" value="<?Print $text_delete;?>">
		</TD>
	</TR>
</TABLE>
</FORM>
<BR>
<?}?>

<TABLE class="fs9px b1">
	<TR>
	<FORM action="index.php" method="get">
		<INPUT name="q" type="hidden" value="kicklist">
		<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
		<TD colspan=<?Print $colums;?> align="right" class="bg_light" nowrap>
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum" size=1>
				<OPTION></OPTION>
				<OPTION value="nick"<?IF($_GET['filter_colum'] == "nick"){Print " selected";}?>><?Print $text_nick;?></OPTION>
				<OPTION value="time"<?IF($_GET['filter_colum'] == "time"){Print " selected";}?>><?Print $text_time;?></OPTION>
				<OPTION value="ip"<?IF($_GET['filter_colum'] == "ip"){Print " selected";}?>><?Print $text_ip;?></OPTION>
				<OPTION value="host"<?IF($_GET['filter_colum'] == "host"){Print " selected";}?>><?Print $text_host;?></OPTION>
				<OPTION value="share_size"<?IF($_GET['filter_colum'] == "share_size"){Print " selected";}?>><?Print $text_share_size;?></OPTION>
				<OPTION value="email"<?IF($_GET['filter_colum'] == "email"){Print " selected";}?>><?Print $text_email;?></OPTION>
				<OPTION value="reason"<?IF($_GET['filter_colum'] == "reason"){Print " selected";}?>><?Print $text_reason;?></OPTION>
				<OPTION value="op"<?IF($_GET['filter_colum'] == "op"){Print " selected";}?>><?Print $text_op;?></OPTION>
				<OPTION value="is_drop"<?IF($_GET['filter_colum'] == "is_drop"){Print " selected";}?>><?Print $text_is_drop;?></OPTION>
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
			<INPUT name="filter" type="text" size=35 value="<?Print $_GET['filter'];?>" class="12px">
			<INPUT class="w75px" type="submit" value="<?Print $text_show;?>" class="12px">
		</TD></FORM>
	</TR><TR>
		<?IF($VA_setup['kicklist_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['kicklist_time']){?><TD class="b bg_light" nowrap><?Print $text_time; PrintOrderBy("time");?></TD><?}?>
		<?IF($VA_setup['kicklist_ip']){?><TD class="b bg_light" nowrap><?Print $text_ip; PrintOrderBy("ip");?></TD><?}?>
		<?IF($VA_setup['kicklist_host']){?><TD class="b bg_light" nowrap><?Print $text_host; PrintOrderBy("host");?></TD><?}?>
		<?IF($VA_setup['kicklist_share_size']){?><TD class="b bg_light" nowrap><?Print $text_share_size; PrintOrderBy("share_size");?></TD><?}?>
		<?IF($VA_setup['kicklist_email']){?><TD class="b bg_light" nowrap><?Print $text_email; PrintOrderBy("email");?></TD><?}?>
		<?IF($VA_setup['kicklist_reason']){?><TD class="b bg_light" nowrap><?Print $text_reason; PrintOrderBy("reason");?></TD><?}?>
		<?IF($VA_setup['kicklist_op']){?><TD class="b bg_light" nowrap><?Print $text_op; PrintOrderBy("op");?></TD><?}?>
		<?IF($VA_setup['kicklist_is_drop']){?><TD class="b bg_light" nowrap><?Print $text_is_drop; PrintOrderBy("is_drop");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{
		$row['nick'] = HTMLSpecialChars($row['nick']);
		$row['op'] = HTMLSpecialChars($row['op']);
		$row['reason'] = HTMLSpecialChars($row['reason']);
	
		$info = $text_nick." : ".$row['nick']."<BR>";
		$info .= $text_time." : ".Date($VA_setup['timedate_format'], $row['time'])."<BR>";
		$info .= $text_ip." : ".$row['ip']."<BR>";
		$info .= $text_host." : ".$row['host']."<BR>";
		$info .= $text_share_size." : ".Number_Format($row['share_size'])." (".RoundShare($row['share_size']).")<BR>";
		$info .= $text_email." : ".$row['email']."<BR>";
		$info .= $text_op." : ".$row['op']."<BR>";
		IF($row['is_drop'])
			$info .= $text_is_drop." : ".$text_yes."<BR>";
		ELSE
			$info .= $text_is_drop." : ".$text_no."<BR>";
		$info .= $text_reason." :<BR>".$row['reason'];
		?>
		<TR onmouseover="JavaScript: return escape('<?Print AddSlashes($info);?>');">
			<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
				<INPUT name="nick" type="hidden" value="<?Print $row['nick'];?>">
				<INPUT name="time" type="hidden" value="<?Print $row['time'];?>">
			</FORM>
			<?IF($VA_setup['kicklist_nick']){?><TD class="bg_light"><?Print $row['nick'];?></TD><?}?>
			<?IF($VA_setup['kicklist_time']){?><TD align="right" class="bg_light"><?Print Date($VA_setup['timedate_format'], $row['time']);?></TD><?}?>
			<?IF($VA_setup['kicklist_ip']){?><TD class="bg_light"><?Print $row['ip'];?></TD><?}?>
			<?IF($VA_setup['kicklist_host']){?><TD class="bg_light"><?Print $row['host'];?></TD><?}?>
			<?IF($VA_setup['kicklist_share_size']){?><TD align="right" class="bg_light"><?Print RoundShare($row['share_size']);?></TD><?}?>
			<?IF($VA_setup['kicklist_email']){?><TD class="bg_light"><?Print $row['email'];?></TD><?}?>
			<?IF($VA_setup['kicklist_reason']){?><TD class="bg_light"><?Print $row['reason'];?></TD><?}?>
			<?IF($VA_setup['kicklist_op']){?><TD class="bg_light"><?Print $row['op'];?></TD><?}?>
			<?IF($VA_setup['kicklist_is_drop']){?><TD class="bg_light"><?Print $row['is_drop'];?></TD><?}?>
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
		<?IF($VA_setup['kicklist_nick']){?><TD class="b bg_light" nowrap><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['kicklist_time']){?><TD class="b bg_light" nowrap><?Print $text_time; PrintOrderBy("time");?></TD><?}?>
		<?IF($VA_setup['kicklist_ip']){?><TD class="b bg_light" nowrap><?Print $text_ip; PrintOrderBy("ip");?></TD><?}?>
		<?IF($VA_setup['kicklist_host']){?><TD class="b bg_light" nowrap><?Print $text_host; PrintOrderBy("host");?></TD><?}?>
		<?IF($VA_setup['kicklist_share_size']){?><TD class="b bg_light" nowrap><?Print $text_share_size; PrintOrderBy("share_size");?></TD><?}?>
		<?IF($VA_setup['kicklist_email']){?><TD class="b bg_light" nowrap><?Print $text_email; PrintOrderBy("email");?></TD><?}?>
		<?IF($VA_setup['kicklist_reason']){?><TD class="b bg_light" nowrap><?Print $text_reason; PrintOrderBy("reason");?></TD><?}?>
		<?IF($VA_setup['kicklist_op']){?><TD class="b bg_light" nowrap><?Print $text_op; PrintOrderBy("op");?></TD><?}?>
		<?IF($VA_setup['kicklist_is_drop']){?><TD class="b bg_light" nowrap><?Print $text_is_drop; PrintOrderBy("is_drop");?></TD><?}?>
	</TR>
</TABLE>

<SCRIPT language="JavaScript" type="text/javascript" src="js/tooltip.js"></script>

<?
IF($pages > 1)
	{Navigation();}
?>
