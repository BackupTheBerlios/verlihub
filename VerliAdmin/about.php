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

<FONT class="h2"><?Print $text_about;?></FONT>

<BR><BR>

<TABLE class="fs9px b1 bg_light">
	<TR>
		<TD class="center">
			<TABLE align="center" class="b1 fs12px">
				<TR>
					<TD class="b right" nowrap>&nbsp;&nbsp;<?Print $text_this_version;?> :</TD>
					<TD>&nbsp;&nbsp;<?Print VA_VERSION;?>&nbsp;&nbsp;</TD>
				</TR>
				<TR>
					<TD class="b right" nowrap>&nbsp;&nbsp;<?Print $text_newest_version;?> :</TD>
					<TD>&nbsp;&nbsp;<?
					//@Include("http://ja.tinet.cz/vahome/newversion.php?count=".VA_COUNT);
					@Include("http://verliadmin.wz.cz/newversion.php?count=".VA_COUNT);
					?>&nbsp;&nbsp;</TD>
				</TR>
			</TABLE>
			<BR>
			<FONT class="b"><?Print $text_download_new;?> :&nbsp;</FONT>
			<?
			//@Include("http://ja.tinet.cz/vahome/dwnld.php?count=".VA_COUNT);
			@Include("http://verliadmin.wz.cz/dwnld.php?count=".VA_COUNT);
			?>

			<BR>

			<FONT class="b"><?Print $text_homepage;?> : </FONT><A href="http://bohyn.czechweb.cz/" title="bohyn.czechweb.cz" class="b">bohyn.czechweb.cz</A><BR>
			<FONT class="b"><?Print $text_forum;?> : </FONT>
			<A href="http://verlihub.no-ip.com/" title="VerliHub forum (EN)" class="b">VerliHub forum</A>,&nbsp;&nbsp;
			<A href="http://www.periferie.biz/modules/newbb" title="periferie.biz forum (CZ)" class="b">periferie.biz</A>

			<BR><BR>			

			<!-- Begin moneybookers button code -->
			<FONT class="b">Support VerliAdmin project:</FONT><BR>
			<A href="http://www.moneybookers.com/" target="_blank"><IMG style="border-width: 1px; border-color: #8B8583;" src="http://www.moneybookers.com/images/banners/88_en_logo.gif" width=88 height=31 border=0></A><BR>
			Account: bohyn @ verliadmin . wz . cz
			<!-- End of moneybookers button code -->

			<BR><BR>

			<A href="http://bohyn.czechweb.cz/changelog.php?version=<?Print VA_VERSION;?>" target="frame" class="b b1">&nbsp;<?Print $text_changelog;?>&nbsp;</A>
			<A href="http://bohyn.czechweb.cz/bugreport.php?version=<?Print VA_VERSION;?>" target="frame" class="b b1">&nbsp;<?Print $text_bug_report;?>&nbsp;</A>
			<BR>
			<!--
			<IFRAME src="http://ja.tinet.cz/vahome/changelog.php?version=<?Print VA_VERSION;?>" name="frame" class="b1" width=550 height=300></IFRAME>
			-->
			<IFRAME src="http://bohyn.czechweb.cz/changelog.php?version=<?Print VA_VERSION;?>" name="frame" class="b1" width=550 height=300></IFRAME>
			
			<BR><BR>

			<FONT class="b"><?Print $text_author;?> : </FONT><BR>
			bohyn (zumpa.no-ip.com)<BR><BR>
			<FONT class="b"><?Print $text_special_thanx;?> : </FONT><BR>
			Kangaroo (hub.periferie.biz:4112)<BR>
			Verliba (czpro.no-ip.com)<BR><BR>
			<FONT class="b"><?Print $text_translations;?> : </FONT><BR>
			Czech by bohyn<BR>
			English by bohyn<BR>
			French by Verliba<BR>
			German by Andy<BR>
			Hungarian by Spy<BR>
			Italian by Skull<BR>
			Latvian by e.T.<BR>
			Polish by Alianora<BR>
			Romanian by DanyD<BR>
			Russian by cirex<BR>
			Swedish by Nille<BR><BR>
		</TD>
	</TR>
</TABLE>
