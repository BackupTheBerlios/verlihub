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

IF(USR_CLASS < $VA_setup['messanger_min_class'])
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['delete'])
	{$DB_hub->Query("DELETE FROM pi_messages WHERE `sender` = '".$_POST['sender']."' AND `date_sent` = '".$_POST['date_sent']."' AND `receiver` LIKE '".USR_NICK."'");}
?>

<FONT class="h2"><?Print $text_messanger;?></FONT>

<BR><BR>

<?
$query = " WHERE `receiver` LIKE '".USR_NICK."'";

IF($_GET['filter'] != "" && $_GET['filter_colum'] != "")
	{
	IF($VA_setup['create_indexes'])
		Create_Index($DB_hub, "pi_messages", $_GET['filter_colum']);
	
	IF($_GET['filter_colum'] == "date_sent" || $_GET['filter_colum'] == "date_expires")
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
	$query .= $_GET['filter'];
	IF($_GET['filter_type'] == "contains" || $_GET['filter_type'] == "begins")
		{$query .= "%";}
	$query .= "'";
	}

$colums  = $VA_setup['messanger_sender'] + $VA_setup['messanger_date_sent'];
$colums += $VA_setup['messanger_sender_ip'] + $VA_setup['messanger_receiver'];
$colums += $VA_setup['messanger_date_expires'] + $VA_setup['messanger_subject'];
$colums += $VA_setup['messanger_body'] + 2;

?>

<BR>

<TABLE class="fs9px b1">
	<TR>
		<FORM action="index.php?q=sendmsg&<?Print "page=".$_GET['page']."&orderby=".$_GET['orderby']."&filter_colum=".$_GET['filter_colum']."&filter_type=".$_GET['filter_type']."&filter=".$_GET['filter'];?>" method="post">
		<TD class="bg_light" colspan=8><INPUT type="submit" value="<?Print $text_send_msg;?>"></TD>
		</FORM>
	</TR>
<?
IF($_COOKIE['login'])
	{
	IF($_GET['page'] == ""){$_GET['page'] = 1;}
	IF($_GET['orderby'] == ""){$_GET['orderby'] = $VA_setup['messanger_order_by'];}
	
	$result = $DB_hub->Query("SELECT Count(sender) AS `count` FROM pi_messages".$query);
	$count = $result->Fetch_Assoc();
	$total = $count['count'];
	$result->Free_Result();
	$pages = (int)(($total - 1) / $VA_setup['messanger_results']) + 1;
	$first = $VA_setup['messanger_results'] * ($_GET['page'] - 1);
	
	$query = "SELECT * FROM pi_messages".$query;
	$query .= " ORDER BY ".$DB_hub->Real_Escape_String($_GET['orderby'])." LIMIT ".$first.",".$VA_setup['file_trigger_results'];
/*	IF($debug[2]) {
		VA_Message($query, "bohyn32");
		Print "<BR>";
		}*/

	IF($pages > 1)
		Navigation();?>
	
	<FORM action="index.php" method="get">
		<TD colspan=<?Print $colums;?> align="right" class="bg_light" nowrap>
			<INPUT name="q" type="hidden" value="messanger">
			<INPUT name="orderby" type="hidden" value="<?Print $_GET['orderby'];?>">
			<SELECT name="filter_colum" size=1>
				<OPTION> </OPTION>
				<OPTION value="sender"<?IF($_GET['filter_colum'] == "sender"){Print " selected";}?>><?Print $text_sender;?></OPTION>
				<OPTION value="date_sent"<?IF($_GET['filter_colum'] == "date_sent"){Print " selected";}?>><?Print $text_date_sent;?></OPTION>
				<OPTION value="sender_ip"<?IF($_GET['filter_colum'] == "sender_ip"){Print " selected";}?>><?Print $text_sender_ip;?></OPTION>
				<OPTION value="receiver"<?IF($_GET['filter_colum'] == "receiver"){Print " selected";}?>><?Print $text_receiver;?></OPTION>
				<OPTION value="date_expires"<?IF($_GET['filter_colum'] == "date_expires"){Print " selected";}?>><?Print $text_date_expires;?></OPTION>
				<OPTION value="subject"<?IF($_GET['filter_colum'] == "subject"){Print " selected";}?>><?Print $text_subject;?></OPTION>
				<OPTION value="body"<?IF($_GET['filter_colum'] == "body"){Print " selected";}?>><?Print $text_body;?></OPTION>
			</SELECT>
			&nbsp;&nbsp;
			<SELECT name="filter_type" size=1>
				<OPTION> </OPTION>
				<OPTION value="contains"<?IF($_GET['filter_type'] == "contains"){Print " selected";}?>><?Print $text_contains;?></OPTION>
				<OPTION value="equal"<?IF($_GET['filter_type'] == "equal"){Print " selected";}?>><?Print $text_equal;?></OPTION>
				<OPTION value="begins"<?IF($_GET['filter_type'] == "begins"){Print " selected";}?>><?Print $text_begins;?></OPTION>
				<OPTION value="ends"<?IF($_GET['filter_type'] == "ends"){Print " selected";}?>><?Print $text_ends;?></OPTION>
				<OPTION value="greater"<?IF($_GET['filter_type'] == "greater"){Print " selected";}?>><?Print $text_greater;?></OPTION>
				<OPTION value="less"<?IF($_GET['filter_type'] == "less"){Print " selected";}?>><?Print $text_less;?></OPTION>
			</SELECT>
			&nbsp;&nbsp;
			<FONT class="b"><?Print $text_filter;?> : </FONT>
			<INPUT name="filter" type="text" size=35 value="<?Print $_GET['filter'];?>">
			<INPUT type="submit" value="<?Print $text_show;?>" class="w75px">
		</TD>
	</FORM>
	</TR><TR>
			<TD class="bg_light" colspan=2 width=32>&nbsp;</TD>
			<?IF($VA_setup['messanger_sender']){?><TD class="b bg_light" nowrap><?Print $text_sender; PrintOrderBy("sender");?></TD><?}?>
			<?IF($VA_setup['messanger_date_sent']){?><TD class="b bg_light" nowrap><?Print $text_date_sent; PrintOrderBy("date_sent");?></TD><?}?>
			<?IF($VA_setup['messanger_sender_ip']){?><TD class="b bg_light" nowrap><?Print $text_sender_ip; PrintOrderBy("sender_ip");?></TD><?}?>
			<?IF($VA_setup['messanger_receiver']){?><TD class="b bg_light" nowrap><?Print $text_receiver; PrintOrderBy("receiver");?></TD><?}?>
			<?IF($VA_setup['messanger_date_expires']){?><TD class="b bg_light" nowrap><?Print $text_date_expires; PrintOrderBy("date_expires");?></TD><?}?>
			<?IF($VA_setup['messanger_subject']){?><TD class="b bg_light" nowrap><?Print $text_subject; PrintOrderBy("date_subject");?></TD><?}?>
			<?IF($VA_setup['messanger_body']){?><TD class="b bg_light" nowrap><?Print $text_body; PrintOrderBy("date_body");?></TD><?}?>
		</TR>
<?
	IF($total > 0) {
		$result = $DB_hub->Query($query);
		WHILE($row = $result->Fetch_Assoc())
			{
			$row['sender'] = HTMLSpecialChars($row['sender']);
			$row['receiver'] = HTMLSpecialChars($row['receiver']);
			$row['subject'] = HTMLSpecialChars($row['subject']);
			$row['body'] = nl2br(HTMLSpecialChars($row['body']));
			
			$info  = $text_sender." : ".$row['sender']."<BR>";
			$info .= $text_sender_ip." : ".$row['sender_ip']."<BR>";
			$info .= $text_receiver." : ".$row['receiver']."<BR>";
			$info .= $text_date_sent." : ".Date($VA_setup['timedate_format'], $row['date_sent'])."<BR>";
			$info .= $text_date_expires." : ".Date($VA_setup['timedate_format'], $row['date_expires'])." ";
			?>
		<TR onmouseover="JavaScript: return escape('<?Print AddSlashes($info);?>');">
				<FORM action="index.php?<?Print Change_URL_Query("q", "sendmsg");?>" method="post">
					<INPUT name="receiver" type="hidden" value="<?Print $row['sender'];?>">
					<INPUT name="subject" type="hidden" value="<?Print Reply_Subject($row['subject']);?>">
				<TD class="bg_light" width=16>
					<INPUT type="image" value="<?Print $text_reply;?>" src="img/reply.gif" title="<?Print $text_reply;?>" class="b0">
				<?IF($browser != "Mozilla") {Print "</TD>";}?>
				</FORM>

				<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
					<INPUT name="sender" type="hidden" value="<?Print $row['sender'];?>">
					<INPUT name="date_sent" type="hidden" value="<?Print $row['date_sent'];?>">
				<TD class="bg_light" width=16>
					<INPUT name="delete" type="image" value="<?Print $text_delete;?>" src="img/delete.gif" title="<?Print $text_delete;?>" class="b0">
				<?IF($browser != "Mozilla") {Print "</TD>";}?>
				</FORM>

				<?IF($VA_setup['messanger_sender']){?><TD class="bg_light"><?Print $row['sender'];?></TD><?}?>
				<?IF($VA_setup['messanger_date_sent']){?><TD class="bg_light"><?Print Date($VA_setup['timedate_format'], $row['date_sent']);?></TD><?}?>
				<?IF($VA_setup['messanger_sender_ip']){?><TD class="bg_light"><?Print $row['sender_ip'];?></TD><?}?>
				<?IF($VA_setup['messanger_receiver']){?><TD class="bg_light"><?Print $row['receiver'];?></TD><?}?>
				<?IF($VA_setup['messanger_date_expires']){?><TD class="bg_light"><?Print Date($VA_setup['timedate_format'], $row['date_expires']);?></TD><?}?>
				<?IF($VA_setup['messanger_subject']){?><TD class="bg_light"><?Print $row['subject'];?></TD><?}?>
				<?IF($VA_setup['messanger_body']){?><TD class="bg_light"><?Print $row['body'];?></TD><?}?>
			</TR>
<?			}
		$result->Free_Result();
		}
	ELSE {?>
			<TR>
				<TD class="b bg_light center" colspan=10>
					<BR>
					&lt;&lt;&lt;&nbsp;&nbsp;<?Print $text_no_results;?>&nbsp;&nbsp;&gt;&gt;&gt;
					<BR><BR>
				</TD>
			</TR>
<?		}?>
		<TR>
			<TD class="bg_light" colspan=2 width=16>&nbsp;</TD>
			<?IF($VA_setup['messanger_sender']){?><TD class="b bg_light" nowrap><?Print $text_sender; PrintOrderBy("sender");?></TD><?}?>
			<?IF($VA_setup['messanger_date_sent']){?><TD class="b bg_light" nowrap><?Print $text_date_sent; PrintOrderBy("date_sent");?></TD><?}?>
			<?IF($VA_setup['messanger_sender_ip']){?><TD class="b bg_light" nowrap><?Print $text_sender_ip; PrintOrderBy("sender_ip");?></TD><?}?>
			<?IF($VA_setup['messanger_receiver']){?><TD class="b bg_light" nowrap><?Print $text_receiver; PrintOrderBy("receiver");?></TD><?}?>
			<?IF($VA_setup['messanger_date_expires']){?><TD class="b bg_light" nowrap><?Print $text_date_expires; PrintOrderBy("date_expires");?></TD><?}?>
			<?IF($VA_setup['messanger_subject']){?><TD class="b bg_light" nowrap><?Print $text_subject; PrintOrderBy("date_subject");?></TD><?}?>
			<?IF($VA_setup['messanger_body']){?><TD class="b bg_light" nowrap><?Print $text_body; PrintOrderBy("date_body");?></TD><?}?>
		</TR>
	</TABLE>	
	<?
	IF($pages > 1)
		{Navigation();}
	}?>
</TABLE>

<SCRIPT language="JavaScript" type="text/javascript" src="js/tooltip.js"></script>
