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

IF($VA_setup['reglist_min_class'] > USR_CLASS)
	{Die(VA_Error($err_msg_no_access));}
?>

<FONT class="h2"><?Print $text_reglist;?></FONT>


<?
$register_class = FetchClass($VA_setup['register_class']);
$disable_class = FetchClass($VA_setup['disable_class']);
$delete_class = FetchClass($VA_setup['delete_class']);

IF($_POST['dis_pwd'] && $_POST['age_pwd']) {
	$time = Time() - $_POST['age_pwd'] * 86400;
	$DB_hub->Query("UPDATE reglist SET enabled = 0 WHERE login_pwd IS NULL AND reg_date < ".$time." AND ((class = 1 AND ".$disable_class[1]." <= ".USR_CLASS.") OR (class = 2 AND ".$disable_class[2]." <= ".USR_CLASS."))");
	VA_Message($text_affected_rows." : ".$DB_hub->affected_rows, "info32");
}
IF($_POST['del_pwd'] && $_POST['age_pwd']) {
	$time = Time() - $_POST['age_pwd'] * 86400;
	$DB_hub->Query("DELETE FROM reglist WHERE login_pwd IS NULL AND reg_date < ".$time." AND ((class = 1 AND ".$delete_class[1]." <= ".USR_CLASS.") OR (class = 2 AND ".$delete_class[2]." <= ".USR_CLASS."))");
	VA_Message($text_affected_rows." : ".$DB_hub->affected_rows, "info32");
}
ELSEIF($_POST['dis_ina'] && $_POST['age_ina']) {
	$time = Time() - $_POST['age_ina'] * 86400;
	$DB_hub->Query("UPDATE reglist SET enabled = 0 WHERE login_last < ".$time." AND ((class = 1 AND ".$disable_class[1]." <= ".USR_CLASS.") OR (class = 2 AND ".$disable_class[2]." <= ".USR_CLASS."))");
	VA_Message($text_affected_rows." : ".$DB_hub->affected_rows, "info32");
}
ELSEIF($_POST['del_ina'] && $_POST['age_ina']) {
	$time = Time() - $_POST['age_ina'] * 86400;
	$DB_hub->Query("DELETE FROM reglist WHERE login_last < ".$time." AND ((class = 1 AND ".$delete_class[1]." <= ".USR_CLASS.") OR (class = 2 AND ".$delete_class[2]." <= ".USR_CLASS."))");
	VA_Message($text_affected_rows." : ".$DB_hub->affected_rows, "info32");
}

IF($_GET['orderby'] == ""){$_GET['orderby'] = $VA_setup['reglist_order_by'];}
IF($_GET['page'] == ""){$_GET['page'] = 1;}

IF($_GET['filter'] != "" && $_GET['filter_colum'] && $_GET['filter_type'])
	{
	IF($VA_setup['create_indexes'])
                Create_Index($DB_hub, "reglist", $_GET['filter_colum']);
	IF($_GET['filter_colum'] == "reg_date" || $_GET['filter_colum'] == "login_last" || $_GET['filter_colum'] == "logout_last" || $_GET['filter_colum'] == "error_last")
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
IF($_GET['filter_active'])
	{
	IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
		{$query .= " AND";}
	ELSE
		{$query = " WHERE";}
	$query .= " enabled = 1";
	}

$colums  = $VA_setup['reglist_nick'] + $VA_setup['reglist_class'];
$colums += $VA_setup['reglist_class_protect'] + 5;
$colums += $VA_setup['reglist_class_hidekick'] + $VA_setup['reglist_hide_kick'];
$colums += $VA_setup['reglist_reg_date'] + $VA_setup['reglist_reg_op'];
$colums += $VA_setup['reglist_pwd_change'] + $VA_setup['reglist_pwd_crypt'];
$colums += $VA_setup['reglist_login_pwd'] + $VA_setup['reglist_login_last'];
$colums += $VA_setup['reglist_logout_last'] + $VA_setup['reglist_login_cnt'];
$colums += $VA_setup['reglist_login_ip'] + $VA_setup['reglist_error_last'];
$colums += $VA_setup['reglist_error_cnt'] + $VA_setup['error_ip'];
$colums += $VA_setup['reglist_enabled'] + $VA_setup['reglist_email'];
$colums += $VA_setup['reglist_note_usr'] + $VA_setup['reglist_hide_keys'];
IF(USR_CLASS >= 3){$colums += $VA_setup['reglist_note_op'];}

$result = $DB_hub->Query("SELECT Count(nick) AS `count` FROM reglist".$query);
$count = $result->Fetch_Assoc();
$result->Free_Result();
$total = $count['count'];
$pages = (int)($total / $VA_setup['reglist_results']) + 1;
$first = $VA_setup['reglist_results'] * ($_GET['page'] - 1);

$query  = "SELECT * FROM reglist".$query;
$query .= " ORDER BY ".$_GET['orderby']." LIMIT ".$first.",".$VA_setup['reglist_results'];
IF($debug[2]) {
	VA_Message($query, "bohyn32");
	Print "<BR>";
	}

IF($pages > 1)
	{Navigation();}

IF($disable_class[1] <= USR_CLASS || $disable_class[2] <= USR_CLASS || $delete_class[1] <= USR_CLASS || $delete_class[2] <= USR_CLASS) {
?>

<BR><BR>

<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE class="fs9px b1">
	<TR>
		<TD class="bg_light right b"><?Print $text_del_no_pwd_users;?>&nbsp;:&nbsp;</TD>
		<TD class="bg_light">
			<?Print $text_older_than;?>
			<INPUT name="age_pwd" type="text" size="5">
			<?Print $text_days."; (".$text_class." <= 2)";?>
			<?IF($disable_class[1] <= USR_CLASS || $disable_class[2] <= USR_CLASS){?><INPUT class="w75px" name="dis_pwd" type="submit" value="<?Print $text_disable;?>"><?}?>
			<?IF($delete_class[1] <= USR_CLASS || $delete_class[2] <= USR_CLASS){?><INPUT class="w75px" name="del_pwd" type="submit" value="<?Print $text_delete;?>"><?}?>
		</TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_del_inactive_users;?>&nbsp;:&nbsp;</TD>
		<TD class="bg_light">
			<?Print $text_older_than;?>
			<INPUT name="age_ina" type="text" size="5">
			<?Print $text_days."; (".$text_class." <= 2)";?>
			<?IF($disable_class[1] <= USR_CLASS || $disable_class[2] <= USR_CLASS){?><INPUT class="w75px" name="dis_ina" type="submit" value="<?Print $text_disable;?>"><?}?>
			<?IF($delete_class[1] <= USR_CLASS || $delete_class[2] <= USR_CLASS){?><INPUT class="w75px" name="del_ina" type="submit" value="<?Print $text_delete;?>"><?}?>
		</TD>
	</TR>
</TABLE>
</FORM>

<BR>
<?}?>


<TABLE class="fs9px b1">
<?
IF(USR_CLASS >= $register_class[1] || USR_CLASS >= $register_class[2] || USR_CLASS >= $register_class[3] || USR_CLASS >= $register_class[4] || USR_CLASS >= $register_class[5] || USR_CLASS >= $register_class[10])
	{?>
	<TR>
		<FORM action="index.php?<?Print Change_URL_Query("q", "addreg");?>" method="post">
		<TD class="bg_light" colspan=<?Print $colums;?>>
			<INPUT class="w160px" type="submit" value="<?Print $text_addreg;?>">
		</TD>
		</FORM>
	</TR>
<?	}?>
	<TR>
		<FORM action="index.php" method="get">
		<INPUT name="q" type="hidden" value="reglist">
		<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
		<TD align="right" colspan=<?Print $colums;?> class="bg_light" nowrap>
			<INPUT name="filter_active" id="filter_active" type="checkbox" value=1<?IF($_GET['filter_active']){Print " checked";} IF($_COOKIE['brwsr_tp'] != "Opera"){Print " class=\"b0\"";}?>><LABEL for="filter_active"><?Print $text_enabled;?></LABEL>&nbsp;&nbsp;
			<FONT class="b"><?Print $text_colum;?> : </FONT>
			<SELECT name="filter_colum" size=1>
				<OPTION> </OPTION>
				<OPTION value="nick"<?IF($_GET['filter_colum'] == "nick"){Print " selected";}?>><?Print $text_nick;?></OPTION>
				<OPTION value="class"<?IF($_GET['filter_colum'] == "class"){Print " selected";}?>><?Print $text_class;?></OPTION>
				<OPTION value="class_protect"<?IF($_GET['filter_colum'] == "class_protect"){Print " selected";}?>><?Print $text_class_protect;?></OPTION>
				<OPTION value="class_hidekick"<?IF($_GET['filter_colum'] == "class_hidekick"){Print " selected";}?>><?Print $text_class_hidekick;?></OPTION>
				<OPTION value="hide_kick"<?IF($_GET['filter_colum'] == "hide_kick"){Print " selected";}?>><?Print $text_hide_kick;?></OPTION>
				<OPTION value="reg_date"<?IF($_GET['filter_colum'] == "reg_date"){Print " selected";}?>><?Print $text_reg_date;?></OPTION>
				<OPTION value="reg_op"<?IF($_GET['filter_colum'] == "reg_op"){Print " selected";}?>><?Print $text_reg_op;?></OPTION>
				<OPTION value="pwd_change"<?IF($_GET['filter_colum'] == "pwd_change"){Print " selected";}?>><?Print $text_pwd_change;?></OPTION>
				<OPTION value="pwd_crypt"<?IF($_GET['filter_colum'] == "pwd_crypt"){Print " selected";}?>><?Print $text_pwd_crypt;?></OPTION>
				<OPTION value="login_cnt"<?IF($_GET['filter_colum'] == "login_cnt"){Print " selected";}?>><?Print $text_login_cnt;?></OPTION>
				<OPTION value="login_ip"<?IF($_GET['filter_colum'] == "login_ip"){Print " selected";}?>><?Print $text_login_ip;?></OPTION>
				<OPTION value="login_last"<?IF($_GET['filter_colum'] == "login_last"){Print " selected";}?>><?Print $text_login_last;?></OPTION>
				<OPTION value="logout_last"<?IF($_GET['filter_colum'] == "logout_last"){Print " selected";}?>><?Print $text_logout_last;?></OPTION>
				<OPTION value="error_cnt"<?IF($_GET['filter_colum'] == "error_cnt"){Print " selected";}?>><?Print $text_error_cnt;?></OPTION>
				<OPTION value="error_ip"<?IF($_GET['filter_colum'] == "error_ip"){Print " selected";}?>><?Print $text_error_ip;?></OPTION>
				<OPTION value="error_last"<?IF($_GET['filter_colum'] == "error_last"){Print " selected";}?>><?Print $text_error_last;?></OPTION>
				<OPTION value="email"<?IF($_GET['filter_colum'] == "email"){Print " selected";}?>><?Print $text_email;?></OPTION>
				<OPTION value="note_op"<?IF($_GET['filter_colum'] == "note_op"){Print " selected";}?>><?Print $text_note_op;?></OPTION>
				<OPTION value="note_usr"<?IF($_GET['filter_colum'] == "note_usr"){Print " selected";}?>><?Print $text_note_usr;?></OPTION>
			</SELECT>
			&nbsp;
			<SELECT name="filter_type" size=1>
				<OPTION> </OPTION>
				<OPTION value="contains"<?IF($_GET['filter_type'] == "contains"){Print " selected";}?>><?Print $text_contains;?></OPTION>
				<OPTION value="equal"<?IF($_GET['filter_type'] == "equal"){Print " selected";}?>><?Print $text_equal;?></OPTION>
				<OPTION value="begins"<?IF($_GET['filter_type'] == "begins"){Print " selected";}?>><?Print $text_begins;?></OPTION>
				<OPTION value="ends"<?IF($_GET['filter_type'] == "ends"){Print " selected";}?>><?Print $text_ends;?></OPTION>
				<OPTION value="greater"<?IF($_GET['filter_type'] == "greater"){Print " selected";}?>><?Print $text_greater;?></OPTION>
				<OPTION value="less"<?IF($_GET['filter_type'] == "less"){Print " selected";}?>><?Print $text_less;?></OPTION>
			</SELECT>
			&nbsp;
			<INPUT name="filter" type="text" size=25 value="<?Print $_GET['filter']?>">
			<INPUT type="submit" value="<?Print $text_show;?>">
		<?IF($browser != "Mozilla") {Print "</TD>";}?>
		</FORM>
	</TR><TR>
		<TD width=80 colspan=5 class="bg_light">&nbsp;</TD>
		<?IF($VA_setup['reglist_nick']){?><TD class="b bg_light"><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['reglist_class']){?><TD class="b bg_light"><?Print $text_class; PrintOrderBy("class");?></TD><?}?>
		<?IF($VA_setup['reglist_class_protect']){?><TD class="b bg_light" nowrap><?Print $text_class_protect; PrintOrderBy("class_protect");?></TD><?}?>
		<?IF($VA_setup['reglist_class_hidekick']){?><TD class="b bg_light" nowrap><?Print $text_class_hidekick; PrintOrderBy("class_hidekick");?></TD><?}?>
		<?IF($VA_setup['reglist_hide_kick']){?><TD class="b bg_light" nowrap><?Print $text_hide_kick; PrintOrderBy("hide_kick");?></TD><?}?>
		<?IF($VA_setup['reglist_reg_date']){?><TD class="b bg_light" nowrap><?Print $text_reg_date; PrintOrderBy("reg_date");?></TD><?}?>
		<?IF($VA_setup['reglist_reg_op']){?><TD class="b bg_light" nowrap><?Print $text_reg_op; PrintOrderBy("reg_op");?></TD><?}?>
		<?IF($VA_setup['reglist_pwd_change']){?><TD class="b bg_light" nowrap><?Print $text_pwd_change; PrintOrderBy("pwd_change");?></TD><?}?>
		<?IF($VA_setup['reglist_pwd_crypt']){?><TD class="b bg_light" nowrap><?Print $text_pwd_crypt; PrintOrderBy("pwd_crypt");?></TD><?}?>
		<?IF($VA_setup['reglist_login_pwd']){?><TD class="b bg_light" nowrap><?Print $text_login_pwd; PrintOrderBy("login_pwd");?></TD><?}?>
		<?IF($VA_setup['reglist_login_last']){?><TD class="b bg_light" nowrap><?Print $text_login_last; PrintOrderBy("login_last");?></TD><?}?>
		<?IF($VA_setup['reglist_logout_last']){?><TD class="b bg_light" nowrap><?Print $text_logout_last; PrintOrderBy("logout_last");?></TD><?}?>
		<?IF($VA_setup['reglist_login_cnt']){?><TD class="b bg_light" nowrap><?Print $text_login_cnt; PrintOrderBy("login_cnt");?></TD><?}?>
		<?IF($VA_setup['reglist_login_ip']){?><TD class="b bg_light" nowrap><?Print $text_login_ip; PrintOrderBy("login_ip");?></TD><?}?>
		<?IF($VA_setup['reglist_error_last']){?><TD class="b bg_light" nowrap><?Print $text_error_last; PrintOrderBy("error_last");?></TD><?}?>
		<?IF($VA_setup['reglist_error_cnt']){?><TD class="b bg_light" nowrap><?Print $text_error_cnt; PrintOrderBy("error_cnt");?></TD><?}?>
		<?IF($VA_setup['reglist_error_ip']){?><TD class="b bg_light" nowrap><?Print $text_error_ip; PrintOrderBy("error_ip");?></TD><?}?>
		<?IF($VA_setup['reglist_enabled']){?><TD class="b bg_light" nowrap><?Print $text_enabled; PrintOrderBy("enabled");?></TD><?}?>
		<?IF($VA_setup['reglist_email']){?><TD class="b bg_light" nowrap><?Print $text_email; PrintOrderBy("email");?></TD><?}?>
		<?IF($VA_setup['reglist_note_op'] && USR_CLASS >= 3){?><TD class="b bg_light" nowrap><?Print $text_note_op; PrintOrderBy("note_op");?></TD><?}?>
		<?IF($VA_setup['reglist_note_usr']){?><TD class="b bg_light" nowrap><?Print $text_note_usr; PrintOrderBy("note_usr");?></TD><?}?>
		<?IF($VA_setup['reglist_note_usr']){?><TD class="b bg_light" nowrap><?Print $text_show_keys; PrintOrderBy("show_keys");?></TD><?}?>
	</TR>
<?
IF($total > 0) {
	$result = $DB_hub->Query($query);
	WHILE($row = $result->Fetch_Assoc())
		{
		$image = Get_Usr_Img($row['nick'], $row['class'], $row['enabled']);
		
		$info  = $text_class." : ".GetClassName($row['class'])." (".$row['class'].")<BR>";
		IF($row['enabled'])
			{$info .= $text_enabled." : ".$text_yes."<BR>";}
		ELSE
			{$info .= $text_enabled." : ".$text_no."<BR>";}
		$info .= $text_nick." : ".$row['nick']."<BR>";
		$info .= $text_class_protect." : ".$row['class_protect']."<BR>";
		$info .= $text_class_hidekick." : ".$row['class_hidekick']."<BR>";
		IF($row['hide_kick'])
			{$info .= $text_hide_kick." : ".$text_yes."<BR>";}
		ELSE
			{$info .= $text_hide_kick." : ".$text_no."<BR>";}
		$info .= $text_reg_date." : ".Date($VA_setup['timedate_format'], $row['reg_date'])."<BR>";
		$info .= $text_reg_op." : ".$row['reg_op']."<BR>";
		IF($row['pwd_change'])
			{$info .= $text_pwd_change." : ".$text_yes."<BR>";}
		ELSE
			{$info .= $text_pwd_change." : ".$text_no."<BR>";}
		IF($row['pwd_crypt'])
			{$info .= $text_pwd_crypt." : ".$text_yes."<BR>";}
		ELSE
			{$info .= $text_pwd_crypt." : ".$text_no."<BR>";}
		IF($row['login_last'] > 0)
			{$info .= $text_login_last." : ".Date($VA_setup['timedate_format'], $row['login_last'])."<BR>";}
		ELSE
			{$info .= $text_login_last." : ".$text_never."<BR>";}
		IF($row['logout_last'] > 0)
			{$info .= $text_logout_last." : ".Date($VA_setup['timedate_format'], $row['logout_last'])."<BR>";}
		ELSE
			{$info .= $text_logout_last." : ".$text_never."<BR>";}
		$info .= $text_login_cnt." : ".Number_format($row['login_cnt'])."<BR>";
		$info .= $text_login_ip." : ".$row['login_ip']."<BR>";
		IF($row['error_last'] > 0)
			{$info .= $text_error_last." : ".Date($VA_setup['timedate_format'], $row['error_last'])."<BR>";}
		ELSE
			{$info .= $text_error_last." : ".$text_never."<BR>";}
		$info .= $text_error_cnt." : ".Number_Format($row['error_cnt'])."<BR>";
		$info .= $text_error_ip." : ".$row['error_ip']."<BR>";
		$info .= $text_email." : ".$row['email']."<BR>";
		IF(USR_CLASS >= 3){$info .= $text_note_op." : ".$row['note_op']."<BR>";}
		$info .= $text_note_usr." : ".$row['note_usr'];

		$row['nick'] = HTMLSpecialChars($row['nick']);
		$row['email'] = HTMLSpecialChars($row['email']);
		$row['reg_op'] = HTMLSpecialChars($row['reg_op']);
		$row['note_op'] = HTMLSpecialChars($row['note_op']);
		$row['note_usr'] = HTMLSpecialChars($row['note_usr']);
		?>
		<TR onmouseover="JavaScript: return escape('<?Print AddSlashes($info);?>');">
			<TD width=16 class="bg_light middle">
				<A name="<?Print $row['nick'];?>"><IMG src="img/<?Print $image?>" width=16 height=16></A>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
			
			<TD width=16 class="bg_light middle">
				<?IF($register_class[$row['class']] <= USR_CLASS && $row['class_protect'] <= USR_CLASS) {?>
					<A href="index.php?<?Print Change_URL_Query("q", "addreg", "nick", $row['nick']);?>" title="<?Print $text_edit_user;?>">
						<IMG src="img/edit_off.gif" width=16 height=16 id="<?Print "edit_".$row['nick'];?>" onMouseOver="ChangeImg('<?Print "edit_".$row['nick'];?>', 'img/edit_on.gif');" onMouseOut="ChangeImg('<?Print "edit_".$row['nick'];?>', 'img/edit_off.gif');">
					</A>
					<?}
				ELSE {?><IMG src="img/space.gif" width=16 height=16><?}
			IF($browser != "Mozilla") {Print "</TD>";}?>
			
			<TD width=16 class="bg_light middle">
				<?IF(($row['class'] < USR_CLASS || USR_CLASS == 10) && !$row['pwd_change'] && USR_CLASS > 2 && $row['class_protect'] <= USR_CLASS)
					{?><A href="index.php?<?Print Change_URL_Query("q", "repass", "nick", $row['nick']);?>" title="<?Print $text_change_password;?>" onClick="return ConfirmLink(this, '<?PrintF($text_pwd_change_confirm."?", $row['nick']);?>')">
						<IMG src="img/repass.gif" class="b0" width=16 height=16>
					</A><?}
				ELSE{?><IMG src="img/space.gif" width=16 height=16><?}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
	
			<TD width=16 class="bg_light middle">
				<A href="index.php?<?Print "q=sendmsg&receiver=".$row['nick'];?>" title="<?Print $text_send_msg;?>">
					<IMG src="img/messanger_off.gif" width=16 height=16 id="<?Print "sendmsg_".$row['nick'];?>" onMouseOver="ChangeImg('<?Print "sendmsg_".$row['nick'];?>', 'img/messanger_on.gif');" onMouseOut="ChangeImg('<?Print "sendmsg_".$row['nick'];?>', 'img/messanger_off.gif');">
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
	
			<TD width=16 class="bg_light middle">
	<?			IF($row['enabled']) {
					IF($disable_class[$row['class']] <= USR_CLASS && $row['class_protect'] <= USR_CLASS)
						{?><A href="index.php?<?Print Change_URL_Query("q", "delreg", "nick", $row['nick'])?>" title="<?Print $text_disable_user;?>" onClick="return ConfirmLink(this, '<?Print $text_disreg_confirm." ".$row['nick']."?";?>')"><IMG src="img/disable.gif" class="b0" width=16 height=16></A><?}
					ELSE{?><IMG src="img/space.gif" width=16 height=16><?}
					}
				ELSE {
					IF($delete_class[$row['class']] <= USR_CLASS && $row['class_protect'] <= USR_CLASS)
						{?><A href="index.php?<?Print Change_URL_Query("q", "delreg", "nick", $row['nick'])?>" title="<?Print $text_delete_user;?>" onClick="return ConfirmLink(this, '<?Print $text_delreg_confirm." ".$row['nick']."?";?>')"><IMG src="img/delete.gif" class="b0" width=16 height=16></A><?}
					ELSE{?><IMG src="img/space.gif" width=16 height=16><?}
					}?>
			<?IF($browser != "Mozilla") {Print "</TD>";}?>
	
			<?IF($VA_setup['reglist_nick']){?><TD class="bg_light"><?Print $row['nick'];?></TD><?}?>
			<?IF($VA_setup['reglist_class']){?><TD align="right" class="bg_light"><?Print $row['class'];?></TD><?}?>
			<?IF($VA_setup['reglist_class_protect']){?><TD align="right" class="bg_light"><?Print $row['class_protect'];?></TD><?}?>
			<?IF($VA_setup['reglist_class_hidekick']){?><TD align="right" class="bg_light"><?Print $row['class_hidekick'];?></TD><?}?>
			<?IF($VA_setup['reglist_hide_kick']){?><TD align="right" class="bg_light"><?Print $row['hide_kick'];?></TD><?}?>
			<?IF($VA_setup['reglist_reg_date']){?><TD class="bg_light"><?Print Date($VA_setup['timedate_format'], $row['reg_date']);?></TD><?}?>
			<?IF($VA_setup['reglist_reg_op']){?><TD class="bg_light 12px"><?Print $row['reg_op'];?></TD><?}?>
			<?IF($VA_setup['reglist_pwd_change']){?><TD align="right" class="bg_light"><?Print $row['pwd_change'];?></TD><?}?>
			<?IF($VA_setup['reglist_pwd_crypt']){?><TD align="right" class="bg_light"><?Print $row['pwd_crypt'];?></TD><?}?>
			<?IF($VA_setup['reglist_login_pwd']){?><TD class="bg_light"><?Print $row['login_pwd'];?></TD><?}?>
			<?IF($VA_setup['reglist_login_last']){?><TD class="bg_light"><?IF($row['login_last'] > 0){Print Date($VA_setup['timedate_format'], $row['login_last']);}ELSE{Print $text_never;}?></TD><?}?>
			<?IF($VA_setup['reglist_logout_last']){?><TD class="bg_light"><?IF($row['logout_last'] > 0){Print Date($VA_setup['timedate_format'], $row['logout_last']);}ELSE{Print $text_never;}?></TD><?}?>
			<?IF($VA_setup['reglist_login_cnt']){?><TD align="right" class="bg_light"><?Print Number_Format($row['login_cnt']);?></TD><?}?>
			<?IF($VA_setup['reglist_login_ip']){?><TD class="bg_light"><?Print $row['login_ip'];?></TD><?}?>
			<?IF($VA_setup['reglist_error_last']){?><TD class="bg_light"><?IF($row['error_last'] > 0){Print Date($VA_setup['timedate_format'], $row['error_last']);}ELSE{Print $text_never;}?></TD><?}?>
			<?IF($VA_setup['reglist_error_cnt']){?><TD align="right" class="bg_light"><?Print Number_Format($row['error_cnt']);?></TD><?}?>
			<?IF($VA_setup['reglist_error_ip']){?><TD align="right" class="bg_light"><?Print $row['error_ip'];?></TD><?}?>
			<?IF($VA_setup['reglist_enabled']){?><TD align="right" class="bg_light"><?Print $row['enabled'];?></TD><?}?>
			<?IF($VA_setup['reglist_email']){?><TD class="bg_light"><?Print $row['email'];?></TD><?}?>
			<?IF($VA_setup['reglist_note_op'] && USR_CLASS >= 3){?><TD class="bg_light"><?Print nl2br($row['note_op']);?></TD><?}?>
			<?IF($VA_setup['reglist_note_usr']){?><TD class="bg_light"><?Print nl2br($row['note_usr']);?></TD><?}?>
			<?IF($VA_setup['reglist_show_keys']){?><TD class="bg_light"><?Print nl2br($row['show_keys']);?></TD><?}?>
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
		<TD colspan=5 class="bg_light">&nbsp;</TD>
		<?IF($VA_setup['reglist_nick']){?><TD class="b bg_light"><?Print $text_nick; PrintOrderBy("nick");?></TD><?}?>
		<?IF($VA_setup['reglist_class']){?><TD class="b bg_light"><?Print $text_class; PrintOrderBy("class");?></TD><?}?>
		<?IF($VA_setup['reglist_class_protect']){?><TD class="b bg_light" nowrap><?Print $text_class_protect; PrintOrderBy("class_protect");?></TD><?}?>
		<?IF($VA_setup['reglist_class_hidekick']){?><TD class="b bg_light" nowrap><?Print $text_class_hidekick; PrintOrderBy("class_hidekick");?></TD><?}?>
		<?IF($VA_setup['reglist_hide_kick']){?><TD class="b bg_light" nowrap><?Print $text_hide_kick; PrintOrderBy("hide_kick");?></TD><?}?>
		<?IF($VA_setup['reglist_reg_date']){?><TD class="b bg_light" nowrap><?Print $text_reg_date; PrintOrderBy("reg_date");?></TD><?}?>
		<?IF($VA_setup['reglist_reg_op']){?><TD class="b bg_light" nowrap><?Print $text_reg_op; PrintOrderBy("reg_op");?></TD><?}?>
		<?IF($VA_setup['reglist_pwd_change']){?><TD class="b bg_light" nowrap><?Print $text_pwd_change; PrintOrderBy("pwd_change");?></TD><?}?>
		<?IF($VA_setup['reglist_pwd_crypt']){?><TD class="b bg_light" nowrap><?Print $text_pwd_crypt; PrintOrderBy("pwd_crypt");?></TD><?}?>
		<?IF($VA_setup['reglist_login_pwd']){?><TD class="b bg_light" nowrap><?Print $text_login_pwd; PrintOrderBy("login_pwd");?></TD><?}?>
		<?IF($VA_setup['reglist_login_last']){?><TD class="b bg_light" nowrap><?Print $text_login_last; PrintOrderBy("login_last");?></TD><?}?>
		<?IF($VA_setup['reglist_logout_last']){?><TD class="b bg_light" nowrap><?Print $text_logout_last; PrintOrderBy("logout_last");?></TD><?}?>
		<?IF($VA_setup['reglist_login_cnt']){?><TD class="b bg_light" nowrap><?Print $text_login_cnt; PrintOrderBy("login_cnt");?></TD><?}?>
		<?IF($VA_setup['reglist_login_ip']){?><TD class="b bg_light" nowrap><?Print $text_login_ip; PrintOrderBy("login_ip");?></TD><?}?>
		<?IF($VA_setup['reglist_error_last']){?><TD class="b bg_light" nowrap><?Print $text_error_last; PrintOrderBy("error_last");?></TD><?}?>
		<?IF($VA_setup['reglist_error_cnt']){?><TD class="b bg_light" nowrap><?Print $text_error_cnt; PrintOrderBy("error_cnt");?></TD><?}?>
		<?IF($VA_setup['reglist_error_ip']){?><TD class="b bg_light" nowrap><?Print $text_error_ip; PrintOrderBy("error_ip");?></TD><?}?>
		<?IF($VA_setup['reglist_enabled']){?><TD class="b bg_light" nowrap><?Print $text_enabled; PrintOrderBy("enabled");?></TD><?}?>
		<?IF($VA_setup['reglist_email']){?><TD class="b bg_light" nowrap><?Print $text_email; PrintOrderBy("email");?></TD><?}?>
		<?IF($VA_setup['reglist_note_op'] && USR_CLASS >= 3){?><TD class="b bg_light" nowrap><?Print $text_note_op; PrintOrderBy("note_op");?></TD><?}?>
		<?IF($VA_setup['reglist_note_usr']){?><TD class="b bg_light" nowrap><?Print $text_note_usr; PrintOrderBy("note_usr");?></TD><?}?>
		<?IF($VA_setup['reglist_note_usr']){?><TD class="b bg_light" nowrap><?Print $text_show_keys; PrintOrderBy("show_keys");?></TD><?}?>
	</TR>
</TABLE>

<script language="JavaScript" type="text/javascript" src="js/tooltip.js"></script>

<?
IF($pages > 1)
	{Navigation();}
?>
