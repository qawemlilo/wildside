<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Subscriber</title>
<link href="./css/db.css" rel="stylesheet" type="text/css" />
<link href="../css/db.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
If ((!isset ($_GET['id']) || trim ($_GET['id']) == "")) 

{ 
die ('Missing Record id'); 
}


$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

$id = $_GET['id'];

$query = "SELECT * FROM w_subscribers
		  WHERE sub_id = '$id'" ; 

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;

while ($row= mysql_fetch_array($result)) 

{
?>
<p>

<table width="100%"  border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td><strong>Subscriber</strong></td>
    <td><strong>Delivery Address</strong></td>
    <td><strong>Subscription</strong></td>
  </tr>
  <tr>
    <td valign="top">
	<? echo $row[delivery_firstname].' '. $row[delivery_lastname];?> <br/>
    <? echo $row[email];?> <br/>
    <? echo $row[tel];?> <br/>
    </td>
    <td valign="top">
    <? echo $row[delivery_street_address];?><br/>
    <? echo $row[delivery_suburb];?> <br/>
    <? echo $row[delivery_city];?> <br/>
    <? echo $row[delivery_postcode];?> <br/>
    <? echo $row[delivery_state];?> <br/>
    <? echo $row[delivery_country];?> <br/>
    </td>
    <td valign="top">Date Subscribed: <br/> <? echo $row[date];?></td>
  </tr>
</table>
<br/>
<table width="100%"  border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td><strong>Payment Status</strong></td>
  </tr>
  <tr>
    <td valign="top">
	<? echo nl2br($row[payment_confirmation]) ;?> 
    </td>
  </tr>
</table>

</p>

<?
}
?>
</body>
</html>