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
?>

<TABLE class="encoding">
	<TR>
		<FORM action="language.php?<?Print $_SERVER['QUERY_STRING'];?>" method="post">
		<TD nowrap>
			<?
			Print "<FONT class=\"b\">".$text_encoding."</FONT>&nbsp;:&nbsp;";
			IF($VA_setup['language_source'] == 1) {
				$encoding = Explode("|", $encoding);
				}
			IF(Count($encoding) > 1) {?>
				<SELECT name="encoding" class="fs9px">
<?				FOR($i = 0; $i < Count($encoding); $i++) {?>
					<OPTION value="<?Print $encoding[$i];?>"<?IF($_COOKIE['encoding'] == $encoding[$i]){Print " selected";}?>><?Print $encoding[$i];?></OPTION>
<?					}?>
				</SELECT>
				<INPUT class="fs9px" type="submit" value="<?Print $text_show;?>">
<?				}
			ELSE
				{Print $encoding[0];}
			?>
		</TD>
		</FORM>
	</TR>
</TABLE>