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

=========================================================================
*/

$script_start = MicroTime();	//Get microtime on start of script
OB_Start();	//Start output buffering

$mysql = Parse_Ini_File("config.php", TRUE);

$browser = substr($_SERVER['HTTP_USER_AGENT'], 0, 7);

IF(isset($_POST['selecthub']) && $mysql['HUB']['multi']==1)
{
        setcookie("database",$_POST['HubDB']);
        $database=$_POST['HubDB'];
}
ELSEIF(!$database && $mysql['HUB']['multi']==1) Print "<SCRIPT language=\"javascript\"><!--

location.replace(\"selectdb.php\");

--></SCRIPT>";

Include "library.php";

IF($mysql['HUB']['multi']==1) $DB_hub = NEW VA_MySQL($mysql['HUB']['host'], $mysql['HUB']['user'], $mysql['HUB']['password'], $database);
ELSE $DB_hub = NEW VA_MySQL($mysql['HUB']['host'], $mysql['HUB']['user'], $mysql['HUB']['password'], $mysql['HUB']['database']);
$VA_setup[] = "";
$VA_setup = Array_Merge($VA_setup, GetConfig($DB_hub, 'VerliAdmin'));
$VH_setup = GetConfig($DB_hub, 'config');

Include "version.php";
Include "language.php";

$debug = GetValues($VA_setup['debug']);

IF($debug[0])
	{Error_Reporting(E_ALL ^ E_NOTICE);}
ELSEIF($debug[1])
	{Error_Reporting(E_ALL);}
ELSE
	{Error_Reporting(0);}


IF($VA_setup['version'] < VA_COUNT) {
	$update_OK = FALSE;
	Include "update.php";
	}

$pw_ch_suc = TRUE;
IF(IsSet($_POST['pwd_change']))
	{$pw_ch_suc = PasswordChange($_POST['password'], $_POST['password2'], $_POST['nick'], $_POST['crypted']);}

IF(!$pw_ch_suc)
	{
	IF($_POST['password'] != $_POST['password2'] || $_POST['password2'] == "" || $_POST['password'] == "")
		{$_GET['warn'] = "pwd_match";}
	ELSE
		{$_GET['err'] = "pwd_ch_not_allowed";}
	}

IF(IsSet($_POST['ch_pwd_only']))
	{$pw_ch_suc = FALSE;}

IF(($_COOKIE['login'] || (IsSet($_POST['nick']) && IsSet($_POST['password']))) && $pw_ch_suc) {
	//If users is logged in verify username and password
	Include "verify.php";
	}
IF(!Defined("USER_CLASS")) {
	Define("USR_CLASS", 0, 1);
	Define("USR_NICK", "", 1);
	Define("USR_PWD_CHANGE", 1, 1);
	}

IF(!IsSet($_GET['q']))
	{$_GET['q'] = "";}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML>
<HEAD>
<LINK type="Image/X-Icon" rel="Icon" href="img/favicon.ico">
<LINK type="Image/X-Icon" rel="ShortCut Icon" href="img/favicon.ico">
<LINK rel="StyleSheet" type="Text/CSS" href="default.css">
<META http-equiv="Content-Type" content="Text/HTML; Charset=<?IF($_COOKIE['encoding']){Print $_COOKIE['encoding'];}ELSE{Print $encoding[0];}?>">
<META http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
<META http-equiv="Author" content="Petr Boháè 2004 [bohyn@verliadmin.wz.cz]">
<META http-equiv="Copyright" content="Petr Boháè 2004 [bohyn@verliadmin.wz.cz]">
	<TITLE><?Print $VH_setup['hub_name']." .::. VerliAdmin ".VA_VERSION;?></TITLE>
</HEAD>

<!--
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
-->

<SCRIPT language="JavaScript" type="text/JavaScript" src="js/rollover.js"></SCRIPT>
<SCRIPT language="JavaScript" type="text/JavaScript" src="js/confirm.js"></SCRIPT>
<BODY class="fs10px">
<CENTER>

<?Include "header.php";

IF(IsSet($update_OK)) {
	IF($update_OK)
		{VA_Message("VerliAdmin successsfully updated to version ".VA_VERSION, "bohyn32");}
	ELSE
		{VA_Message("VerliAdmin update to version ".VA_VERSION." failed. Update manualy", "bohyn32");}
	}

IF(IsSet($_GET['warn']))
	{
	$error = "err_msg_".$_GET['warn'];
	VA_Message($$error, "warning");}

IF(IsSet($_GET['err']))
	{
	$error = "err_msg_".$_GET['err'];
	Die(VA_Message($$error, "error"));}
//If user is not loged in include login form (expect about, stats,
//chpass, messages and unban_request page)
ELSEIF(!USR_CLASS && $_GET['q'] != "about" && $_GET['q'] != "stats" && $_GET['q'] != "chpass" && $_GET['q'] != "messages" && $_GET['q'] != "unban_request" && $_GET['q'] != "bantest")
	{Include "login.php";}

//Otherwise include required page
ELSEIF($_GET['q'] != "" && $_GET['q'] != "none") {
	if(substr_count($_GET['q'], "/"))  die("Hacking attempt. You bastard."); 
	IF(!Include $_GET['q'].".php") {
		//If include fails (page is not found or sytax error in script
		//display error message)
		VA_Message($err_msg_not_such_page, "error");
		}
	}
//I don`t remember why it is there ;o))
ELSEIF($_GET['q'] == "none")
	{}
ELSE
{//No page is selected so print database info
?>

<BR><BR>

<?IF($newlogin) {
	Include "userinfo.php";
	}?>
<TABLE class="b1 fs9px">
	<TR>
		<TD class="bg_light b center" colspan=7><?Print $text_database." ".$mysql_database?></TD>
	</TR><TR>
		<TD class="bg_light b center">&nbsp;&nbsp;<?Print $text_table;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light b center">&nbsp;&nbsp;<?Print $text_rows;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light b center">&nbsp;&nbsp;<?Print $text_size;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light b center">&nbsp;&nbsp;<?Print $text_overhead;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=2>&nbsp;</TD>
		<TD class="bg_light">&nbsp;</TD>
	</TR>
<?
$result = $DB_hub->Query("SHOW TABLE STATUS");

WHILE($row = $result->Fetch_Assoc()) {
	$total_rows += $row['Rows'];
	$total_size += $row['Data_length'] + $row['Index_length'];
	$total_overhead += $row['Data_free'];
	?>
	<TR>
		<TD class="bg_light">&nbsp;&nbsp;<?Print $row['Name'];?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print Number_Format($row['Rows']);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print RoundShare($row['Data_length'] + $row['Index_length']);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right<?IF($row['Data_free']){Print " red";}?>">&nbsp;&nbsp;<?Print RoundShare($row['Data_free']);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=2>
			&nbsp;&nbsp;
			<?IF(USR_CLASS == 10)
				{?><A href="index.php?q=optimize&c=optimize&table=<?Print $row['Name'];?>" onClick="return ConfirmLink(this, '<?PrintF($text_tb_optimize." ?", $row['Name']);?>')"><?Print $text_optimize;?></A><?}
			ELSE {Print $text_optimize;}?>
			&nbsp;&nbsp;
		</TD>
		<TD class="bg_light">
			&nbsp;&nbsp;
			<?IF(USR_CLASS == 10)
				{?><A href="index.php?q=optimize&c=truncate&table=<?Print $row['Name'];?>" onClick="return ConfirmLink(this, '<?PrintF($text_tb_truncate." ?", $row['Name']);?>')"><?Print $text_truncate;?></A><?}
			ELSE {Print $text_truncate;}?>
			&nbsp;&nbsp;
		</TD>
	</TR>
	<?}?>
	<TR>
		<TD class="bg_light b">&nbsp;&nbsp;<?Print $text_total;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light b right">&nbsp;&nbsp;<?Print Number_Format($total_rows);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light b right">&nbsp;&nbsp;<?Print RoundShare($total_size);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light b right<?IF($total_overhead){Print " red";}?>">&nbsp;&nbsp;<?Print RoundShare($total_overhead);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=2>&nbsp;</TD>
		<TD class="bg_light">&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light b center" colspan=7><?Print $text_mysql_status;?></TD>
	</TR>
<?
$result = $DB_hub->Query("SHOW STATUS");

WHILE($row = $result->Fetch_Assoc()) {
	$mysql_stat[$row['Variable_name']] = $row['Value'];
	}
$queries = Array_Slice($mysql_stat, 4, 70);
?>
	<TR>
		<TD class="bg_light b">&nbsp;&nbsp;<?Print $text_version;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print $DB_hub->server_info;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=5>&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light b">&nbsp;&nbsp;<?Print $text_received;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print RoundShare($mysql_stat['Bytes_received']);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print RoundShare($mysql_stat['Bytes_received'] / $mysql_stat['Uptime']);?>/s&nbsp;&nbsp;</TD>
		<TD class="bg_light right" colspan=2>&nbsp;&nbsp;<?Print RoundShare($mysql_stat['Bytes_received'] / Array_Sum($queries))."/".$text_query;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=2>&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light b">&nbsp;&nbsp;<?Print $text_sent;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print RoundShare($mysql_stat['Bytes_sent']);?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print RoundShare($mysql_stat['Bytes_sent'] / $mysql_stat['Uptime']);?>/s&nbsp;&nbsp;</TD>
		<TD class="bg_light right" colspan=2>&nbsp;&nbsp;<?Print RoundShare($mysql_stat['Bytes_sent'] / Array_Sum($queries))."/".$text_query;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=2>&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light b">&nbsp;&nbsp;<?Print $text_queries;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print Number_Format(Array_Sum($queries));?>&nbsp;&nbsp;</TD>
		<TD class="bg_light right">&nbsp;&nbsp;<?Print Number_Format(Array_Sum($queries) / $mysql_stat['Uptime'], 2);?>/s&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=4>&nbsp;</TD>
	</TR><TR>
		<TD class="bg_light b">&nbsp;&nbsp;<?Print $text_uptime;?>&nbsp;&nbsp;</TD>
		<TD class="bg_light" colspan=6>
			&nbsp;&nbsp;
			<?
			Print Date("z", $mysql_stat['Uptime'])." ".$text_days.", ";
			Print (Date("G", $mysql_stat['Uptime']) - 1)." ".$text_hours.", ";
			Print Date("i", $mysql_stat['Uptime'])." ".$text_minutes.", ";
			Print Date("s", $mysql_stat['Uptime'])." ".$text_seconds;
			?>
			&nbsp;&nbsp;
		</TD>
	</TR>
</TABLE>
<?}?>

<?
Include "footer.php";?>

</CENTER>
</BODY>
</HTML>
<?OB_End_Flush();?>
