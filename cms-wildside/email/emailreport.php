<?php
// This code is called by the tracking image call in the email.

// Initialize the database, using the protocol given by your web host:
$mysql= mysql_connect("mysql55.pointinspace.com", "LIG_lightship", "lightinusa", "lig_wildside");


//Get the parameters from your email tracking code. These are my parameters:
$campaignname = $_GET['campaign'];
$open = $_GET['open'];
$click = $_GET['click'];



$query = "INSERT INTO lig_wildside.w_email_report (campaign, open, clicks, dateadded) VALUES ('$campaignname', '$open', '$click', NOW())";
mysql_query($query) or die( mysql_error() );
mysql_close();
exit;
?>