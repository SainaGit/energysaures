<?php
require_once 'configu.php';

$dbConn = mysql_connect ($dbHost, $dbUser, $dbPass) or die ('MySQL cannot connect database. ' . mysql_error());
mysql_select_db($dbName) or die('Cannot select from MySQL database. ' . mysql_error());

function dbQuery($sql)
{
	$result = mysql_query($sql) or die(mysql_error());
	return $result;
}

function dbFetchAssoc($result)
{
	return mysql_fetch_assoc($result);
}

function dbNumRows($result)
{
	return mysql_num_rows($result);
}

function dbInsertId()
{
	return mysql_insert_id();
}
?>