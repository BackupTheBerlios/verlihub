<?
/*
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

//---------------------------------------------------------------------

//Language name:
$lang_name = "Italian";
//Language by:
$lang_author = "Skull";
//Homepage:
$lang_http = "";
//Author's e-mail:
$lang_email = "";
//version:
$lang_version = "0.3 RC1";
//Choose encoding (add as many as you want):
$encoding[0] = "ISO-8859-1";

$text_about =					"Info";
$text_active_kicks =			"Solo attivi";
$text_add_new_setup =			"Aggiunge un nuovo valore di setup";
$text_add_new_trigger =			"Aggiunge un nuovo file di trigger";
$text_addreg =					"Registra un nuovo user";
$text_admin =					"Amministratore";
$text_all =						"Tutti";
$text_applies =					"Applica";
$text_april =					"Aprile";
$text_author =					"Autore";
$text_august =					"Agosto";
$text_averange =				"Media";
$text_ban_reason =				"Motivo del ban";
$text_ban_cmds =				"Comandi ban";
$text_banlist =			 		"Lista ban";
$text_ban_op =	 				"Bannato da";
$text_ban_type = 				"Tipo ban";
$text_begins =					"Inizia";
$text_body =					"Corpo";
$text_bug_report = 				"Rapporto bug";
$text_changelog =		 		"Cambio log";
$text_change_password =	 		"Cambio password";
$text_chief_op =				"OP Capo";
$text_class =			 		"Classe";
$text_class_protect =			"Classe protetta";
$text_class_hidekick =			"Classe kick nascosto";
$text_colum =					"Colonna";
$text_cmd_ban_help =			"Ban permanente dell'IP con questo motivo";
$text_cmd_banemail_help =		"Aggiungi l'e-mail permanentemente alla lista dei ban";
$text_cmd_banhost_help =		"Aggiungi l'host permanentemente alla lista dei ban";
$text_cmd_banip_help =			"Ban permanente dell'IP, ma non del nick, anche se il kick e' presente nel database";
$text_cmd_bannick_help =		"Ban permanente del nick";
$text_cmd_banshare_help =		"Aggiungi la dimensione dello share permanentemente alla lista dei ban";
$text_cmd_bantemp_help =		"Ban temporaneo dell'IP (e possibilmente del nick)";
$text_cmd_drop_help =			"Disconnette lo user dall'hub, il kick(tempban) viene applicato";
$text_cmd_gc_help =				"Ottiene la configurazione";
$text_cmd_getinfo_help =		"Ottiene l'ip e l'hostname del nick dato";
$text_cmd_getip_help =			"Ottiene l'ip del nick dato";
$text_cmd_gethost_help =		"Ottiene l'hostname del nick dato";
$text_cmd_infoban_help =		"Ottiene informazione sui ban";
$text_cmd_kick_help =			"Kicca lo user dalla linea di comando. Puoi usare _ban_ o _ban_#x (dove # = numero, x = tempo (m = minuti, h = ore, d = giorni, w = settimane, M = mesi, y = anni)) come parte del motivo per bannare qualcuno";
$text_cmd_noctm_help =			"Vieta allo user il download dall'hub";
$text_cmd_nopm_help =			"Vieta allo user di mandare messaggi privati (PM)";
$text_cmd_nosearch_help =		"Vieta allo user di fare ricerche sull'hub";
$text_cmd_passwd_help =			"Setta una nuova password (vedi anche !regpasswd)";
$text_cmd_rclass_help =			"Cambia classe o registra utente";
$text_cmd_rdel_help =			"Cancella completamente l'utente dal database";
$text_cmd_rdisable_help =		"Disabilita user registrato (appare come se user non in database)";
$text_cmd_renable_help =		"Abilita user registrato";
$text_cmd_rinfo_help =			"Mostra informazioni su uno user registrato";
$text_cmd_rnew_help =			"Registra un nuovo user con la classe inserita (quando non e' specificata nessuna classe allora classe = 1)";
$text_cmd_rpasswd_help =		"Permette allo user di cambiare la sua password";
$text_cmd_rprotect_help =		"Se 'class' > classe user allora non puo' intervenire (Es. Op non puo' far nulla a capo Op)";
$text_cmd_rhidekick_help =		"Nasconde i kick. Puo' essere utile per i bot p.e. per non mostrare i kick";
$text_cmd_rset_help =			"Setta una qualsiasi variabile. Variabili disponibili: nick, class, class_protect, class_hidekick, hide_kick, reg_date, reg_op, pwd_change, pwd_crypt, login_pwd, login_last, logout_last, login_cnt, login_ip, error_last, error_cnt, error_ip, enabled, email, note_op, note_usr";
$text_cmd_set_help =			"Setta valore";
$text_cmd_wip_help =			"Mostra le info whois sull'IP";
$text_cmd_wrange_help =			"Mostra le info whois sull'intervallo IP";
$text_cmd_flood_help =			"Flood user con un messaggio privato (molto brutto :o) )";
$text_cmd_gag_help =			"Vieta allo user di scrivere in mainchat";
$text_cmd_unban_help =			"Rimuove il ban dal database (sia nick che IP)";
$text_cmd_unbanip_help =		"Rimuove ban IP e lascia il nick nel database";
$text_cmd_unbanhost_help =		"Rimuove il ban dell'host dal database";
$text_cmd_unbannick_help =		"Rimuove il ban nick e lascia l'IP nel database";
$text_command =			 		"Comando";
$text_commands =				"Comandi";
$text_contains =				"Contiene";
$text_credits =			 		"Crediti :)";
$text_crypted =					"Criptato";
$text_date_expires =			"Scade";
$text_date_limit =				"Al";
$text_date_sent =				"Data spedita";
$text_date_start =				"Dal";
$text_date_unban =				"Reintegrato";
$text_day =						"giorno";
$text_december =				"Dicembre";
$text_def =						"Def";
$text_defval =					"Defval";
$text_delete_user =				"Cancella user";
$text_delreg_confirm =			"Vuoi veramente cancellare lo user";
$text_descr =					"Descrizione";
$text_disable =					"Disabilita";
$text_disabled =				"Disabilitato";
$text_disable_user =			"Disabilita account";
$text_disreg_confirm =			"Vuoi veramente disabilitare lo user";
$text_documentation =			"Documentazione";
$text_download_new =			"A questo link puoi trovare l'ultima versione del VerliAdmin";
$text_edit_setup =				"Modifica configurazione";
$text_edit_trigger =			"Modifica file trigger";
$text_edit_user =				"Modifica account";
$text_email	=					"E-mail";
$text_enabled =					"Abilitato";
$text_ends =					"Ends";
$text_equal =					"Uguale";
$text_error_cnt =				"Errori";
$text_error_ip =				"Errore IP";
$text_error_last =				"Ultimo errore";
$text_estimated =				"Stimato";
$text_february =				"Febbraio";
$text_for_class =				"Per classe";
$text_forum =					"Forum";
$text_file =					"File";
$text_file_trigger =			"File trigger";
$text_filter =					"Filtro";
$text_flags =					"Flags";
$text_gag_cmds =				"Comandi Bavaglio";
$text_guest =					"Ospite";
$text_hide_kick =				"Nascondi kick";
$text_help =					"Aiuto";
$text_host =					"Host";
$text_homepage =				"VA home page";
$text_info_cmds =				"Info comandi";
$text_ip =						"IP";
$text_is_drop =					"E' soppresso";
$text_january =					"Gennaio";
$text_jully =					"Luglio";
$text_june =					"Giugno";
$text_kicklist =			 	"Lista Kick";
$text_login = 					"Login";
$text_login_cnt =				"Logins";
$text_login_ip =				"Login IP";
$text_login_last =				"Ultimo login";
$text_login_pwd =				"Password login";
$text_logout =					"Logout";
$text_logout_last =				"Ultimo logout";
$text_main_chat =				"Chat principale";
$text_march =					"Marzo";
$text_master =					"Master";
$text_max =						"Massimo";
$text_may =						"Maggio";
$text_mass_presubfix =			"Prefisso /suffisso di massa";
$text_messanger =				"Messanger";
$text_min =						"Minimo";
$text_min_class =				"Classe minima";
$text_month =					"mese";
$text_month_stats =				"Statistiche mensili";
$text_most_active_ip =			"Gli IP piu' bannati / kiccati";
$text_most_active_nick =		"I nick piu' bannati / kiccati";
$text_most_active_op =			"L'OP piu' attivo";
$text_never =					"Mai";
$text_newest_version =			"Il VA piu recente";
$text_nick =					"Nick";
$text_no =						"No";
$text_noncrypted =				"Non criptato";
$text_note_op =					"Note OP";
$text_note_usr =				"Note user";
$text_november =				"Novembre";
$text_octomber =				"Ottobre";
$text_op =						"OP";
$text_other_cmds =				"Altri comandi";
$text_others =					"E a tutti gli altri che mi hanno aiutato in questo progetto...";
$text_parametrs =				"Parametri";
$text_password =			 	"Password";
$text_password_confirm =		"Conferma password";
$text_permanent =				"Permanente";
$text_pm =						"Messaggio privato";
$text_pwd_change =				"Cambio password";
$text_pwd_change_confirm =		"Vuoi veramente permettere il cambio password allo user &#039;%s&#039;";
$text_pwd_crypt =				"Password criptata";
$text_range_fr =				"Intervallo IP da";
$text_range_to =				"Intervallo IP a";
$text_reason =					"Motivo";
$text_receiver =				"Destinatario";
$text_reg =						"Registrazione";
$text_reg_cmds =				"Comandi registrazione";
$text_reg_date =				"Data reg";
$text_reg_op =					"Reg da OP";
$text_reglist =					"Lista Registrati";
$text_reset =					"Reset";
$text_rows =					"Righe";
$text_send =					"Invia";
$text_send_as =					"Invia come";
$text_send_msg =				"Invia messaggio";
$text_send_notification =		"Invia e-mail";
$text_sender =					"Mittente";
$text_september =				"Settembre";
$text_set_prefix =				"Setta prefisso";
$text_set_subfix =				"Setta suffisso";
$text_setup_cmds =				"Comandi setup";
$text_setuplist =				"Lista Setup";
$text_share_size =				"Share";
$text_share_stats =				"Statistiche share";
$text_shortcut =				"Scorciatoia";
$text_special_thanx =			"Ringraziamenti speciali";
$text_stats =					"Statistiche";
$text_subject =					"Oggetto";
$text_table =					"Table";
$text_this_version =			"Questo VA";
$text_time =					"Tempo";
$text_total =					"Totale";
$text_translations =			"Traduzioni";
$text_unban =					"Reintegro";
$text_unban_cmds =				"Comandi reintegro";
$text_unbanlist =				"Lista Reintegro";
$text_unban_op =				"Op del reintegro";
$text_unban_reason =			"Motivo reintegro";
$text_upload =					"Upload";
$text_upload_stats =			"Statistiche upload";
$text_user = 					"User";
$text_user_stats =				"Statistiche user";
$text_val =						"Valore";
$text_var =						"Variabile";
$text_vip =						"VIP";
$text_view_mode =				"Vista";
$text_vtype =					"Vtype";
$text_week_stats =				"Statistiche settimanali";
$text_yes =						"Si'";
$err_msg['bad_nick'] = 				"Nickname non corretto";
$err_msg['bad_pwd'] = 				"Password non corretta";
$err_msg['disabled_account'] =		"Il tuo account e' disabilitato";
$err_msg['enter_body'] =			"Inserisci il corpo del messaggio";
$err_msg['enter_nick'] =			"Inserisci il tuo nick";
$err_msg['enter_recsiver'] =		"Inserisci il nick del destinatario";
$err_msg['enter_subject'] =			"Inserisci l'oggetto";
$err_msg['guest_sending_as_reg'] =	"Non puoi mandare un messaggio come user registrato se non sei loggato";
$err_msg['invalid_nick'] =			"Nick non valido";
$err_msg['no_access'] =				"Non hai accesso a questa sezione";
$err_msg['no_addreg_access'] =		"Non hai i diritti per aggiungere / modificare questo user";
$err_msg['no_delete_rights'] =		"Non hai i diritti per cancellare questo user";
$err_msg['no_disable_rights'] =		"Non hai i diritti per disabilitare questo user";
$err_msg['no_edit_rights'] =		"Non hai i diritti per modificare questo user";
$err_msg['no_edit_setup_access'] =	"Non hai i diritti per modificare i settaggi";
$err_msg['no_repass_priv'] = 		"Non puoi cambiare password a questo user";
$err_msg['no_user_found'] =			"User non trovato";
$err_msg['no_unban_access'] =		"Non hai i diritti per reintegrare";
$err_msg['no_unban_reason'] =		"Nessun motivo di reintegro";
$err_msg['not_such_page'] =			"Pagina non trovata";
$err_msg['pwd_ch_not_allowed'] =	"Non ti e' permesso cambiare la tua password. Chiedi a qualcuno con una classe piu' elevata della tua.";
$err_msg['pwd_match'] =				"Le password non corrispondono";
$err_msg['too_low_class'] =			"La tua classe è troppo bassa per entrare in VerliAdmin";
$err_msg['too_much_users_found'] =	"Trovati troppi user con lo stesso nick";
$err_msg['user_exist'] =			"User gia' esistente";
$err_msg['wrong_vtype'] =			"Il valore inserito non corrisponde a quello richiesto dal tipo di variabile";
?>
