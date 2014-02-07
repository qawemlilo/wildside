<?php
define('INCLUDE_CHECK',true);

require 'connect.php';

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body><?php
// connect to the database and select the correct database
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


// find out how many records there are to update
$size = count($_POST['text']);

echo $size;

// start a loop in order to update each record
$i = 0;
while ($i < $size) {
// define each variable
$text = $_POST['text'][$i];
$id = $_POST['id'][$i];

// do the update and print out some info just to provide some visual feedback
// you might need to remove the single quotes around the field names, for example bookinfo = '$bookinfo' instead of `bookinfo` = '$bookinfo'
$query = "UPDATE w_mag_1of42012 SET text = '$text' WHERE id = '$id' LIMIT 1";
mysql_query($query) or die ("Error in query: $query");
print "$text<br /><br /><em>Updated!</em><br /><br />";
++$i;
}
mysql_close();
?>
</body>
</html>