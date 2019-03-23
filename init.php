<?php
/*--------------------------------------------------------------------
 * Filename:	init.php
 * Version:		0.15
 * Create Date: 2005-10-23
 * Updated at:	2007-10-11
 * Created by:	Áõº£ÖÛ	longbow0@163.com
 * Description: ³õÊŒ»¯ÏµÍ³¡£ÖØœšÊýŸÝ¿âºÍÈ«²¿±í¡£
--------------------------------------------------------------------*/
set_time_limit(0);

$host = 'localhost';
$admin = 'root';
$pass = '466920@e';
$pass = '@2.71828$';
echo '<br>Start init system...</br>';

$dblink = mysql_connect($host, $admin, $pass) or die("<br>" . mysql_error() . "</br>");

$sqlstr = 'DROP DATABASE IF EXISTS `refman`;';

mysql_query($sqlstr) or die("<br>" . mysql_error() . "</br>");

//ŽŽœšÊýŸÝ¿ârefman, ±àÂë·œÊœutf8
$sqlstr = 'CREATE DATABASE IF NOT EXISTS `refman` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;';


mysql_query($sqlstr) or die("<br>" . mysql_error() . "</br>");

echo "<br>* Database REFMAN created successfully.</br>";

mysql_select_db('refman', $dblink) or die("<br>" . mysql_error() . "</br>");

#
# Create table 'tbl_ref'
#
$sqlstr = <<<EOS
CREATE TABLE IF NOT EXISTS `tbl_ref` ( 
id int unsigned NOT NULL auto_increment,	# id
mark varchar(255) NOT NULL default '',	# brief user notes
title varchar(255) NOT NULL,	# article title
authors varchar(255) NOT NULL,	# article authors
address text,	# communicate/address
abstract text,	# abstract
keywords varchar(255),	#
journal varchar(255) NOT NULL,	#
pub_year year default '0000',	# publish year
volume varchar(10),	#
issue varchar(10),	#
page_start varchar(10),	#
page_end varchar(10),	#
pmid varchar(15),	# PubMed ID
update_date date default '0000-00-00',	#
file_path varchar(255) default '',	#
class int unsigned,	# future:
owner int unsigned,	# future:

PRIMARY KEY (id),

# Indices
index idx_mark (mark),
index idx_title (title),
index idx_keyword (keywords),
index idx_pmid (pmid)
);
EOS;

mysql_query($sqlstr) or die("<br>" . mysql_error() . "</br>");
echo  "<br>* Table REFERENCE created successfully.</br>";

#
# Create table 'tbl_user'
#
$sqlstr = <<<EOS
CREATE TABLE IF NOT EXISTS `tbl_user` (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
user VARCHAR(20) NOT NULL,
pass VARCHAR(255) NOT NULL,
pri_ins CHAR(1) NOT NULL DEFAULT '', 
pri_del CHAR(1) NOT NULL DEFAULT '', 
pri_edit CHAR(1) NOT NULL DEFAULT '',

PRIMARY KEY(id),

INDEX idx_user(user),
INDEX idx_pri(pri_ins, pri_del, pri_edit)
);
EOS;

mysql_query($sqlstr) or die("<br>" . mysql_error() . "</br>");

echo '<br>* Table USER created successfully.</br>';

echo '<hr/>';

#
# Create ref_man database administrator 'admin'
# The actual MySQL account is ref_admin
#
$sqlstr = <<<EOS
INSERT INTO `tbl_user` SET
user = 'admin',
pass = PASSWORD('123456abcd'),
pri_ins = 'Y',
pri_del = 'Y',
pri_edit = 'Y';
EOS;

mysql_query($sqlstr) or die("<br>" . mysql_error() . "</br>");

echo '<br>* User ADMIN created.</br>';

# Grant previleges of account 'admin' to database 'refman'
$sqlstr = <<<EOS
GRANT ALL ON `refman`.* TO ref_admin@'%' IDENTIFIED BY '123456abcd';
EOS;

mysql_query($sqlstr) or die('<br>'. mysql_error() . '</br>');

echo '<br>* User ADMIN privilege granted!</br>';
echo '<hr/>';

#
# Create user 'guest' to browse table 'tbl_ref'
# The actual MySQL account 'ref_guest', without password
#
$sqlstr = <<<EOS
GRANT SELECT ON `refman`.`tbl_ref` to ref_guest;
EOS;

mysql_query($sqlstr) or die('<br>'. mysql_error() . '</br>');

$sqlstr = <<<EOS
INSERT INTO `tbl_user` SET
user = 'guest',
pass = '', 
pri_ins = 'N',
pri_del = 'N',
pri_edit = 'N';
EOS;

mysql_query($sqlstr) or die('<br>'. mysql_error() . '</br>');

echo '<br>Guest account created!</br>';
echo '<hr />';

echo '<br>INIT System Success!</br>';
?>
