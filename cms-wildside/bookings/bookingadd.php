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


<?php
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

// Select Company  
$query = "SELECT DISTINCT company_id, company_name FROM w_company 
          WHERE industry_category != 'agency'
		  ORDER by company_name ASC
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

{
	$com_id=$row["company_id"]; 
    $com_name=$row["company_name"]; 
    $options.="<OPTION VALUE=\"$com_id\">".htmlentities($com_name). '</option>';
}

?>
<?php
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

// Select Agency  
$queryagency = "SELECT DISTINCT company_id, company_name FROM w_company 
				WHERE industry_category= 'agency'
				ORDER by company_name ASC
	         ";
$resultagency = mysql_query($queryagency);
while ($rowagency = mysql_fetch_array($resultagency)) 
{
    $com_agency=$rowagency["company_name"]; 
	$com_agency_id=$rowagency["company_id"]; 
    $options_agency.="<OPTION VALUE=\"$com_agency_id\">".$com_agency. '</option>';
}
?>


<?php
// Select Edition  
$query1 = "SELECT edition_id, edition FROM w_product_edition 
		 ORDER by edition_id ASC
	         ";
$result1 = mysql_query($query1);
while ($row_edition = mysql_fetch_array($result1)) 
{
    $ord_edition=$row_edition["edition"]; 
	$ord_edition_id=$row_edition["edition_id"]; 
    $options_edition.="<OPTION VALUE=\"$ord_edition_id\">".$ord_edition. '</option>';
}
?>

<?php
// Select Product description Advert Size 
$query2 = "SELECT product_id, description FROM w_product_description 
		 ORDER by product_id ASC
	         ";
$result2 = mysql_query($query2);
while ($row_advert_size = mysql_fetch_array($result2)) 
{
	$advert_size_id=$row_advert_size["product_id"]; 
    $advert_size=$row_advert_size["description"]; 
    $options_advert_size.="<OPTION VALUE=\"$advert_size_id\">".$advert_size. '</option>';
}
?>

<?php
// Select Product description Advert Size 
$query3 = "SELECT product_id, description FROM w_product_advertorial 
		 ORDER by product_id ASC
	         ";
$result3 = mysql_query($query3);
while ($row_advertorial_size = mysql_fetch_array($result3)) 
{
	$advertorial_size_id=$row_advertorial_size["product_id"]; 
    $advertorial_size=$row_advertorial_size["description"]; 
    $options_advertorial_size.="<OPTION VALUE=\"$advertorial_size_id\">".$advertorial_size. '</option>';
}
?>

<?php
// Select Agent 
$query4 = "SELECT agent FROM w_agent
	         ";
$result4 = mysql_query($query4);
while ($row_agent = mysql_fetch_array($result4)) 
{
	$agent=$row_agent["agent"]; 
    $options_agent.="<OPTION VALUE=\"$agent\">".$agent. '</option>';
}

?>

<?php
// Select feature 
$query5 = "SELECT feature FROM w_feature
	         ";
$result5 = mysql_query($query5);
while ($row_feature = mysql_fetch_array($result5)) 
{
	$area=$row_feature["feature"]; 
    $options_feature.="<OPTION VALUE=\"$area\">".$area. '</option>';
}
?>

<div class="row">
<div class="span12">
<h2>Add a new Booking</h2>
</div></div>
<div class="row">
<div class="span4">

<form action="<?php $_SERVER ['PHP_SELF']; ?>" method="post" >

<fieldset>
<legend>Agent</legend>

<select name="agent"  style="font-size:14px;">   
<option value="">Select</option>      
<?=$options_agent?>                 
</select>
</fieldset>

<fieldset>
<legend>Company being Advertised</legend>

<select name="company"   style="font-size:14px;"> 
<option value="">Select</option>         
<?=$options?>                 
</select>
</fieldset>

<fieldset>
<legend>Agency doing the booking</legend>
<select name="agency_id"   style="font-size:14px;">    
<option value="0">No</option>   
<?=$options_agency?>                 
</select> 
</fieldset>



<fieldset>
<legend>CI or Authorisation Number</legend>
<label for="ci_number">CI Number</label><input    type="text"   id="ci_number"  name="ci_number" value=""/>
</fieldset>

</div>
<div class="span4">

<fieldset>
<legend>Booking Details</legend>
<label>Edition</label><select name="edition_id"   style="font-size:14px;">
<option value="">Select</option>       
<?=$options_edition?>                 
</select>

<label>Advert Size</label><select name="product_description_id"   style="font-size:14px;">
<option value="">Select</option>        
<?=$options_advert_size?>                 
</select> 

<label>Advertorial</label><select name="product_advertorial_id"   style="font-size:14px;"> 
<option value="">Select</option>       
<?=$options_advertorial_size?>                 
</select>

<label>Feature</label><select name="feature"   style="font-size:14px;">
<option value="">Select</option>        
<?=$options_feature?>                 
</select>
</fieldset>

</div>
<div class="span4">
<fieldset>
<legend>Booking Specific Details</legend>
<label for="order_price">Order Price</label><input    type="text"   id="order_price"  name="order_price" value=""/>
</fieldset>
<div class="alert alert-error">
You might need to change the Price if you have to? <strong>(Otherwise leave this field blank or empty)</strong>
</div>

<fieldset>
<label>Vat</label>
<select name="vat_status"   style="font-size:14px;">      
<option value="14">14</option>   
<option value="0">0</option> 
</select> 



<label>Rate Other</label>
<select name="rate_other"   style="font-size:14px;">      
<option value="No"> No </option>  
<option value="Yes"> Yes </option>    
</select> 

<label>Discount Percentage</label>

<select name="discount_percentage"   style="font-size:14px;">
<option value"0">0</option>
<option value="16.50"> 16.50 </option>
<option value"">-</option>       
<option value="2.50"> 2.50 </option>  
<option value="5"> 5 </option> 
<option value="7.50"> 7.50 </option> 
<option value="10"> 10 </option> 
<option value="12.50"> 12.50 </option>     
</select> 
</fieldset>
</div>
</div>
<hr />
<div class="row">
<div class="span12">

<label>Add your new Record</label><input class="btn btn-success" type="Submit" name="submit" value="Add record" />
</form>
</div>
</div>

<?php
}
else
{

// Validation 
$errorList = array ();


$company_id = $id = mysql_real_escape_string($_POST[ 'company']);
if (trim ($_POST[ 'company' ]) =='')
{
 $errorList[] = 'Invalid entry for : company ';
}

$agency_id = mysql_real_escape_string($_POST[ 'agency_id']);
if (trim ($_POST[ 'agency_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : agency_id ';
}

$edition_id = mysql_real_escape_string($_POST[ 'edition_id']);
if (trim ($_POST[ 'edition_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : edition_id ';
}

$product_description_id = mysql_real_escape_string($_POST[ 'product_description_id']);
if (trim ($_POST[ 'product_description_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : product_description_id ';
}
$product_advertorial_id = mysql_real_escape_string($_POST[ 'product_advertorial_id']);
if (trim ($_POST[ 'product_advertorial_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : product_advertorial_id ';
}

$vat_status = mysql_real_escape_string($_POST[ 'vat_status']);
if (trim ($_POST[ 'vat_status' ]) =='')
{
 $errorList[] = 'Invalid entry for : vat_status ';
}

$rate_other = mysql_real_escape_string($_POST[ 'rate_other']);
if (trim ($_POST[ 'rate_other' ]) =='')
{
 $errorList[] = 'Invalid entry for : rate_other ';
}
$discount_percentage = mysql_real_escape_string($_POST[ 'discount_percentage']);
if (trim ($_POST[ 'discount_percentage' ]) =='')
{
 $errorList[] = 'Invalid entry for : discount_percentage ';
}

$agent= mysql_real_escape_string($_POST[ 'agent']);
if (trim ($_POST[ 'agent' ]) =='')
{
 $errorList[] = 'Invalid entry for : agent ';
}

$feature= mysql_real_escape_string($_POST[ 'feature']);
if (trim ($_POST[ 'feature' ]) =='')
{
 $errorList[] = 'Invalid entry for : Feature ';
}

$ci_number = mysql_real_escape_string($_POST[ 'ci_number']);



if (sizeof($errorList) == 0)


{
	
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

// CALCULATIONS FOR THE ORDER AND BOOKING FORM
// NBNBNBNBNBNBNBNBNNNNNNBBBBBNNNNNNNNNNBBBBB
// BEGIN
// ___________________________________________________________________________

// company being advertised 
$query = "SELECT company_name FROM w_company 
          WHERE company_id= '".$company_id."'
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$company_name= $row['company_name'];
$company_name = str_replace("'", "&#039;", $company_name);

// Agency
$query = "SELECT company_name FROM w_company 
          WHERE company_id= '".$agency_id."'
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$agency_name = $row['company_name'];
$agency_name = str_replace("'", "&#039;", $agency_name);


// Edition
$query = "SELECT edition FROM w_product_edition 
          WHERE edition_id= '".$edition_id."'
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$edition= $row['edition'];

// Product description
$query = "SELECT * FROM w_product_description 
          WHERE product_id= '".$product_description_id."'
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$product_description = ($row['product']. ' - '. $row['dimension']);


// Product advertorial
$query = "SELECT * FROM w_product_advertorial 
          WHERE product_id= '".$product_advertorial_id."'
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$product_advertorial = ($row['description']. ' - '. $row['dimension']);


// Product dimension
$query = "SELECT * FROM w_product_description 
          WHERE product_id= '".$product_description_id."'
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$product_description = ($row['description']. ' - '. $row['dimension']);


// Product price


if (trim ($_POST[ 'order_price' ]) =='')
{
$query = "SELECT * FROM w_product_price 
          WHERE product_description_id= '".$product_description_id."' AND order_year = DATE_FORMAT(NOW(),'%Y')
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$order_price = $row['price'];
}
else
{
$order_price = $_POST[ 'order_price'];
}

// Order /Invoice id
$query = "SELECT id FROM w_orders
		  ORDER BY id DESC
		  LIMIT 1 
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$order_id_a = $row['id'];
$order_id_b = 100;
$order_id_c = $order_id_a + $order_id_b;
$order_id = ('SJ '.$order_id_c);


// CALCULATIONS FOR THE ORDER AND BOOKINF FORM
// NBNBNBNBNBNBNBNBNNNNNNBBBBBNNNNNNNNNNBBBBB
// END
// ___________________________________________________________________________


$query = "INSERT INTO
w_orders (
order_id,
company_id,
company_name,
agency_id,
agency_name,
ci_number,
edition_id,
edition,
product_description_id,
product_description,
product_advertorial_id,
product_advertorial,
order_price,
rate_other,
vat_status,
discount_percentage,
feature,
agent,
order_date)

VALUES (   

'$order_id',
'$company_id',
'$company_name',
'$agency_id',
'$agency_name',
'$ci_number',
'$edition_id',
'$edition',
'$product_description_id',
'$product_description',
'$product_advertorial_id',
'$product_advertorial',
'$order_price',
'$rate_other',
'$vat_status',
'$discount_percentage',
'$feature',
'$agent',
now()
)";

$idsearch= $order_id;
$id= $_GET['id'];


$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
?>

</br>
<div class="alert alert-success">
Record added successfully.</br>
<a href="bookingsdisplayplain.php?id=<?php echo $idsearch ?>"><strong>TAKE ME TO THE BOOKING</strong></a>
</div>

<?php
// FINAL SUB TOTALS AND TOTALS
$query = "SELECT * FROM w_orders
		  WHERE order_id='".$idsearch."'
	         ";
$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());	
$row = mysql_fetch_array($result);





$order_p= $row['order_price'];

$discount_p= $row['discount_percentage'];			 


$discount_value_calc = (($order_price * $discount_percentage) / 100);
$discount_value=$discount_value_calc;




// Order price sub total
$order_price_subtotal= $order_p - $discount_value;


// Order vat amount

$vatpercent= $row['vat_status'];

$ordervat= (($order_price_subtotal * $vatpercent) / 100);


// Order Total
$ordertotal= $order_price_subtotal + $ordervat;



$query = "UPDATE w_orders SET
order_date = now(),
discount_value='$discount_value',
order_price_subtotal='$order_price_subtotal',
vat_total='$ordervat',
total='$ordertotal'
WHERE order_id='".$idsearch."' 
";

$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

	
mysql_close($connection);

}

else

{
?>
    <div class="alert alert-block alert-error">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Warning!</h4> Best check your form, it's not looking too good.<br/>
</div>
<FORM><button type="Input" class="btn" VALUE="Go Back" onClick="history.go(-1);return true;">Go Back</button> </FORM>
<?
	echo '<div>';
	echo '</br>';
	echo '<ul class="nav nav-tabs nav-stacked">';
	for ($x=0; $x<sizeof($errorList); $x++)
{
    echo "<li>$errorList[$x]";
}
    echo '</ul></p>';
}
}


}
else 

{
	echo '<br/><br/><br/><br/><div class="container"><div class="row"><div class="span12"><h1>Please, <a href="demo.php">login</a> and come back later!</h1></div></div></div>';
    	
}
?>




</div>

</body>
</html>