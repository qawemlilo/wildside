<?php
define('INCLUDE_CHECK',true);

require 'connect.php';
require 'function.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
include 'maststrip.php'; 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>people</title>
<style type="text/css"> @import url("css.css"); </style> 
</head>
<body>

<?php
if($_SESSION['id'])
{


if (!mysql_connect($db_host, $db_user, $db_pass))
    die("Can't connect to database");

if (!mysql_select_db($db_database))
    die("Can't select database");
	$table = 'w_my_cart';

// sending query
$result = mysql_query("SELECT * FROM {$table}");
if (!$result) {
    die("Query to show fields from table failed");
}

$fields_num = mysql_num_fields($result);

echo "<h1>Table: {$table}</h1>";
echo "<table border='0' width='800'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($result);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";
// printing table rows
while($row = mysql_fetch_row($result))
{
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
        echo "<td>$cell</td>";

    echo "</tr>\n";
}
mysql_free_result($result);

}
?>
</body>
</html>
