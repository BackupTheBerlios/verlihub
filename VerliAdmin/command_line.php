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

$continue = TRUE;

$_POST['command'] = Trim($_POST['command']);
IF(($command = SubStr($_POST['command'], 0, StrPos($_POST['command'], " "))) == FALSE)
	$command = $_POST['command'];
$param = LTrim(StrStr($_POST['command'], " "));

//Print "'".$command."' - '".$param."' - '".$_POST['command']."'";

SWITCH(StrToLower($command)) {
//---------------------------------------------------------------------
//	+passwd
	CASE "+passwd" :
		$password = $param;

		IF(!PasswordChange($password, $password, $nick, 1)) {
			VA_Alert($err_msg_pwd_ch_not_allowed, "error", "index.php?".Change_URL_Query("q", $_GET['return'], "return", ""));
			$continue = FALSE;
			}

		BREAK;

//---------------------------------------------------------------------
//	!help
	CASE "!?" :
	CASE "!h" :
	CASE "!help" :
		Header("Location: index.php?q=commands");
		Die();

		BREAK;

//---------------------------------------------------------------------
//	!infoban
	CASE "!infoban" :
		
		IF(ValidateIP($param))
			Header("Location: index.php?q=banlist&filter_colum=ip&filter_type=equal&filter=".$param);
		ELSE
			Header("Location: index.php?q=banlist&filter_colum=nick&filter_type=equal&filter=".$param);
		Die();

		BREAK;

//---------------------------------------------------------------------
//	!logout
	CASE "!logout" :
		Header("Location: logout.php");
		Die();
		BREAK;

//---------------------------------------------------------------------
//	!regclass
	CASE "!rclass" :
	CASE "!regclass" :
		$param = Explode(" ", $param);
		$nick = $DB_hub->Real_Escape_String($param[0]);
		IF($param[1] < 1)
			$class = 1;
		ELSEIF($param[1] > 10)
			$class = 10;
		ELSE
			$class = $param[1];

		$result = $DB_hub->Query("SELECT class, class_protect FROM reglist WHERE nick LIKE '".$nick."'");
		$row = $result->Fetch_Assoc($result);

		$register = FetchClass($VA_setup['register_class']);
		IF($register[$class] > USR_CLASS || $register[$row['class']] > USR_CLASS || $row['class_protect'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));

		$DB_hub->Query("UPDATE reglist SET class = ".$class." WHERE nick LIKE '".$nick."'");

		BREAK;

//---------------------------------------------------------------------
//	!regdel
	CASE "!rdel" :
	CASE "!regdel" :
		$nick = $DB_hub->Real_Escape_String($param);

		$result = $DB_hub->Query("SELECT class, class_protect FROM reglist WHERE nick LIKE '".$nick."'");
		$row = $result->Fetch_Assoc();

		$delete = FetchClass($VA_setup['delete_class']);
		IF($delete[$row['class']] > USR_CLASS || $row['class_protect'] > USR_CLASS)
			{Die(VA_Message($err_msg_no_access, "error"));}

		$DB_hub->Query("DELETE FROM reglist WHERE nick LIKE '".$nick."'");
		BREAK;

//---------------------------------------------------------------------
//	!regdisable
	CASE "!r0" :
	CASE "!rdisable" :
	CASE "!regdisable" :
		$nick = $DB_hub->Real_Escape_String($param);

		$result = $DB_hub->Query("SELECT class, class_protect FROM reglist WHERE nick LIKE '".$nick."'");
		$row = $result->Fetch_Assoc($result);
		$result->Free_Result();

		$disable = FetchClass($VA_setup['disable_class']);
		IF($disable[$row['class']] > USR_CLASS && $row['class_protect'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));

		$DB_hub->Query("UPDATE reglist SET enabled = 0 WHERE nick LIKE '".$nick."'");
		BREAK;

//---------------------------------------------------------------------
//	!regenable
	CASE "!r1" :
	CASE "!renable" :
	CASE "!regenable" :
		$nick = $DB_hub->Real_Escape_String($param);

		$result = $DB_hub->Query("SELECT class, class_protect FROM reglist WHERE nick LIKE '".$nick."'");
		$row = $result->Fetch_Assoc();

		$register = FetchClass($VA_setup['register_class']);
		IF($register[$row['class']] > USR_CLASS && $row['class_protect'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));

		$DB_hub->Query("UPDATE reglist SET enabled = 1 WHERE nick LIKE '".$nick."'");
		BREAK;

//---------------------------------------------------------------------
//	!reghidekick
	CASE "!rhidekick" :
	CASE "!reghidekick" :
		$param = Explode(" ", $param);
		$nick = $DB_hub->Escape_String($param[0]);
		$hide = $param[1];
		
		$result = $DB_hub->Query("SELECT class, class_protect FROM reglist WHERE nick LIKE '".$hide."'");
		$row = $result->Fetch_Assoc($result);
		
		$register = FetchClass($VA_setup['register_class']);
		IF($register[$row['class']] > USR_CLASS || $row['class_protect'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));
		
		$DB_hub->Query("UPDATE reglist SET hide_kick = ".$hide." WHERE nick LIKE '".$nick."'");
		
		BREAK;
		
//---------------------------------------------------------------------
//	!reginfo
	CASE "!ri" :
	CASE "!rinfo" :
	CASE "!reginfo" :
		Header("Location: index.php?q=reglist&filter_colum=nick&filter_type=equal&filter=".$param);
		Die();
		BREAK;

//---------------------------------------------------------------------
//	!regnew
	CASE "!rn" :
	CASE "!rnew" :
	CASE "!regnew" :
		$param = Explode(" ", $param);
		$nick = $DB_hub->Real_Escape_String($param[0]);
		$class = $param[1];
		IF(!$class)
			{$class = 1;}

		$register = FetchClass($VA_setup['register_class']);
		IF($register[$class] > USR_CLASS)
			{Die(VA_Message($err_msg_no_access, "error"));}

		IF(!NickExist($nick,$DB_hub))
			VA_Query($DB_hub, "INSERT INTO reglist (nick, class, reg_date, reg_op) VALUES ('".$nick."', '".$class."', UNIX_TIMESTAMP(), '".USR_NICK."')");
		ELSE {
			VA_Alert(SPrintF($err_msg_user_exist, $param[0]), "error", "index.php?".Change_URL_Query("q", $_GET['return'], "return", ""));
			$continue = FALSE;
			}

		BREAK;

//---------------------------------------------------------------------
//	!regpasswd
	CASE "!rpasswd" :
	CASE "!regpasswd" :
		$nick = $DB_hub->Real_Escape_String($param);

		$result = $DB_hub->Query("UPDATE reglist SET pwd_change = 1 WHERE nick LIKE '".$nick."' AND class < ".USR_CLASS." AND 3 <= ".USR_CLASS);

		IF($DB_hub->affected_rows == 0) {
			VA_Alert(SPrintF($text_cmd_rpasswd_err, $param), "error", "index.php?".Change_URL_Query("q", $_GET['return'], "return", ""));
			$continue = FALSE;
			}

		BREAK;

//---------------------------------------------------------------------
//	!regprotect
	CASE "!rprotect" :
	CASE "!regprotect" :
		$param = Explode(" ", $param);
		$nick = $DB_hub->Escape_String($param[0]);
		$class = $param[1];
		
		$result = $DB_hub->Query("SELECT class, class_protect FROM reglist WHERE nick LIKE '".$nick."'");
		$row = $result->Fetch_Assoc();
		
		$register = FetchClass($VA_setup['register_class']);
		IF($register[$row['class']] > USR_CLASS || $row['class_protect'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));
		
		$DB_hub->Query("UPDATE reglist SET class_protect = ".$class." WHERE nick LIKE '".$nick."'");
		
		BREAK;
		
//---------------------------------------------------------------------
//	!regset
	CASE "!r=" :
	CASE "!rset" :
	CASE "!regset" :
		$param = Explode(" ", $param);
		$nick = $DB_hub->Real_Escape_String($param[0]);
		$var = $DB_hub->Real_Escape_String($param[1]);
		$val = $DB_hub->Real_Escape_String($param[2]);

		$result = $DB_hub->Query("SELECT class, class_protect FROM reglist WHERE nick LIKE '".$nick."'");
		$row = $result->Fetch_Assoc();

		$register = FetchClass($VA_setup['register_class']);
		IF($register[$row['class']] > USR_CLASS || $row['class_protect'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));

		$DB_hub->Query("UPDATE reglist SET ".$var." = '".$val."' WHERE nick LIKE '".$nick."'");

		BREAK;

//---------------------------------------------------------------------
//	!set
	CASE "!=" :
	CASE "!set" :
		$param = Explode(" ", $param);
		$var = $DB_hub->Real_Escape_String($param[0]);
		$val = $DB_hub->Real_Escape_String($param[1]);
		$file = "config";

		IF($VA_setup['setuplist_edit_class'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));
		
		$DB_hub->Query("REPLACE INTO SetupList (file, var, val) VALUES ('".$file."', '".$var."', '".$val."')");

		BREAK;

//---------------------------------------------------------------------
//	!unban
	CASE "!unban" :
		IF($VA_setup['banlist_unban_class'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));
	
		$reason = Trim(StrStr($param, " "));
		$param = Explode(" ", $param);
		$key = $param[0];
		
		Unban(0, $key, $reason);
		
		BREAK;

//---------------------------------------------------------------------
//	!unbanip
	CASE "!unbanip" :
		IF($VA_setup['banlist_unban_class'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));
		
		$reason = StrStr($param, " ");
		$param = Explode(" ", $param);
		$ip = $param[0];
		
		Unban(1, $ip, $reason);
		
		BREAK;

//---------------------------------------------------------------------
//	!unbannick
	CASE "!unbannick" :
		IF($VA_setup['banlist_unban_class'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));
		
		$reason = StrStr($param, " ");
		$param = Explode(" ", $param);
		$nick = $param[0];
		
		Unban(2, $nick, $reason);
		
		BREAK;

//---------------------------------------------------------------------
//	!vaset
	CASE "!va=" :
	CASE "!vaset" :
		$param = Explode(" ", $param);
		$var = $DB_hub->Real_Escape_String($param[0]);
		$val = $DB_hub->Real_Escape_String($param[1]);
		$file = "VerliAdmin";

		IF($VA_setup['setuplist_edit_class'] > USR_CLASS)
			Die(VA_Message($err_msg_no_access, "error"));

		$DB_hub->Query("REPLACE INTO SetupList (file, var, val) VALUES ('".$file."', '".$var."', '".$val."')");

		BREAK;
//---------------------------------------------------------------------

	CASE "!sql" :
		IF($debug[4] && USER_CLASS >= 10)
			$DB_hub->Query($param);
		ELSE {
			VA_Alert(SPrintF($err_msg_unknown_command, $command, $_POST['command']), "error", "index.php?".Change_URL_Query("q", $_GET['return'],"return", ""));
			$continue = FALSE;
			}
		BREAK;

//---------------------------------------------------------------------
//Neznamy prikaz
	DEFAULT :
		VA_Alert(SPrintF($err_msg_unknown_command, $command, $_POST['command']), "error", "index.php?".Change_URL_Query("q", $_GET['return'],"return", ""));
		$continue = FALSE;
		BREAK;
	}


IF($continue) {
	StoreQueries();
	Header("Location: index.php?".Change_URL_Query("q", $_GET['return'], "return", ""));
	}
?>
