<?php

define('INCLUDE_CHECK',true);

require '../connect.php';


// DATABASE: Clean data before use
function clean($value)
{
	return mysql_real_escape_string($value);
}

/*
 * FORM PARSING
 */

// FORM: Variables were posted
if (count($_POST))
{
	// Prepare form variables for database
	foreach($_POST as $column => $value)
		${$column} = clean($value);

	// Perform MySQL UPDATE
	$result = mysql_query("UPDATE w_people SET ".$col."='".$val."'
		WHERE ".$w_col."='".$w_val."'")
		or die ('Unable to update row.');
}

?>