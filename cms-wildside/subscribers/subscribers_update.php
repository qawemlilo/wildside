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

<div class="containerdbbox" style=" background:none; ">

<div class="containerdbfloat" style="background-color:#67b0fc;">

<div class="div960backgroundnone">

<div class="div960blue" style=" border:none; "><strong style="font-size:17px; color: #FEFEFE; padding-left:15px; padding-right:15px;">UPDATE SUBSCRIBER </strong></div>
</div>






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

$query = "SELECT * FROM w_subscribers
		  WHERE sub_id = '$id'" ; 

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;


if(mysql_num_rows($result) > 0)
{


if (!$_POST ['submit'])
{
	
while ($rowname = mysql_fetch_array($result)) 
{

?>
<form action="<?php echo $_SERVER ['../subscribers/PHP_SELF']; ?>" method="post" class="iform">
<input name='id' type='hidden' value="<?php echo $id; ?>" /> 

<ul>
<li><label for="delivery_firstname">First Name</label><input class="itext" type="text" name="delivery_firstname" value="<?php echo $rowname ['delivery_firstname']; ?>"/></li> 
<li><label for="delivery_lastname">Surname Name</label><input class="itext" type="text" name="delivery_lastname" value="<?php echo $rowname ['delivery_lastname']; ?>"/></li> 
<li><label for="email">Email</label><input class="itext" type="text" name="email" value="<?php echo $rowname ['email']; ?>"/></li> 
<li><label for="tel">Tel</label><input class="itext" type="text" name="tel" value="<?php echo $rowname ['tel']; ?>"/></li> 
<li>
<label for="subscription_type">Subscription type</label>
<select name="subscription_type"  class="iselect" style="font-size:14px;">
<option value="<?php echo $rowname ['subscription_type']; ?>" selected="selected"><?php echo $rowname ['subscription_type']; ?></option>
<option name="subscription_type" value="subscriber"> Subscriber </option>  
<option name="subscription_type" value="marketing"> Marketing </option>  
<option name="subscription_type" value="Wildside Warrior"> Wildside Warrior</option>
<option name="subscription_type" value="Wildside Warrior Subs SA"> Wildside Warrior Subs SA </option>
<option name="subscription_type" value="Wildside Warrior Subs International"> Wildside Warrior Subs International </option>
<option name="subscription_type" value="complimentary">complimentary</option>                 
</select></li> 
</fieldset>
<li><label for="date">Date subscribed</label><input class="itext" type="text" name="date" value="<?php echo $rowname ['date']; ?>"/></li> 
<li></br></li>
<fieldset>
<legend>Delivery Address</legend>
<li><label for="delivery_street_address">street_address</label><input class="itext" type="text" name="delivery_street_address" value="<?php echo $rowname ['delivery_street_address']; ?>"/></li> 
<li><label for="delivery_suburb">suburb</label><input class="itext" type="text" name="delivery_suburb" value="<?php echo $rowname ['delivery_suburb']; ?>"/></li> 
<li><label for="delivery_city">city</label><input class="itext" type="text" name="delivery_city" value="<?php echo $rowname ['delivery_city']; ?>"/></li> 
<li><label for="delivery_postcode">postcode</label><input class="itext" type="text" name="delivery_postcode" value="<?php echo $rowname ['delivery_postcode']; ?>"/></li> 
<li><label for="delivery_state">state</label><input class="itext" type="text" name="delivery_state" value="<?php echo $rowname ['delivery_state']; ?>"/></li> 
<li><label for="delivery_country">country</label><input class="itext" type="text" name="delivery_country" value="<?php echo $rowname ['delivery_country']; ?>"/></li> 
</fieldset>
<li></br></li>
<fieldset>
<legend>Payment Confirmation</legend>
<li><label for="payment_confirmation">Payment id</label>
  <textarea name="payment_confirmation" cols="100" rows="6" class="itext"><?php echo $rowname ['payment_confirmation']; ?></textarea>
</li>
</fieldset>
<li></br></li>
<li><input class="ibutton" type="Submit" name="submit" value="Update this record" /></li>
</ul>

</form>

<?php
}
}
else
{	
echo 'Your record could not be located';
}

}
else
{
	// form submitted
}


}
else
{


$errorList = array ();

$id = $_POST['id'];


If ((!isset ($_POST['id']) || trim ($_POST['id']) == "")) 

{ 
echo $id;
die ('Missing Record id'); 
}


//Subscriber form validation


$delivery_firstname = $_POST[ 'delivery_firstname'];
$delivery_lastname = $_POST[ 'delivery_lastname'];

$tel = $_POST[ 'tel'];
$date = $_POST[ 'date'];
$subscription_type = $_POST[ 'subscription_type'];

$delivery_street_address = $_POST[ 'delivery_street_address'];
$delivery_suburb = $_POST[ 'delivery_suburb'];
$delivery_city = $_POST[ 'delivery_city'];
$delivery_postcode = $_POST[ 'delivery_postcode'];
$delivery_state = $_POST[ 'delivery_state'];
$delivery_country = $_POST[ 'delivery_country'];
$payment_confirmation = $_POST[ 'payment_confirmation'];


$email = $_POST[ 'email'];
if (trim ($_POST[ 'email' ]) =='')
{
 $errorList[] = 'Invalid entry for : email ';
}


if (sizeof($errorList) == 0)

{

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


$query = "UPDATE w_subscribers SET 

delivery_firstname = '$delivery_firstname',
delivery_lastname = '$delivery_lastname',
email = '$email',
tel = '$tel',
subscription_type = '$subscription_type',
date = '$date',
delivery_street_address = '$delivery_street_address',
delivery_suburb = '$delivery_suburb',
delivery_city = '$delivery_city',
delivery_postcode = '$delivery_postcode',
delivery_state = '$delivery_state',
delivery_country = '$delivery_country',
payment_confirmation = '$payment_confirmation'
WHERE sub_id = '$id' ";



$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());


echo '<p></br></br>Update successful.</br></br>&nbsp; <a href=subscribers.php?q='.$delivery_lastname.' style="color:#FFF;">Display the record </a> </p>';

	
mysql_close($connection);

}

else
{
	?>

<div class="div960backgroundnone">
<a href="<?php echo $_SERVER['../subscribers/http_referrer']; ?>" style="padding-left:15px;"><img name="" src="../css/linkback.png" width="40" height="40" alt=""/></a>
<a href="<?php echo $_SERVER['../subscribers/http_referrer']; ?>"><i style="color:#FFF; padding-left:5px;">GO BACK TO FORM ENTRY</i></a></td></br></br
></div>

<?


{   echo '<div>';
	echo '</br><p> The following errors were encountered :';
	echo '</br>';
	echo '<ul>';
	for ($x=0; $x<sizeof($errorList); $x++)
	echo '<li style="padding-right:15px;">'.$errorList[$x].'</li>';
	echo '</ul></p>';
	echo '</div>'; 
{  
}
}
   
}
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