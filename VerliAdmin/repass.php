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
	
	$query  = "SELECT * FROM reglist \n";
	$query .= "WHERE nick LIKE '".$_GET['nick']."'";
	$result = $DB_hub->Query($query);

	IF($result->num_rows() != 1) {
		IF($result->num_rows() == 0) {
			Die(VA_Message($err_msg_no_user_found, "error"));
			}
		ELSE {
			Die(VA_message($err_msg_too_much_users, "error"));
			}
		}
	
	$row = $result->Fetch_Assoc();
	
	IF(USR_CLASS <= $row['class'] && USR_CLASS != 10) {
		Die(VA_Message($err_msg_no_access, "error"));
		}

	$query  = "UPDATE reglist \n";
	$query .= "SET pwd_change = 1 \n";
	$query .= "WHERE nick = '".$_GET['nick']."'";
	$DB_hub->Query($query);

	StoreQueries();

	Header("Location: index.php?".Change_URL_Query("q", "reglist", "nick", "", "confirmed", "")."#".$_GET['nick']);
	Die();
	}
ELSEIF(IsSet($_POST['no'])) {
	Header("Location: index.php?".Change_URL_Query("q", "reglist", "nick", "")."#".$_GET['nick']);
	Die();
	}
?>

<FONT class="h2"><?Print $text_pwd_change;?></FONT>

<BR><BR>

<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE class="b1 fs12px" width=350>
	<TR>
		<TD class="bg_light center" height=60 width=50>
			<IMG src="img/help.gif" height=32 width=32>
		</TD>
		<TD class="bg_light b center">
			<?PrintF($text_pwd_change_confirm." ?", $_GET['nick']);?>
		</TD>
	</TR>
	<TR>
		<TD class="bg_light right" colspan=2>
			<INPUT class="w75px" name="yes" type="submit" value="<?Print $text_yes;?>">
			<INPUT class="w75px" name="no" type="submit" value="<?Print $text_no;?>">
		</TD>
	</TR>
</TABLE>
</FONT>
