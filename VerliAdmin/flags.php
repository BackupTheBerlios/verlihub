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

SWITCH($VA_setup['language_source']) {
	CASE 0 :
		//Flags source is gif file (default ()like in <= 0.3 RC3 versions)
		$language = Explode("|", $VA_setup['language']);
		$width = Count($language) * 22 + Count($language) * 4 + 4;
		?>
		
		<TABLE align="right" class="rightpanel" width=0>
			<TR>
				<TD valign="middle" align="center" nowrap>
					<IMG src="img/space.gif" width=4 height=15>
					<?
					$language = Explode("|", $VA_setup['language']);
					FOR($i = 0; $i < Count($language); $i++) {
						Print "<A href=\"language.php?".Change_URL_Query("lang", $language[$i])."\" title=\"".StrToUpper($language[$i])."\"><IMG src=\"img/".$language[$i]."flag.gif\" width=22 height=15 alt=\"".StrToUpper($language[$i])."\"></A>\n";
?>						<IMG src="img/space.gif" width=4 height=15>
<?						}?>
				</TD>
			</TR>
		</TABLE>
<?		BREAK;
//---------------------------------------------------------------------
	CASE 1 :
		//Get flags from MySQL database (not ready yet)
		$result = $DB_hub->Query("SELECT DISTINCT language FROM va_languages ORDER BY language");?>
		<TABLE align="right" class="rightpanel" width=0>
			<TR>
				<TD valign="middle" align="center" nowrap>
					<IMG src="img/space.gif" width=4 height=15>
<?					WHILE($row = $result->Fetch_Assoc()) {
						Print "<A href=\"language.php?".Change_URL_Query("lang", $row['language'])."\">";
							Print "<IMG src=\"img/".$row['language']."flag.gif\" width=22 height=15 alt=\"".StrToUpper($row['language'])."\">";
?>						</A>
						<IMG src="img/space.gif" width=4 height=15>
<?						}
?>				</TD>
			</TR>
		</TABLE>
<?		BREAK;
//---------------------------------------------------------------------
	CASE 2 :
		Die(VA_Message("Not yet implemented", "error"));

		IF(!Defined(SQLITE_ASSOC))
			Die(VA_Message("SQLite support missing", "error"));

//		$sqlite_db = SQLite_Open("language/".LANG);
		$result = SQLite_Query($sqlite_db, "SELECT DISTINCT language FROM va_languages ORDER BY language");
?>
		<TABLE align="right" class="rightpanel" width=0>
			<TR>
				<TD valign="middle" align="center" nowrap>
					<IMG src="img/space.gif" width=4 height=15>
<?					WHILE($row = SQLite_Fetch_Array($result, SQLITE_ASSOC)) {
						Print "<A href=\"language.php?".Change_URL_Query("lang", $row['language'])."\">";
							Print "<IMG src=\"img/".$row['language']."flag.gif\" width=22 height=15 alt=\"".StrToUpper($row['language'])."\">";
?>						</A>
						<IMG src="img/space.gif" width=4 height=15>
<?						}
?>				</TD>
			</TR>
		</TABLE>
<?		BREAK;
		}?>	