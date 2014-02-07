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
if (!$_POST ['submit'])
{
?>

<div class="container"
<div class="row">
<div class="span4">

<form action="<?php $_SERVER ['PHP_SELF']; ?>" method="post" >
<fieldset>
<legend>Subscriber Details</legend><br />
<label for="delivery_firstname">First Name</label><input  type="text" name="delivery_firstname"/> 
<label for="delivery_lastname">Surname Name</label><input  type="text" name="delivery_lastname"/> 
<label for="email">Email</label><input  type="text" name="email"/> 
<label for="tel">Tel</label><input  type="text" name="tel"/> 

<label for="subscription_type">Subscription type</label>
<select name="subscription_type"  class="iselect" style="font-size:14px;">
<option value="" selected="selected"> Select Subscription type </option>
<option name="subscription_type" value="subscriber"> Subscriber </option>  
<option name="subscription_type" value="marketing"> Marketing </option>  
<option name="subscription_type" value="Wildside Warrior"> Wildside Warrior</option>
<option name="subscription_type" value="Wildside Warrior Subs SA"> Wildside Warrior Subs SA </option>
<option name="subscription_type" value="Wildside Warrior Subs International"> Wildside Warrior Subs International </option>
<option name="subscription_type" value="complimentary">complimentary</option>                 
</select> 
<label for="date">Date subscribed</label><input  type="text" name="date"/><br/>yyyy-mm-dd 
</fieldset>

</div>
<div class="span4">

<fieldset>
<legend>Delivery Address</legend><br />
<label for="delivery_street_address">street_address</label><input  type="text" name="delivery_street_address"/> 
<label for="delivery_suburb">suburb</label><input  type="text" name="delivery_suburb"/> 
<label for="delivery_city">city</label><input  type="text" name="delivery_city"/> 
<label for="delivery_postcode">postcode</label><input  type="text" name="delivery_postcode"/> 
<label for="delivery_state">state</label><input  type="text" name="delivery_state"/> 
<label for="delivery_country">country</label><input  type="text" name="delivery_country"/> 
</fieldset>

</div>
<div class="span3">

<fieldset>
<legend>Payment Confirmation</legend>
<label for="payment_confirmation">Payment id</label><input  type="text" name="payment_confirmation"/> 
</fieldset>

</div>
</div>
<hr />

<div class="row">
<div class="span12">
<input class="btn" type="Submit" name="submit" value="Add record" />
</form>
</div>
</div>
</div>
<?php
}
else
{
	

$errorList = array ();



$delivery_firstname = $_POST[ 'delivery_firstname'];
$delivery_lastname = $_POST[ 'delivery_lastname'];

$tel = $_POST[ 'tel'];
$date = $_POST[ 'date'];
$delivery_street_address = $_POST[ 'delivery_street_address'];
$delivery_suburb = $_POST[ 'delivery_suburb'];
$delivery_city = $_POST[ 'delivery_city'];
$delivery_postcode = $_POST[ 'delivery_postcode'];
$delivery_state = $_POST[ 'delivery_state'];
$delivery_country = $_POST[ 'delivery_country'];
$payment_confirmation = $_POST[ 'payment_confirmation'];
$subscription_type = $_POST[ 'subscription_type'];

$email = $_POST[ 'email'];
if (trim ($_POST[ 'email' ]) =='')
{
 $errorList[] = 'Invalid entry for : email ';
}


if (sizeof($errorList) == 0)

{
	

	
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


$query = "INSERT INTO
w_subscribers (
delivery_firstname,
delivery_lastname,
email,
tel,
subscription_type,
date,
delivery_street_address,
delivery_suburb,
delivery_city,
delivery_postcode,
delivery_state,
delivery_country,
payment_confirmation
)

VALUES (

'$delivery_firstname',
'$delivery_lastname',
'$email',
'$tel',
'$subscription_type',
'$date',
'$delivery_street_address',
'$delivery_suburb',
'$delivery_city',
'$delivery_postcode',
'$delivery_state',
'$delivery_country',
'$payment_confirmation'
)";






$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
?>
<div class="alert alert-info">
Record added successfully. 
<?
$id = $_GET['sub_id'];

?>
<p><a href="../subscribers/subscribers.php?q=<?Php echo $_POST[ 'delivery_lastname'] ?>" class="whitelink"><strong>Take me to this record</strong></a></p>

</div>



<?
	
mysql_close($connection);

}

else

{
	echo '<div class="alert alert-warning">';
	echo '</br>';
	echo '<ul>';
	for ($x=0; $x<sizeof($errorList); $x++)
{
    echo "<li>$errorList[$x]";
}
    echo '</ul></div>';
}
}


}
else 

{
	echo '<h1>&nbsp;&nbsp;Please, <a href="demo.php">login</a> and come back later!</h1>';
    	
}
?>



   
</br>


</div>

</body>
</html>