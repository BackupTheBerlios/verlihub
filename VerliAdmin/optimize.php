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

IF(USR_CLASS < 10)
	{Die(VA_Message($err_msg_no_access, "error"));}

IF($_POST['yes'] || $_GET['confirmed']) {
	
	IF($_GET['c'] == "optimize") {
		$DB_hub->Query("OPTIMIZE TABLE `".$_GET['table']."`");
		}
	ELSEIF($_GET['c'] == "truncate") {
		$DB_hub->Query("TRUNCATE TABLE `".$_GET['table']."`");
		}
	
	StoreQueries();
	
	Header("Location: index.php");
	Die();
	}
ELSEIF($_POST['no']) {
	Header("Location: index.php");
	Die();
	}
?>

<FONT class="h2"><?Print $text_tb_optimalization;?></FONT>

<BR><BR>

<FORM action="index.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
<TABLE width=300 class="b1 fs9px">
	<TR>
		<TD class="bg_light center" height=50 width=50>
			<IMG height=32 src="img/help.gif" width=32>
		</TD>
		<TD class="bg_light b center">
<?			IF($_GET['c'] == "optimize")
				{PrintF($text_tb_optimize." ?", $_GET['table']);}
			ELSE
				{PrintF($text_tb_truncate." ?", $_GET['table']);}?>
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
