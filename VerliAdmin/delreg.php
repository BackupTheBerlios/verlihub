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
IF($_POST['yes'] || $_GET['confirmed']) {

	$query  = "SELECT * FROM reglist
				WHERE nick LIKE '".$_GET['nick']."'";
	$result = $DB_hub->Query($query);

	IF($result->num_rows != 1) {
		IF($result->num_rows == 0) {
			Die(VA_Message($err_msg_no_user_found, "error"));
			}
		ELSE {
			Die(VA_Message($err_msg_too_much_users, "error"));
			}
		}
	
	$row = $result->Fetch_Assoc();
	
	IF($row['enabled']) {
		$disable_class = FetchClass("|", $VA_setup['disable_class']);
		IF($disable_class[$row['class']] <= USR_CLASS) {
			$query  = "UPDATE reglist
						SET enabled=0
						WHERE nick LIKE '".$_GET['nick']."'";
			$DB_hub->Query($query);

			IF($setup['log_disablereg']) {
				$action = "Disabled reg user ".$_GET['nick']." with class ".$row['class'];
				LogFile(USR_NICK, USR_CLASS, $action, "disablereg");
				}
			}
		ELSE {
			Die(VA_Message($err_msg_no_access, "error"));
			}
		}
	ELSE {
		$delete_class = FetchClass("|", $VA_setup['delete_class']);
		IF($delete_class[$row['class']] <= USR_CLASS) {
			$query  = "DELETE FROM reglist
						WHERE nick LIKE '".$_GET['nick']."'";
			$DB_hub->Query($query);

			IF($VA_setup['log_deletereg']) {
				$action = "Deleted reg user ".$_GET['nick']." with class ".$row['class'];
				LogFile(USR_NICK, USR_CLASS, $action, "deletereg");
				}
			}
		ELSE {
			Die(VA_Message($err_msg_no_access, "error"));
			}
		}

	StoreQueries();
	
	Header("Location: index.php?".Change_URL_Query("q", "reglist", "confirmed", "", "nick", ""));
	Die();
	}

ELSEIF($_POST['no']) {
	Header("Location: index.php?".Change_URL_Query("q", "reglist", "nick", ""));
	Die();
	}


$query  = "SELECT enabled FROM reglist
			WHERE nick = '".$_GET['nick']."'";
$result = $DB_hub->Query($query);
$row = $result->Fetch_Assoc();
?>

<FONT class="h2"><?Print $text_delreg;?></FONT>

<BR><BR>
<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE width=300 class="b1 fs9px">
	<TR>
		<TD class="bg_light center" height=50 width=50>
			<IMG src="img/delreg.gif" width=32 height=32>
		</TD>
		<TD class="bg_light b center">
<?			IF($row['enabled'])
				{Print $text_disreg_confirm." '".$_GET['nick']."' ?";}
			ELSE
				{Print $text_delreg_confirm." '".$_GET['nick']."' ?";}?>
		</TD>
	</TR>
	<TR>
		<TD align="right" colspan=2 class="bg_light">
			<INPUT class="w75px" name="yes" type="submit" value="<?Print $text_yes;?>">
			<INPUT class="w75px" name="no" type="submit" value="<?Print $text_no;?>">
		</TD>
	</TR>
</TABLE>
</FONT>
