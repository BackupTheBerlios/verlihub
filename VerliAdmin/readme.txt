VerliAdmin v0.3.x help file

Instalation:
========================================================================

Insert setuplist.sql and setuphelp.sql into your verlihub database.
You can do it trought some MySQL administration tool like phpMyAdmin
or directly in MySQL.
mysql -u user -p -A Db < setuplist.sql
mysql -u user -p -A Db < setuphelp.sql


Table maitanance:
========================================================================

Truncate:
------------------------------------------------------------------------
minimum class = 10
Truncate operations drop and re-create the table

Optimize:
------------------------------------------------------------------------
minimum class = 5
Optimize free allocated but not used space in table


Plugins:
========================================================================

Messanger plugin :
------------------------------------------------------------------------
minimum class = SetupList -> messanger_min_class
To enable it, set messanger_min_class to something else
(recommended is 1) than 11.

Statistic plugin :
------------------------------------------------------------------------
To enble set stats_plugin to 1 (enabled).


Tested on:
========================================================================

Apache:		1.3.31
PHP:		4.3.8
MySQL:		2.0.20a
System:		Windows 98
Browsers:	MSIE 6.0 (Avant browser 9.02.33)
			Mozilla Firefox 0.9.2
			Opera 7.51