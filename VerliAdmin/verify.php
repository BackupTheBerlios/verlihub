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

IF(!$_COOKIE['login'])
	{//New login
	$password = $_POST['password'];
	$nick = $_POST['nick'];
	$newlogin = 1;
	}
ELSE
	{//Already logged in, just verify of user
	$password = $_COOKIE['password'];
	$nick = $_COOKIE['nick'];
	$newlogin = 0;
	}
//Get user profil informations
$result = $DB_hub->Query("SELECT * FROM reglist WHERE nick LIKE '".$nick."'");

IF($result->num_rows == 1)
	{//User exists
	$user = $result->Fetch_Assoc();
	$result->Free_Result();
	
	IF($newlogin && $user['pwd_crypt'] == 0)
		{$password = MD5($password);}
	ELSEIF($newlogin && $user['pwd_crypt'] == 1)
		{$password = Crypt($password, $user['login_pwd']);}
	ELSEIF($newlogin && $user['pwd_crypt'] == 2)
		{$password = MD5($password);}
	
	
	IF(((MD5($user['login_pwd']) == $password && !$user['pwd_crypt'])
		|| ($user['login_pwd'] == $password && $user['pwd_crypt']))
		&& $user['error_last'] + 30 < Time()) {
		//password verifyed

		IF($user['enabled'])
			{//User is enabled
			//login succesful

			//Set cookies with username and nick
			$time = Time() + $VA_setup['login_time'];
		
			Define("USR_NICK", $user['nick'], 1);
			Define("USR_CLASS", $user['class'], 1);
			Define("USR_PWD_CHANGE", $user['pwd_change'], 1);
			
			$_COOKIE['login'] = 1;
			$_COOKIE['password'] = $password;
			$_COOKIE['nick'] = $user['nick'];
			
			$reg_chpass = &$user['pwd_change'];
			$reg_class = &$user['class'];
			$reg_nick = &$user['nick'];

			SetCookie("login", 1, $time);
			SetCookie("password", $password, $time);
			SetCookie("nick", USR_NICK, $time);
			
			IF($newlogin)
				{
				$DB_hub->Query("UPDATE reglist SET login_last = ".Time().", login_cnt = login_cnt+1, login_ip = '".$_SERVER['REMOTE_ADDR']."' WHERE nick = '".USR_NICK."'");
				IF($VA_setup['log_login'])
					{//Login is enabled and loging too
					$action = "Login";
					LogFile(USR_NICK, USR_CLASS, $action, "login");
					}
				}
			}
		ELSE
			{//User is disabled
			SetCookie("login");
			SetCookie("nick");
			SetCookie("password");
			$_GET['err'] = "disabled_account";
			}
		}
	ELSE
		{//Wrong password provided
		IF($newlogin)
			{
			$DB_hub->Query("UPDATE reglist SET error_last = ".Time().", error_cnt = error_cnt+1, error_ip = '".$_SERVER['REMOTE_ADDR']."' WHERE nick = '".$user['nick']."'");
			IF($VA_setup['log_login'])
				{//Loging is enabled, write notification about wrong login
				$action = "Bad password provided";
				LogFile(USR_NICK, USR_CLASS, $action, "login");
				}
			}
		SetCookie("login");
		SetCookie("nick");
		SetCookie("password");
		$_GET['warn'] = "bad_pwd";
		}
	}
ELSE
	{//User was`t found in database
	SetCookie("login");
	SetCookie("nick");
	SetCookie("password");
	$_GET['err'] = "bad_nick";
	}
?>