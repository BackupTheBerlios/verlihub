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

$script_start = GetMicroTime($script_start);
$script_end = GetMicroTime();
$scrpt_time = Round($script_end - $script_start, 4);

StoreQueries($DB_hub);
?>

<BR>
<TABLE class="footer">
	<TR>
		<TD class="left" nowrap><?PrintF("<FONT class=\"b\">".$text_page_time."</FONT>", $scrpt_time);?></TD>
		<?IF(MySQL == "MySQL"){?><TD class="left" nowrap><?Print "<FONT class=\"b\">".$text_queries."</FONT> : ".($DB_hub->mysql_queries * 1)." / ".Number_Format($_COOKIE['queries']);?></TD><?}?>
		<TD class="right b" nowrap><A href="http://bohyn.czechweb.cz/" title="bohyn.czechweb.cz">VerliAdmin v<?Print VA_VERSION;?></A>, &copy; by <A href="mailto:support@verliadmin.wz.cz">bohyn</A>&nbsp;&nbsp;</TD>
	</TR>
</TABLE>

<BR><BR>