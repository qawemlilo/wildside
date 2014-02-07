<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>


<?php
	include '../maststrip.php'; 
if($_SESSION['id'])
{
include '../menu.php'; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Databse Records</title>
<link href="../css/db.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/form.css" type="text/css" />
</head>

<body>



<div class="row">
<div class="span12">
<div class="alert alert-error">
<h4>You have deleted a booking</h4>
<?

if(!$_POST['submit'])
{

If ((!isset ($_GET['id']) || trim ($_GET['id']) == "")) 

{ 
die ('Missing Record id'); 
}


$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

$id = $_GET['id'];
$company_id = $_GET['company_id'];


$query = "DELETE FROM w_orders
		  WHERE order_id = '$id'" ; 

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;


mysql_close($connection);


echo '<p></br></br>Deletion successful.</br>';
echo '</div>';  
}
}



else 


{
	echo '<h1>&nbsp;&nbsp;Please, <a href="index.php">login</a> and come back later!</h1>';
    	
}

?>


   
</br>

</div>
</div>

</body>
</html>