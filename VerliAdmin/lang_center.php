<?
IF($_POST['submit_lang']) {
	Print "submit_lang provedeno";
	$lang = $_POST['mlanguage'];
	UnSet($_POST['submit_lang']);
	UnSet($_POST['lang']);

	WHILE(List($var, $val) = Each($_POST)) {
		$val = VA_Escape_String($DB_hub, $val);
		$val = HTMLSpecialChars($val);
		$DB_hub->Query("REPLACE INTO va_languages (language, var, val) VALUES ('".$lang."', '".$var."', '".Trim($val)."')");
		}
	}

$result = $DB_hub->Query("SELECT var, val FROM va_languages WHERE language LIKE 'en'");
?>

<FORM action="index.php?q=lang_center" method="post">
<TABLE class="b1 fs10px">
	<TR>
		<TD class="bg_light right" colspan=3><INPUT class="w75px" name="submit_lang" type="submit" value="<?Print $text_send;?>"></TD>
	</TR><TR>
		<TD class="b bg_light right">&nbsp;<?Print $text_language;?>&nbsp;:&nbsp;</TD>
		<TD class="bg_light"><INPUT class="w300px" name="mlanguage" type="text" value="<?Print LANG;?>"></TD>
		<TD class="bg_light">&nbsp;</TD>
	</TR><TR>
		<TD class="b bg_light right">&nbsp;</TD>
		<TD class="b bg_light">&nbsp;</TD>
		<TD class="b bg_light">&nbsp;</TD>
	</TR><TR>
		<TD class="b bg_light right">&nbsp;<?Print $text_var;?>&nbsp;:&nbsp;</TD>
		<TD class="b bg_light"><?Print $text_val;?></TD>
		<TD class="b bg_light"><?Print $text_var;?></TD>
	</TR>
<?WHILE($row = $result->Fetch_Assoc()) {?>
	<TR>
		<TD class="b bg_light right">&nbsp;<?Print $row['var'];?>&nbsp;:&nbsp;</TD>
		<TD class="bg_light">
			<INPUT class="w300px" name="<?Print $row['var'];?>" type="text" value="<?IF($$row['var']){Print $$row['var'];}ELSE{Print $row['val'];}?>">	
		</TD>
		<TD class="bg_light"><?Print $row['val'];?></TD>
	</TR>
<?	}?>
	<TR>
		<TD class="bg_light right" colspan=3><INPUT class="w75px" name="submit_lang" type="submit" value="<?Print $text_send;?>"></TD>
	</TR>
</TABLE>
</FORM>