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

IF($_POST['submit']) {
	//Add / edit trigger

	IF($VA_setup['conn_types_edit_class'] > USR_CLASS) {
		Die(VA_Message($err_msg_no_access));
		}

	$_POST['identifier'] = $DB_hub->Real_Escape_String($_POST['identifier']);
	$_POST['description'] = $DB_hub->Real_Escape_String($_POST['description']);

	$query  = "REPLACE INTO conn_types \n";
	$query .= "(identifier, description, tag_min_slots, tag_max_slots, tag_min_limit, tag_min_ls_ratio) \n";
	$query .= "VALUES ('".$_POST['identifier']."', '".$_POST['description']."', '".$_POST['tag_min_slots']."', '".$_POST['tag_max_slots']."', '".$_POST['tag_min_limit']."', '".$_POST['tag_min_ls_ratio']."')";
	$DB_hub->Query($query);

	StoreQueries();

	//Return to conn_typess
	Header("Location: index.php?".Change_URL_Query("q", "conn_types"));
	Die();
	}
?>

<FONT class="h2"><?Print $text_edit_type;?></FONT>

<BR><BR>

<?
IF($_GET['identifier']) {
	$query  = "SELECT * FROM conn_types \n";
	$query .= "WHERE `identifier` LIKE '".$_GET['identifier']."'";
	$result = $DB_hub->Query($query);
	$row = $result->Fetch_Assoc();
	}
?>

<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE class="b1 fs9px">
	<TR>
		<TD class="bg_light right b"><?Print $text_identifier;?> : </TD>
		<TD class="bg_light"><INPUT name="identifier" class="w300px" type="text" value="<?Print $row['identifier'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_description;?> : </TD>
		<TD class="bg_light"><INPUT name="description" class="w300px" type="text" value="<?Print $row['description'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_tag_min_slots;?> : </TD>
		<TD class="bg_light"><INPUT name="tag_min_slots" class="w300px" type="text" value="<?Print $row['tag_min_slots'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_tag_max_slots;?> : </TD>
		<TD class="bg_light"><INPUT name="tag_max_slots" class="w300px" type="text" value="<?Print $row['tag_max_slots'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_tag_min_limit;?> : </TD>
		<TD class="bg_light"><INPUT name="tag_min_limit" class="w300px" type="text" value="<?Print $row['tag_min_limit'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right b"><?Print $text_tag_min_ls_ratio;?> : </TD>
		<TD class="bg_light"><INPUT name="tag_min_ls_raio" class="w300px" type="text" value="<?Print $row['tag_min_ls_ratio'];?>"></TD>
	</TR><TR>
		<TD class="bg_light right" colspan=2>
			<INPUT class="w75px" type="reset" value="<?Print $text_reset;?>">
			<INPUT class="w75px" name="submit" type="submit" value="<?Print $text_send;?>">
		</TD>
	</TR>
</TABLE>
</FORM>
