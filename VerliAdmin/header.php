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
?>

<TABLE align="left" class="leftpanel" width=100>
<?IF(USR_CLASS) {
	$img = Get_Usr_Img(USR_NICK, USR_CLASS);
?>
	<TR>
		<TD class="b right"><?Print $text_nick." : ";?></TD>
		<TD nowrap><?Print USR_NICK;?></TD>
		<TD class="top right"><IMG src="img/<?Print $img;?>" height=16 width=16></TD>
	</TR>
<?}?>
	<TR>
		<TD class="b right" nowrap><?Print $text_class." : ";?></TD>
		<TD nowrap><?Print GetClassName(USR_CLASS)." (".USR_CLASS.")";?></TD>
	</TR><TR>
		<TD class="b right" nowrap><?Print $text_language." : ";?></TD>
		<TD<?IF(USR_CLASS){?> colspan=2<?}?> nowrap>
			<?
			IF($lang_http)
				{Print "<A href=\"".$lang_http."\" target=\"_blank\">".$lang_name."</A>";}
			ELSE
				{Print $lang_name;}
			Print " ".$text_by." ";
			IF($lang_email)
				{Print "<A href=\"mailto:".$lang_email."\">".$lang_author."</A>";}
			ELSE
				{Print $lang_author;}
			Print " (".$lang_version.")";
			?>
		</TD>
	</TR>
<?IF($debug[3]) {?>
	<TR>
		<TD class="b right" nowrap><?Print $text_view_mode;?> : </TD>
		<TD colspan=2 nowrap><?Print $_COOKIE['brwsr_tp'];?></TD>
	</TR>
<?}?>
</TABLE>

<?
Include "flags.php";
Include "encoding.php";
?>


<FONT class="h1">VerliAdmin</FONT><BR>

<?
Include "menu_op.php";
Include "menu_common.php";

IF(USR_NICK) {
	IF($_GET['return'])
		$return = $_GET['return'];
	ELSE
		$return = $_GET['q'];
?>
	<TABLE class="<?IF($_COOKIE['brwsr_tp'] == "Mozilla"){Print " command_line";}ELSE{Print "b1 bg_light fs10px";}?>">
	<FORM action="index.php?<?Print Change_URL_Query("q", "command_line", "return", $return);?>" method="post">
		<TR>
			<TD width=1 nowrap><FONT class="b"><?Print Str_Replace(" ", "&nbsp;", $text_command_line);?>&nbsp;:&nbsp;</FONT></TD>
			<TD><INPUT class="fs9px<?IF($_COOKIE['brwsr_tp'] == "Mozilla"){Print " w100pr";}ELSE{Print " w300px";}?>" name="command" type="text" value="<?Print $_POST['command'];?>"></TD>
			<TD width=1 nowrap><INPUT class="fs9px w75px" name="command_line" type="submit" value="<?Print $text_send;?>"></TD>
		</TR>
	</FORM>
	</TABLE>
<?	}?>
