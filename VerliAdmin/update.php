<?
//Add setuplist.sql to database
RunSQL($DB_hub, "scripts/setuplist.sql");

//Add setuphelp.sql to database
RunSQL($DB_hub, "scripts/setuphelp.sql");

//---------------- Version specific -------------------------------------

IF($VA_count < 5) {
	RunSQL($DB_hub, "scripts/va_unban.sql");
	}
IF($VA_count < 7) {
	$DB_hub->Query("UPDATE SetupList SET var = 'file_trigger_flags' WHERE file = 'VerliAdmin' AND var = 'file_trigger_flag'");
	}

//---------------- Update version in table -------------------------------
$DB_hub->Query("REPLACE INTO SetupList (file, var, val) VALUES ('VerliAdmin', 'version', '".VA_COUNT."')");

$update_OK = TRUE;
?>