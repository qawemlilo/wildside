<?php
	require_once('../auth.php');
	require_once('../config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {die('Failed to connect to server: ' . mysql_error());}
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {die("Unable to select database");}
?>

<?php
$q=$_GET["q"];

echo 'You have searched for: ' . $q;

echo '<br/><br/><br/>';

//Choose the path to table
$path = 'ws4of42011';

echo $path;


$sql = "SELECT * FROM $path" ; 
$result = mysql_query($sql);
$numrows=mysql_num_rows($result);

if(!$_POST['submit'])
{
	
		
?>
<table width="741" border="0" cellpadding="0" cellspacing="0">
<? include('pdf2text.php'); ?>
<?  
// Create FORM
echo "<form  method='post' action=''>\n";


while($row = mysql_fetch_array($result))
{	
?>
<tr>
<td width="585" valign="top">
<?php

$id=($row['id']);

$pdf = pdf2text ('../'.$path.'/'.$row['page']);

$pdf = preg_replace('/[^(\x20-\x7F)]*/','', $pdf);





print "<input type='text' name='id' value='$id' />";
print "<p><input type='text' size='40' name='text' value='$pdf' /></p>\n";
$query_update = "UPDATE $path SET text = '$pdf' WHERE id = '$id'";
mysql_query($query_update) or die ("Error in query: $query");
echo "$text<br /><br /><em>Updated!</em><br /><br />";
echo '<br/><br/>';
?>
</td>
<?
}
?>
</tr>
</table>
<?
print "<input type='submit' value='submit' />";
print "</form>";

}

?>


</body>
<html>