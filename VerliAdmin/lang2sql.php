<?//Include "library.php";
$mysql_host = "localhost"; 			//MySQL host (usualy localhost)
$mysql_user = "root";				//MySQL username
$mysql_password = "";				//MySQL password
$mysql_database = "verlihub";		//MySQL database name

$DB_HUB = MySQL_Connect($mysql_host, $mysql_user, $mysql_password) OR Die(MySQL_Error());
MySQL_Select_DB($mysql_database, $DB_HUB) OR Die(MySQL_Error());

$file_en = File("scripts/languages/en.php");
$file = File("scripts/languages/en.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace("( =)|(\\\\)", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('en', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

UnSet($file);
$file = File("scripts/languages/cz.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace(" =", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('cz', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}
FOR($i = 0; $i < Count($file_en); $i++) {
	$file_en[$i] = Ereg_Replace("([\$\"\;\t])", "", $file_en[$i]);
	$file_en[$i] = Str_Replace("( =)|(\\\\)", "|", $file_en[$i]);
	$lang = Explode("|", $file_en[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('cz', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

UnSet($file);
$file = File("scripts/languages/de.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace(" =", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('de', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}
FOR($i = 0; $i < Count($file_en); $i++) {
	$file_en[$i] = Ereg_Replace("([\$\"\;\t])", "", $file_en[$i]);
	$file_en[$i] = Str_Replace("( =)|(\\\\)", "|", $file_en[$i]);
	$lang = Explode("|", $file_en[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('de', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

UnSet($file);
$file = File("scripts/languages/fr.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace(" =", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('fr', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}
FOR($i = 0; $i < Count($file_en); $i++) {
	$file_en[$i] = Ereg_Replace("([\$\"\;\t])", "", $file_en[$i]);
	$file_en[$i] = Str_Replace("( =)|(\\\\)", "|", $file_en[$i]);
	$lang = Explode("|", $file_en[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('fr', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

UnSet($file);
$file = File("scripts/languages/hun.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace(" =", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('hun', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

FOR($i = 0; $i < Count($file_en); $i++) {
	$file_en[$i] = Ereg_Replace("([\$\"\;\t])", "", $file_en[$i]);
	$file_en[$i] = Str_Replace("( =)|(\\\\)", "|", $file_en[$i]);
	$lang = Explode("|", $file_en[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('hun', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

UnSet($file);
$file = File("scripts/languages/ro.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace(" =", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('ro', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}
FOR($i = 0; $i < Count($file_en); $i++) {
	$file_en[$i] = Ereg_Replace("([\$\"\;\t])", "", $file_en[$i]);
	$file_en[$i] = Str_Replace("( =)|(\\\\)", "|", $file_en[$i]);
	$lang = Explode("|", $file_en[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('ro', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

UnSet($file);
$file = File("scripts/languages/pl.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace(" =", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('pl', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}
FOR($i = 0; $i < Count($file_en); $i++) {
	$file_en[$i] = Ereg_Replace("([\$\"\;\t])", "", $file_en[$i]);
	$file_en[$i] = Str_Replace("( =)|(\\\\)", "|", $file_en[$i]);
	$lang = Explode("|", $file_en[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('pl', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

UnSet($file);
$file = File("scripts/languages/lv.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace(" =", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('lv', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}
FOR($i = 0; $i < Count($file_en); $i++) {
	$file_en[$i] = Ereg_Replace("([\$\"\;\t])", "", $file_en[$i]);
	$file_en[$i] = Str_Replace("( =)|(\\\\)", "|", $file_en[$i]);
	$lang = Explode("|", $file_en[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('lv', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}

UnSet($file);
$file = File("scripts/languages/it.php");

FOR($i = 0; $i < Count($file); $i++) {
	$file[$i] = Ereg_Replace("([\$\"\;\t])", "", $file[$i]);
	$file[$i] = Str_Replace(" =", "|", $file[$i]);
	$lang = Explode("|", $file[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('it', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}
FOR($i = 0; $i < Count($file_en); $i++) {
	$file_en[$i] = Ereg_Replace("([\$\"\;\t])", "", $file_en[$i]);
	$file_en[$i] = Str_Replace("( =)|(\\\\)", "|", $file_en[$i]);
	$lang = Explode("|", $file_en[$i]);
	$lang[1] = MySQL_Escape_String($lang[1]);
	Query("INSERT delayed ignore INTO va_languages VALUES ('it', '".$lang[0]."', '".$lang[1]."', '".$lang[2]."')") OR Die("#".MySQL_ErrNo()." : ".MySQL_Error());
	}
?>
