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

IF(USR_CLASS < $VA_setup['stats_min_class'])
	{Die(VA_Message($err_msg_no_access, "error"));}


IF($VA_setup['create_indexes']) {
	Create_Index($DB_hub, "kicklist", "op");
	Create_Index($DB_hub, "banlist", "nick_op");
	Create_Index($DB_hub, "unbanlist", "unban_op");
	Create_Index($DB_hub, "kicklist", "ip");
	Create_Index($DB_hub, "banlist", "nick");
	}
?>
<FONT class="h2"><?Print $text_stats;?></FONT>

<BR><BR>

<?
GetTables($DB_hub);

IF($VA_setup['stats_plugin'] && IsSet($tables['pi_stats'])) {
	IF(!IsSet($_GET['month']))
		{
		$_GET['month'] = Date(n);
		$_GET['year'] = Date(Y);
		}

	$date_start = MkTime(0, 0, 0, $_GET['month'], 1, $_GET['year']);
	$days = Date(t, $date_start);
	$date_end = $date_start + 86400 * $days - 1;

	$result = mysql_Query("SELECT * FROM pi_stats WHERE realtime > $date_start AND realtime < $date_end");

	$users = Array(32 => 0);
	$share = Array(32 => 0);
	$upload = Array(32 => 0);
	WHILE($row = mysql_Fetch_Assoc($result))
		{
		$day = Date(j, $row['realtime']);

		$usercount = $row['users_total'];
		$usercount0 = $row['users_zone0'];
		$usercount1 = $row['users_zone1'];
		$usercount2 = $row['users_zone2'];
		$usercount3 = $row['users_zone3'];
		$usercount4 = $row['users_zone4'];

		$uploadcount = $row['upload_total'];
		$uploadcount0 = $row['upload_zone0'];
		$uploadcount1 = $row['upload_zone1'];
		$uploadcount2 = $row['upload_zone2'];
		$uploadcount3 = $row['upload_zone3'];
		$uploadcount4 = $row['upload_zone4'];

		$sharecount = $row['share_total_gb'];
		
		$searchcount = $row['freq_search_active'] + $row['freq_search_passive'];

		$users[$day] = Round(($users[$day] * $rows[$day] + $usercount) / ($rows[$day] + 1));
		$users0[$day] = Round(($users0[$day] * $rows[$day] + $usercount0) / ($rows[$day] + 1));
		$users1[$day] = Round(($users1[$day] * $rows[$day] + $usercount1) / ($rows[$day] + 1));
		$users2[$day] = Round(($users2[$day] * $rows[$day] + $usercount2) / ($rows[$day] + 1));
		$users3[$day] = Round(($users3[$day] * $rows[$day] + $usercount3) / ($rows[$day] + 1));
		$users4[$day] = Round(($users4[$day] * $rows[$day] + $usercount4) / ($rows[$day] + 1));

		$upload[$day] = Round(($upload[$day] * $rows[$day] + $uploadcount) / ($rows[$day] + 1));
		$upload0[$day] = Round(($upload0[$day] * $rows[$day] + $uploadcount0) / ($rows[$day] + 1));
		$upload1[$day] = Round(($upload1[$day] * $rows[$day] + $uploadcount1) / ($rows[$day] + 1));
		$upload2[$day] = Round(($upload2[$day] * $rows[$day] + $uploadcount2) / ($rows[$day] + 1));
		$upload3[$day] = Round(($upload3[$day] * $rows[$day] + $uploadcount3) / ($rows[$day] + 1));
		$upload4[$day] = Round(($upload4[$day] * $rows[$day] + $uploadcount4) / ($rows[$day] + 1));

		$share[$day] = Round(($share[$day] * $rows[$day] + $sharecount) / ($rows[$day] + 1));

		$search[$day] = Round(($search[$day] * $rows[$day] + $searchcount) / ($rows[$day] + 1), 3);

		IF($max_users[$day] < $usercount)
			{$max_users[$day] = $usercount;}
		IF($min_users[$day] == 0 || ($usercount != 0 && $min_users[$day] > $usercount))
			{$min_users[$day] = $usercount;}

		IF($max_share[$day] < $sharecount)
			{$max_share[$day] = $sharecount;}
		IF($min_share[$day] == 0 || ($sharecount != 0 && $min_share[$day] > $sharecount))
			{$min_share[$day] = $sharecount;}

		IF($max_upload[$day] < $uploadcount)
			{$max_upload[$day] = $uploadcount;}
		IF($min_upload[$day] == 0 || ($uploadcount != 0 && $min_upload[$day] > $uploadcount))
			{$min_upload[$day] = $uploadcount;}

		IF($max_search[$day] < $searchcount)
			{$max_search[$day] = $searchcount;}
		IF($min_search[$day] == 0 || ($searchcount != 0 && $min_search[$day] > $searchcount))
			{$min_search[$day] = $searchcount;}

		$total['users'] = Round(($usercount + $total['users'] * $total['rows']) / ($total['rows'] + 1));
		$total['upload'] = Round(($uploadcount + $total['upload'] * $total['rows']) / ($total['rows'] + 1));
		$total['share'] = Round(($sharecount + $total['share'] * $total['rows']) / ($total['rows'] + 1));
		$total['search'] = Round(($searchcount + $total['search'] * $total['rows']) / ($total['rows'] + 1), 3);

		$total['rows']++;
		$rows[$day]++;
		}
	?>
	<TABLE class="b0 fs9px">
		<TR>
			<TD class="h2 b1 center" colspan=2><?Print $text_month_stats;?></TD>
		</TR><TR>
			<FORM action="index.php" method="get">
			<INPUT name="q" type="hidden" value="stats">
			<TD class="bg_light right" colspan=2>
				<SELECT name="month">
					<OPTION value=1 <?IF($_GET['month'] == 1){Print "selected";}?>><?Print $text_january;?></OPTION>
					<OPTION value=2 <?IF($_GET['month'] == 2){Print "selected";}?>><?Print $text_february;?></OPTION>
					<OPTION value=3 <?IF($_GET['month'] == 3){Print "selected";}?>><?Print $text_march;?></OPTION>
					<OPTION value=4 <?IF($_GET['month'] == 4){Print "selected";}?>><?Print $text_april;?></OPTION>
					<OPTION value=5 <?IF($_GET['month'] == 5){Print "selected";}?>><?Print $text_may;?></OPTION>
					<OPTION value=6 <?IF($_GET['month'] == 6){Print "selected";}?>><?Print $text_june;?></OPTION>
					<OPTION value=7 <?IF($_GET['month'] == 7){Print "selected";}?>><?Print $text_jully;?></OPTION>
					<OPTION value=8 <?IF($_GET['month'] == 8){Print "selected";}?>><?Print $text_august;?></OPTION>
					<OPTION value=9 <?IF($_GET['month'] == 9){Print "selected";}?>><?Print $text_september;?></OPTION>
					<OPTION value=10 <?IF($_GET['month'] == 10){Print "selected";}?>><?Print $text_octomber;?></OPTION>
					<OPTION value=11 <?IF($_GET['month'] == 11){Print "selected";}?>><?Print $text_november;?></OPTION>
					<OPTION value=12 <?IF($_GET['month'] == 12){Print "selected";}?>><?Print $text_december;?></OPTION>
				</SELECT>
				<SELECT name="year">
					<?FOR($i = 2004; $i <= Date(Y); $i++){?>
					<OPTION value=<?Print $i; IF($i == $_GET['year']){Print " selected";}?>><?Print $i;?></OPTION>
					<?}?>
				</SELECT>
				<INPUT type="submit" value="<?Print $text_send;?>">
			</TD>
		</TR><TR>
			<TD class="b bg_light" colspan=2>
				&nbsp;&nbsp;&nbsp;
				<IMG src="img/bar0.gif" class="b1" width=16 height=8> : Zone 0&nbsp;&nbsp;
				<IMG src="img/bar1.gif" class="b1" width=16 height=8> : Zone 1&nbsp;&nbsp;
				<IMG src="img/bar2.gif" class="b1" width=16 height=8> : Zone 2&nbsp;&nbsp;
				<IMG src="img/bar3.gif" class="b1" width=16 height=8> : Zone 3&nbsp;&nbsp;
				<IMG src="img/bar4.gif" class="b1" width=16 height=8> : Zone 4&nbsp;&nbsp;
			</TD>
		</TR><TR>
			<TD>
	<!-- ------- Users stats ------- -->
				<TABLE class="b1 fs9px">
					<TR>
						<TD class="h3 center b1" colspan=<?Print $days?>><?Print $text_user_stats;?></TD>
					</TR><TR>
						<TD class="bg_light" colspan=<?Print $days;?>>
							<?Print "<FONT class=\"b\">".$text_max."</FONT> : ".@Number_Format(Max($max_users) * 1);?>&nbsp;
							<?Print "<FONT class=\"b\"> ".$text_min."</FONT> : ".@Number_Format(Min($min_users) * 1);?>&nbsp;
							<?Print "<FONT class=\"b\"> ".$text_averange."</FONT> : ".Number_Format(Round($total['users']));?>
						</TD>
					</TR><TR>
						<?FOR($i = 1; $i <= $days; $i++){
						IF($users[$i] == ""){$users[$i] = 0;}
						IF($min_users[$i] == ""){$min_users[$i] = 0;}
						IF($max_users[$i] == ""){$max_users[$i] = 0;}

						$info  = $text_averange." : ".Number_Format($users[$i])."\n";
						$info .= $text_min." : ".Number_Format($min_users[$i])."\n";
						$info .= $text_max." : ".Number_Format($max_users[$i])."\n";
						$info .= "\n";
						$info .= "Zone 0 ".$text_averange." : ".Number_Format($users0[$i])."\n";
						$info .= "Zone 1 ".$text_averange." : ".Number_Format($users1[$i])."\n";
						$info .= "Zone 2 ".$text_averange." : ".Number_Format($users2[$i])."\n";
						$info .= "Zone 3 ".$text_averange." : ".Number_Format($users3[$i])."\n";
						$info .= "Zone 4 ".$text_averange." : ".Number_Format($users4[$i]);?>
						<TD class="fs0px b1 center bottom" height=100 title="<?Print $info;?>">
							<?IF($users4[$i]){?><IMG src="img/bar4.gif" width=8 height=<?Print @Round($users4[$i] / Max($users) * 100);?>><BR><?}?>
							<?IF($users3[$i]){?><IMG src="img/bar3.gif"<?IF($users4[$i]){?> class="b1top"<?}?> width=8 height=<?Print @Round($users3[$i] / Max($users) * 100);?>><BR><?}?>
							<?IF($users2[$i]){?><IMG src="img/bar2.gif"<?IF($users4[$i] || $users3[$i]){?> class="b1top"<?}?> width=8 height=<?Print @Round($users2[$i] / Max($users) * 100);?>><BR><?}?>
							<?IF($users1[$i]){?><IMG src="img/bar1.gif"<?IF($users4[$i] || $users3[$i] || $users2[$i]){?> class="b1top"<?}?> width=8 height=<?Print @Round($users1[$i] / Max($users) * 100);?>><BR><?}?>
							<?IF($users0[$i]){?><IMG src="img/bar0.gif"<?IF($users4[$i] || $users3[$i] || $users2[$i] || $users1[$i]){?> class="b1top"<?}?> width=8 height=<?Print @Round($users0[$i] / Max($users) * 100);?>><?}?>
							<?IF(!$users0[$i] && !$users1[$i] && !$users2[$i] && !$users3[$i] && !$users4[$i]){?><IMG src="img/space.gif" width=8><?}?>
						</TD>
						<?}?>
					</TR><TR>
						<?FOR($i = 1; $i <= $days; $i++){?>
						<TD class="fs8px bg_light center"><?Print $i;?></TD>
						<?}?>
					</TR>
				</TABLE>
			</TD><TD>
	<!-- ------- Upload stats ------- -->
				<TABLE class="b1 fs9px">
					<TR>
						<TD class="h3 center b1" colspan=<?Print $days?>><?Print $text_upload_stats;?></TD>
					</TR><TR>
						<TD class="bg_light" colspan=<?Print $days;?>>
							<?Print "<FONT class=\"b\"> ".$text_max."</FONT> : ".RoundShare(@Max($max_upload) * 1)."/s";?>&nbsp;
							<?Print "<FONT class=\"b\"> ".$text_min."</FONT> : ".RoundShare(@Min($min_upload) * 1)."/s";?>&nbsp;
							<?Print "<FONT class=\"b\"> ".$text_estimated."</FONT> : ".RoundShare($total['upload'] * 86400 * $days)."/".$text_month;?>
						</TD>
					</TR><TR>
						<?FOR($i = 1; $i <= $days; $i++){
						IF($upload[$i] == ""){$upload[$i] = 0;}
						IF($min_upload[$i] == ""){$min_upload[$i] = 0;}
						IF($max_upload[$i] == ""){$max_upload[$i] = 0;}

						$info  = $text_averange." : ".RoundShare($upload[$i])."/s\n";
						$info .= $text_min." : ".RoundShare($min_upload[$i])."/s\n";
						$info .= $text_max." : ".RoundShare($max_upload[$i])."/s\n";
						$info .= $text_estimated." : ".RoundShare($upload[$i] * 8640)."/".$text_day."\n";
						$info .= "\n";
						$info .= "Zone 0 ".$text_averange." : ".RoundShare($upload0[$i])."/s\n";
						$info .= "Zone 1 ".$text_averange." : ".RoundShare($upload1[$i])."/s\n";
						$info .= "Zone 2 ".$text_averange." : ".RoundShare($upload2[$i])."/s\n";
						$info .= "Zone 3 ".$text_averange." : ".RoundShare($upload3[$i])."/s\n";
						$info .= "Zone 4 ".$text_averange." : ".RoundShare($upload4[$i])."/s";?>
						<TD class="fs0px b1 center bottom" height=100 title="<?Print $info;?>">
							<?IF($upload4[$i]){?><IMG src="img/bar4.gif" width=8 height=<?Print @Round($upload4[$i] / Max($upload) * 100);?>><BR><?}?>
							<?IF($upload3[$i]){?><IMG src="img/bar3.gif"<?IF($upload4[$i]){?> class="b1top"<?}?> width=8 height=<?Print @Round($upload3[$i] / Max($upload) * 100);?>><BR><?}?>
							<?IF($upload2[$i]){?><IMG src="img/bar2.gif"<?IF($upload4[$i] || $upload3[$i]){?> class="b1top"<?}?> width=8 height=<?Print @Round($upload2[$i] / Max($upload) * 100);?>><BR><?}?>
							<?IF($upload1[$i]){?><IMG src="img/bar1.gif"<?IF($upload4[$i] || $upload3[$i] || $upload2[$i]){?> class="b1top"<?}?> width=8 height=<?Print @Round($upload1[$i] / Max($upload) * 100);?>><BR><?}?>
							<?IF($upload0[$i]){?><IMG src="img/bar0.gif"<?IF($upload4[$i] || $upload3[$i] || $upload2[$i] || $upload1[$i]){?> class="b1top"<?}?> width=8 height=<?Print @Round($upload0[$i] / Max($upload) * 100);?>><?}?>
							<?IF(!$upload0[$i] && !$upload1[$i] && !$upload2[$i] && !$upload3[$i] && !$upload4[$i]){?><IMG src="img/space.gif" width=8><?}?>
						</TD>
						<?}?>
					</TR><TR>
						<?FOR($i = 1; $i <= $days; $i++){?>
						<TD class="fs8px bg_light center"><?Print $i;?></TD>
						<?}?>
					</TR>
				</TABLE>
			</TD>
		</TR><TR>
			<TD>
	<!-- ------- Share stats ------- -->
				<TABLE class="b1 fs9px">
					</TR><TR>
						<TD class="h3 center b1" colspan=<?Print $days?>><?Print $text_share_stats;?></TD>
					</TR><TR>
						<TD class="bg_light" colspan=<?Print $days;?>>
							<?Print "<FONT class=\"b\"> ".$text_max."</FONT> : ".@RoundShare(Max($max_share) * 1073741824);?>&nbsp;
							<?Print "<FONT class=\"b\"> ".$text_min."</FONT> : ".@RoundShare(Min($min_share) * 1073741824);?>&nbsp;
							<?Print "<FONT class=\"b\"> ".$text_averange."</FONT> : ".RoundShare($total['share'] * 1073741824);?>
						</TD>
					</TR><TR>
						<?FOR($i = 1; $i <= $days; $i++){
						$info  = $text_averange." : ".RoundShare($share[$i] * 1073741824)."\n";
						$info .= $text_min." : ".RoundShare($min_share[$i] * 1073741824)."\n";
						$info .= $text_max." : ".RoundShare($max_share[$i] * 1073741824);?>
						<TD class="fs0px b1 center bottom" height=100 title="<?Print $info;?>">
							<?IF($share[$i]){?><IMG src="img/bar.gif" width=8 height=<?Print @Round($share[$i] / Max($share) * 100);?>><?}
							ELSE{?><IMG src="img/space.gif" width=8><?}?>
						</TD>
						<?}?>
					</TR><TR>
						<?FOR($i = 1; $i <= $days; $i++){?>
						<TD class="fs8px bg_light center"><?Print $i;?></TD>
						<?}?>
					</TR>
				</TABLE>
			</TD><TD>
	<!-- ------- Search stats ------- -->
				<TABLE class="b1 fs9px">
					</TR><TR>
						<TD class="h3 center b1" colspan=<?Print $days?>><?Print $text_search_stats;?></TD>
					</TR><TR>
						<TD class="bg_light" colspan=<?Print $days;?>>
							<?Print "<FONT class=\"b\"> ".$text_max."</FONT> : ".@Max($max_search);?>/s&nbsp;
							<?Print "<FONT class=\"b\"> ".$text_min."</FONT> : ".@Min($min_search);?>/s&nbsp;
							<?Print "<FONT class=\"b\"> ".$text_averange."</FONT> : ".$total['search'];?>/s
						</TD>
					</TR><TR>
						<?FOR($i = 1; $i <= $days; $i++){
						$info  = $text_averange." : ".$search[$i]."/s\n";
						$info .= $text_min." : ".$min_search[$i]."/s\n";
						$info .= $text_max." : ".$max_search[$i]."/s";?>
						<TD class="fs0px b1 center bottom" height=100 title="<?Print $info;?>">
							<?IF($search[$i]){?><IMG src="img/bar.gif" width=8 height=<?Print @Round($search[$i] / Max($search) * 100);?>><?}
							ELSE{?><IMG src="img/space.gif" width=8><?}?>
						</TD>
						<?}?>
					</TR><TR>
						<?FOR($i = 1; $i <= $days; $i++){?>
						<TD class="fs8px bg_light center"><?Print $i;?></TD>
						<?}?>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>

	<BR>
<?	}?>

<TABLE>
	<TR>
		<TD colspan=2 class="b1 center h2"><?Print $text_most_active_op;?></TD>
	</TR><TR>
		<TD class="top right">
			<TABLE class="fs9px b1" width=100%>
				<TR>
					<TD colspan=4 class="b bg_light center"><?Print $text_kicklist." ( ".Number_Format($tables['kicklist']['rows'])." )";?></TD>
				</TR>
<?
$i = 1;
$kick = $DB_hub->Query("SELECT `op`, Count(`op`) AS `count` FROM kicklist WHERE `op` != '' GROUP BY `op` ORDER BY `count` DESC LIMIT 0,".$VA_setup['stats_results']);
WHILE($row = $kick->Fetch_Assoc())
	{?>
				<TR>
					<TD class="right bg_light">&nbsp;<?Print $i++;?>&nbsp;</TD>
					<TD class="b bg_light">&nbsp;<?IF(USR_CLASS >= $VA_setup['kicklist_min_class']){Print "<A href=\"index.php?q=kicklist&filter_colum=op&filter_type=equal&filter=".$row['op']."\">".$row['op']."</A>";}ELSE{Print $row['op'];}?>&nbsp;</TD>
					<TD width=150 class="b1 fs0px"><IMG src="img/bar.gif" height=10 width=<?Print CountStatBar($tables['kicklist']['rows'], $row['count']);?>></TD>
					<TD class="bg_light">&nbsp;<?Print $row['count']?>&nbsp;(<?Print Round(($row['count'] / $tables['kicklist']['rows']) * 100, 2)."%";?>)&nbsp;</TD>
				</TR>
<?	}
$kick->Free_Result();?>
			</TABLE>
		</TD><TD class="top left">
			<TABLE class="fs9px b1" width=100%>
				<TR>
					<TD colspan=4 class="b bg_light center"><?Print $text_banlist." ( ".Number_Format($tables['banlist']['rows'])." )";?></TD>
				</TR>
<?
$i = 1;
$ban = $DB_hub->Query("SELECT `nick_op`, Count(`nick_op`) AS `count` FROM banlist WHERE `nick_op` != '' GROUP BY `nick_op` ORDER BY `count` DESC LIMIT 0,".$VA_setup['stats_results']);
WHILE($row = $ban->Fetch_Assoc())
	{?>
				<TR>
					<TD class="right bg_light">&nbsp;<?Print $i++;?>&nbsp;</TD>
					<TD class="b bg_light">&nbsp;<?IF(USR_CLASS >= $VA_setup['banlist_min_class']){Print "<A href=\"index.php?q=banlist&filter_colum=nick_op&filter_type=equal&filter=".$row['nick_op']."\">".$row['nick_op']."</A>";}ELSE{Print $row['nick_op'];}?>&nbsp;</TD>
					<TD width=150 class="b1 fs0px"><IMG src="img/bar.gif" height=10 width=<?Print CountStatBar($tables['banlist']['rows'], $row['count']);?>></TD>
					<TD class="bg_light">&nbsp;<?Print $row['count']?>&nbsp;(<?Print Round(($row['count'] / $tables['banlist']['rows']) * 100, 2)."%";?>)&nbsp;</TD>
				</TR>
<?	}
$ban->Free_Result();?>
			</TABLE>
		</TD>
	</TR><TR>
		<TD class="top right">
			<TABLE class="fs9px b1" width=100%>
				<TR>
					<TD colspan=4 class="b bg_light center"><?Print $text_reglist." ( ".Number_Format($tables['reglist']['rows'])." )";?></TD>
				</TR>
<?
$i = 1;
$reg = $DB_hub->Query("SELECT `reg_op`, Count(`reg_op`) AS `count` FROM reglist WHERE `reg_op` != '' GROUP BY `reg_op` ORDER BY `count` DESC LIMIT 0,".$VA_setup['stats_results']);
WHILE($row = $reg->Fetch_Assoc())
	{?>
				<TR>
					<TD class="right bg_light">&nbsp;<?Print $i++;?>&nbsp;</TD>
					<TD class="b bg_light">&nbsp;<?IF(USR_CLASS >= $VA_setup['reglist_min_class']){Print "<A href=\"index.php?q=reglist&filter_colum=reg_op&filter_type=equal&filter=".$row['reg_op']."\">".$row['reg_op']."</A>";}ELSE{Print $row['reg_op'];}?>&nbsp;</TD>
					<TD width=150 class="b1 fs0px"><IMG src="img/bar.gif" height=10 width=<?Print CountStatBar($tables['reglist']['rows'], $row['count']);?>></TD>
					<TD class="bg_light">&nbsp;<?Print $row['count']?>&nbsp;(<?Print Round(($row['count'] / $tables['reglist']['rows']) * 100, 2)."%";?>)&nbsp;</TD>
				</TR>
<?	}
$reg->Free_Result();?>
			</TABLE>
		</TD><TD class="top left">
			<TABLE class="fs9px b1" width=100%>
				<TR>
					<TD colspan=4 class="b bg_light center"><?Print $text_unbanlist." ( ".Number_Format($tables['unbanlist']['rows'])." )";?></TD>
				</TR>
<?
$i = 1;
$unban = $DB_hub->Query("SELECT `unban_op`, Count(`unban_op`) AS `count` FROM unbanlist WHERE `unban_op` != '' GROUP BY `unban_op` ORDER BY `count` DESC LIMIT 0,".$VA_setup['stats_results']);
WHILE($row = $unban->Fetch_Assoc())
	{?>
				<TR>
					<TD class="right bg_light">&nbsp;<?Print $i++;?>&nbsp;</TD>
					<TD class="b bg_light">&nbsp;<?IF(USR_CLASS >= $VA_setup['unbanlist_min_class']){Print "<A href=\"index.php?q=unbanlist&filter_colum=unban_op&filter_type=equal&filter=".$row['unban_op']."\">".$row['unban_op']."</A>";}ELSE{Print $row['unban_op'];}?>&nbsp;</TD>
					<TD width=150 class="b1 fs0px"><IMG src="img/bar.gif" height=10 width=<?Print CountStatBar($tables['unbanlist']['rows'], $row['count']);?>></TD>
					<TD class="bg_light">&nbsp;<?Print $row['count']?>&nbsp;(<?Print Round(($row['count'] / $tables['unbanlist']['rows']) * 100, 2)."%";?>)&nbsp;</TD>
				</TR>
<?	}
$unban->Free_Result();?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<BR>

<TABLE>
	<TR>
		<TD colspan=2 class="h2 center b1"><?Print $text_most_active_ip;?></TD>
	</TR><TR>
		<TD class="top right">
			<TABLE class="fs9px b1">
				<TR>
					<TD colspan=4 class="b bg_light center"><?Print $text_kicklist." ( ".Number_Format($tables['kicklist']['rows'])." )";?></TD>
				</TR>
<?
$i = 1;
$kick = $DB_hub->Query("SELECT ip, Count(ip) AS `count` FROM kicklist GROUP BY ip ORDER BY `count` DESC, time DESC LIMIT 0,".$VA_setup['stats_results']);
WHILE($row = $kick->Fetch_Assoc())
	{?>
				<TR>
					<TD class="right bg_light">&nbsp;<?Print $i++;?>&nbsp;</TD>
					<TD class="b bg_light">&nbsp;<?IF(USR_CLASS >= $VA_setup['kicklist_min_class']){Print "<A href=\"index.php?q=kicklist&filter_colum=ip&filter_type=equal&filter=".$row['ip']."\">".$row['ip']."</A>";}ELSE{Print $row['ip'];}?>&nbsp;</TD>
					<TD width=150 class="b1 fs0px"><IMG src="img/bar.gif" height=10 width=<?Print CountStatBar($tables['kicklist']['rows'], $row['count']);?>></TD>
					<TD class="bg_light">&nbsp;<?Print $row['count']?>&nbsp;(<?Print Round(($row['count'] / $tables['kicklist']['rows']) * 100, 2)."%";?>)&nbsp;</TD>
				</TR>
<?	}
$kick->Free_Result();?>
			</TABLE>
		</TD><TD class="top left">
			<TABLE class="fs9px b1">
				<TR>
					<TD colspan=4 class="b bg_light center"><?Print $text_banlist." ( ".Number_Format($tables['banlist']['rows'])." )";?></TD>
				</TR>
<?
$i = 1;
$ban = $DB_hub->Query("SELECT ip, Count(ip) AS `count` FROM banlist WHERE ip != '_nickban_' GROUP BY ip ORDER BY `count` DESC, date_start DESC LIMIT 0,".$VA_setup['stats_results']);
WHILE($row = $ban->Fetch_Assoc())
	{?>
				<TR>
					<TD class="right bg_light">&nbsp;<?Print $i++;?>&nbsp;</TD>
					<TD class="b bg_light">&nbsp;<?IF(USR_CLASS >= $VA_setup['banlist_min_class']){Print "<A href=\"index.php?q=banlist&filter_colum=ip&filter_type=equal&filter=".$row['ip']."\">".$row['ip']."</A>";}ELSE{Print $row['ip'];}?>&nbsp;</TD>
					<TD width=150 class="b1 fs0px"><IMG src="img/bar.gif" height=10 width=<?Print CountStatBar($tables['banlist']['rows'], $row['count']);?>></TD>
					<TD class="bg_light">&nbsp;<?Print $row['count']?>&nbsp;(<?Print Round(($row['count'] / $tables['banlist']['rows']) * 100, 2)."%";?>)&nbsp;</TD>
				</TR>
<?	}
$ban->Free_Result();?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<BR>

<TABLE>
	<TR>
		<TD colspan=2 class="b1 center h2"><?Print $text_most_active_nick;?></TD>
	</TR><TR>
		<TD class="right top">
			<TABLE class="fs9px b1">
				<TR>
					<TD colspan=4 class="b bg_light center"><?Print $text_kicklist." ( ".Number_Format($tables['kicklist']['rows'])." )";?></TD>
				</TR>
<?
$i = 1;
$kick = $DB_hub->Query("SELECT nick, Count(nick) AS `count` FROM kicklist GROUP BY nick ORDER BY `count` DESC, time DESC LIMIT 0,".$VA_setup['stats_results']);
WHILE($row = $kick->Fetch_Assoc())
	{?>
				<TR>
					<TD class="right bg_light">&nbsp;<?Print $i++;?>&nbsp;</TD>
					<TD class="b bg_light">&nbsp;<?IF(USR_CLASS >= $VA_setup['kicklist_min_class']){Print "<A href=\"index.php?q=kicklist&filter_colum=nick&filter_type=equal&filter=".$row['nick']."\">".$row['nick']."</A>";}ELSE{Print $row['nick'];}?>&nbsp;</TD>
					<TD width=150 class="b1 fs0px"><IMG src="img/bar.gif" height=10 width=<?Print CountStatBar($tables['kicklist']['rows'], $row['count']);?>></TD>
					<TD class="bg_light">&nbsp;<?Print $row['count']?>&nbsp;(<?Print Round(($row['count'] / $tables['kicklist']['rows']) * 100, 2)."%";?>)&nbsp;</TD>
				</TR>
<?	}
$kick->Free_Result();?>
			</TABLE>
		</TD><TD class="left top">
			<TABLE class="fs9px b1">
				<TR>
					<TD colspan=4 class="b bg_light center"><?Print $text_banlist." ( ".Number_Format($tables['banlist']['rows'])." )";?></TD>
				</TR>
<?
$i = 1;
$ban = $DB_hub->Query("SELECT nick, Count(nick) AS `count` FROM banlist WHERE nick != '_ipban_' GROUP BY nick ORDER BY `count` DESC, date_start DESC LIMIT 0,".$VA_setup['stats_results']);
WHILE($row = $ban->Fetch_Assoc())
	{?>
				<TR>
					<TD class="right bg_light">&nbsp;<?Print $i++;?>&nbsp;</TD>
					<TD class="b bg_light">&nbsp;<?IF(USR_CLASS >= $VA_setup['banlist_min_class']){Print "<A href=\"index.php?q=banlist&filter_colum=nick&filter_type=equal&filter=".$row['nick']."\">".$row['nick']."</A>";}ELSE{Print $row['nick'];}?>&nbsp;</TD>
					<TD width=150 class="b1 fs0px"><IMG src="img/bar.gif" height=10 width=<?Print CountStatBar($tables['banlist']['rows'], $row['count']);?>></TD>
					<TD class="bg_light">&nbsp;<?Print $row['count']?>&nbsp;(<?Print Round(($row['count'] / $tables['banlist']['rows']) * 100, 2)."%";?>)&nbsp;</TD>
				</TR>
<?	}
$ban->Free_Result();?>
			</TABLE>
		</TD>
	</TR>
</TABLE>
