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

<TABLE align="center" class="header b0">
	<TR>
		<TD class="b1" nowrap><A href="index.php" class="home" title="<?Print $text_home;?>"><?Print $text_home;?></A></TD>
		<?IF(USR_CLASS >= $VA_setup['banlist_unban_class']) {
		        $reqres = $DB_hub->Query("SELECT nick, ip, time FROM va_unban WHERE status = 0");
		        while($nicks = $reqres->Fetch_Assoc())
		        {
      		            $reqquery = "SELECT Count(nick) AS `count` FROM banlist WHERE ";
      		            IF($nicks['nick']=="_ipban_")
                            $reqquery .= "`ip` LIKE '".$nicks['ip']."'";
      		            ELSEIF($nicks['ip']=="_nickban_")
                            $reqquery .= "`nick` LIKE '".$nicks['nick']."'";
                            ELSE
                            $reqquery .= "`nick` LIKE '".$nicks['nick']."' AND `ip` LIKE '".$nicks['ip']."'";
                            $reqquery .= " AND (`date_limit` > UNIX_TIMESTAMP() OR `date_limit` IS NULL)";
                            $reqres2 = $DB_hub->Query($reqquery);
                            $count = $reqres2->Fetch_Assoc();
                            $all += $count['count'];
		        }
		        IF($all!=0){
                        ?><TD class="b1" nowrap><A href="index.php?q=unban_admin" class="unban" title="<?Print $text_unban;?>"><?Print $text_unbans."&nbsp;(".$all.")";?></A></TD><?}}
		ELSE
			{?><TD class="b1" nowrap><A href="index.php?q=bantest" class="bantest" title="<?Print $text_ban_test;?>"><?Print $text_ban_test;?></A></TD><?}
		IF($VA_setup['messanger_min_class'] <= USR_CLASS) {
			$result = $DB_hub->Query("SELECT Count(body) AS `count` FROM pi_messages WHERE receiver LIKE '".$_COOKIE['nick']."'");
                        $count = $result->Fetch_Assoc();
?>			<TD class="b1"><A href="index.php?q=messanger" class="messanger" title="<?Print $text_messanger;?>"><?Print $text_messanger; IF($count['count']!=0) Print "&nbsp;(".$count['count'].")";?></A></TD>
<?			}?>
		<?IF($VA_setup['stats_min_class'] <= USR_CLASS)
			{?><TD class="b1" nowrap><A href="index.php?q=stats" class="stats" title="<?Print $text_stats;?>"><?Print $text_stats;?></A></TD><?}?>
		<?IF($_COOKIE['login'])
			{?><TD class="b1" nowrap><A href="index.php?q=logout" class="logout" title="<?Print $text_logout;?>"><?Print $text_logout;?></A></TD><?}
		IF((USR_PWD_CHANGE && $_COOKIE['login']) || !$_COOKIE['login'])
			{?><TD class="b1" nowrap><A href="index.php?q=chpass" class="chpass" title="<?Print $text_change_password;?>"><?Print $text_change_password;?></A></TD><?}?>
		<TD class="b1" nowrap><A href="index.php?q=about" class="about" title="<?Print $text_about;?>"><?Print $text_about;?></A></TD>
	</TR>
</TABLE>
