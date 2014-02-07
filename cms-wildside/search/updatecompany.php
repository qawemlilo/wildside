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

<div class="container">
<div class="row">
<div class="span12">
<h3>UPDATE COMPANY</h3>
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
$company_id = $_GET['company_id'];


$query = "SELECT * FROM w_company
		  WHERE company_id = '$id'" ; 

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;


if(mysql_num_rows($result) > 0)
{


if (!$_POST ['submit'])
{
?>

<? // Select Company  
$querycat = "SELECT id, type FROM w_category 
       	  ORDER by type ASC
	         ";
$resultcat = mysql_query($querycat);
while ($rowcat = mysql_fetch_array($resultcat)) 

{
    $industry_category=$rowcat["type"]; 
    $options.="<OPTION VALUE=\"$industry_category\">".$industry_category. '</option>';
}
?>

<div class="span4">

<form method="post" action=""  class="iform">

<input name='id' type='hidden' value="<?php echo $id; ?>" /> 
<input name='company_id' type='hidden' value="<?php echo $company_id; ?>" class=ibutton" /> 
<legend>Company</legend>
<?php
while($rowname = mysql_fetch_array($result))
{
echo '<label for="company name">Company name</label><input class="itext"   type="text"   id="company_name"  name="company_name" value="'.$rowname['company_name']. '"/>'; 
echo '<label for="vat">Vat</label><input class="itext"   type="text"   id="vat"  name="vat" value="'.$rowname['vat']. '"/>'; 
echo '<label for="website">Website</label><input class="itext"   type="text"   id="website"  name="website" value="'.$rowname['website']. '"/>';
?>

<label for="industry_category">Industry Category</label><select name="industry_category"  class="iselect" style="font-size:14px;"> 
<option value="<? echo $rowname['industry_category']?>" selected="selected"><? echo $rowname['industry_category']?> </option>       
<?=$options?>                 
</select> 
 
</div>
<div class="span4">

<fieldset>
<legend>Address</legend>
<?
echo '<label for="address 1">address 1</label><input class="itext"   type="text"   id="address_1"  name="address_1" value="'.$rowname['address_1']. '"/>'; 
echo '<label for="address 2">address 2</label><input class="itext"   type="text"   id="address_2"  name="address_2" value="'.$rowname['address_2']. '"/>'; 
echo '<label for="city town area">City Town Area</label><input class="itext"   type="text"   id="city_town_area"  name="city_town_area" value="'.$rowname['city_town_area']. '"/>'; 
echo '<label for="postalcode">postalcode</label><input class="itext"   type="text"   id="postalcode"  name="postalcode" value="'.$rowname['postalcode']. '"/>'; 
echo '<label for="province state">province_state</label><input class="itext"   type="text"   id="province_state"  name="province_state" value="'.$rowname['province_state']. '"/>'; 
echo '<label for="country">country</label><input class="itext"   type="text"   id="country"  name="country" value="'.$rowname['country']. '"/>'; 
?>
</fieldset>
 
</div>
<div class="span4">

<fieldset>
<legend>Billing Address</legend>
<?
echo '<label for="b address 1">address 1</label><input class="itext"   type="text"   id="b_address_1"  name="b_address_1" value="'.$rowname['b_address_1']. '"/>'; 
echo '<label for="b address 2">address 2</label><input class="itext"   type="text"   id="b_address_2"  name="b_address_2" value="'.$rowname['b_address_2']. '"/>'; 
echo '<label for="b city town area">City Town Area</label><input class="itext"   type="text"   id="b_city_town_area"  name="b_city_town_area" value="'.$rowname['b_city_town_area']. '"/>'; 
echo '<label for="b postalcode">postalcode</label><input class="itext"   type="text"   id="b_postalcode"  name="b_postalcode" value="'.$rowname['b_postalcode']. '"/>'; 
echo '<label for="b province state">Province State</label><input class="itext"   type="text"   id="b_province_state"  name="b_province_state" value="'.$rowname['b_province_state']. '"/>'; 
echo '<label for="b country">Country</label><input class="itext"   type="text"   id="b_country"  name="b_country" value="'.$rowname['b_country']. '"/>'; 
?>
</fieldset>
 
</div>

<?
}
?>

<div class="span12">
<hr/>
<button type="submit" class="btn" name="submit"  value="Update this record">Update Record</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" class="btn btn-danger"  name="cancel" value="Delete this record"><a href="deletecompany.php?id=<?php echo $id; ?>" style="color:#fff;">Delete Record</a></button>
</div>





</div>




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


//COMPANY form validation



$company_name = $_POST[ 'company_name'];
if (trim ($_POST[ 'company_name' ]) =='')
{
 $errorList[] = 'Invalid entry for : company_name ';
}

$vat = $_POST[ 'vat'];


$website = $_POST[ 'website'];




$industry_category = $_POST[ 'industry_category'];
if (trim ($_POST[ 'industry_category' ]) =='')
{
 $errorList[] = 'Invalid entry for : industry_category ';
}

$address_1 = $_POST[ 'address_1'];

$address_2 = $_POST[ 'address_2'];

$city_town_area = $_POST[ 'city_town_area'];

$postalcode = $_POST[ 'postalcode'];


$province_state = $_POST[ 'province_state'];


$country = $_POST[ 'country'];


$b_address_1 = $_POST[ 'b_address_1'];


$b_address_2 = $_POST[ 'b_address_2'];



$b_city_town_area = $_POST[ 'b_city_town_area'];


$b_postalcode = $_POST[ 'b_postalcode'];



$b_province_state = $_POST[ 'b_province_state'];



$b_country = $_POST[ 'b_country'];






if (sizeof($errorList) == 0)

{

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


$query = "UPDATE w_company SET 

company_name='$company_name',

vat='$vat',

website='$website',

industry_category='$industry_category',

address_1='$address_1',

address_2='$address_2',

city_town_area='$city_town_area',

postalcode='$postalcode',

province_state='$province_state',

country='$country',

b_address_1='$b_address_1',

b_address_2='$b_address_2',

b_city_town_area='$b_city_town_area',

b_postalcode='$b_postalcode',

b_province_state='$b_province_state',

b_country='$b_country',
dateupdated = NOW()
WHERE company_id = '$id' ";





$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());


echo '<p></br></br>Update successful.</br></br>&nbsp; <a href=display.php?id='.$id.' style="color:#FFF;">Display the record </a> </p>';

	
mysql_close($connection);

}

else
{
	?>
<div class="row">
<div class="span12">
<a href="<?php echo $_SERVER['http_referrer']; ?>" style="padding-left:15px;"><img name="" src="../css/linkback.png" width="40" height="40" alt=""/></a>
<a href="<?php echo $_SERVER['http_referrer']; ?>"><i style="color:#FFF; padding-left:5px;">GO BACK TO FORM ENTRY</i></a></td></br></br
></div>
</div>

<?


{   echo '<div>';
	echo '</br><p> The following errors were encountered :';
	echo '</br>';
	echo '<ul>';
	for ($x=0; $x<sizeof($errorList); $x++)
	echo '<li style="padding-right:15px;">'.$errorList[$x].'';
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