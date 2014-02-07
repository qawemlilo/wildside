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
$query = "SELECT DISTINCT company_id, company_name FROM w_company ORDER BY company_name ASC";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 
{
    $id=$row["company_id"]; 
    $thing=$row["company_name"]; 
    $options.="<OPTION VALUE=\"$id\">".$thing.'</option>';
} 	
?> 


<div class="containerdbbox" style=" background:none;">

<div class="containerdbfloat" style="background-color:#67b0fc;">

<div class="div960backgroundnone">

<div class="div960blue" style=" border:none; "><strong style="font-size:17px; color: #FEFEFE; padding-left:15px;">ADD A NEW BILLING PERSON</strong></div>
</div>
<div class="div960backgroundnone">

<form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post" class="iform">




<ul>
<li class="ilabel">SELECT COMPANY TO MATCH PERSON</br></li>

<li>
<select name="company_id" class="iselect" >
 <option value="">CLICK TO SELECT A COMPANY</option>          
<?=$options?>                 
</select>
</li> 

<li>&nbsp;&nbsp;
</li>

<li><label for="b_name_first">Billing First Name</label><input class="itext" type="text" name="b_name_first"/></li> 
<li><label for="b_name_last">Billing Last Name</label><input class="itext" type="text" name="b_name_last"/></li> 
<li><label for="b_tel">Billing Tel</label><input class="itext" type="text" name="b_tel"/></li> 
<li><label for="b_cell">Billing Cell</label><input class="itext" type="text" name="b_cell"/></li> 
<li><label for="b_fax">Billing Fax</label><input class="itext" type="text" name="b_fax"/></li> 
<li><label for="b_email">Billing Email</label><input class="itext" type="text" name="b_email"/></li> 
<li><label>&nbsp;</label><input class="ibutton" type="Submit" name="submit" value="Add Billing Person" /></li>
</ul>



</form>


<?php
}
else
{
	

$errorList = array ();


$b_name_first = $_POST['b_name_first'];
if (trim ($_POST['b_name_first']) =='')
{
 $errorList[] = 'Invalid entry for : Billing First Name ';
}
$b_name_last = $_POST['b_name_last'];
if (trim ($_POST['b_name_last']) =='')
{
 $errorList[] = 'Invalid entry for : Billing Name Last ';
}
$b_tel = $_POST['b_tel'];
$b_fax = $_POST['b_fax'];
$b_cell = $_POST['b_cell'];

$b_email = $_POST['b_email'];


$company_id = $_POST[ 'company_id'];
if ((trim ($_POST[ 'company_id' ]) =='') or (trim ($_POST[ 'company_id' ] == '')))
{
 $errorList[] = 'Please make a valid selection for : Company ';
 
 echo $_POST[ 'company_id'];
}





if (sizeof($errorList) == 0)

{
	
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


$query = "INSERT INTO
w_people (
company_id,
b_name_first,
b_name_last,
b_tel,
b_cell,
b_fax,
b_email,
dateadded
)

VALUES (

'$company_id',

'$b_name_first',

'$b_name_last',

'$b_tel',

'$b_cell',

'$b_fax',

'$b_email',
now()
)";






$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
?>
<div class="containerdbbox" style=" background:none; ">
<div class="containerdbfloat" style="background-color:#67b0fc;">
<div class="div960backgroundnone">
</br>
<p>
Record added successfully. <a href="display.php?id=<? echo $company_id ?>" style="color:#FFF;">Display the record </a> </br>
</br>
</p>
</div>
</div>
</div>

<?
	
mysql_close($connection);

}

else

{   echo '<div class="containerdbbox">';
	echo '<p> The following errors were encountered :';
	echo '</br>';
	echo '<ul>';
	for ($x=0; $x<sizeof($errorList); $x++)
{
    echo "<li>$errorList[$x]";
}
    echo '</ul></p></div>';
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