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

IF(IsSet($_GET['lang'])) {//Language change
	Include "library.php";
	$time = Time() + 31536000;
	SetCookie("lang", $_GET['lang'], $time);
	SetCookie("encoding");
	IF($_GET['q'] == "") {//Language was changed from main page
		Header("Location: index.php");
		}
	ELSE {//Otherwise return to page
		Header("Location: index.php?".Change_URL_Query("lang", ""));
		}
	Die();
	}

IF(IsSet($_POST['encoding'])) {//Encoding change
	$time = Time() + 31536000;
	SetCookie("encoding", $_POST['encoding'], $time);
	Header("Location: index.php?".$_SERVER['QUERY_STRING']);
	Die();
	}

//If lang is not set, set default one
IF(!IsSet($_COOKIE['lang']))
	{
	$accept = Explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
	$language = Explode("|", $VA_setup['language']);
//	FOR()
	
	SetCookie("lang", $language[0], Time() + 31536000);
	$_COOKIE['lang'] = $language[0];
	}
ELSE
	Define("LANG", $_COOKIE['lang'], 1);

// language_source
// 0 = from php file (default)
// 1 = from MySQL database (Maybe work, maybe not)
// 2 = from SQLite (Sometimes later ;o) )
SWITCH($VA_setup['language_source']) {
	CASE 0 :
		//Include language files
		@Include "language/en.php";//English language
		IF($_COOKIE['lang'] != "en")
			@Include "language/".LANG.".php";//Selected one
		BREAK;
//---------------------------------------------------------------------	
	CASE 1 :
		//Get laguage from MySQL database
		$result = $DB_hub->Query("SELECT var, val FROM va_languages WHERE language = '".LANG."'");
		WHILE(List($var, $val) = $result->Fetch_Row()) {
			$$var = $val;
			}
		BREAK;
//---------------------------------------------------------------------
	CASE 2 :
		Die(VA_Message("Not yet implemented", "error"));

		IF(!Defined(SQLITE_ASSOC))
			Die(VA_Message("SQLite support missing", "error"));
	
		$result = SQLite_Query("SELECT var, val FROM va_languages WHERE language = '".LANG."'");
		WHILE(List($var, $val) = SQLite_Fetch_Array($result, SQLITE_NUM)) {
			$$var = $val;
			}
		BREAK;
	}
?>
