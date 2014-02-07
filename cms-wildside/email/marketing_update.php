<?php
define('INCLUDE_CHECK',true);

require '../connect.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sugar Journal Marketing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

  </head>
<body>
<?php
if($_SESSION['id'])
{
?>

<div class="container">

<?php

$var =  mysql_real_escape_string(@$_GET['v']) ;

echo $var;

$query = "SELECT * FROM sj_marketing WHERE id
		 LIKE '".$var."' 
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 
{
  echo $row['Contact'];
}
?>



<?php
}
?>
<?php	include 'marketing_footer.php'; ?>
