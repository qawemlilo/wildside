<?php

if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');


/* Database config */

$db_host		= 'mysql55.pointinspace.com';
$db_user		= 'LIG_lightship';
$db_pass		= 'lightinusa';
$db_database	= 'lig_wildside'; 

/* End config */

$myConnection = mysql_connect("$db_host","$db_user","$db_pass", "$db_database") or die ("could not connect to mysql");
mysql_query("SET names UTF8");
?>