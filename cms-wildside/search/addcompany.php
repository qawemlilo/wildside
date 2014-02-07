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


<div class="containerdbbox" style=" background:none; ">

<div class="containerdbfloat" style="background-color:#67b0fc;">

<div class="div960backgroundnone">

<div class="div960blue" style=" border:none; "><strong style="font-size:17px; color: #FEFEFE; padding-left:15px;">ADD A NEW COMPANY</strong></div>
</div>

<div class="div960backgroundnone">


<? // Select Company  
$query = "SELECT id, type FROM w_category 
       	  ORDER by type ASC
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

{
    $cat_type=$row["type"]; 
    $options.="<OPTION VALUE=\"$cat_type\">".$cat_type. '</option>';
}
?>

<form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post" class="iform">
<ul>
<li><label for="company name">company_name</label><input class="itext" type="text" name="company_name"/></li> 
<li><label for="vat">vat</label><input class="itext" type="text" name="vat"/></li> 
<li><label for="website">website</label><input class="itext" type="text" name="website"/></li> 

<li>
<label for="industry_category">Industry Category</label><select name="industry_category"  class="iselect" style="font-size:14px;">
<option value="" selected="selected"> Select Category </option>     
<?=$options?>                 
</select></li> 
</fieldset>
<li></li>
<fieldset>
<legend>Address</legend>
<li><label for="address 1">address_1</label><input class="itext" type="text" name="address_1"/></li> 
<li><label for="address 2">address_2</label><input class="itext" type="text" name="address_2"/></li> 
<li><label for="city town area">city_town_area</label><input class="itext" type="text" name="city_town_area"/></li> 
<li><label for="postalcode">postalcode</label><input class="itext" type="text" name="postalcode"/></li> 
<li><label for="province state">province_state</label><input class="itext" type="text" name="province_state"/></li> 
<li><label for="country">country</label><input class="itext" type="text" name="country"/></li> 
</fieldset>
<li></li>
<fieldset>
<legend>Billing Address</legend>
<li><label for="b address 1">billing address_1</label><input class="itext" type="text" name="b_address_1"/></li> 
<li><label for="b address 2">billing address_2</label><input class="itext" type="text" name="b_address_2"/></li> 
<li><label for="b city town area">billing city_town_area</label><input class="itext" type="text" name="b_city_town_area"/></li> 
<li><label for="b postalcode">billing postalcode</label><input class="itext" type="text" name="b_postalcode"/></li> 
<li><label for="b province state">billing province_state</label><input class="itext" type="text" name="b_province_state"/></li> 
<li><label for="b country">billing country</label><input class="itext" type="text" name="b_country"/></li> 
</fieldset>
<li></li>
<li><label>&nbsp;</label><input class="ibutton" type="Submit" name="submit" value="Add record" /></li>
</ul>

</form>


<?php
}
else
{
	

$errorList = array ();


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


$query = "INSERT INTO
w_company (
company_name,
vat,
website,
industry_category,
address_1,
address_2,
city_town_area,
postalcode,
province_state,
country,
b_address_1,
b_address_2,
b_city_town_area,
b_postalcode,
b_province_state,
b_country,
dateadded
)

VALUES (

'$company_name',
'$vat',
'$website',
'$industry_category',
'$address_1',
'$address_2',
'$city_town_area',
'$postalcode',
'$province_state',
'$country',
'$b_address_1',
'$b_address_2',
'$b_city_town_area',
'$b_postalcode',
'$b_province_state',
'$b_country',
now()
)";






$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
?>
<div class="containerdbbox" style=" background:none; ">
<div class="containerdbfloat" style="background-color:#67b0fc;">
<div class="div960backgroundnone">
</br>
<p>
Record added successfully. Now add a contact person for this company</br>

<?
$id = $_GET['id'];

$query = " SELECT * FROM w_company
		   WHERE company_name = '$company_name'
            " ;

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;

$row = mysql_fetch_array ($result);

?>

<div class="div960backgroundnone" style=" margin-bottom:10px; width:959px;">
<div><p><?php echo $row['company_name'] ?> <?php echo $row['company_id'] ?></p>

<p><a href="addpeople.php?company_id=<?php echo $row['company_id'] ?>" class="whitelink"><strong>ADD A CONTACT TO THIS COMPANY</strong></a></p>

</div>
<div>



</br>
</p>
</div>
</div>
</div>

<?
	
mysql_close($connection);

}

else

{
	echo '<div class="containerdbbox">';
	echo '</br>';
	echo '<ul>';
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
	echo '<h1>&nbsp;&nbsp;Please, <a href="demo.php">login</a> and come back later!</h1>';
    	
}
?>



   
</br>

</div>
</div>

</body>
</html>