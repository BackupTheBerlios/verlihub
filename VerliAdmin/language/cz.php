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

//Language name:
$lang_name = "Èeština";
//Language by:
$lang_author = "bohyn";
//Homepage:
$lang_http = "http://bohyn.czechweb.cz";
//Author's e-mail:
$lang_email = "bohyn@verliadmin.wz.cz";
//version:
$lang_version = "0.3.3";
//Choose encoding (add as many as you want):
$encoding[0] = "ISO-8859-2";
$encoding[1] = "Windows-1250";

$text_active_kicks =			"Jen aktivní";
$text_add_new_setup =			"Pøidat novou promìnou";
$text_add_new_trigger =			"Pøidat nový file trigger";
$text_addreg =					"Registrovat nového uživatele";
$text_affected_rows =			"Ovlivnìno záznamù";
$text_all =						"Všechny";
$text_answer =					"Odpovìï";
$text_april =					"Duben";
$text_august =					"Srpen";
$text_author =					"Autor";
$text_averange =				"Prùmìr";
$text_ban_cmds =				"Banovací pøikazy";
$text_ban_reason =				"Dùvod banu";
$text_ban_op =					"Zabanoval";
$text_ban_type = 				"Typ banu";
$text_banfree =					"Nemáte žádný ban";
$text_bans =					"Bany";
$text_begins =					"Zaèíná";
$text_body =					"Zpráva";
$text_bug_report = 				"Ohlásit chybu";
$text_check =					"Test";
$text_cmd_ban_help =			"Permanentni ban IP a nicku";
$text_cmd_banemail_help =		"Pøidá e-mail permanentnì do banlistu";
$text_cmd_banhost1_help =		"Zabanuje doménu prvního øádu z host. Vìtšinou to neni pøíliš praktické. Pøíklad: Z my.web.host.com zabanuje 'com'";
$text_cmd_banhost2_help =		"Zabanuje doménu druhého øádu z host. Pøíklad: my.web.host.com zabanuje 'host.com'";
$text_cmd_banhost3_help =		"Zabanuje doménu tøetího øádu z host. Pøíklad: my.web.host.com zabanuje 'web.host.com'";
$text_cmd_banhostr1_help =		"Zabanuje zbytek domény";
$text_cmd_banip_help =			"Permanentní ban IP, ne nicku pokud není nalezen kick v databázi";
$text_cmd_bannick_help =		"Permanentní ban nicku";
$text_cmd_banprefix_help =		"Permanentní ban pøedpony nicku";
$text_cmd_banrange_help =		"Zabanuje IP range. Pøíklad: !banrange 1.1.1.1...1.1.1.4 nebo !banrange 1.1.1.1/24";
$text_cmd_banshare_help =		"Pøidá velikost sdílení permanentnì do banlistu";
$text_cmd_bantemp_help =		"Èasový ban IP a nicku";
$text_cmd_broadcast_help =		"Pošle PM všem uživatelùm, odpovìdi jsou posílány zpìt pøes hub security";
$text_cmd_ccbroadcast_help =	"Stejné jako !broadcast, sle posílá jen uživatelùm pøíslušných country codù";
$text_cmd_class_help =			"Doèasnì zmìní uživatelovi class. Trvá dokud se uživatel neopustí hub. default class: 3";
$text_cmd_drop_help =			"Odpojí uživatele od hubu a použije tempban";
$text_cmd_gc_help =				"Zobrazí konfiguraci hubu";
$text_cmd_getinfo_help =		"Vrátí IP a host daného nicku";
$text_cmd_getip_help =			"Vrátí IP daného nicku";
$text_cmd_gethost_help =		"Vrátí host daného nicku";
$text_cmd_hidekick_help =		"Skryje odesílání kickù do chatu";
$text_cms_hideme_help =			"Skryje odesílání kickù uživatelùm s nižší class než je class";
$text_cmd_hublist_help =		"Registrovat na hublisty";
$text_cmd_infoban_help =		"Zobrazí ban(y) na daný nick / IP";
$text_cmd_kick_help =			"Kickne uzivatele s casovym banem. Je mozné použít _ban_ nebo _ban_#x (# = èíslo, x = èas (S,s = sekunda, m = minuta, H,h = hodina, D,d = den, W,w = týden, M = mìsíc, Y,y = rok)) Jako souèást dùvodu pro zabanování nìkoho";
$text_cmd_logout_help =			"Odhlášení z VerliAdmina";
$text_cmd_me_help =				"Odešle zprávu ve tvaru '** nick zpráva'";
$text_cmd_motd_help =			"Zobrazi úvodní zprávu";
$text_cmd_myinfo_help =			"Zobrazí dostupné informace o Vás";
$text_cmd_myip_help =			"Ukáže Vaší IP";
$text_cmd_noctm_help =			"Zakázat uživatelovi stahovat z hubu";
$text_cmd_nopm_help =			"Zakázat uživatelovi posílat soukromé zprávy";
$text_cmd_nosearch_help =		"Zakázat uživatelovi hledat na hubu";
$text_cmd_ops_help =			"Pošle PM všem OPùm";
$text_cmd_passwd_help =			"Nastaví nové heslo (viz !regpasswd)";
$text_cmd_pkick_help =			"Kopne uživatele (Jen pokud je uzivaeli povoleno !maykick)";
$text_cmd_plugin_help =			"Instalovat plugin";
$text_cmd_pluglist_help =		"Seznam instalovaných pluginù";
$text_cmd_plugout_help =		"Odinstalovat plugin";
$text_cmd_plugreload_help =		"Znovu naèíst plugin";
$text_cmd_protect_help =		"Chrání uživatele proti kicknutí atd., default class: yourclass-1";
$text_cmd_quit_help =			"Ukonèit hub";
$text_cmd_rclass_help =			"Zmìnit class registrovanému uživatelovi";
$text_cmd_rdel_help =			"Smazat uživatele z databaze";
$text_cmd_rdisable_help =		"Deaktivivat uživatele (chová se jako kdyby uživatel v databázi nebyl)";
$text_cmd_reload_help =			"Znova naèíst konfiguraci";
$text_cmd_regme_help =			"Odešle žádost o registraci na OPchat";
$text_cmd_regs_help =			"Pošle PM všem registrovaným uživatelùm";
$text_cmd_renable_help =		"Aktivovat uživatele (viz !regdisable)";
$text_cmd_report_help =			"Pošle report na OPchat";
$text_cmd_rinfo_help =			"Zobrazí informace o registrovaném uživatelovi";
$text_cmd_rnew_help =			"Registrovat nového uživatele s danou class (když není dána žádná class, class = 1)";
$text_cmd_rpasswd_help =		"Povolit uživatelovi zmìnu hesla";
$text_cmd_rpasswd_err =			"Uživatel \"%s\" nabyl nalezenv databázi nebo nejste oprávnìn k této operaci";
$text_cmd_rprotect_help =		"Class > uživatel nesmí manipulovat s daným uživatelem";
$text_cmd_rhidekick_help =		"Toto mùže být použito treba u botù aby se nezobrazovali kicky";
$text_cmd_rset_help =			"Nastavit jakouliv promìnout u uøivatele. Dostupné promìné: nick, class, class_protect, class_hidekick, hide_kick, reg_date, reg_op, pwd_change, pwd_crypt, login_pwd, login_last, logout_last, login_cnt, login_ip, error_last, error_cnt, error_ip, enabled, email, note_op, note_usr";
$text_cmd_set_help =			"Nastavit promìnou (file = config)";
$text_cmd_vaset_help =			"Nastavit promìnou (file = VerliAdmin)";
$text_cmd_wip_help =			"Zobrazí uživatele na dané IP";
$text_cmd_wrange_help =			"Zobrazí uživatele na daném rozsahu IP adresy";
$text_cmd_flood_help =			"Zahltí uživatele zprávou na PM (velmi nepøíjemné :o) )";
$text_cmd_gag_help =			"Zakázat uživatelovi posílat zprávy do chatu";
$text_cmd_unban_help =			"Odstraní ban z databaze (nick a IP)";
$text_cmd_unbanemail_help =		"Zruší e-mail ban";
$text_cmd_unbanip_help =		"Odbanuje IP ale nick zùstane v databázi";
$text_cmd_unbanhost1_help =		"Odbanuje domému 1. øádu";
$text_cmd_unbanhost2_help =		"Odbanuje domému 2. øádu";
$text_cmd_unbanhost3_help =		"Odbanuje domému 3. øádu";
$text_cmd_unbanhostr1_help =	"Odbanuje zbytek domémy";
$text_cmd_unbannick_help =		"Odbanuje nick a nechá IP v banlistu";
$text_cmd_unbanprefix_help =	"Odbanuje pøedponu nicku";
$text_cmd_unbanrange_help =		"Odbanuje IP range který obsahuje specifikovanou IP";
$text_cmd_unbanshare_help =		"Zruší ban na velikost share";
$text_cmd_unhidekick_help =		"Opak !hidekick";
$text_cmd_userlimit_help =		"Nastaví doèasný limit uživatelù na 'time' minut. Default time: 60";
$text_command_line =			"Pøíkazová øádka";
$text_comment =					"Komentáø";
$text_changelog =		 		"Changelog";
$text_change_password =	 		"Zmìnit heslo";
$text_colum =					"Sloupeèek";
$text_command =					"Pøíkaz";
$text_commands =				"Pøíkazy";
$text_contains =				"Obsahuje";
$text_credits =			 		"Závìreèné titulky :)";
$text_crypted =					"Kryptovanì";
$text_database =				"Databáze";
$text_date =					"Datum";
$text_date_expires =			"Platné do";
$text_date_limit =				"Do";
$text_date_sent =				"Odesláno";
$text_date_start =				"Od";
$text_date_unban =				"Unbanováno";
$text_day =						"den";
$text_days =					"dní";
$text_december =				"Prosinec";
$text_del_inactive_users =		"Neaktivní uživatele";
$text_del_no_pwd_users =		"Uživatele s nenastaveným heslem";
$text_del_old_kicks =			"Smazat záznamy starší než";
$text_delete =					"Smazat";
$text_delete_user =				"Smazat uživatele";
$text_delreg_confirm =			"Opravdu chcete smazat uživatele";
$text_disable =					"Deaktivovat";
$text_disabled =				"Neaktivní";
$text_disable_user =			"Disablovat úèet";
$text_disreg_confirm =			"Opravdu chcete disablovat uživatele";
$text_documentation =			"Dokumentace";
$text_download_new =			"Na této adrese mùžete získat nejnovejší verzi VerliAdminu";
$text_edit_setup =				"Editovat konfiguraci";
$text_edit_trigger =			"Editovat file trigger";
$text_edit_user =				"Editovat úèet";
$text_enabled =					"Aktivní";
$text_encoding =				"Kódování";
$text_ends =					"Konèí";
$text_equal =					"Rovná se";
$text_error_cnt =				"Chyb";
$text_estimated =				"Oèekáváno";
$text_february =				"Únor";
$text_for =						"Po";
$text_for_class =				"Pro class";
$text_forum =					"Forum";
$text_filter =					"Filtr";
$text_gag_cmds =				"Umlèovací pøíkazy";
$text_greater =					"Více než";
$text_help =					"Nápovìda";
$text_hide_keys =				"Hide keys";
$text_homepage =				"Domovská stránaka VA";
$text_hours =					"Hodin";
$text_info_cmds =				"Info pøíkazy";
$text_language =				"Jazyk";
$text_january =					"Leden";
$text_june =					"Èerven";
$text_jully =					"Èervenec";
$text_less =					"Ménì než";
$text_login = 					"Pøihlásit";
$text_login_cnt = 				"Pøihlášení";
$text_logout =					"Odhlásit";
$text_main_chat =				"Hlavní chat";
$text_may =						"Kvìten";
$text_march =					"Bøezen";
$text_messanger =				"Messanger";
$text_minutes =					"Minut";
$text_month =					"mìsíc";
$text_month_stats =				"Mìsíèní statistiky";
$text_most_active_ip =			"Nejproblematiètìjší IP";
$text_most_active_nick =		"Nejproblematiètìjší nicky";
$text_most_active_op =			"Nejaktivnìjší OP";
$text_never =					"Nikdy";
$text_newest_version =			"Nejnovìjší verze VA";
$text_nick_reg =				"Nick registrován";
$text_no =						"Ne";
$text_no_ban =					"Žádný ban nebyl nalezen, Vaše žádost byla smazána";
$text_no_results =				"Žádné záznamy nenalezeny";
$text_noncrypted =				"Nekryptovanì";
$text_november =				"Listopad";
$text_optimize =				"Optimalizovat";
$text_other_cmds =				"Ostatní pøíkazy";
$text_others =					"A všem ostatním kteøí mi pomohli s tímto projektem...";
$text_octomber =				"Øíjen";
$text_overhead =				"Navíc";
$text_page_time =				"Stránka vygenerována za %s s";
$text_parametrs =				"Parametry";
$text_password =			 	"Heslo";
$text_password_confirm =		"Potvrdit heslo";
$text_pending =					"Èeká";
$text_permanent =				"Permanentní";
$text_pm =						"Soukromá zpráva";
$text_proto_cmds =				"Proto*_* pøíkazy";
$text_pwd_change_confirm =		"Opravdu chcete povolit zmìnu hesla uživateli \'%s\'";
$text_queries =					"Dotazù";
$text_query =					"Dotaz";
$text_reason =					"Dùvod";
$text_received =				"Pøijato";
$text_receiver =				"Pøíjemce";
$text_refuse =					"Odmítnut";
$text_refused =					"Odmítnuto";
$text_reg_cmds =				"Registrovcí pøikazy";
$text_reg_date =				"Registrován";
$text_register_nick =			"Registrovat";
$text_registered =				"Registrován nick";
$text_reply =					"Odpovìdìt";
$text_rows =					"Záznamù";
$text_search_stats =			"Statistika hledání";
$text_seconds =					"Sekund";
$text_send =					"Odeslat";
$text_send_msg =				"Poslat zprávu";
$text_send_notification =		"Odeslat e-mail";
$text_sender =					"Odesílatel";
$text_sender_ip =				"IP odesílatele";
$text_sent =					"Odesláno";
$text_september =				"Záøí";
$text_set_prefix =				"Nastavit prefix";
$text_set_subfix =				"Nastavit subfix";
$text_setup_cmds =				"Nastavovací pøikazy";
$text_share_size =				"Sdílení";
$text_share_stats =				"Statistika velikosti sdílení";
$text_shortcut =				"Zkratka";
$text_show =					"Zobrazit";
$text_size =					"Velikost";
$text_special_thanx =			"Specialní podìkování";
$text_subject =					"Pøedmìt";
$text_table =					"Tabulka";
$text_tb_optimize =				"Opravdu chcete optimalizovat tabulku %s";//0.3
$text_tb_truncate =				"Opravdu chcete vyprázdnit tabulku %s";//0.3
$text_this_version =			"Tato verze VA";
$text_time =					"Èas";
$text_total =					"Celkem";
$text_truncate =				"Vyprázdnit";
$text_translations =			"Pøeklady";
$text_unban =					"Unbanovat";
$text_unban_inserted =			"Vaše žádost o unban byla vložena do databáze, vyèkej na posouzení operátora";
$text_unban_request =			"Žádost o unban";
$text_unban_cmds =				"Odbanovávací pøikazy";
$text_unban_reason =			"Dùvod unbanu";
$text_unbaned =					"Odbanováno";
$text_unbans =					"Unbany";
$text_upload_stats =			"Statistika uploadu";
$text_user = 					"Uživatel";
$text_user_stats =				"Statistika poètu uživatelù";
$text_version =					"Verze";
$text_view_mode =				"Mód";
$text_week_stats =				"Týdenní statistika";
$text_year1 =					"rok";
$text_year2 =					"roky";
$text_year5 =					"let";
$text_yes =						"Ano";

$err_msg_bad_nick = 				"Uživatel nenalezen";
$err_msg_bad_pwd = 					"Nespravné heslo. Vyèkejte 30s a zkuste to znovu";
$err_msg_disabled_account =			"Váš úèet je deaktivován";
$err_msg_enter_body =				"Vložte tìlo zprávy";
$err_msg_enter_nick =				"Vložte svùj nick";
$err_msg_enter_receiver =			"Vložte nick pøíjemce";
$err_msg_enter_subject =			"Vložte pøedmìt zprávy";
$err_msg_guest_sending_as_reg =		"Nemùžete posélat zprávu jako registrovaný uživatel když nejste pøihlášen";
$err_msg_invalid_nick =				"Zadaný nick není platný";
$err_msg_no_access =				"Pøístup zamítnut";
$err_msg_no_answer =				"Zadejte nìjakou odpovìd";
$err_msg_no_user_found =			"Uživatel nenalezen";
$err_msg_no_unban_reason =			"Vplòte dùvod unbanu";
$err_msg_not_such_page =			"Stránka nenalezena nebo došlo k fatální chybì na stránce";
$err_msg_pwd_ch_not_allowed =		"Nemáte povoleni zmìnit si heslo. Požádejte nekoho s vyšší class než máte vy.";
$err_msg_pwd_match =				"Zadaná hesla si neodpovídají";
$err_msg_too_much_users_found =		"Pøíliš mnoho uživatelù naleno se stejným nickem";
$err_msg_unknown_command =			"Neznámý pøíkaz '%s' ('%s')\n Viz. '!help'";
$err_msg_user_exist =				"Uživatel již existuje";
$err_msg_wrong_vtype =				"Zadaná hodnota neodpovídá typu promìné";
?>
