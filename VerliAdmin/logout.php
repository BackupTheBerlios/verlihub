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

//Logout user (delete cookies and log to file action)

$time = Time();
$DB_hub->Query("UPDATE reglist SET logout_last = ".Time()." WHERE nick = '".USR_NICK."'");

IF($VA_setup['log_login']) {
	$action = "Logout";
	LogFile(USR_NICK, USR_CLASS, $action, "login");
	}

SetCookie("login");
SetCookie("nick");
SetCookie("password");

Header("Location: index.php");
?>
