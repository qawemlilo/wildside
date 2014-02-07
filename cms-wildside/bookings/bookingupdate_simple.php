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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Databse Records</title>

</head>

<body>
<div class="container">
<br/><br/>
</div>
<div class="container">
<div class="row">
<div class="span12">
<h2>Update Order</h2>
</div></div>


<?

if(!$_POST['submit'])
{

If ((!isset ($_GET['id']) || trim ($_GET['id']) == "")) 

{ 
die ('Missing Record id'); 
}





$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

$id = mysql_real_escape_string($_GET['id']);


$query = "SELECT * FROM w_orders
		  WHERE order_id = '$id'" ; 

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;


$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

// Select Company  
$querycompany = "SELECT DISTINCT company_id, company_name FROM w_company 
                 WHERE industry_category != 'agency'
                 ORDER by company_name ASC
	         ";
$resultcompany = mysql_query($querycompany);
while ($rowcompany = mysql_fetch_array($resultcompany)) 

{
	$com_id=$rowcompany["company_id"]; 
    $com_name=$rowcompany["company_name"]; 
    $optionscompany.="<OPTION VALUE=\"$com_id\">".$com_name. '</option>';
}


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


// Select Product Advertorial Size 
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




// Select Agent 
$query4 = "SELECT agent FROM w_agent
	         ";
$result4 = mysql_query($query4);
while ($row_agent = mysql_fetch_array($result4)) 
{
	$agent=$row_agent["agent"]; 
    $options_agent.="<OPTION VALUE=\"$agent\">".$agent. '</option>';
}


// Select Feature 
$query5 = "SELECT feature FROM w_feature
	         ";
$result5 = mysql_query($query5);
while ($row_feature = mysql_fetch_array($result5)) 
{
	$feature=$row_feature["feature"]; 
    $options_feature.="<OPTION VALUE=\"$feature\">".$feature. '</option>';
}





if(mysql_num_rows($result) > 0)
{


if (!$_POST ['submit'])
{
?>


<form method="post" action="" >

<input name='id' type='hidden' value="<?php echo $id; ?>" /> 
<input name='order_id' type='hidden' value="<?php echo $order_id; ?>" class=ibutton" /> 

<?php
while($rowname = mysql_fetch_array($result))
{


	
//SELECT PULL DOWN	
	
?>
<div class="row">
<div class="span4">
<fieldset>
<legend>Agent</legend>
<select name="agent" > 
<option value="<? echo $rowname['agent']?>" selected="selected"><? echo $rowname['agent']?> </option>       
<?=$options_agent?>                 
</select> 
</fieldset>


<fieldset>
<legend>Company being Advertised</legend>
<select name="company_id"> 
<option value="<? echo $rowname['company_id']?>" selected="selected"><? echo $rowname['company_name']?> </option> 
<?=$optionscompany?>             
</select> 
</fieldset>

<fieldset>
<legend>Agency doing the booking</legend>
<select name="agency_id" > 
<option value="<? echo $rowname['agency_id']?>" selected="selected"><? echo $rowname['agency_name']?> </option>
<option value="0">No</option>   
<?=$options_agency?>                 
</select> 
</fieldset>


<fieldset>
<legend>CI or Authorisation Number</legend>
<label for="ci_number">CI Number</label>
<input class="itext"   type="text"   id="ci_number"  name="ci_number" value="<? echo $rowname['ci_number']?>"/>
</fieldset>

<label for="order instructions">Order Instructions</label>
<textarea rows="3" class="span7"   type="text"   id="order_instructions"  name="order_instructions" value="<? echo $rowname['order_instructions']?> "/></textarea>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Info!</strong> Type instructions from the advertiser that need to appear on the booking form.
</div>



</div>

<div class="span4">

<fieldset>
<legend>Booking Details</legend>
<label>Edition</label><select name="edition_id"  class="iselect" style="font-size:14px;"> 
<option value="<? echo $rowname['edition_id']?>" selected="selected"><? echo $rowname['edition']?> </option>       
<?=$options_edition?>                 
</select> 

<label>Advert Size</label><select name="product_description_id"  class="iselect" style="font-size:14px;">    
<option value="<? echo $rowname['product_description_id']?>" selected="selected"><? echo $rowname['product_description']?> </option>    
<?=$options_advert_size?>                 
</select> 

<label>Advertorial</label><select name="product_advertorial_id"  class="iselect" style="font-size:14px;"> 
<option value="<? echo $rowname['product_advertorial_id']?>" selected="selected"><? echo $rowname['product_advertorial']?> </option>      
<?=$options_advertorial_size?>                 
</select> 


<label>Feature</label><select name="feature"  class="iselect" style="font-size:14px;"> 
<option value="<? echo $rowname['feature']?>" selected="selected"><? echo $rowname['feature']?> </option>       
<?=$options_feature?>                 
</select> 
</fieldset>

</div>

<div class="span4">
<fieldset>
<legend>Other Details</legend>

<fieldset>
<label for="order_price">Order Price (Change Price if you have to)</label>
<input class="itext"   type="text"   id="order_price"  name="order_price" value="<? echo $rowname['order_price']?>"/>
</fieldset>
<div class="alert alert-info" style="font-size:12px;line-height: 13px;">
The price above is what will show once you have updated the booking?
<br/><strong>Revert to Rate Card price?</strong> - Delete the contents and update.
<br/><strong>Change the price?</strong> - Enter a new value and update.
</div>

<label>Rate Other</label>
<select name="rate_other"  class="iselect" style="font-size:14px;">   
<option value="<? echo $rowname['rate_other']?>" selected="selected"><? echo $rowname['rate_other']?> </option>    
<option value="No"> No </option>  
<option value="Yes"> Yes </option>    
</select> 


<label>Vat</label>
<select name="vat_status"  class="iselect" style="font-size:14px;">    
<option value="<? echo $rowname['vat_status']?>" selected="selected"><? echo $rowname['vat_status']?> </option>    
<option value="14">14</option>   
<option value="0">0</option> 
</select> 

<?

echo '<label for=" discount percentage"> discount_percentage</label><input class="itext"   type="text"   id="discount_percentage"  name="discount_percentage" value="'.$rowname['discount_percentage']. '"/>'; 
?>

</div>
</div>
<hr/>
<div class="row">
<div class="span12">
<?
echo '<label for="order memo">Order Memo</label><textarea rows="3" class="span12"    type="text"   id="order_memo"  name="order_memo" value="'.$rowname['order_memo']. '"/>'.$rowname['order_memo']. '</textarea>';
?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Info!</strong> These instructions are to guide the editorial and studio team.
</div>

</div>
</div>
<?

}
?>
</fieldset>
<hr/>
<button type="submit" class="btn" name="submit"  value="Update this record">Update Record</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" class="btn btn-danger"  name="cancel" value="Delete this record"><a href="deletebooking.php?id=<?php echo $id; ?>" style="color:#fff;">Delete Record</a></button>





</form>




<?php
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
$company_id = $_POST['company_id'];

If ((!isset ($_POST['id']) || trim ($_POST['id']) == "")) 

{ 
die ('Missing Record id'); 
}


// PEOPLE form validation


$company_id = $_POST[ 'company_id'];
if (trim ($_POST[ 'company_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : company_id ';
}


$agency_id = $_POST[ 'agency_id'];
if (trim ($_POST[ 'agency_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : agency_id ';
}


$rate_other = $_POST[ 'rate_other'];
if (trim ($_POST[ 'rate_other' ]) =='')
{
 $errorList[] = 'Invalid entry for : rate_other ';
}


$discount_percentage = $_POST[ 'discount_percentage'];


$vat_status = $_POST[ 'vat_status'];
if (trim ($_POST[ 'vat_status' ]) =='')
{
 $errorList[] = 'Invalid entry for : vat_status ';
}


$edition_id = $_POST[ 'edition_id'];
if (trim ($_POST[ 'edition_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : edition_id ';
}

$product_description_id = $_POST[ 'product_description_id'];
if (trim ($_POST[ 'product_description_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : product_description_id ';
}

$product_advertorial_id = $_POST[ 'product_advertorial_id'];
if (trim ($_POST[ 'product_advertorial_id' ]) =='')
{
 $errorList[] = 'Invalid entry for : product_advertorial_id ';
}

$order_instructions = $_POST[ 'order_instructions'];
$ci_number = $_POST[ 'ci_number'];
$order_memo = $_POST[ 'order_memo'];
$agent = $_POST[ 'agent'];
$feature = $_POST[ 'feature'];








if (sizeof($errorList) == 0)

{

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

// CALCULATIONS FOR THE ORDER AND BOOKINF FORM
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

$agency_name= $row['company_name'];


// Edition
$query = "SELECT * FROM w_product_edition 
          WHERE edition_id= '".$edition_id."'
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

$edition=$row['edition'];


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


// FINAL SUB TOTALS AND TOTALS
$query = "SELECT * FROM w_orders
		  WHERE order_id='".$id."'
	         ";
$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());	
while ($row = mysql_fetch_array($result)) 		 
{


$discount_p= $row['discount_percentage'];			 


$discount_value_calc = (($order_price * $discount_percentage) / 100);
$discount_value=$discount_value_calc;




// Order price sub total
$order_price_subtotalcalc= $order_price - $discount_value;


// Order vat amount

$vatpercent= $row['vat_status'];

$ordervat= (($order_price_subtotalcalc * $vatpercent) / 100);


// Order Total
$ordertotal= $order_price_subtotalcalc + $ordervat;

}


// CALCULATIONS FOR THE ORDER AND BOOKINF FORM
// NBNBNBNBNBNBNBNBNNNNNNBBBBBNNNNNNNNNNBBBBB
// END
// ___________________________________________________________________________




$query = "UPDATE w_orders SET 

company_id='$company_id',

company_name='$company_name',

agency_id='$agency_id',

agency_name='$agency_name',

ci_number='$ci_number',

order_date_update = now(),

edition='$edition',

edition_id='$edition_id',

product_description='$product_description',

product_description_id='$product_description_id',

product_advertorial_id = '$product_advertorial_id',

product_advertorial = '$product_advertorial',

rate_other='$rate_other',

order_memo='$order_memo',

order_instructions ='$order_instructions',

order_price='$order_price',

discount_percentage='$discount_percentage',

discount_value='$discount_value',

order_price_subtotal='$order_price_subtotalcalc',

vat_status='$vat_status',

vat_total='$ordervat',

total='$ordertotal',

agent='$agent',

feature='$feature'

WHERE order_id = '$id' ";





$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());


echo '<div class="alert alert-success">Update successful.</div>
<button class="btn" type="button"><a href="bookingsdisplayplain.php?id='.$id.'">Display the record </a></button> or <button class="btn" type="button"><a href="bookings_edition.php">Go to Bookings Search</a></button>';

	
mysql_close($connection);

}

else
{
	?>

<div>
<a href="<?php $_SERVER ['PHP_SELF']; ?>" style="padding-left:15px;"><img name="" src="../css/linkback.png" width="40" height="40" alt=""/></a>
<a href="<?php $_SERVER ['PHP_SELF']; ?>"><i style="color:#FFF; padding-left:5px;">GO BACK TO FORM ENTRY</i></a></td></br></br></div>

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