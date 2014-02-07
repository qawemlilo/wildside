<?php
	require_once('auth.php');
	require_once('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My Profile</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://www.wildsidesa.co.za/fonts/stylesheet.css" type="text/css" charset="utf-8" media="screen">
</head>
<body>

<br/><br/><br/><br/>
<div id="wrapper">
<div id="container">
<div id="left_box">
<div id="logo"></div>
</div>
<div id="right_box">
<p><a href="member-index.php">Home</a> | <a href="logout.php">Logout</a></p>
<p><span class="headline_small">Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></span></p>
<h2 style="text-align:left;" >Your Wildside Subscription Profile </h2>
<p>

<?php

	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {die('Failed to connect to server: ' . mysql_error());}
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {die("Unable to select database");}
	
$member_email= $_SESSION['SESS_LOGIN'];
$query = "SELECT * FROM w_subscribers WHERE email='$member_email' "; 
$result = mysql_query($query) or die("Couldn't execute query");


$numresults=mysql_query($query) ;
$numrows=mysql_num_rows($numresults);


// If we have no results, offer a google search as an alternative

if ($numrows == 0)

  {
 echo '<span class="headline_small">Your link to your FREE Wildside subcription is below. Clik on the Green Rhino Cover and enjoy the read. <br/><br/> - the Wildside team.</h2>';
  }
	
	



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
</p>

<?
$date_begin= $row[date];
}
?>


</p>
</div>
</div>

<div id="clear"></div>

<div id="container">
<?php
$query_sub = "SELECT * FROM w_subscriber_edition WHERE edition_date>'$date_begin' AND edition_date< DATE_ADD('$date_begin', INTERVAL +360 DAY) "; 
$result_sub = mysql_query($query_sub) or die("Couldn't execute query");

echo '<h2 style="text-align:left;">Your Wildside subscriptions</h2>';
?>
<br/><br/>
<div id="subscriptionlink">
<a href="flip/mag2.php?edition=ws4of42011" style="text-align:left;"><img name="" src="cover_thumbs/ws4of42011.gif" width="150" height="202" alt="" /> </a>
</div>
<?
while ($row_sub= mysql_fetch_array($result_sub)) 

{
?>
<div id="subscriptionlink">
<?php  
  if  (date("Y-m-d") < $row_sub['edition_date']) 
 {
    echo '<span id="bold">'. $row_sub['edition']  . '</span> has not yet been published. This link will be available on the <span id="bold"> '. $row_sub['edition_date']. '</span>';
 }
else
 {
?>
<a href="flip/mag2.php?edition=<? echo $row_sub[edition];?>" style="text-align:left;"><img name="" src="cover_thumbs/<?php echo $row_sub['edition'] ?>.gif" width="150" height="202" alt="" />  </a>
<?	
 }
?>
</div>
<?
}
?>

</div>
</div>




</body>
</html>
