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

//Get browser type
IF(!IsSet($_COOKIE['brwsr_tp'])) {
	$time = Time() + 31536000;
	//Opera browser
	IF(EregI("opera.[1-9]", $_SERVER['HTTP_USER_AGENT']))
		{SetCookie("brwsr_tp", "Opera", $time);$_COOKIE['brwsr_tp'] = "Opera";}
	//MSIE browser
	ELSEIF(EregI("msie.[1-9]", $_SERVER['HTTP_USER_AGENT']))
		{SetCookie("brwsr_tp", "MSIE", $time); $_COOKIE['brwsr_tp'] = "MSIE";}
	//Netscape or mozilla
	ELSEIF(EregI("rv:1\.[1-9]|netscape", $_SERVER['HTTP_USER_AGENT']))
		{SetCookie("brwsr_tp", "Mozilla", $time); $_COOKIE['brwsr_tp'] = "Mozilla";}
	//Some other
	ELSE
		{SetCookie("brwsr_tp", "Other", $time); $_COOKIE['brwsr_tp'] = "Other";}
	}

IF(Function_Exists("mysqli_query")) {
	Include "lib/mysqli.php";
	Define("VA_MySQL", "MySQLi", 1);
	}
ELSEIF(Function_Exists("mysql_query")) {
	Include "lib/mysql.php";
	Define("VA_MySQL", "MySQL", 1);
	}
ELSE
	Die("No MySQL support extension. Check your PHP configuration");

//---------------------------------------------------------------------
//Return TRUE if index on $colum in table $table exists
FUNCTION Check_Index($link, $table, $colum) {
	$result = $link->Query("SHOW INDEX FROM ".$table);
	WHILE($row = $result->Fetch_Assoc()) {
		IF(StrToLower($row['Column_name']) == StrToLower($colum) && $row['Seq_in_index'] == 1) {
			RETURN TRUE;
			}
		}
	$result->Free_Result();
	
	RETURN FALSE;
	}

//---------------------------------------------------------------------
//Change value(s) in URL query or add new / remove variable and value
//Parametrs (var_1, val_1, var_2, val_2, ... , var_n, val_n)
//If val_x is empty remove var_x from query
FUNCTION Change_URL_Query() {
	GLOBAL $_SERVER;
	$new_query = "";

	$num_args = Func_Num_Args();
	$query = Explode("&", $_SERVER['QUERY_STRING']);

	FOR($i = 0; $i < Count($query); $i++) {
		$v = Explode("=", $query[$i]);
		$args[$v[0]] = $v[1];
		}

	FOR($i = 0; $i < $num_args;) {
		$args[Func_Get_Arg($i++)] = @Func_Get_Arg($i++);
		}

		WHILE($row = Each($args)) {
		IF($row[1] != "") {
			$new_query .= $row[0]."=".$row[1]."&";
			}
		}
		RETURN SubStr($new_query, 0, -1);
	}		

//---------------------------------------------------------------------
//Logaritmic size of bars in stats page
FUNCTION CountStatBar($max, $value) {
	$res = 5;
	$der = 80;
	$size = 150;

	$width = Ceil($size*((Log($res + $der*$value/$max)-Log($res))/(Log($res+$der)-Log($res))));

	RETURN $width;
	}

//---------------------------------------------------------------------
//Creates index on $colum in table $table
FUNCTION Create_Index($link, $table, $colum) {
	IF(!Check_Index($link, $table, $colum))
		$link->Query("ALTER IGNORE TABLE `".$table."` ADD INDEX `".$colum."_index` (`".$colum."`)"); //OR Die(VA_Message("MySQL Error #".MySQL_ErrNo()." : ".MySQL_Error(), "bug"));
	
	RETURN TRUE;
	}

//---------------------------------------------------------------------

FUNCTION CryptPwd($password) {
	$num1 = Rand(97, 122);
	$num2 = Rand(65, 90);
	$password = Crypt($password, Chr($num1).Chr($num2));

	RETURN $password;
	}

//---------------------------------------------------------------------
//Prevede dd.mm.rrrr hh:mm:ss na integer
FUNCTION DateToInt($date) {
	$date = Explode(" ", $date);
	
	$time = Explode(":", $date[1]);
	$date = Explode(".", $date[0]);

	$time = Array_Pad($time, 3, 0);
	$date = Array_Pad($date, 3, 0);
	
	$int = MkTime($time[0], $time[1], $time[2], $date[1], $date[0], $date[2]);
	
	RETURN $int;
	}

//---------------------------------------------------------------------

FUNCTION DecodeStr($hex, $key) {
	$hex = EregI_Replace("([a-f0-9]{".$key[8]."})([a-f0-9]{".$key[6]."})([a-f0-9]*)([a-f0-9]{".$key[7]."})([a-f0-9]{".$key[9]."})", "\\5\\4\\3\\2\\1", $hex);

	FOR($i = 0; $i < StrLen($hex); $i++) {
		$str .= Chr(HexDec($hex[$i++].$hex[$i]));
		}

	RETURN Explode(Chr(30), $str);
	}

//---------------------------------------------------------------------

FUNCTION EncodeStr($user, $password, $key) {
	$str = $user.Chr(30).$password;

	FOR($i = 0; $i < StrLen($str); $i++) {
		$hex .= DecHex(Ord($str[$i]));
		}

	$hex = EregI_Replace("([a-f0-9]{".$key[9]."})([a-f0-9]{".$key[7]."})([a-f0-9]*)([a-f0-9]{".$key[6]."})([a-f0-9]{".$key[8]."})", "\\5\\4\\3\\2\\1", $hex);

	RETURN $hex;
	}

//---------------------------------------------------------------------
//Fetch classes from "##|##|##|##|##" format string
FUNCTION FetchClass($setup_class) {
	$class = Explode("|", $setup_class);
	$class[10] = $class[5];
	$class[5] = $class[4];
	$class[4] = $class[3];
	$class[3] = $class[2];
	$class[2] = $class[1];
	$class[1] = $class[0];
	
	RETURN $class;
	}

//---------------------------------------------------------------------
//Convert integer value of IP to IPv4
FUNCTION Get_IP_From_Range($range) {
	$range = $range / 16777216; // 16777216 = 256^3
	$a = (int)$range;
	$range -= $a;
	
	$range = $range * 256;
	$b = (int)$range;
	$range -= $b;
	
	$range = $range * 256;
	$c = (int)$range;
	$range -= $c;

	$d = $range * 256;
	
	$ip = $a.".".$b.".".$c.".".$d;

	RETURN $ip;
	}

//---------------------------------------------------------------------
//Vrati ikonu uzivatele
FUNCTION Get_Usr_Img($nick, $class, $enabled = 1) {
	GLOBAL $VA_setup;

	IF($class == 1){$image = "reg.gif";}
	ELSEIF($class == 2){$image = "vip.gif";}
	ELSEIF($class == 3){$image = "op.gif";}
	ELSEIF($class == 4){$image = "op.gif";}
	ELSEIF($class == 5){$image = "op.gif";}
	ELSEIF($class == 10){$image = "master.gif";}
	ELSE $image = "space.gif";

	$x = Explode(";", $VA_setup['user_images']);
	FOR($i = 0; $i < Count($x); $i++) {
		$y = Explode(",", $x[$i]);
		IF(PReg_Match("/".Trim($y[0])."/", $nick)) {
			$image = Trim($y[1]);
			BREAK;
			}
		}
	
	IF($enabled == 0){$image = "skull.gif";}

	RETURN $image;
	}

//---------------------------------------------------------------------
//Return name of class
FUNCTION GetClassName($class) {
	GLOBAL $text_guest, $text_reg, $text_vip, $text_op;
	GLOBAL $text_chief_op, $text_admin, $text_master;
	
	
	IF($class == 0) {$class_name = "text_guest";}
	ELSEIF($class == 1) {$class_name = "text_reg";}
	ELSEIF($class == 2) {$class_name = "text_vip";}
	ELSEIF($class == 3) {$class_name = "text_op";}
	ELSEIF($class == 4) {$class_name = "text_chief_op";}
	ELSEIF($class == 5) {$class_name = "text_admin";}
	ELSEIF($class == 10) {$class_name = "text_master";}
	
	RETURN $$class_name;
	}

//---------------------------------------------------------------------

FUNCTION GetConfig($link, $file) {
	$result = $link->Query("SELECT var, val FROM SetupList WHERE val != '' AND file LIKE '".$file."'");

	WHILE($row = $result->Fetch_Assoc()) {
		$config[$row['var']] = $row['val'];
		}

	RETURN $config;
	}

//---------------------------------------------------------------------

FUNCTION GetMicroTime($time = 0) {
	IF(!$time)
		{$time = MicroTime();}
	List($usec, $sec) = Explode(" ", $time); 
	RETURN ((float)$usec + (float)$sec); 
	}

//---------------------------------------------------------------------

FUNCTION GetTables($link) {
	$result = $link->Query("SHOW TABLE STATUS");

	GLOBAL $tables;

	WHILE($row = $result->Fetch_Assoc()) {
		$tables[StrToLower($row['Name'])]['name'] = $row['Name'];
		$tables[StrToLower($row['Name'])]['rows'] = $row['Rows'];
		$tables[StrToLower($row['Name'])]['size'] = $row['Data_lenght'];
		$tables[StrToLower($row['Name'])]['index'] = $row['Index_lenght'];
		$tables[StrToLower($row['Name'])]['free'] = $row['Data_free'];
		}
	
	RETURN TRUE;
	}

//---------------------------------------------------------------------

FUNCTION GetValues($in) {
	$in = (string)DecBin($in);
	WHILE($in != "") {
		$out[] = SubStr($in, strlen($in)-1, 1);
		$in = SubStr($in, 0, strlen($in)-1);
		}

	$out = Array_Pad($out, 10, 0);
		
	RETURN $out;
	}

//---------------------------------------------------------------------
//Log actions to file
FUNCTION LogFile($nick, $class, $action, $logaction) {
	GLOBAL $VA_setup;

	$log = $VA_setup['log_format'];
	$log = EregI_Replace("%time%", Date($VA_setup['time_format']), $log);
	$log = EregI_Replace("%date%", Date($VA_setup['date_format']), $log);
	$log = EregI_Replace("%nick%", $nick, $log);
	$log = EregI_Replace("%class%", $class, $log);
	$log = EregI_Replace("%ip%", $_SERVER['REMOTE_ADDR'], $log);
	$log = EregI_Replace("%host%", GetHostByAddr($_SERVER['REMOTE_ADDR']), $log);
	$log = EregI_Replace("%action%", $action, $log);
	
	//If loging by action is enabled log to file by action name
	IF(EregI("%logfileaction%", $log)) {
		$write = EregI_Replace("%logfileaction%", "", $log);
		$write = EregI_Replace("%logfilenick%", "", $write);
		$file = @FOpen($VA_setup['log_dir'].$logaction.".log", "a+");
		@FWrite($file, $write."\r\n");
		@FClose($file);
	}

	//If loging by nick is enabled log to file by nick name
	IF(EregI("%logfilenick%", $log)) {
		$write = EregI_Replace("%logfileaction%", "", $log);
		$write = EregI_Replace("%logfilenick%", "", $write);
		$file = @FOpen($VA_setup['log_dir'].$nick.".log", "a+");
		@FWrite($file, $write."\r\n");
		@FClose($file);
	}
	RETURN;
}

//---------------------------------------------------------------------
//Print navigation bar in lists
FUNCTION Navigation() {
	GLOBAL $_GET;
	GLOBAL $pages;
	?>
	<TABLE class="fs8px">
		<TR>
			<TD>
				<?IF($_GET['page'] > 1)
					{?><A href="index.php?<?Print Change_URL_Query("page", $_GET['page'] - 1)?>"><IMG src="img/back.gif" width=27 hight=27></A><?}
				ELSE
					{?><IMG src="img/space.gif" width=38 height=32><?}?>
			</TD><TD valign="middle" align="center">
				<?
				FOR($i = 1; $pages >= $i; $i++) {
					IF($i != $_GET['page'])
						{?> | <A href="index.php?<?Print Change_URL_Query("page", $i);?>" class="b"><?Print $i;?></A><?}
					ELSE
						{?> | <FONT class="red b"><?Print $i;?></FONT><?}
					}
				?>
				  | 
			</TD><TD>
				<?IF($_GET['page'] < $pages)
					{?><A href="index.php?<?Print Change_URL_Query("page", $_GET['page'] + 1);?>"><IMG src="img/next.gif" width=27 hight=27></A><?}
				ELSE
					{?><IMG src="img/space.gif" width=38 height=32><?}?>
			</TD>
		</TR>
	</TABLE><?
	RETURN;
}


//---------------------------------------------------------------------
//Return true if nick exist
FUNCTION NickExist($nick, $link) {
	$result = $link->Query("SELECT nick FROM reglist WHERE nick LIKE '".$nick."'");

	IF(0 < $result->num_rows)
		{RETURN TRUE;}
	ELSE
		{RETURN FALSE;}
}

//---------------------------------------------------------------------

FUNCTION PasswordChange($password1, $password2, $nick, $crypted) {
	
	$result = $DB_hub->Query("SELECT pwd_change FROM reglist WHERE nick LIKE '$nick'");
	$row = $result->Fetch_Assoc();
	IF($row['pwd_change'] == 1) {
		IF($password1 == $password2) {
			IF($crypted == 1)
				{$password1 = CryptPwd($password1);}
			ELSEIF($crypted == 2)
				{$password1 = MD5($password1);}
			
			$password1 = $DB_hub->Real_Escape_String($password1);
			$nick = $DB_hub->Real_Escape_String($nick);
				
			$DB_hub->Query("UPDATE reglist SET pwd_change = 0, login_pwd = '".$password1."', pwd_crypt = ".$crypted." WHERE nick LIKE '".$nick."'");
			RETURN TRUE;
		}
		ELSE
			{RETURN FALSE;}
	}
	ELSE
		{RETURN FALSE;}
}

//---------------------------------------------------------------------
//Prints orderby arrows in lists table headers
//Expecting $_GET['orderby']
FUNCTION PrintOrderBy($colum) {
	GLOBAL $_GET;

	IF(!EregI("^".$colum, $_GET['orderby'])) {
		$sec_order = EregI_Replace(",.{1,100}$", "", $_GET['orderby']);
		$sec_order = ",%20".$sec_order;
		}
	
	IF(EregI("^".$colum." ASC", $_GET['orderby']))
		{?>&nbsp;<A href="index.php?<?Print Change_URL_Query("orderby", $colum."%20ASC".$sec_order, "page", "");?>"><IMG src="img/asca.gif" width=8 height=7></A><?}
	ELSEIF(EregI(", ".$colum." ASC$", $_GET['orderby']))
		{?>&nbsp;<A href="index.php?<?Print Change_URL_Query("orderby", $colum."%20ASC".$sec_order, "page", "");?>"><IMG src="img/ascp.gif" width=8 height=7></A><?}
	ELSE
		{?>&nbsp;<A href="index.php?<?Print Change_URL_Query("orderby", $colum."%20ASC".$sec_order, "page", "");?>"><IMG src="img/asc.gif" width=8 height=7></A><?}

	IF(EregI("^".$colum." DESC", $_GET['orderby']))
		{?><A href="index.php?<?Print Change_URL_Query("orderby", $colum."%20DESC".$sec_order, "page", "");?>"><IMG src="img/desca.gif" width=8 height=7></A><?}
	ELSEIF(EregI(", ".$colum." DESC$", $_GET['orderby']))
		{?><A href="index.php?<?Print Change_URL_Query("orderby", $colum."%20DESC".$sec_order, "page", "");?>"><IMG src="img/descp.gif" width=8 height=7></A><?}
	ELSE
		{?><A href="index.php?<?Print Change_URL_Query("orderby", $colum."%20DESC".$sec_order, "page", "");?>"><IMG src="img/desc.gif" width=8 height=7></A><?}
	RETURN;
	}

//---------------------------------------------------------------------
//Add RE(x) to message subject in reply
FUNCTION Reply_Subject($subject) {
	$pocet = 1 + SubStr($subject, 3, 5);
	$subject = Ereg_Replace("RE\(([0-9]){1,3}\)\: ", "", $subject);
	$subject = "RE(".$pocet."): ".$subject;

	RETURN $subject;
	}

//---------------------------------------------------------------------
//Return short type of share (B/KB/MB/GB/TB)
FUNCTION RoundShare($share) {
	IF($share >= 1073741824 * 1024)
		{$share = Number_format($share / (1073741824 * 1024), 2)." TB";}
	ELSEIF($share >= 1073741824)
		{$share = Number_Format($share / 1073741824, 2)." GB";}
	ELSEIF($share >= 1048576)
		{$share = Number_Format($share / 1048576, 2)." MB";}
	ELSEIF($share >= 1024)
		{$share = Number_Format($share / 1024, 2)." KB";}
	ELSE
		{$share = Number_Format($share)." B";}

	RETURN $share;
	}

//---------------------------------------------------------------------
//Run SQL query(s) from file
FUNCTION RunSQL($link, $file) {
	IF(File_Exists($file)) {
		$fd = FOpen($file, "r");
		$sql = FRead($fd, FileSize($file));
		FClose($fd);

		$query = Split(";( )?(\r)?\n(\r)?", $sql);

		FOR($i = 0; $i < Count($query); $i++) {
			IF($query[$i] != "") {
				$link->Query($query[$i]);
				}
			}
		RETURN TRUE;
		}
	ELSE
		{RETURN FALSE;}
	}

//---------------------------------------------------------------------

FUNCTION StoreQueries($link) {
	GLOBAL $_COOKIE, $VA_setup;
	
	$_COOKIE['queries'] += $link->mysql_queries;
	$time = Time() + $VA_setup['login_time'];
	SetCookie("queries", $_COOKIE['queries'], $time);

	RETURN;
	}

//---------------------------------------------------------------------
// Odanuje IP a/nebo nick (casem mozna i neco vic)
// 0 IP & nick
// 1 IP
// 2 nick
// 3 IP range
FUNCTION Unban($unban_type, $key, $reason) {
	GLOBAL $DB_hub;
	
	IF($unban_type == 1 || ($unban_type == 0 && ValidateIP($key)))
		$result  = $DB_hub->Query("SELECT * FROM banlist WHERE ip LIKE '".$key."' AND (`date_limit` > UNIX_TIMESTAMP() OR `date_limit` IS NULL)");
	ELSEIF($unban_type == 2 || $unban_type == 0)
		$result  = $DB_hub->Query("SELECT * FROM banlist WHERE nick LIKE '".$key."' AND (`date_limit` > UNIX_TIMESTAMP() OR `date_limit` IS NULL)");
	ELSEIF($unban_type == 3)
		$result  = $DB_hub->Query("SELECT * FROM banlist WHERE range_fr < '".$key."' AND range_to > '".$key."' AND (`date_limit` > UNIX_TIMESTAMP() OR `date_limit` IS NULL)");
	
	WHILE($ban = $result->Fetch_Assoc()) {
		IF($unban_type == 0) {
			$nick = $ban['nick'];
			$ip = $ban['ip'];
			}
		ELSEIF($unban_type == 1) {
			$nick = $ban['nick'];
			$ip = "_nickban_";
			}
		ELSEIF($unban_type == 2) {
			$nick = "_ipban_";
			$ip = $ban['ip'];
			}
		ELSEIF($unban_type == 3) {
			$nick = "_rangeban_";
			$ip = $ban['ip'];
			}

//		$DB_hub->Query("REPLACE INTO unbanlist (ban_type, ip, nick, host, share_size, email, range_fr, range_to, date_start, date_limit, date_unban, nick_op, unban_op, reason, unban_reason) VALUES (".$unban_type.", '".$ip."', '".$nick."', '".$ban['host']."', '".$ban['share_size']."', '".$ban['email']."', '".$ban['range_fr']."', '".$ban['range_to']."', '".$ban['date_start']."', '".$ban['date_limit']."', UNIX_TIMESTAMP(), '".$ban['nick_op']."', '".USR_NICK."', '".$ban['reason']."', '".$reason."')");

		IF($unban_type == $ban['ban_type'])
			$DB_hub->Query("DELETE FROM banlist WHERE nick LIKE '".$ban['nick']."' AND ip LIKE '".$ban['ip']."'");
		ELSEIF($unban_type == 1 && $ban['nick']!="_ipban_")
			$DB_hub->Query("UPDATE banlist SET ban_type = 2, nick = '".$ban['nick']."', ip = '_nickban_' WHERE nick LIKE '".$ban['nick']."' AND ip LIKE '".$ban['ip']."'");
		ELSEIF($unban_type == 1 && $ban['nick']=="_ipban_")
                        $DB_hub->Query("DELETE FROM banlist WHERE ip LIKE '".$ban['ip']."'");
		ELSEIF($unban_type == 2 && $ban['ip']!="_nickban_")
			$DB_hub->Query("UPDATE banlist SET ban_type = 1, nick = '_ipban_', ip = '".$ban['ip']."' WHERE nick LIKE '".$ban['nick']."' AND ip LIKE '".$ban['ip']."'");
		ELSEIF($unban_type == 2 && $ban['ip']=="_nickban_")
                        $DB_hub->Query("DELETE FROM banlist WHERE nick LIKE '".$ban['nick']."'");
		}

	RETURN;
	}

//---------------------------------------------------------------------

FUNCTION UpTime($time) {
	GLOBAL $text_year1, $text_year2, $text_year5;
	GLOBAL $text_month1, $text_month2, $text_month5;
	GLOBAL $text_day1, $text_day2, $text_day5;
	GLOBAL $text_hour1, $text_hour2, $text_hour5;
	GLOBAL $text_minute1, $text_minute2, $text_minute5;
	GLOBAL $text_second1, $tex_second2, $text_second5;

	IF($year = (int)Date("Y", $time) - 1970) {
		$str = $year." ";
		IF($year >= 5)
			$str .= $text_year5;
		ELSEIF($year >= 2)
			$str .= $text_year2;
		ELSE
			$str .= $text_year1;
		$str .=", ";
		}

	IF($month = (int)Date("m", $time)) {
		$str .= $month." ";
		IF($month >= 5)
			$str .= $text_month5;
		ELSEIF($month >= 2)
			$str .= $text_month2;
		ELSE
			$str .= $text_month1;
		$str .=", ";
		}

	IF($day = (int)Date("d", $time)) {
		$str .= $day." ";
		IF($day >= 5)
			$str .= $text_day5;
		ELSEIF($day >= 2)
			$str .= $text_day2;
		ELSE
			$str .= $text_day1;
		$str .=", ";
		}

	IF($hour = (int)Date("H", $time)) {
		$str .= $hour." ";
		IF($hour >= 5)
			$str .= $text_hour5;
		ELSEIF($hour >= 2)
			$str .= $text_hour2;
		ELSE
			$str .= $text_hour1;
		$str .=", ";
		}

	IF($min = (int)Date("i", $time)) {
		$str .= $min." ";
		IF($min >= 5)
			$str .= $text_minute5;
		ELSEIF($min >= 2)
			$str .= $text_minute2;
		ELSE
			$str .= $text_minute1;
		$str .=", ";
		}

	IF($sec = (int)Date("s", $time)) {
		$str .= $sec." ";
		IF($sec >= 5)
			$str .= $text_second5;
		ELSEIF($sec >= 2)
			$str .= $text_second2;
		ELSE
			$str .= $text_second1;
		}

	RETURN $str;
	}

//---------------------------------------------------------------------
//Zobrazi zpravu s OK tlacitkem. ikony:(error|warning|info32|help|bohyn32)
FUNCTION VA_Alert($message, $icon, $url) {
	GLOBAL $text_ok;
	?>

	<BR><BR>
	<FORM action="<?Print $url;?>" method="post">
	<TABLE align="center" class="b1 fs11px" width=350>
		<TR>
			<TD class="bg_light center fs9px b" colspan=2>VerliAdmin alert</TD>
		</TR><TR>
			<TD class="bg_light center" width=50  height=70><IMG src="img/<?Print $icon;?>.gif" width=32 height=32></TD>
			<TD class="center b bg_light<?IF($icon == "error" OR $icon == "warning"){Print " red";}?>"><?Print nl2br(HTMLSpecialChars($message));?></TD>
		</TR><TR>
			<TD class="bg_light center" colspan=2>
				<INPUT class="w100px" name="OK" type="submit" value="<?Print $text_ok;?>">
			</TD>
		</TR>
	</TABLE>
	</FORM>
<?	}

//---------------------------------------------------------------------
//Print message. ikony:(error|warning|info32|help|bohyn32)
FUNCTION VA_Message($message, $icon) {?>
	<BR><BR>
	<TABLE align="center" class="b1 fs11px" width=350>
		<TR>
			<TD class="bg_light center fs9px b" colspan=2>VerliAdmin message</TD>
		</TR><TR>
			<TD class="bg_light center" width=50  height=70><IMG src="img/<?Print $icon;?>.gif" width=32 height=32></TD>
			<TD class="center b bg_light<?IF($icon == "error" OR $icon == "warning"){Print " red";}?>"><?Print nl2br(HTMLSpecialChars($message));?></TD>
		</TR>
	</TABLE>
<?	}

//---------------------------------------------------------------------
//Return true if $email string is valid e-mail
FUNCTION ValidateEmail($email) {
	IF(Ereg("^[\'+\\./0-9A-Z^_\`a-z{|}~\-]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z0-9_\-]+){1,4}$", $email))
		{RETURN TRUE;}
	ELSE
		{RETURN FALSE;}
	}

//---------------------------------------------------------------------
//Return true if ip is valid IPv4
FUNCTION ValidateIP($ip)
	{
	IF(Ereg("([0-9]{1,2}|[01][0-9]{2}|2[0-4][0-9]|25[0-5])\.([0-9]{1,2}|[01][0-9]{2}|2[0-4][0-9]|25[0-5])\.([0-9]{1,2}|[01][0-9]{2}|2[0-4][0-9]|25[0-5])\.([0-9]{1,2}|[01][0-9]{2}|2[0-4][0-9]|25[0-5])", $ip))
		{RETURN TRUE;}
	ELSE
		{RETURN FALSE;}
	}
?>
