<?
	Include "version.php";
	Include "library.php";

        $mysql = Parse_Ini_File("config.php", TRUE);
        IF($mysql['HUB']['multi']!=1) Die("MultiVerliAdmin not allowed");
?>

<HTML>
<HEAD>
<LINK type="Image/X-Icon" rel="Icon" href="img/favicon.ico">
<LINK type="Image/X-Icon" rel="ShortCut Icon" href="img/favicon.ico">
<LINK rel="StyleSheet" type="Text/CSS" href="default.css">
<META http-equiv="Content-Type" content="Text/HTML; Charset=<?Print $encoding;?>">
<META http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
<META http-equiv="Author" content="Kosa Gergely 2005 [zipi@dcinfo.org]">
<META http-equiv="Copyright" content="Kosa Gergely 2005 [zipi@dcinfo.org]">
<TITLE><? Print "MultiVerliAdmin";?></TITLE>
</HEAD>
<BODY>
<CENTER>
<FONT class="h1">VerliAdmin</FONT><BR>
<FONT class="h2">Select HUB</FONT>
			<BR><BR>
			<FORM method="post" action="index.php">
				<TABLE align="center" class="fs12px b1">
					<TR>
						<TD class="b right bg_light">HUB : </TD>
						<TD class="bg_light"><SELECT name="HubDB">
							<?
								$connection = mysql_connect($mysql['HUB']['host'],$mysql['HUB']['user'],$mysql['HUB']['password']);
								if(!$connection) die(mysql_error());

								$databases = mysql_list_dbs($connection);
								$numofdb = mysql_num_rows($databases);

								$i = 0;
								while ($i < $numofdb)
								{
									$ishub=0;
									$name = mysql_tablename($databases,$i);
									$qry = mysql_list_tables($name,$connection);
									while($table_row=mysql_fetch_row($qry))
										if($table_row[0]=="SetupList")
											$ishub=1;
									if ($ishub==1)
									{
										$qry = mysql_db_query($name," SELECT val FROM SetupList WHERE var LIKE 'hub_name'");
										while ($row = mysql_fetch_assoc($qry)) echo "<OPTION value=".$name.">".htmlspecialchars($row['val'])."</OPTION>";
									}
									$i++;
								}
							?>
						</SELECT></TD>
						</TR><TR>
						<TD class="right bg_light" colspan=2><CENTER><INPUT type="submit" name="submit" value="Start VA"></CENTER></TD>
					</TR>
				</TABLE>
			</FORM>
			<? Include "footer.php"; ?>
		</CENTER>
	</BODY>
</HTML>
