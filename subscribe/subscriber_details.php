
<!-- Address Details
 ================================================== -->

<?php if (!isset($_POST['submit'])) { ; ?>



<h4>Please enter the delivery address details to which you want Wildside sent.</h4>

<form action='' method='POST' id="register-form" novalidate="novalidate"> 

<input style="margin-bottom:5px;" type='text' class="form-control" placeholder="Email" name='email'/> 
<input style="margin-bottom:5px;" type='text' class="form-control" placeholder="Password" name='password'/>
 
<input style="margin-bottom:5px;" type='hidden' class="form-control" name='subscription_type' value="<?php echo $sub_type ;?>" /> 
<input style="margin-bottom:5px;" type='text'class="form-control" placeholder="First Name"  name='delivery_firstname'/> 
<input style="margin-bottom:5px;" type='text' class="form-control" placeholder="Surname" name='delivery_lastname'/> 
<input style="margin-bottom:5px;" type='text' class="form-control" placeholder="Telephone or Cell" name='tel'/> 
<input style="margin-bottom:5px;" type='text'class="form-control" placeholder="Address 1"  name='delivery_street_address'/> 
<input style="margin-bottom:5px;" type='text'class="form-control" placeholder="Address 2"  name='delivery_suburb'/> 
<input style="margin-bottom:5px;" type='text' class="form-control" placeholder="City or Town" name='delivery_city'/> 
<input style="margin-bottom:5px;" type='text' class="form-control" placeholder="Postal Code" name='delivery_postcode'/> 
<input style="margin-bottom:5px;" type='text' class="form-control" placeholder="Province or State" name='delivery_state'/> 
<input style="margin-bottom:5px;" type='text'class="form-control" placeholder="Country"  name='delivery_country'/> 
<br/>
<br/>
<input type="submit" name="submit" value="Register" class="submit btn btn-outline-inverse btn-lg">
</form>

 



<? 

}/* end form show */

else

{


?>



<?php
if (isset($_POST['submit'])) { 



/* Connect to database */
define('INCLUDE_CHECK',true);
require 'connect.php';
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');



/* SUBMIT FORM AFTER SANITIZE */

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `w_subscribers` ( `password`, `subscription_type` ,  `delivery_firstname` , `delivery_lastname` , `email` ,  `tel` ,  `delivery_street_address` ,  `delivery_suburb` ,  `delivery_city` ,  `delivery_postcode` ,  `delivery_state` ,  `delivery_country` , `date`  ) VALUES( '{$_POST['password']}' , '{$_POST['subscription_type']}' ,   '{$_POST['delivery_firstname']}' , '{$_POST['delivery_lastname']}' , '{$_POST['email']}' ,  '{$_POST['tel']}' ,  '{$_POST['delivery_street_address']}' ,  '{$_POST['delivery_suburb']}' ,  '{$_POST['delivery_city']}' ,  '{$_POST['delivery_postcode']}' ,  '{$_POST['delivery_state']}' ,  '{$_POST['delivery_country']}' ,  NOW()  ) "; 
mysql_query($sql) or die(mysql_error()); 


?>

<div class="well well-lg">
<h4 style="color:#333;"> Please click on the PayPal button below to complete your purchase </h4><br/> 
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="S2GHYAA7XBGH2">
<input type="hidden" name="first_name" value="<?php echo mysql_real_escape_string($_POST[ 'delivery_firstname']); ?>">
<input type="hidden" name="last_name" value="<?php echo mysql_real_escape_string($_POST[ 'delivery_lastname']); ?>">
<input type="hidden" name="address1" value="<?php echo mysql_real_escape_string($_POST[ 'delivery_street_address']); ;?>">
<input type="hidden" name="address2" value="<?php echo mysql_real_escape_string($_POST[ 'delivery_suburb']);?>">
<input type="hidden" name="city" value="<?php echo mysql_real_escape_string($_POST[ 'delivery_city']);?>">
<input type="hidden" name="state" value="<?php echo mysql_real_escape_string($_POST[ 'delivery_state']);?>">
<input type="hidden" name="country" value="<?php echo mysql_real_escape_string($_POST[ 'delivery_country']);?>">
<input type="hidden" name="zip" value="<?php echo mysql_real_escape_string($_POST[ 'delivery_postcode']);?>">
<input type="hidden" name="night_phone_a" value="<?php mysql_real_escape_string($_POST[ 'tel']);?>">
<input type="hidden" name="email" value="<?php echo mysql_real_escape_string($_POST[ 'email']);?>">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>


<? } } ?>
